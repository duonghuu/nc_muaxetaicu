<?php
	session_start();
	$session=session_id();
	@define ( '_template' , './templates/');
	@define ( '_source' , './sources/');
	@define ( '_lib' , './admin/lib/');
	include_once _lib."compressor.php";	
	
	include_once _lib."config.php";	
	include_once _lib."constant.php";
	include_once _lib."class.database.php";
	include_once _lib."functions.php";	
	if($_GET['com']!='lien-he'){
	//ob_start("sanitize_output2");
	}
	include_once _lib."functions_giohang.php";
	include_once _lib."file_requick.php";
	
	include_once _lib."libraries.php";	
	
	$d->query("select * from #_photo where id=41");
	$bn = $d->fetch_array();
	if(@$_REQUEST['command']=='add' && $_REQUEST['productid']>0){
	$pid=$_REQUEST['productid'];
		addtocart($pid,1);
		redirect("gio-hang.html");}
	if(!isset($_SESSION['main_popup'])){
		$_SESSION['main_popup'] = 1;
	
	}
	if($template=="index"){
		$d->query("select * from #_baiviet where id = 10 and hienthi = 1");
		$main_popup = $d->fetch_array();
		$_SESSION['main_popup'] = time();
	}	
	
	if(isAjaxRequest() & isset($_POST['action'])){
		$sql = "select * from #_newsletter where email = '".$_POST['email']."'";
		$d->query($sql);
		if(!$d->num_rows()){
				$d->setTable("newsletter");
				$d->insert(array("email"=>$_POST['email']));
		}
		die;
	}
	
	require_once _lib.'Mobile_Detect.php';
$detect = new Mobile_Detect;

$check_mobile = $detect->isMobile();

$check_tablet = $detect->isTablet();
// Any mobile device (phones or tablets).

if ( $detect->isMobile() ) {

redirect("http://muaxetaicu.net/m/");

}
// Any tablet device.

if( $detect->isTablet() ){

redirect("http://muaxetaicu.net/m/");

}
// Exclude tablets.

if( $detect->isMobile() && !$detect->isTablet() ){

redirect("http://muaxetaicu.net/m/");
}
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<base href="<?=$config_url?>/"  />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=1200, maximum-scale=1.0" />
<meta name="keywords" content="<?=$keyword?>" />
<meta name="description" content="<?=$description?>" />
<meta name="copyright" content="" />
<meta name="robots" content="noodp,index,follow" />
<meta name="google-site-verification" content="" />
<meta name="DC.title" content="" />
<meta name="geo.region" content="VN-SG" />
<meta name="geo.placename" content="Ho Chi Minh" />
<meta name="geo.position" content="" />
<meta name="ICBM" content="" />
<meta name='revisit-after' content='1 days' />
<?=$global_setting['meta_top']?>
<?=$global_setting['google_analytics']?>
<?php 
$img = $config_url."/"._upload_hinhanh_l.$global_setting['share_image'];
if(isset($product_detail)){
$img  = ($product_detail) ?  $config_url."/"._upload_sanpham_l.$product_detail['thumb'] : $img ;
}
if(isset($tintuc_detail)){
$img = ($tintuc_detail) ? $config_url."/"._upload_news_l.$tintuc_detail['thumb'] : $img ;
}
?>
<meta property="og:image" content="<?=$img?>" />
<meta property="og:url" content="<?=getCurrentPageUrl() ?>" />
<meta property="og:description" content="<?=($description) ? $description : $title_bar.$row_title['ten']  ?>" />
<meta property="og:site_name" content="<?=$row_title['ten']?>" />
<title><?=$title_bar?><?=$row_title['ten']?></title>
<script>var base_url = '<?=$config_url?>';  </script>



<?php /* <link href="assets/css/normalize.css" type="text/css" rel="stylesheet" />
<link href="assets/bootstrap/css/bootstrap-theme.min.css" type="text/css" rel="stylesheet" />
<link href="assets/bootstrap/css/bootstrap.min.css" type="text/css" rel="stylesheet" />
<link href="assets/bxslider/jquery.bxslider.css" type="text/css" rel="stylesheet" />
<link href="assets/fancybox/jquery.fancybox.css" type="text/css" rel="stylesheet" />
<link href="assets/lobibox/dist/css/LobiBox.min.css" type="text/css" rel="stylesheet" />
<link href="assets/nprogress-master/nprogress.css" type="text/css" rel="stylesheet" />
<link href="assets/css/style.css" type="text/css" rel="stylesheet" />

<link rel="stylesheet" href="assets/iView-master/css/skin1/style.css" type="text/css"/>
<link rel="stylesheet" href="assets/iView-master/css/iview.css" type="text/css"/>
<link rel="stylesheet" href="assets/css/pp.css" type="text/css"/>

<link href="assets/carousel/css/style.css" rel="stylesheet" type="text/css" /> */?>
<link href="main.css" rel="stylesheet" type="text/css" />
<!--[if lt IE 9]>
<script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
<![endif]-->
<!--[if lt IE 9]>
    <meta http-equiv="refresh" content="0; url=<?=$config_url?>/detect.html" />
	<script type="text/javascript">
	/* <![CDATA[ */
	window.top.location = '<?=$config_url?>/detect.html';
	/* ]]> */
	</script>
<![endif]-->

</head>
<?php if($maintenance){echo $maintenance;die;}?>
<body data-tit="<?= $source."_"._template.$template ?>" class="cls<?= $template ?> status js-status 
	<?=($template!="index") ? 'hasBg': '' ?>" itemscope itemtype=http://schema.org/WebPage> 
	<div id="loading" class="hide"><span><span class="child"></span></span></div>
	
	<?php if($template=="index"){ /*  */ }?>

	<?php include _template."layout/header.php";?>
	<?php include _template."layout/slider_full.php"; ?>
<div id="page-wrapper" class="container rel container-fixed">
<?php if($template=="index"){?>
	
	<?php } 	?>
	<div id="page">
		<div class="col-xs-12">
			<div class="row">
				<div id="content-right">					
						<?php include _template."/layout/left_tpl.php"; ?> 
				</div>
				<div id="content-center">					
						<?php include _template.$template."_tpl.php"; ?> 
				</div>
				<div class="clearfix"></div>				
			</div>
			<div class="clearfix"></div>
		</div>
		<div class="clearfix"></div>
		<?php //include _template."layout/facebook_full.php" ?>
	</div><!-- #page -->
	<div class="clearfix"></div>

	<?php //include _template."layout/support.php" ?>
	<?php //include _template."layout/advs.php";?>
	</div><!--end page-wrapper-->
	<?php if($source=="index") include _template."layout/bottom.php" ?>
	<?php include _template."layout/logo.php" ?>
	<?php //include _template."layout/popup_tpl.php";?>
	<?php include _template."layout/footer.php";?>
	<div id="fb-root"></div>
	<?php include _template."layout/js.php";?>
	<?php //include _template."layout/facebook.php";?>
	


<?=$global_setting['meta_bottom']?>
</body>
</html>