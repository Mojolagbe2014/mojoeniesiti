<div class="mobile-hide">
            <?php 
            $colSize = 8;  $column = 0;
            $allCatQry =  MysqlSelectQuery("select * from categories");
            $totalCategories = NUM_ROWS($allCatQry);
            
            for($count=0; $count< $totalCategories; $count++) {
                $listStarts = ($count==0) ? '<div class="socialize" ><h6>Event By Categories</h6><ul class="bulleting">' : '<div class="socialize" ><h6 class="emptyHolder">&nbsp; </h6><ul  class="bulleting">';
                $listEnds = '</ul><div class="clearfix"></div></div>';
                $rowsCat = SqlArrays($allCatQry);
                $isStartOfNewColum = 0 === ($count % $colSize); // modulo
                $isEndOfColumn = ($count && $isStartOfNewColum);
                $isStartOfNewColum && $column++; // update column counter
                
                $stripName = str_replace(" / ","-",$rowsCat['category_name']);
                $cleanCatName = str_replace(" ","-",$stripName);
                $thisCatSlug = strtolower($cleanCatName);
                
                if ($isEndOfColumn) { echo $listEnds; }
                if ($isStartOfNewColum) { echo $listStarts; }
                echo '<li><a class="mobile-hide mobile-enabled" href="javascript:;" data-href="'.SITE_URL.$thisCatSlug.'" title="Events in '.$rowsCat['category_name'].' Category">'.trimStringToFullWord(35, $rowsCat['category_name']).'</a></li>'; 
                if($count==($totalCategories-1) && !$isEndOfColumn){echo $listEnds;}
            }
            
            ?>
            <div class="clearfix"></div>
            <?php 
            $thisDay = date("Y");//."-". intval(date("m")). "-".intval(date("d"));
            $ctryEvtQuery = MysqlSelectQuery("SELECT DISTINCT(country) AS country FROM events WHERE '$thisDay' <= SortDate  AND status = 1 ORDER BY RAND() LIMIT 20 ");
            $totalCtryEvts = NUM_ROWS($ctryEvtQuery);
            $colSize = 10;  $column = 0;
            $allCtryEvts = []; $countCtry = 1; $mainCtryAll = ''; $flagToDisplay='';
            for($count=0; $count< $totalCtryEvts; $count++) {
                $listStarts = ($count==0) ? '<div class="socialize" ><h6>Event By Locations</h6><ul>' : '<div class="socialize" ><h6 class="emptyHolder">&nbsp; </h6><ul>';
                $listEnds = '</ul><div class="clearfix"></div></div>';
                $ctryEvt = SqlArrays($ctryEvtQuery);
                $countriesQuery = MysqlSelectQuery("SELECT * FROM countries WHERE id = ".$ctryEvt['country']);
                $country = SqlArrays($countriesQuery);
                $thisFlag = '<a class="mobile-hide mobile-enabled" href="javascript:;" title="Events in '.$country['countries'].'" data-href="'.SITE_URL.str_replace('.png', '', $country['country_image']).'" style="font-size:13px;"><img src="'.SITE_URL.'images/flags/medium/'.$country['country_image'].'" style="vertical-align:middle;" alt="'.$country['countries'].'" /> </a>';
                $thisFlagList = '<li><a class="mobile-hide mobile-enabled" href="javascript:;" title="Events in '.$country['countries'].'" data-href="'.SITE_URL.str_replace('.png', '', $country['country_image']).'" style="font-size:13px;"><img src="'.SITE_URL.'images/flags/medium/'.$country['country_image'].'" style="vertical-align:middle;" alt="'.$country['countries'].'"  title="'.$country['countries'].'" /> '.trimStringToFullWord(15, $country['countries']).'</a></li>';
                $isStartOfNewColum = 0 === ($count % $colSize); // modulo
                $isEndOfColumn = ($count && $isStartOfNewColum);
                $isStartOfNewColum && $column++; // update column counter
                
                if($country['countries'] !=''){
                    $mainCtryAll .= $thisFlag;
                    if ($isEndOfColumn) { echo $listEnds; }
                    if ($isStartOfNewColum) { echo $listStarts; }
                    echo $thisFlagList; 
                    if($count==($totalCtryEvts-1) && !$isEndOfColumn){echo $listEnds;}
                }
            }
            ?>
 
            <div class="socialize">
               <h6>Other Links</h6>
               <ul class="bulleting">
                    <li><a href="<?php echo SITE_URL;?>about" title="About Us">About Us </a></li>
                    <li><a href="<?php echo SITE_URL;?>articles" title="Articles">Articles</a></li>
                    <li><a href="<?php echo SITE_URL;?>archive" title="News and Updates">News and Updates</a></li>
                    <li><a href="<?php echo SITE_URL;?>faq" title=FAQ>FAQ</a></li>
                    <li><a href="<?php echo SITE_URL;?>all-vacancies" title="Find Jobs">Find Jobs</a></li>
                    <li><a href="<?php echo SITE_URL;?>quoteArchive" title="Quotes">Quotes</a></li>
                    <li><a href="<?php echo SITE_URL;?>sitemap-page" title=Sitemap>Sitemap </a></li>
                    <li><a href="<?php echo SITE_URL;?>article-submission" title="Submit Articles"> Submit Articles </a></li>
                    <li><a href="<?php echo SITE_URL;?>videos-all" title="Watch Training Videos">Watch Training Videos </a></li>
                </ul>
               <div class="clearfix"></div>
            </div>
            <div class="socialize">
               <h6>Useful Web Links</h6>
               <ul class="bulleting">
                    <li><a href="<?php echo SITE_URL;?>weather" title="Check Weather Report">  Check Weather Report</a></li>
                    <li><a href="javascript:void(0)" class="currency" data-id="#currency" title="Currency Converter">  Currency Converter</a></li>
                    <li><a href="<?php echo SITE_URL;?>domain-checker" title="Domain Name Checker">  Domain Name Checker</a></li>
                    <li><a href="<?php echo SITE_URL;?>favicon-generator" title="Favicon Generator">  Favicon Generator</a></li>
                    <li><a href="<?php echo SITE_URL;?>install-widget" title="Install Widget" target=_blank> Install Training Widget</a></li>
                 </ul>
               <div class="clearfix"></div>
            </div>
            <div class="socialize">
               <h6>Socialize</h6>
               <ul class="orion-menu footer-socials">
                   <li><a href="https://www.facebook.com/nigerianseminars" target="_blank" id="fb" title="Facebook"><i class="fa fa-facebook-square fa-3x"></i> </a></li>
                    <li><a href="https://twitter.com/NigerianSeminar" target="_blank" id="twitter" title="Twitter"><i class="fa fa-twitter fa-3x"></i> </a></li>
                    <li><a href="https://www.nigerianseminarsandtrainings.com/rss" target="_blank" id="rssfeed" title="RSS Feeds"><i class="fa fa-rss fa-3x"></i> </a></li>
                    <li><a href="https://plus.google.com/+Nigerianseminarsandtrainings" target="_blank"  class="gplus" rel="publisher" title="Google Plus"><i class="fa fa-google fa-3x"></i> </a></li>
                    <li><a href="https://www.pinterest.com/nigerianseminar" target="_blank" id="pint" title="Pinterest"><i class="fa fa-pinterest fa-3x"></i> </a></li>
                    <li><a href="https://www.youtube.com/user/nigerianseminars" target="_blank" rel="nofollow" class="gplus" title="Youtube"><i class="fa fa-youtube fa-3x"></i> </a></li>
                </ul>
               <div class="clearfix"></div>
            </div>
            </div>