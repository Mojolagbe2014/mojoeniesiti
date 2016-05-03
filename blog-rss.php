<?php
	
	require_once("app/classes/RssFeed.php");
	use nigerianseminarsandtrainings\app\classes\RssFeed;


	$blog_feed = new RssFeed('http://blog.nigerianseminarsandtrainings.com/rss');
	$blog_feed->getItems(5);