<?php
include('../scripts/config.php');
if(isset($_GET['topSubMenu'])){
?>
<li><a href="<?php echo SITE_URL;?>venues" title="Find Venues">Find Venues</a></li>
<li><a href="<?php echo SITE_URL;?>suppliers" title="Find Suppliers">Find Suppliers</a></li>
<li><a href="<?php echo SITE_URL;?>event-managers" title="Event Managers">Event Managers</a></li>
<li><a href="<?php echo SITE_URL;?>articles" title="Articles">Articles</a></li>
<li><a href="<?php echo SITE_URL;?>archive" title="News and Updates">News and Updates</a></li>
<li><a href="<?php echo SITE_URL;?>quoteArchive" title="Quotes">Quotes</a></li>
<?php
	}
if(isset($_GET['footerMenu'])){
?>
<li><a href="<?php echo SITE_URL;?>about" title="About Us">About Us</a></li>
<li><a href="http://www.nsthotels.com" target="_blank" rel="nofollow" title="Find Hotels">Find Hotels</a></li>
<li><a href="<?php echo SITE_URL;?>all-vacancies" title="Find Jobs">Find Jobs</a></li>
<li><a href="<?php echo SITE_URL;?>rss" title="RSS Feeds">RSS Feeds</a></li>
<li><a href="<?php echo SITE_URL;?>sitemap-page" title="Sitemap">Sitemap</a></li>
<li><a href="<?php echo SITE_URL;?>videos-all" title="Watch Training Videos">Watch Training Videos</a></li>
<li><a href="<?php echo SITE_URL;?>article-submission" title="Submit Articles">Submit Articles</a></li>
<li><a href="<?php echo SITE_URL;?>faq" title="FAQ">FAQ</a></li>
<?php
}
?>