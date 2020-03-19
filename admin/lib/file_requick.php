<?php
	$com = (isset($_REQUEST['com'])) ? addslashes($_REQUEST['com']) : "";
	$act = (isset($_REQUEST['act'])) ? addslashes($_REQUEST['act']) : "";
	$d = new database($config['database']);
	$d->query("select * from #_setting");
	$global_setting = $d->fetch_array();
	if(!isset($_SESSION['lang'])){
		$_SESSION['lang']=$global_setting['default_lang'];
	}
	if(count($config['lang']) == 1){
		$lang=$global_setting['default_lang'];
	}else{
		$lang=$_SESSION['lang'];
	}
	$maintenance = false;
	if($global_setting['site_maintenance'] & $_GET['com']==""){
		$maintenance = '<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />';
		$maintenance.= $global_setting['site_maintenance_message']."</body></html>";
		
	}
	require_once _source."lang_$lang.php";	
	switch($com)
	{
		case 'detect':
			include_once _template."detect.php";
			die();
			break;
		case 'ajax':
			$source = "ajax";
			break;	
		case 'home':
			$source = "index";
			$template = (isset($_GET['id'])) ? "index_item" : "index";
		break;	
		
		case 'gio-hang':
			$source = "giohang";
			$template = "giohang";
			break;
			
		case 'newletter':
			$source = "newsletter";
			//$template = "camera/index";
		break;	
		case 'khuyen-mai':
			$source = "promotion";
			$template = isset($_GET['id']) ? $source."/detail" : $source."/index";
			break;
		case 'gallery':
			$source = "gallery";
			$template = isset($_GET['id']) ? $source."/detail" : $source."/index";
			break;
		case 'kien-thuc':
			$source = "know";
			$template = isset($_GET['id']) ? $source."/detail" : $source."/index";
			break;	
		case 'chinh-sach':
			$source = "info";
			$template = isset($_GET['id']) ? $source."/detail" : $source."/index";
			break;
		case 'bo-suu-tap':
			$source = "bosuutap";
			$template = isset($_GET['id']) ? $source."/detail" : $source."/index";
			break;
		case 'ao-cuoi':
			$source = "aocuoi";
			$template = isset($_GET['id']) ? $source."/detail" : $source."/index";
			break;
		case 'hoi-nghi-va-su-kien':
			$source = "hoinghi";
			$template = isset($_GET['id']) ? $source."/detail" : $source."/index";
			break;	
		case 'album':
			$source = "album";
			$template = isset($_GET['id']) ? $source."/detail" : $source."/index";
			break;	
		case 'gioi-thieu':
			//$source = "about";
			//$template = isset($_GET['id']) ? "about/detail" : "about/index";
			$source = "baiviet";
			$_GET['id'] = 1;
			$template = "baiviet/detail";
			break;	
		case 'tiec-cuoi':
			$source = "tieccuoi";
			$template = isset($_GET['id']) ? "tieccuoi/detail" : "tieccuoi/index";
			break;		
		case 'doi-tac':
			$source = "doitac";
			$template = isset($_GET['id']) ? "doitac/detail" : "doitac/index";
			break;		
		case 'huong-dan-mua-hang':
			$source = "baiviet";
			$id = 7;
			$template =  "baiviet/detail" ;
			break;		
		
		case 'huong-dan-thanh-toan':
			$source = "baiviet";
			$id = 12;
			$template =  "baiviet/detail" ;
			break;		
			
		/*case 'gioi-thieu':
			$source = "about";
			$template = isset($_GET['id']) ? "about/detail" : "about/index";
			break;	*/
			
			
		case 'ho-tro':
			$source = "hotro";
			$template = isset($_GET['id']) ? "hotro/detail" : "hotro/index";
			break;	
		case 'video':
			$source = "video";
			$template = isset($_GET['id']) ? "video/detail" : "video/index";
			break;		
		
		case 'tai-lieu':
			$source = "tailieu";
			$template = isset($_GET['id']) ? "tailieu/detail" : "tailieu/index";
			break;
		case 'tuyen-dung':
			$source = "service";
			$template = isset($_GET['id']) ? "service/detail" : "service/index";
			break;	
			
			case 'download':
			$source = "download";
			$template = isset($_GET['id']) ? "download/detail" : "download/index";
			break;
			
			
		case 'khuyen-mai':
			$source = "promotion";
			$template = isset($_GET['id']) ? "promotion/detail" : "promotion/index";
			break;
		case 'linh-vuc-hoat-dong':
			$source = "work";
			$template = isset($_GET['id']) ? "work/detail" : "work/index";
			
			break;
			case 'ho-so-nang-luc':
			$source = "profile";
			$template = "profile/master";
			if(isset($_GET['id'])){
				$template = "profile/detail";
				
			}
			if(isset($_GET['id_danhmuc']) | isset($_GET['id_list'])){
					$template = "profile/index";
			}
			
			break;
		case 'tim-mua-oto':
			$type="is_buy";
			$prf = "Tìm mua ô tô";
			$source = "product";
			$template = isset($_GET['id']) ? "product/detail" : "product/index";
			
			break;
			
		case 'ban-oto':
			$type="is_sale";
			$prf = "Bán ô tô";
			$source = "product";
			$template = isset($_GET['id']) ? "product/detail" : "product/index";
			break;	
		case 'san-pham':
			$source = "product";
			$template = isset($_GET['id']) ? "product/detail" : "product/index";
			break;	
		case 'gio-hang':
			$source = "giohang";
			$template = "giohang";
			break;	
		case 'thanh-toan':
			$source = "thanhtoan";
			$template = "thanhtoan";
			break;		
			
			
		case 'location':
			$source = "location";
			$template = "location";
			break;	
			
		case 'dich-vu':
			$source = "service";
			$template = isset($_GET['id']) ? "service/detail" : "service/index";
			break;		
		case 'dao-tao':
			$source = "daotao";
			$template = isset($_GET['id']) ? "daotao/detail" : "daotao/index";
			break;
		case 'recruitment':
			$source = "recruitment";
			$template = "news/news_detail";
			break;

        case 'khach-san':
            $source = "product";
            $template = (isset($_GET['id'])) ? "khachsan/detail" : "khachsan/index";
            break;

		case 'tin-tuc':
			$source = "tintuc";
			$template = isset($_GET['id']) ? "news/detail" : "news/index";
			break;
			
		case 'quy-dinh-mua-ban':
			$source = "info";
			$template = isset($_GET['id']) ? "info/detail" : "info/index";
			break;	
		case 'ho-tro-khach-hang':
			$source = "project";
			$template = isset($_GET['id']) ? "project/detail" : "project/index";
			break;	
		case 'chat-luong':
			$source = "quality";
			$template = isset($_GET['id']) ? "quality/detail" : "quality/index";
			break;		

		case 'lien-he':
			$source = "contact";
			$template = "contact";
			break;	
		case 'search':
			$source = "search";
			$template = "search/product";
			break;	
		case 'ngonngu':
			if(isset($_GET['lang']))
			{
				switch($_GET['lang'])
					{
					case 'vi':
						$_SESSION['lang'] = 'vi';
						break;
					case 'en':
						$_SESSION['lang'] = 'en';
						break;
					case 'cn':
						$_SESSION['lang'] = 'cn';
						break;	
					
					default: 
						$_SESSION['lang'] = 'vi';
						break;
					}
			}
			else{
			$_SESSION['lang'] = 'vi';
			}
			echo '<script language="javascript">history.go(-1)</script>';
			break;		
			
		/*
		case 'gio-hang':
			$source = "giohang";
			$template = "giohang";
			break;	
			
		
				
		case 'gioi-thieu':
			$source = "about";
			$template = "about";
			break;	
			
		case 'tuyen-dung':
			$source = "khuyenmai";
			$template = "khuyenmai";
			break;	
			
		case 'bang-gia':
			$source = "banggia";
			$template = "banggia";
			break;
			
		case 'tin-tuc':
			$source = "tintuc";
			$template = isset($_GET['id']) ? "tintuc_detail" : "tintuc";
			break;
		
		case 'lien-he':
			$source = "contact";
			$template = "contact";
			break;		
		
		case 'tim-kiem':
			$source = "search";
			$template = "search";
			break;
						
		case 'san-pham':
			$source = "product";
			$template = isset($_GET['id']) ? "product_detail" : "product";
			break;	
					
*/					
		default: 
			$source = "index";
			$template = "index";
			break;
	}
	
	$sql_title = "select ten from #_title limit 0,1";
	$d->query($sql_title);
	$row_title= $d->fetch_array();
	
	
	#  lay meta tim kiem
	$sql_meta = "select * from #_meta limit 0,1";
	$d->query($sql_meta);
	$row_meta= $d->fetch_array();	
	$description = $row_meta['description'];
	$keyword = $row_meta['keyword'];
	if($source!="") include _source.$source.".php";
	
	
	if(@$_REQUEST['com']=='logout')
	{
	session_unregister($login_name);
	header("Location:index.php");
	}

?>
