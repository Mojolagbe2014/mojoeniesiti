<?php
require_once("../scripts/functions.php");
if(isset($_GET['num'])){
	$string = 'This course will take the PAs and Senior Secretaries through some thought process that focuses on the style and work culture which 	characterises the managers they work with. The jobs of Personal Assistants and Senior Secretaries involve consciously working with the boss to obtain the best possible results for the organisation, for the boss and, of course, for the PA and Secretary too!
    How PAs and Senior Secretaries work smart, not just hard, putting the most emphasis on the most critical functions.
    How they appreciate that nothing will help their career more than a reputation for high quality work that makes their boss look good.
    How they make their boss become comfortably dependent on them for new ideas and support.
';
	echo '<div class="pageHeader">'.$_GET['num'].' Events starting today</div>';
	for($i=0; $i < $_GET['num']; $i++){
?>
<div class="testCalendar">
	<div class="providerImg">
    	<img src="../premium/logos/thumbs/uwKyQBFJA1r651N4O0wm23e4f647e217de2fc8b22cf15716f59d.png" class="img-circle" width="150" height="150">
    </div>
    <div class="title">
    	<h2>Management Development for Personal Assistants and Senior Secretaries</h2>
    </div>
    <div class="icons">
    <ul>
    	<li><i class="icon-calendar"></i> May 5 - June 8, 2015</li>
        <li><i class="icon-bullhorn"></i> Tom Associates Training</li>
    </ul>
    </div>
    <div class="description">
	<?php echo WordTruncate($string, 80)."...";?>
    </div>
    
</div>
<?php
	}
}
?>