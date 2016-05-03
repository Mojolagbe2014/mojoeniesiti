<?php
namespace nigerianseminarsandtrainings\app\classes;
// include composer autoload
require 'vendor/autoload.php';
// import the Intervention Image Manager Class
use Intervention\Image\ImageManager;

/**
* RssFeed
*/
class RssFeed
{
	public $url;
	function __construct($url)
	{
		$this->url = $url;
	}

	public function getChannel()
	{
		$xmlDoc = new \DOMDocument();
		$xmlDoc->load($this->url);
		$channel = $xmlDoc->getElementsByTagName('channel')->item(0);

		$channel_title = $channel->getElementsByTagName('title')->item(0)
			->childNodes->item(0)->nodeValue;
		$channel_link = $channel->getElementsByTagName('link')->item(0)
			->childNodes->item(0)->nodeValue;
		$channel_desc = $channel->getElementsByTagName('description')->item(0)
			->childNodes->item(0)->nodeValue;

		echo("<p><a href='". $channel_link . "'>" . $channel_title . "</a>");
		echo "<br />";
		echo($channel_desc . "</p>");
	}

	public function getItems($limit)
	{
		$xmlDoc = new \DOMDocument();
		$xmlDoc->load($this->url);
		$item = $xmlDoc->getElementsByTagName('item');
		for ($i=0; $i < $limit; $i++) { 
			$item_title = $item->item($i)->getElementsByTagName('title')->item(0)
				->childNodes->item(0)->nodeValue;
			$item_link = $item->item($i)->getElementsByTagName('link')->item(0)
				->childNodes->item(0)->nodeValue;
			$item_desc = $item->item($i)->getElementsByTagName('description')->item(0)
				->childNodes->item(0)->nodeValue;
			$unsave_image = substr($item->item($i)->getElementsByTagName('image')->item(0)
				->childNodes->item(0)->nodeValue, 45);
			$item_image = rawurldecode($unsave_image);
                        
                        // create an image manager instance with favored driver
                        $manager = new ImageManager(array('driver' => 'gd'));
                        // to finally create image instances
                        $interv_img = $manager->make($item_image)->resize(80, 60);
                        $interv_img->save("images/blog-images/$i.jpg");
                        
			$output = "<li>";
			$output .= "<img src='".SITE_URL.'images/blog-images/'.$i.".jpg' alt='".$item_title."'/>";
			$output .= "<span><a class='blog-url' href='".$item_link ."'>".$item_title ."</a></span>";
			$output .= "</li>";
			echo $output;
		}
	}
}