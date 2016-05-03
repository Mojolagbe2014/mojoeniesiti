<?php
	if(isset($_GET['search'])){
		//$search = str_replace("&","and",$_GET['search']);
		switch($_GET['search']){
			case"Health":
			header("HTTP/1.1 301 Moved Permanently");
	
			header("location: events/categories/15/Health-HSE");
			break;
			case"Education":
			header("HTTP/1.1 301 Moved Permanently");
	
			header("location: events/categories/6/Education");
			break;
			case"State Governments":
			header("HTTP/1.1 301 Moved Permanently");
	
			header("location: events/categories/14/Governance");
			break;
			case"Media and Communication":
			header("HTTP/1.1 301 Moved Permanently");
	
			header("location: events/categories/24/Media-and-Communication");
			break;
			case"Marketing & Sales Management":
			header("HTTP/1.1 301 Moved Permanently");
	
			header("location: events/categories/23/Marketing-Sales-Mgt");
			break;
			case"Media ":
			header("HTTP/1.1 301 Moved Permanently");
	
			header("location: events/categories/24/Media-and-Communication");
			break;
			case"Public Administration":
			header("HTTP/1.1 301 Moved Permanently");
	
			header("location: events/categories/28/Public-Administration");
			break;
			
			case"Legal/Legislative":
			header("HTTP/1.1 301 Moved Permanently");
	
			header("location: events/categories/20/Legal-Legislative");
			break;
			case"Agriculture and Rural Development":
			header("HTTP/1.1 301 Moved Permanently");
	
			header("location: events/categories/2/Agriculture-and-Rural-Dev.");
			break;
			
			case"Finance":
			header("HTTP/1.1 301 Moved Permanently");
	
			header("location: events/categories/12/Finance-Accounting");
			break;
			case"Entertainment":
			header("HTTP/1.1 301 Moved Permanently");
	
			header("location: events/categories/6/Education");
			break;
			case"Agriculture%20":
			header("HTTP/1.1 301 Moved Permanently");
	
			header("location: events/categories/2/Agriculture-and-Rural-Dev.");
			break;
			
			case"Oil ":
			header("HTTP/1.1 301 Moved Permanently");
	
			header("location: events/categories/25/Oil-and-Gas");
			break;
			case"Leadership ":
			header("HTTP/1.1 301 Moved Permanently");
	
			header("location: events/categories/19/Leadership-Self-Development");
			break;
			
			case"Human":
			header("HTTP/1.1 301 Moved Permanently");
	
			header("location: events/categories/17/Human-Resource-Management");
			break;
			case"Logistics ":
			header("HTTP/1.1 301 Moved Permanently");
	
			header("location: events/categories/21/Logistics-Supply-Chain-Mgt");
			break;
			case"Project Management":
			header("HTTP/1.1 301 Moved Permanently");
	
			header("location: events/categories/27/Project-Management");
			break;
			
			case"Operations Management":
			header("HTTP/1.1 301 Moved Permanently");
	
			header("location: events/categories/26/Operations-Management");
			break;
			case"INFORMATION ":
			header("HTTP/1.1 301 Moved Permanently");
	
			header("location: events/categories/18/Info-Communications-Tech");
			
			case"Entrepreneurship&al=VIEW ALL":
			header("HTTP/1.1 301 Moved Permanently");
			header("location: events/categories/10/Entrepreneurship-Biz-Dev");
			break;
			
			case"INFORMATION":
			header("HTTP/1.1 301 Moved Permanently");
	
			header("location: events/categories/18/Info-Communications-Tech");
			
			
			default:
			header("HTTP/1.1 301 Moved Permanently");
	
			header("location:  events/categories/10/Entrepreneurship-Biz-Dev");
			
		}
		
		switch($_GET['&search']){
			case"Entrepreneurship&al=VIEW ALL":
			header("HTTP/1.1 301 Moved Permanently");
	
			header("location: events/categories/10/Entrepreneurship-Biz-Dev");
		}
	}
	
	//else if(isset($_GET['&amp;search'])){
			//switch($_GET['&amp;search']){
			//case"Entrepreneurship&al=VIEW ALL":
			//header("HTTP/1.1 301 Moved Permanently");
			//header("location: events/categories/10/Entrepreneurship-Biz-Dev");
			
			//default:
			//header("HTTP/1.1 301 Moved Permanently");
	
			//header("location: events/categories/10/Entrepreneurship-Biz-Dev");
			//}
	//}
	
	else {
		header("HTTP/1.1 301 Moved Permanently");
	
		header("location: all_event");
	}
?> 
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
<title></title>
</head>

<body>
<?php
echo $_GET['search'];
?>
</body>
</html>