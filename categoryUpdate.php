<?php
require_once("scripts/config.php");
require_once("scripts/functions.php");
$message = '';
reset ($subscribers);
	while (list ($key, $val) = each ($subscribers)) {
		if (!isset($_SESSION[$key])) $_SESSION[$key] = "";
		if ($_SESSION[$key] == "NULL") $_SESSION[$key] = "";
	}
	if(connection());
$advert = "Subscribers";
//require_once("scripts/insertions.php");	
$random = random(8);

if(isset($_GET['id'])){
	
	$query="select * from categories,businessinfo  WHERE  business_id='".$_GET['id']."' and category_id=specialization ";
	
	$result=MysqlSelectQuery($query);
	$rowsSub=SqlArrays($result);
	
	}
	
	if(isset($_POST['changeInterest'])){
	MysqlQuery("update businessinfo set specialization='".$_POST['category']."' where business_id='".$_GET['id']."'");
	header('location: categoryUpdate?id='.$_GET['id'].'&suc=updated');
	 }
	if(isset($_GET['suc'])){ 
$message = successMsg("Your watch List have been changed!");
	}
?>
<!DOCTYPE html>
<html lang="en">
<head>

<?php include('tools/analytics.php');?>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
<link href="<?php echo SITE_URL;?>images/favicon.ico" rel="shortcut icon" type="image/x-icon" />
<title>Change Category of Interest - Nigerian Seminars and Trainings</title>
<meta name="description" content="Change category of interest on watch list" />
<meta name="dcterms.description" content="Change category of interest on watch list" />
<meta property="og:title" content="Change Category of Interest - Nigerian Seminars and Trainings" />
<meta property="og:description" content="Change category of interest on watch list" />
<meta property="twitter:title" content="Change Category of Interest - Nigerian Seminars and Trainings" />
<meta property="twitter:description" content="Change category of interest on watch list" />

<?php include("scripts/headers_new.php");?>

<script>

$(document).ready(function() {	

	$('a[class=currency]').click(function(e) {
      		//Cancel the link behavior
		e.preventDefault();
		
		//Get the A tag
		var id = $(this).attr('href');
	
		//Get the screen height and width
		var maskHeight = $(document).height();
		var maskWidth = $(window).width();
	
		//Set heigth and width to mask to fill up the whole screen
		$('#mask').css({'width':maskWidth,'height':maskHeight});
		
		//transition effect		
		$('#mask').fadeIn(1000);	
		$('#mask').fadeTo("slow",0.8);
		
		$('#amount').val('200');
	
		//Get the window height and width
		var winH = $(window).height();
		var winW = $(window).width();
              
		//Set the popup window to center
		$(id).css('top',  winH/2-$(id).height()/2);
		$(id).css('left', winW/2-$(id).width()/2);
	
		//transition effect
		$(id).fadeIn(2000); 
	
	});
	
	//if close button is clicked
	$('.window_currency #Close').click(function (e) {
		//Cancel the link behavior
		e.preventDefault();
		
	
		$('#mask').fadeOut('slow');
		$('.window_currency').fadeOut('slow');
	});		
	
	//if mask is clicked
	$('#mask').click(function () {
		$(this).fadeOut('slow');
		$('#msgbox').fadeOut('slow');
		$('.window_currency').fadeOut('slow');
	});			

	$(window).resize(function () {
	 
 		var box = $('#boxes .window_currency');
 
        //Get the screen height and width
        var maskHeight = $(document).height();
        var maskWidth = $(window).width();
      
        //Set height and width to mask to fill up the whole screen
        $('#mask').css({'width':maskWidth,'height':maskHeight});
               
        //Get the window height and width
        var winH = $(window).height();
        var winW = $(window).width();

        //Set the popup window to center
        box.css('top',  winH/2 - box.height()/2);
        box.css('left', winW/2 - box.width()/2);
    });
	
});
function Close(){
		$('#mask').fadeOut('slow');
		$('.window_currency').fadeOut('slow');
}
function GetRate(val){
	$('#price_rate').text(val)
		$('#price_advert').show();
}
</script>
<style type="text/css">
#mask {
  position:absolute;
  left:0;
  top:0;
  z-index:9000;
  background-color:#000;
  display:none;
}

