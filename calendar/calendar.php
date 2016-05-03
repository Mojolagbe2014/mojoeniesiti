<?php
/**
*@author  Xu Ding
*@email   thedilab@gmail.com
*@website http://www.StarTutorial.com
**/
class Calendar {  
     
    /**
     * Constructor
     */
    public function __construct($subID){ 
        $this->naviHref = htmlentities($_SERVER['PHP_SELF']);
		$this->SubscriberID = $subID;
    }
     
    /********************* PROPERTY ********************/  
    private $dayLabels = array("Monday","Tuesday","Wednesday","Thursday","Friday","Saturday","Sunday");
     
    private $currentYear=0;
     
    private $currentMonth=0;
     
    private $currentDay=0;
     
    private $currentDate= NULL ;
     
    private $daysInMonth=0;
     
    private $naviHref= NULL;
	
	private $SubscriberID = NULL;
	
	private $months = array("0","January","February","March","April","May","June","July","August","September","October","November","December");
     
    /********************* PUBLIC **********************/  
        
    /**
    * print out the calendar
    */
    public function show() {
        $year  = NULL;
         
        $month = NULL;
         
        if($year == NULL && isset($_GET['year'])){
 
            $year = $_GET['year'];
         
        }else if($year == NULL){
 
            $year = date("Y",time());  
         
        }          
         
        if($month == NULL && isset($_GET['month'])){
 
            $month = $_GET['month'];
         
        }else if($month == NULL){
 
            $month = date("m",time());
         
        }                  
        $this->currentYear=$year;
         
        $this->currentMonth=$month;
         
        $this->daysInMonth=$this->_daysInMonth($month,$year); 
		
		$startYear = 2010;
		$option = "";
		for($currentYear = date('Y',strtotime("+ 2years")); $currentYear >= $startYear ; $currentYear --){
				$option .='<option value="'.$currentYear.'">'.$currentYear.'</option>';
		} 
        $content='<div id="calendar">'.
						'<div class="box">'.
						'<select name="year" style="margin:10px 20px 10px 0px; float: right;" id="year_change">
  							<option value="">Select Year</option>'.
								$option.
						'</select>'.
						'</div><div class="months_header"><ul>'.
						$this->_createMonths().
						'</ul></div>'.
                        '<div class="box">'.
                        $this->_createNavi().
                        '</div>'.
                        '<div class="box-content">'.
                                '<ul class="label"></ul>';   
                                $content.='<div class="clear"></div>';     
                                $content.='<ul class="dates">';    
                                 
                                $weeksInMonth = $this->_weeksInMonth($month,$year);
                                // Create weeks in a month
                                for( $i=0; $i<$weeksInMonth; $i++ ){
                                     
                                    //Create days in a week
                                    for($j=1;$j<=7;$j++){
                                        $content.=$this->_showDay($i*7+$j);
                                    }
                                }
                                $content.='</ul>';
                                 
                                $content.='<div class="clear"></div>';     
             
                        $content.='</div>';
                 
        $content.='</div>';
        return $content;   
    }
     
    /********************* PRIVATE **********************/ 
    /**
    * create the li element for ul
    */
    private function _showDay($cellNumber){
         
        if($this->currentDay==0){
             
            $firstDayOfTheWeek = date('N',strtotime($this->currentYear.'-'.$this->currentMonth.'-01'));
                     
            if(intval($cellNumber) == intval($firstDayOfTheWeek)){
                 
                $this->currentDay=1;
                 
            }
        }
         
        if(($this->currentDay!=0)&&($this->currentDay<=$this->daysInMonth)){
             
            $this->currentDate = date('Y-m-d',strtotime($this->currentYear.'-'.$this->currentMonth.'-'.($this->currentDay)));
             
            $cellContent = $this->currentDay;
             
            $this->currentDay++;   
             
        }else{
             
            $this->currentDate =null;
 
            $cellContent=null;
        }
           
		   $todayClass = ($this->currentDate == date("Y-m-d")) ? 'style="background-color:#FFFFCC;"' : '';
		   $ajaxLink = ($this->currentDate != '') ? ' data-type="ajax" href="'.SITE_URL.'sub/get-event?date='.base64_encode($this->currentDate).'" ' : '';
		   $ajaxHook = ($this->currentDate != '') ? ' calendar ' : '';
		   $dayOfWeek = ($this->currentDate != '') ? '<div class="day_of_week">'.date('D',strtotime($this->currentDate)).'</div>' : '';
         
        return '<li id="li-'.$this->currentDate.'"><a class="'.($cellNumber%7==1?' start ':($cellNumber%7==0?' end ':' ')).
                ($cellContent==null?'mask':'').$ajaxHook.'" '.$todayClass.$ajaxLink.' >'.$dayOfWeek.$cellContent.$this->GetEventCount().'</a></li>';
    }
     
