<?php  if(!defined('_source')) die("Error");
	$d->reset();
	$sql_contact = "select * from #_lienhe ";
	$d->query($sql_contact);
	$company_contact = $d->fetch_array();	

	$title_bar = _contact." - ";
	$title_tcat = _contact;


	
	$d->reset();
	$sql = "select * from #_hotline";
	$d->query($sql);
	$email5 = $d->fetch_array();
		
		
		if(!empty($_POST))
		{
			$body = $global_setting['email_contact_form'];
			$arr = array("website"=>$config_url,"name"=>$_POST['tenlienhe'],"address"=>$_POST['diachi'],"phone"=>$_POST['dienthoai'],"email"=>$_POST['email'],"date"=>date("h:i:s d-m-Y",time()),"title"=>$_POST['tieude'],"content"=>$_POST['noidung']);
			foreach($arr as $k=>$v){
				$body = str_replace("%".$k."%",$v);
			}
			if(sendEmail($global_setting['email_contact'],null,null, $subject, $body))
			{ 
				transfer("Thông tin liên hệ được gửi.<br>Cảm ơn.", "index.html");
			}
			else
			{
				transfer("Thông tin KHÔNG gửi được.<br>Cảm ơn.", "lien-he.html");
			}
		}
		
		$d->reset();
		$sql_hotline="select * from #_hotline limit 0,1";
		$d->query($sql_hotline);
		$result_hotline=$d->fetch_array();