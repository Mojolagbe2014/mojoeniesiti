<?php
/**
 *	CLASS UPLOAD_IMAGE
 *	With this class you can upload an image and a thumbnail will be created.
 *	AUTHOR : ARJAN VELDKAMP (ARIE2ZERO.NL)
 *	Released 4 june 2009
**/

class upload_image {
	
	/**
	 * Before you use the function upload, make sure you defined:
	 	- extensions wich is an array
		- imageDir, the directory must have the write rights
		- thumbDir, the directory must have the write rights
		- thumb_x,	the width of the created thumbnail
		- size, the maximum filesize wich is allowed
		- blackbar, set this on true for thumnails with black bar
	**/
	public $extensions= array();
	public $imageDir;
	public $thumbDir;
	private $alert= array();
	public $thumb_x;
	private $thumb_y;
	public $blackBar=true;
	public $size;
	
	/**
	 *	Input: File
	 *	Output: true/false
	 *	Descrption: When the upload is succesfull this function will return true.
	 *	When mkthum is true, thumbnails will be created,
	 *	When overWrite is true, If there allready exists a file with this name the file will be overwritten
	**/
	public function upload($mkthumb=true, $overWrite=true) {
		if(is_uploaded_file($_FILES['bestand']['tmp_name'])) {
			$this->alert[] = 'Uploading in process';
			$this->alert[] = 'Type: '.$_FILES['bestand']['type'];
			if(is_dir($this->imageDir)) {
				$this->alert[] = 'Directory found!';
				$ext = strtolower(array_pop(explode('.', $_FILES['bestand']['name'])));
				if(in_array($ext, $this->extensions)) {
					$file = $this->convert_file($_FILES['bestand']['name']);
					if($_FILES['bestand']['size'] < $this->size) {
						if($this->write($file, $overWrite) == true) {
							if(move_uploaded_file($_FILES['bestand']['tmp_name'], $file)) {
								chmod($file, 0777);
								if($mkthumb == true) { $this->thumbnail($file, $ext, $_FILES['bestand']['name']); }
								$this->alert[] = 'Your file has been uploaded succesfully';
								$this->alert[] = 'URL: '.$file;
								return true;
							} else { $this->alert[] = 'Cannot move '.$_FILES['bestand']['name'].' to '. $file; return false; }
						}
					} else { $this->alert[] = 'Overwriting maximum MB'; return false; }
				} else { $this->alert[] = 'This extension is not allowed!'; }
			} else { $this->alert[] = 'The given location doesnt exist'; return false; }
		} else { $this->alert[] = 'No file given'; return false; }
	}
	
	/**
	 *	Input: filename, boolean, boolean
	 *	Output: New Filename
	 *	Description: Converts the filename to an valid filename
	 *	When forThumb is true, the filename will get an other name.
	 *	When meld is true, errormessages will be produced.
	**/
	
	private function convert_file($name, $forThumb=false, $meld=true) {
		
		$sFor = array(' ', "'", '\\', '"');
		$nname = str_replace($sFor, '_', $name);
		$nname = explode('.', $nname);
		$ext = array_pop($nname);
		$nname = implode('_', $nname) .'.'. $ext;
		
		if($forThumb == true) {
			$nname = explode('.', $nname);
			$file = strtolower($this->thumbDir .'thumb_'. $nname[0].'.png');
			if($meld == true) { $this->alert[] = 'Thumbnail renamed From: '.$name .' to '. $nname[0]; }
		} else {
			$file = strtolower($this->imageDir .$nname);
			if($meld == true) { $this->alert[] = 'File renamed From: '.$name .' to '. $nname; }
		}
		return $file;
	}
	
	/**
	 *	Input: Uploaded_file, extension, filename
	 *	Output: Resized file
	 * 	Description: This function will create thumbnails with a black bar on bottom
	 *	The thumnail will be .png and resize the height automaticly,
	 *	This function will not create a thumbnail if the given file is no image.
	**/
	
	private function thumbnail($file, $ext, $name) {
		$blBar = $this->blackBar;
		$this->alert[] = 'Trying to create Thumbnail';
		$exten = array('jpg', 'jpeg', 'gif', 'png');
		if(in_array($ext, $exten)) {
			if(is_dir($this->thumbDir)) {
				$this->alert[] = 'Thumb Directory found!';
				
				list($width, $height) = getimagesize($file);
				if($blBar == true) { 
					$this->thumb_y = round(($height/$width) * $this->thumb_x, 0) + 16; 
				} else $this->thumb_y = round(($height/$width) * $this->thumb_x, 0);
				
				$dest = imagecreatetruecolor($this->thumb_x, $this->thumb_y);
				if($ext == 'jpg' || $ext == 'jpeg') {
					$file = imagecreatefromjpeg($file);
				} elseif($ext == 'gif') {
					$file = imagecreatefromgif($file);	
				} elseif($ext == 'png') {
					$file = imagecreatefrompng($file);	
				} else $this->alert[] = 'Cant create thumbnail from this extension';
				if($blBar == true) { 
					$fill = $this->thumb_y - 16;
				} else $fill = $this->thumb_y;
				
				$wit = imagecolorallocate($dest, 255,255,255);
				imagecopyresampled($dest, $file, 0, 0, 0, 0, $this->thumb_x, $fill, $width, $height);
				if($blBar == true) {
					imagefilledrectangle($dest, 0, $fill, $this->thumb_x, $this->thumb_y, imagecolorallocate($dest, 0,0,0));
					$fill = $fill + 10;
					imagettftext($dest, 8, 0, 2, $fill, $wit, 'ARIAL.TTF', $name);
				}
				if(imagepng($dest, $this->convert_file($name, true))) {
					$this->alert[] = 'Thumbnail created!';
					$this->alert[] = 'Result: <br> <img src="'.$this->convert_file($name, true, false).'" />';
					imagedestroy($dest);
				} else $this->alert[] = 'No Thumnail created'; 
			} else $this->alert[] = 'The Thumb Directory has not been found!';
		} else $this->alert[] = 'Wrong extension to create Thumbnail';
	}
	
	/**
	 * Input: Filename, boolean
	 * Output: true/false
	 * Description: checks if the file allready exists
	**/
	
	private function write($file, $overWrite) {
		if(is_file($file)) { 
			$this->alert[] = 'Warning, this file allready exsist!'; 
			if($overWrite == true) {
				$this->alert[] = 'File has been overwritten';	
				return true;
			} else {
				$this->alert[] = 'File has not been uploaded, file may not be overwritten';
				return false;
			}
		} else return true;
	}
	
	/**
	 * Input: None
	 * Output: All alerts
	 * Description: This function will echo all created alerts while uploading.
	**/
	
	public function alert() {
		$txt = '<div style="width: 500px; background-color: #ccc; color: #f00; padding: 3px; text-align: center; border: 1px solid #000;">
				<b>THESE MESSAGES HAS BEEN RECEIVED:</b><br>';
		foreach($this->alert as $alert) {
			$txt .=  $alert .'<br>';
		}
		$txt .= '</div>';
		return $txt;
	}
}
?>