    /**
    * create navigation
    */
    private function _createNavi(){
         
        $nextMonth = $this->currentMonth==12?1:intval($this->currentMonth)+1;
         
        $nextYear = $this->currentMonth==12?intval($this->currentYear)+1:$this->currentYear;
         
        $preMonth = $this->currentMonth==1?12:intval($this->currentMonth)-1;
         
        $preYear = $this->currentMonth==1?intval($this->currentYear)-1:$this->currentYear;
        return
            '<div class="header">'.
                '<a class="prev" href="'.$this->naviHref.'?month='.sprintf('%02d',$preMonth).'&year='.$preYear.'">Prev</a>'.
                    '<span class="title">'.date('Y F',strtotime($this->currentYear.'-'.$this->currentMonth.'-1')).'</span>'.
                '<a class="next" href="'.$this->naviHref.'?month='.sprintf("%02d", $nextMonth).'&year='.$nextYear.'">Next</a>'.
            '</div>';
    }
         
    /**
    * create calendar week labels
    */
   /* private function _createLabels(){  
                 
        $content='';
         
        foreach($this->dayLabels as $index=>$label){
             
            $content.='<li class="'.($label==6?'end title':'start title').' title">'.$label.'</li>';
 
        }
         
        return $content;
    }*/
	
	/**
    * create calendar months labels
    */
	 private function _createMonths(){  
	 	
		$currentYear = $this->currentYear;
         $content = '';
        foreach($this->months as $index=>$month){
			 if($index > 0){
				 
				 $style = ($index == 1) ? "style='margin-left:15px;'" : ''; 
				 $result= MysqlSelectQuery("select * from my_events a, events b where subscriber_id='".$this->SubscriberID."' and b.event_id=a.event_id and sortDate like'%".$currentYear.'-'.date('m',strtotime($month))."%'");
				 
           		$content.='<li '.$style.'><a href="'.$this->naviHref.'?month='.date('m',strtotime($month)).'&year='.$currentYear.'">'.substr($month,0,3).' ('.NUM_ROWS($result).')</a></li>';
			 }
 
        }
         
        return $content;
    }
     
	 private function GetEventCount(){
		 $result= MysqlSelectQuery("select * from my_events a, events b where subscriber_id='".$this->SubscriberID."' and b.event_id=a.event_id and sortDate='".$this->currentDate."'");
		 $rows = SqlArrays($result);
		 $num = NUM_ROWS($result);
		 $startDate = date("Y-m-d",strtotime($rows['startDate']));
		 $word = ($num > 1) ? 'events' : 'event';
		 return ($num > 0) ? '<div class="event_count">'.$num.' Saved '.$word.'</div>':'';
		 //return date('D',strtotime($this->currentDate));
	 }
     
  
    /**
    * calculate number of weeks in a particular month
    */
    private function _weeksInMonth($month=null,$year=null){
         
        if( null==($year) ) {
            $year =  date("Y",time()); 
        }
         
        if(null==($month)) {
            $month = date("m",time());
        }
         
        // find number of days in this month
        $daysInMonths = $this->_daysInMonth($month,$year);
         
        $numOfweeks = ($daysInMonths%7==0?0:1) + intval($daysInMonths/7);
         
        $monthEndingDay= date('N',strtotime($year.'-'.$month.'-'.$daysInMonths));
         
        $monthStartDay = date('N',strtotime($year.'-'.$month.'-01'));
         
        if($monthEndingDay<$monthStartDay){
             
            $numOfweeks++;
         
        }
         
        return $numOfweeks;
    }
 
    /**
    * calculate number of days in a particular month
    */
    private function _daysInMonth($month=null,$year=null){
         
        if(null==($year))
            $year =  date("Y",time()); 
 
        if(null==($month))
            $month = date("m",time());
             
        return date('t',strtotime($year.'-'.$month.'-01'));
    }
	public function headers(){
		$link = '<link rel="stylesheet" href="'.SITE_URL.'calendar/font-awesome/css/font-awesome.css" type="text/css" media="screen" />';
		$link .= '<link rel="stylesheet" href="'.SITE_URL.'calendar/venobox/venobox.css" type="text/css" media="screen" />';
		$link .= '<script type="text/javascript" src="'.SITE_URL.'calendar/venobox/venobox.min.js"></script>';
		return $link;
	}
}