.window_currency {
  position:fixed;
  left:0;
  top:0;
  width:200px;
  z-index:9999;
  padding:20px;
  display:none;
}
.boxContent{
-webkit-border-radius: 8px;
-moz-border-radius: 8px;
border-radius: 8px;
background-color:#666666;
padding:8px;
}

.advert_bg{
	background-image: url(images/advertbg.png);
	background-repeat: no-repeat;
	background-position: center center;	
}

</style>
 <script type="text/javascript">
$().ready(function() {
	// validate the comment form when it is submitted
	$("#contactform2").validate({
			rules:{
				fname: {
				required:true,
				minlength: 2
				},
				lname: {
				required:true,
				},
				country: {
				required:true,
				},
				category: {
				required:true,
				},
				state: {
				required:true,
				},
				city: {
				required:true,
				},
				organization:{
					required: true,
					minlength: 2
				},
				email_sub:{
					required: true,
					email:true
				},
				phone:{
					required: true,
					number: true
				},
				address:{
					required: true,
				},
				verify:{
					required: true,
				}
				
			}		
		});
	});

	</script>
	
</head>

<body>

<?php include("tools/header_new.php");?>

<div id="main">
	
	<div id="content">
            <?php include("tools/categories_new.php");?>
		<div id="content_left">
                    <div class="event_table_inner">
                    <form>
                        <table style="width:100%">
                      <tr>
                        <td>&nbsp;</td>
                        </tr>
                      <tr>
                          <td style="text-align:center;"><h1 style="font-size:20px; font-weight: normal;"><strong style="font-weight: normal;"><u style="text-decoration:none">Change category of interest on watch list</u></strong></h1></td>
                        </tr>
                      <tr>
                          <td style="font-size:11px"><em>&nbsp;</em></td>
                        </tr>
                    </table>
                    </form>
                </div>	
		
				<div id="subpage">
					
					<div id="subpage_content">
						
						<div id="contact-wrapper" class="rounded">
                           <?php echo $message;?>
						  <div id="contact-wrapper-inner" class="rounded">
                        
						  
						    <form action="" method="post" id="contactform2">
                           
						      <table width="100%"  height="212" border="0">
						       <tr>
                                                           <td height="43" align="right" valign="bottom"><h2 style="font-weight:normal; font-size: 12px;">Business Name:</h2></td>
						         <td colspan="3" valign="bottom"><?php echo $rowsSub['business_name'];?></td>
					            </tr>
						       <tr>
                                                           <td height="43" align="right" valign="bottom"><span class="contact-left"><h3 style="font-weight:normal; font-size: 12px;">Interetsted in:</h3></span></td>
						          <td colspan="3" valign="bottom"><select name="category" id="category2" class="input">
                                  <option><?php echo $rowsSub['category_name'];?></option>
						            <?php 
	if(connection());
	$result = MysqlSelectQuery("select * from categories order by category_name");?>
						            
						            <?php while ($rows = SqlArrays($result)){?>
						            <option value="<?php echo $rows['category_id'];?>"><?php echo $rows['category_name'];?></option>
						            <?php
		}
	?>
					              </select></td>
					            </tr>
						        
						        <tr>
						          <td align="right">&nbsp;</td>
						          <td colspan="3" valign="top"><input name="changeInterest" type="submit" class="cssButton_roundedLow cssButton_aqua" style="padding:6px;font-size:10px;background-color:#435a65;color:#FFF;margin:0" value="Change" /></td>
					            </tr>
					          </table>
					        </form>
					      </div>
					 </div>
						 
						 <div id="contact-info">
						 
						 </div>
					</div>
                    </div>
				</div><!-- end subpage -->
		</div>
            <?php include("tools/side-menu_new.php");?>
	</div>
	
	<div class="clearfix"></div>
</div>
</div>	
	
<?php include ("tools/footer_new.php");?>
<script type="text/javascript" src="js/jquery.currency.js"></script>
<script type="text/javascript" src="js/jquery.currency.localization.en_US.js"></script>
<script type="text/javascript">
$(document).ready(function(){
	$('#currency-widget').currency({
		localRateProvider: '<?php echo SITE_URL;?>api_currency.php',
		loadingImage: '<?php echo SITE_URL;?>images/img/loader.gif',
	});
});
</script>

</body>
</html>