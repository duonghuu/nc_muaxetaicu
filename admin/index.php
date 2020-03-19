<?php
	session_start();
	@define ( '_template' , './templates/');
	@define ( '_source' , './sources/');
	@define ( '_lib' , './lib/');

	include_once _lib."config.php";
	include_once _lib."constant.php";
	include_once _lib."functions.php";
	include_once _lib."functions_giohang.php";
	include_once _lib."library.php";
	include_once _lib."class.database.php";	
	$com = (isset($_REQUEST['com'])) ? addslashes($_REQUEST['com']) : "";
	$act = (isset($_REQUEST['act'])) ? addslashes($_REQUEST['act']) : "";
	$login_name = 'AMTECOL';
	
	$d = new database($config['database']);
	if(isAjaxRequest() & isset($_REQUEST['ajax'])){
		$com = $_POST['com'];
		$id = $_POST['id'];
		$type = $_POST['type'];
		$value = $_POST['value'];
		$d->setTable($com);
		$d->setWhere("id",$id);
		$d->update(array($type=>$value));
		echo $d->showSql();
		die;
	}
	switch($com){
		case 'baiviet':
			$source = "baiviet";
			break;
		case 'aocuoi':
			$source = "aocuoi";
			break;
		case 'product_size':
			$source = "product_size";
			break;
		case 'product_color':
			$source = "product_color";
			break;	
			
		case 'album':
			$source = "album";
			break;	
		case 'loaiphong':
			$source = "loaiphong";
			break;	
		case 'setting':
			$source = "setting";
			break;		
		case 'bosuutap':
			$source = "bosuutap";
			break;		
		case 'info':
			$source = "info";
			break;	
		case 'know':
			$source = "know";
			break;		
		case 'tieccuoi':
			$source = "tieccuoi";
			break;	
		case 'advs':
			$source = "advs";
			break;	
		case 'work':
			$source = "work";
			break;
		case 'profile':
			$source = "profile";
			break;	
		case 'hoinghi':
			$source = "hoinghi";
			break;		
		case 'hotro':
			$source = "hotro";
			break;	
		case 'index':
			$source = "index";
			break;	
		case 'photo':
			$source = "photo";
			break;	
		case 'recruitment':
			$source = "recruitment";
			break;		
		case 'tailieu':
			$source = "tailieu";
			break;	
			case 'doitac':
			$source = "doitac";
			break;	
		case 'download':
			$source = "download";
			break;		
		case 'video':
			$source = "video";
			break;
		case 'gallery':
			$source = "gallery";
			break;
		
		case 'project':
			$source = "project";
			break;
		case 'quality':
			$source = "quality";
			break;	
		case 'user':
			$source = "user";
			break;
		case 'config':
			$source = "config";
			break;	
		case 'order':
			$source = "donhang";
			break;
			
		case 'banggia':
			$source = "banggia";
			break;
		case 'promotion':
			$source = "promotion";
			break;	

		case 'about':
			$source = "about";
			break;
		case 'news':
			$source = "news";
			break;
		case 'phauthuat':
			$source = "phauthuat";
			break;	
		case 'khongphauthuat':
			$source = "khongphauthuat";
			break;		
		case 'service':
			$source = 'service';
			break;
		case 'promotion':
			$source = 'promotion';
			break;	
		case 'daotao':
			$source = 'daotao';
			break;		
		case 'newsletter':
		case 'newletter':
			$source = "newsletter";
			break;
		case 'social':
			$source = 'social';
			break;
		case 'camera':
			$source = "camera";
			break;
			
		case 'slider':
			$source = "slider";
			break;	
		case 'smallslider':
			$source = "smallslider";
			break;		
		case 'footer':
			$source = "footer";
			break;		
			
		case 'title':
			$source = "title";
			break;
			
		case 'meta':
			$source = "meta";
			break;
			
		case 'letruot':
			$source = "letruot";
			break;	
		case 'bannerqc':
			$source = "bannerqc";
			break;

		case 'quangcao':
			$source = "quangcao";
			break;
			
		case 'doitac':
			$source = "doitac";
			break;
			
		case 'product':
			$source = "product";
			break;
			
		case 'product1':
			$source = "product1";
			break;
			
		case 'yahoo':
			$source = "yahoo";
			break;
			
		case 'contact':
			$source = "contact";
			break;
		
		case 'hotline':
			$source = "hotline";
			break;
			
		case 'lienhe':
			$source = "lienhe";
			break;
		//---------------------------------------------------------
			
		default: 
			$source = "";
			$template = "index";
			break;
	}
	
	if((!isset($_SESSION[$login_name]) || $_SESSION[$login_name]==false) && $act!="login"){
		redirect("index.php?com=user&act=login");
	}
	$_SESSION['SCRIPT_FILENAME'] = str_replace("/admin/index.php","",$_SERVER['SCRIPT_FILENAME']);
	$_SESSION['SERVER_FOLDER'] = $config['finder']['folder'];
	$_SESSION['UPLOAD_DIR'] = $config['finder']['dir'];
	
	if($source!="") include _source.$source.".php";
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01//EN"
"http://www.w3.org/TR/html4/DTD/strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Website Administration</title>
<link href="media/css/style.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="tinymce/tinymce/tinymce.min.js"></script>
<script type="text/javascript" src="media/scripts/jquery-1.8.3.js"></script>
<script src="assets/colorpicker/js/bootstrap-colorpicker.min.js" type="text/javascript" ></script>

