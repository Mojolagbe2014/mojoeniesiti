<?php
require_once("../scripts/config.php");
require_once("../scripts/functions.php");
if(isset($_GET['news'])){
?>
<div class="sneak_peak2">
<div class="button_class"><h3 style="font-size:14px">News / Updates</h3></div>
</div>
<ul class="listItem">
<?php Get_News();?>
</ul>
<div class="divider"></div>
<?php
}
if(isset($_GET['articles'])){
?>
<div class="sneak_peak2">
<div class="button_class"><h3 style="font-size:14px">Read Articles</h3></div>
</div>
<ul class="listItem">
<?php Get_Articles();?>
</ul>
<div class="divider"></div>
<?php
}
?>