<script src="assets/ckeditor/ckeditor.js" type="text/javascript" ></script>
<script src="assets/ckfinder/ckfinder.js" type="text/javascript" ></script>
<script type="text/javascript" src="assets/bootstrap/js/bootstrap.min.js"></script>
<script type="text/javascript" src="media/fancybox/jquery.fancybox.js"></script>
<link href="media/fancybox/jquery.fancybox.css" rel="stylesheet" type="text/css" />
<link href="assets/bootstrap-switch-master/dist/css/bootstrap3/bootstrap-switch.css" rel="stylesheet" type="text/css" />
<!-- <link href="assets/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" /> -->
<link href="assets/bootstrap/bootstrap.min.css" rel="stylesheet" type="text/css" />
<link href="assets/colorpicker/css/bootstrap-colorpicker.min.css" rel="stylesheet" type="text/css" />
<link href="assets/css/style.css" rel="stylesheet" type="text/css" />
<link href="assets/nprogress-master/nprogress.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="assets/nprogress-master/nprogress.js"></script>
<script type="text/javascript" src="media/scripts/my_script.js"></script>
<script> var base_url = "<?=$config_url?>";var server_folder = '<?=$config['finder']['folder']?>'; var rel_url = '<?=$relative_url?>';</script>
<script type="text/javascript" src="assets/js/autoNumeric.js"></script>
<script type="text/javascript" src="assets/bootstrap-switch-master/dist/js/bootstrap-switch.min.js"></script>
<script type="text/javascript" src="assets/js/script.js"></script>

</head>
<body>

<?php if(isset($_SESSION[$login_name]) && ($_SESSION[$login_name] == true)){?>  
<div id="wrapper">
	<?php include _template."header_tpl.php"?>
    
    <div id="main"> 
		 
        <!-- Right col -->
        <div id="contentwrapper">
        <div id="content">
          <?php include _template.$template."_tpl.php"?>
        </div>
        </div>
        <!-- End right col -->
        
        <!-- Left col -->
        <div id="leftcol">
          <div class="innertube">
           <?php include _template."menu_tpl.php";?>
          </div>
        </div>
        <!-- End Left col -->
		
			<div class="clr"></div>
    </div>
  <div id="footer">
		<?php include _template."footer_tpl.php"?>
	</div>
</div>
<?php }else{?>   
				<?php include _template.$template."_tpl.php"?>
		<?php }?>
		<input type="hidden" id="com" value="<?=$_GET['com']?>" />
		<input type="hidden" id="act" value="<?=$_GET['act']?>" />
</body>
</html>
