<?php if(!defined('_lib')) die("Error");
#
#	$id_connect : ket noi database
#
	function getPercent($old,$new){
			return round(100-($new/$old)*100);
		
	}
	function getColorByProductId($pid){
		global $d;
		
		$d->query("select #_product_color_condition.*,#_product_color.ten_vi as ten,bg_color,text_color from #_product_color_condition,#_product_color where #_product_color.id = #_product_color_condition.id_color and hienthi = 1 and id_product = ".$pid." order by stt desc");
		return $d->result_array();
	}
	function getSizeByProductId($pid){
		global $d;
		
		$d->query("select sc.*,s.ten_vi as ten from #_product_size_condition sc,#_product_size s where sc.id_size = s.id and hienthi = 1 and  id_product = ".$pid." order by stt desc");
		return $d->result_array();
	}
	function objectToArray ($object) {
    if(!is_object($object) && !is_array($object))
        return $object;

    return array_map('objectToArray', (array) $object);
}
function sanitize_output2($buffer) {

    $search = array(
        '/\>[^\S ]+/s',  // strip whitespaces after tags, except space
        '/[^\S ]+\</s',  // strip whitespaces before tags, except space
        '/(\s)+/s'       // shorten multiple whitespace sequences
    );

    $replace = array(
        '>',
        '<',
        '\\1'
    );

    $buffer = preg_replace($search, $replace, $buffer);

    return $buffer;
}
	
function sendEmail($to, $from=null, $from_name=null, $subject, $body,$more=array(),$file='') { 
	include_once "phpMailer/class.phpmailer.php";	
	global $error;
	if(!$from_name){
		$from_name = _MAIL_USER;//'noreply@mevabembcare.com';
	}
	if(!$from){
		$from = _MAIL_USER;//'noreply@mevabembcare.com';
	}
	$mail = new PHPMailer();  // tạo một đối tượng mới từ class PHPMailer
	$mail -> CharSet  =  'UTF-8' ;
	$mail->IsSMTP(); // bật chức năng SMTP
	$mail->SMTPDebug = 1;  // kiểm tra lỗi : 1 là  hiển thị lỗi và thông báo cho ta biết, 2 = chỉ thông báo lỗi
	$mail->SMTPAuth = true;  // bật chức năng đăng nhập vào SMTP này
	//$mail->SMTPSecure = 'ssl'; // sử dụng giao thức SSL vì gmail bắt buộc dùng cái này
	$mail->Host = _MAIL_IP;
	//$mail->Port = 465; 
	$mail->Username = _MAIL_USER;  
	$mail->Password = _MAIL_PWD;           
	$mail->SetFrom($from, $from_name);
	$mail->IsHTML(true);
	$mail->Subject = $subject;
	$mail->Body = $body;
	$mail->AddAddress($to);
	if($file){
			$mail->AddAttachment($file);
	}
	if(count($more) > 0){
		foreach($more as $k=>$v){
			$mail->AddAddress($v['email']);
		
		}
		
	}
	if(!$mail->Send()) {
		$error = 'Gởi mail bị lỗi: '.$mail->ErrorInfo; 
		return false;
	} else {
		$error = 'Thư của bạn đã được gởi đi ';
		return true;
	}
	}  
function ajaxData($item){
	global $lang;
	$arr = array();
	$arr['content'] = $item['noidung_'.$lang];
	$arr['desc'] = $item['mota_'.$lang];
	$arr['name'] = $item['ten_'.$lang];
	echo json_encode($arr);
	die;

}
function initList($name,$field_name,$table,$id=null){
	global $d;
	echo  '<div style="margin:13px 0" class="col-sm-12">
	<div class="form-group form-group-sm">
		<label for="" class="col-sm-3 control-label">'.$name.'</label> 
			<div class="col-sm-6">
				<select required="" id="'.$field_name.'" class="form-control col-sm-6 id_list_chk" name="'.$field_name.'">
						<option value="">-Chọn -</option>';
							$d->query("select * from #_".$table." order by stt desc");
							foreach($d->result_array() as $k=>$v){
								$slt = '';
								if($id){
									
									if($v['id'] == $id){
										$slt = "selected";
							
									
									}
									
								}
								echo '<option value="'.$v['id'].'" '.$slt.'>'.$v['ten_vi'].'</option>';
								
							
							
							}
						
							echo '</select></div></div></div>';



}



function magic_quote($str, $id_connect=false)	
{	
	if (is_array($str))
	{
		foreach($str as $key => $val)
		{
			$str[$key] = escape_str($val);
		}
		
		return $str;
	}
	
	if (is_numeric($str)) {
		return $str;
	}
	
	if(get_magic_quotes_gpc()){
		$str = stripslashes($str);
	}

	if (function_exists('mysql_real_escape_string') AND is_resource($id_connect))
	{
		return mysql_real_escape_string($str, $id_connect);
	}
	elseif (function_exists('mysql_escape_string'))
	{
		return @mysql_escape_string($str);
	}
	else
	{
		return addslashes($str);
	}
}

#
#	$id_connect : ket noi database
#
function escape_str($str, $id_connect=false)	
{	
	if (is_array($str))
	{
		foreach($str as $key => $val)
		{
			$str[$key] = escape_str($val);
		}
		
		return $str;
	}
	
	if (is_numeric($str)) {
		return $str;
	}
	
	if(get_magic_quotes_gpc()){
		$str = stripslashes($str);
	}

	if (function_exists('mysql_real_escape_string') AND is_resource($id_connect))
	{
		return "'".mysql_real_escape_string($str, $id_connect)."'";
	}
	elseif (function_exists('mysql_escape_string'))
	{
		return "'".mysql_escape_string($str)."'";
	}
	else
	{
		return "'".addslashes($str)."'";
	}
}
// dem so nguoi online //
/////////////////////////
function current_url(){
	return getCurrentPageURL();

}
function count_online(){
/*
CREATE TABLE `camranh_online` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `session_id` varchar(255) NOT NULL,
  `time` int(10) unsigned NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 ;
*/
	global $d;
	$time = 600; // 10 phut
	$ssid = session_id();

	// xoa het han
	$sql = "delete from #_online where time<".(time()-$time);
	$d->query($sql);
	//
	$sql = "select id,session_id from #_online order by id desc";
	$d->query($sql);
	$result['dangxem'] = $d->num_rows();
	$rows = $d->result_array();
	$i = 0;
	while(($rows[$i]['session_id'] != $ssid) && $i++<$result['dangxem']);
	
	if($i<$result['dangxem']){
		$sql = "update #_online set time='".time()."' where session_id='".$ssid."'";
		$d->query($sql);
		$result['daxem'] = $rows[0]['id'];
	}
	else{
		$sql = "insert into #_online (session_id, time) values ('".$ssid."', '".time()."')";
		$d->query($sql);
		$result['daxem'] = mysql_insert_id();
		$result['dangxem']++;
	}
	
	
	
	
	$is_add = 0;
	$d->query("select * from #_statistics where st_ip='".$_SERVER['REMOTE_ADDR']."' and st_week = '".date("W")."' and st_day = '".date("d")."' order by st_time desc");
	if($d->num_rows() == 0){
			$is_add = 1;
	}else{
		$rs = $d->fetch_array();
		if($rs['st_time']+300 < time()){
			$is_add = 1;
		}
	}
	if($is_add){
		$sql = "insert into #_statistics(st_time,st_week,st_month,st_day,st_year,st_ip,st_url) value(".time().",".date("W").",".date("m").",".date("d").",".date("Y").",'".$_SERVER['REMOTE_ADDR']."','".current_url()."')";
		$d->query($sql);
	}	

		$sql = "select * from #_statistics where st_year = '".date("Y")."' and st_month = '".((date("m")))."' and   st_day = '".(date("d")-1)."'";
		
		$d->query($sql);
		$statistics['yesterday'] = $d->num_rows();
		
		$sql = "select * from #_statistics where st_year = '".date("Y")."' and st_month = '".((date("m")))."' and   st_day = '".date("d")."'";
		
		$d->query($sql);
		$statistics['today'] = $d->num_rows();
		
		
		
		$sql = "select * from #_statistics where st_year = '".date("Y")."' and st_month = '".date("m")."' and st_week = '".date("W")."'";
		
		$d->query($sql);
		$statistics['week'] = $d->num_rows();
		$sql = "select * from #_statistics where st_year = '".date("Y")."' and st_week = '".(date("W")-1)."'";
		$d->query($sql);
		
		$statistics['last_week'] = $d->num_rows();
		$sql = "select * from #_statistics where st_year = '".date("Y")."' and st_month = '".date("m")."'";
		$d->query($sql);
		$statistics['month'] = $d->num_rows();
		$sql = "select * from #_statistics where st_year = '".date("Y")."' and st_month = '".(date("m")-1)."'";
		
		$d->query($sql);
		$statistics['last_month'] = $d->num_rows();
		
		$sql = $sql = "select * from #_statistics";
		$d->query($sql);
		$statistics['all'] = $d->num_rows();
		
		$result['advance'] = $statistics;
		
	
	return $result; // array('dangxem'=>'', 'daxem'=>'')
}

function make_date($time,$dot='.',$lang='vi',$f=false){
	
	$str = ($lang == 'vi') ? date("d{$dot}m{$dot}Y",$time) : date("m{$dot}d{$dot}Y",$time);
	if($f){
		$thu['vi'] = array('Chủ nhật','Thứ hai','Thứ ba','Thứ tư','Thứ năm','Thứ sáu','Thứ bảy');
		$thu['en'] = array('Sunday','Monday','Tuesday','Wednesday','Thursday','Friday','Saturday');
		$str = $thu[$lang][date('w',$time)].', '.$str;
	}
	return $str;
}

function alert($s){
	echo '<script language="javascript"> alert("'.$s.'") </script>';
}

function delete_file($file){
		return @unlink($file);
}

function upload_image($file, $extension, $folder, $newname='',$maxw='',$maxh=''){

	if(!$newname){
		$newname = md5(time());
	}
	global $config;
	if(isset($_FILES[$file]) && !$_FILES[$file]['error']){
		
		$ext = @end(explode('.',$_FILES[$file]['name']));
		$name = basename($_FILES[$file]['name'], '.'.$ext);
		
		if(strpos($extension, $ext)===false){
			alert('Chỉ hỗ trợ upload file dạng '.$extension);
			return false; // không hỗ trợ
		}
		
		if($newname=='' && file_exists($folder.$_FILES[$file]['name']))
			for($i=0; $i<100; $i++){
				if(!file_exists($folder.$name.$i.'.'.$ext)){
					$_FILES[$file]['name'] = $name.$i.'.'.$ext;
					break;
				}
			}
		else{
			$_FILES[$file]['name'] = $newname.'.'.$ext;
		}
		
		if (!copy($_FILES[$file]["tmp_name"], $folder.$_FILES[$file]['name']))	{
			if ( !move_uploaded_file($_FILES[$file]["tmp_name"], $folder.$_FILES[$file]['name']))	{
				
				return false;
			}
		}
		
		if(smart_resize_image($folder.$_FILES[$file]['name'],(($maxw) ? $maxw : $config['max-width']),(($maxh) ? $maxh : $config['max-height']))){
			return $_FILES[$file]['name'];
		}else{
		return $_FILES[$file]['name'];
		}
	}
	
	return false;
}

function thumb_image($file, $width, $height, $folder){	

	if(!file_exists($folder.$file))	return false; // không tìm thấy file
	
	if ($cursize = getimagesize ($folder.$file)) {					
		$newsize = setWidthHeight($cursize[0], $cursize[1], $width, $height);
		$info = pathinfo($file);
		
		$dst = imagecreatetruecolor ($newsize[0],$newsize[1]);
		
		$types = array('jpg' => array('imagecreatefromjpeg', 'imagejpeg'),
					'gif' => array('imagecreatefromgif', 'imagegif'),
					'png' => array('imagecreatefrompng', 'imagepng'));
		$func = $types[$info['extension']][0];
		$src = $func($folder.$file); 
		imagecopyresampled($dst, $src, 0, 0, 0, 0,$newsize[0], $newsize[1],$cursize[0], $cursize[1]);
		$func = $types[$info['extension']][1];
		$new_file = str_replace('.'.$info['extension'],'_thumb.'.$info['extension'],$file);
		
		return $func($dst, $folder.$new_file) ? $new_file : false;
	}
}


function setWidthHeight($width, $height, $maxWidth, $maxHeight){
	$ret = array($width, $height);
	$ratio = $width / $height;
	if ($width > $maxWidth || $height > $maxHeight) {
		$ret[0] = $maxWidth;
		$ret[1] = $ret[0] / $ratio;
		if ($ret[1] > $maxHeight) {
			$ret[1] = $maxHeight;
			$ret[0] = $ret[1] * $ratio;
		}
	}
	return $ret;
}


function transfer($msg,$page="index.php")
{
	 $showtext = $msg;
	 $page_transfer = $page;
	 include("./templates/transfer_tpl.php");
	 exit();
}


function redirect($url=''){
	echo '<script language="javascript">window.location = "'.$url.'" </script>';
	exit();
}

function back($n=1){
	echo '<script language="javascript">history.go = "'.-intval($n).'" </script>';
	exit();
}

function chuanhoa($s){
	$s = str_replace("'", '&#039;', $s);
	$s = str_replace('"', '&quot;', $s);
	$s = str_replace('<', '&lt;', $s);
	$s = str_replace('>', '&gt;', $s);
	return $s;
}

function themdau($s){
	$s = addslashes($s);
	return $s;
}

function bodau($s){
	$s = stripslashes($s);
	return $s;
}

function dump($arr, $exit=1){
	echo "<pre>";	
		var_dump($arr);
	echo "<pre>";	
	if($exit)	exit();
}

	function paging($r, $url='', $curPg=1, $mxR=5, $mxP=5, $class_paging='')
	{
		if($curPg<1) $curPg=1;
		if($mxR<1) $mxR=5;
		if($mxP<1) $mxP=5;
		$totalRows=count($r);
		if($totalRows==0)	
			return array('source'=>NULL, 'paging'=>NULL);
		$totalPages=ceil($totalRows/$mxR);
		if($curPg > $totalPages) $curPg=$totalPages;
		
		$_SESSION['maxRow']=$mxR;
		$_SESSION['curPage']=$curPg;

		$r2=array();
		$paging="";
		
		//-------------tao array------------------
		$start=($curPg-1)*$mxR;
		$end=($start+$mxR)<$totalRows?($start+$mxR):$totalRows;
		#echo $start;
		#echo $end;
		
		$j=0;
		for($i=$start;$i<$end;$i++)
			$r2[$j++]=$r[$i];
			
		//-------------tao chuoi------------------
		$curRow = ($curPg-1)*$mxR+1;	
		if($totalRows>$mxR)
		{
			$start=1;
			$end=1;
			$paging1 ="";				 	 
			for($i=1;$i<=$totalPages;$i++)
			{	
				if(($i>((int)(($curPg-1)/$mxP))* $mxP) && ($i<=((int)(($curPg-1)/$mxP+1))* $mxP))
				{
					if($start==1) $start=$i;
					if($i==$curPg){
						$paging1.=" <span>".$i."</span> ";//dang xem
					} 		  	
					else    
					{
						$paging1 .= " <a href='".$url."&curPage=".$i."'  class=\"{$class_paging}\">".$i."</a> ";	
					}
					$end=$i;	
				}
			}//tinh paging
			//$paging.= "Go to page :&nbsp;&nbsp;" ;
			#if($curPg>$mxP)
			#{
				$paging .=" <a href='".$url."' class=\"{$class_paging}\" >&laquo;</a> "; //ve dau
				
				#$paging .=" <a href='".$url."&curPage=".($start-1)."' class=\"{$class_paging}\" >&#8249;</a> "; //ve truoc
				$paging .=" <a href='".$url."&curPage=".($curPg-1)."' class=\"{$class_paging}\" >&#8249;</a> "; //ve truoc
			#}
			$paging.=$paging1; 
			#if(((int)(($curPg-1)/$mxP+1)*$mxP) < $totalPages)  
			#{
				#$paging .=" <a href='".$url."&curPage=".($end+1)."' class=\"{$class_paging}\" >&#8250;</a> "; //ke
				$paging .=" <a href='".$url."&curPage=".($curPg+1)."' class=\"{$class_paging}\" >&#8250;</a> "; //ke
				
				$paging .=" <a href='".$url."&curPage=".($totalPages)."' class=\"{$class_paging}\" >&raquo;</a> "; //ve cuoi
			#}
		}
		$r3['curPage']=$curPg;
		$r3['source']=$r2;
		$r3['paging']=$paging;
		#echo '<pre>';var_dump($r3);echo '</pre>';
		return $r3;
	}
function paging_home($r, $url='', $curPg=1, $mxR=5, $mxP=5, $class_paging='')
	{
		if($curPg<1) $curPg=1;
		if($mxR<1) $mxR=5;
		if($mxP<1) $mxP=5;
		$totalRows=count($r);
		if($totalRows==0)	
			return array('source'=>NULL, 'paging'=>NULL);
		$totalPages=ceil($totalRows/$mxR);
		if($curPg > $totalPages) $curPg=$totalPages;
		
		$_SESSION['maxRow']=$mxR;
		$_SESSION['curPage']=$curPg;

		$r2=array();
		$paging="";
		
		//-------------tao array------------------
		$start=($curPg-1)*$mxR;
		$end=($start+$mxR)<$totalRows?($start+$mxR):$totalRows;
		#echo $start;
		#echo $end;
		
		$j=0;
		for($i=$start;$i<$end;$i++)
			$r2[$j++]=$r[$i];
			
		//-------------tao chuoi------------------
		$curRow = ($curPg-1)*$mxR+1;	
		if($totalRows>$mxR)
		{
			$start=1;
			$end=1;
			$paging1 ="";				 	 
			for($i=1;$i<=$totalPages;$i++)
			{	
				if(($i>((int)(($curPg-1)/$mxP))* $mxP) && ($i<=((int)(($curPg-1)/$mxP+1))* $mxP))
				{
					if($start==1) $start=$i;
					if($i==$curPg){
						$paging1.="<li class='active'><a href='javascript:voi(0)'><span>".$i."</span></a></li>";//dang xem
					} 		  	
					else    
					{
						$paging1 .= "<li> <a href='".$url."&p=".$i."'  class=\"{$class_paging}\">".$i."</li></a> ";	
					}
					$end=$i;	
				}
			}//tinh paging 
			//$paging.= "Go to page :&nbsp;&nbsp;" ;
			#if($curPg>$mxP)
			#{
				$paging = '<ul class="pagination pagination-sm">';
				$paging .=" <li> <a href='".$url."' class=\"{$class_paging}\" >Trang đầu</a> </li>"; //ve dau
				
				#$paging .=" <a href='".$url."&curPage=".($start-1)."' class=\"{$class_paging}\" >&#8249;</a> "; //ve truoc
				$paging .="<li> <a href='".$url."&p=".($curPg-1)."' class=\"{$class_paging}\" >&laquo;</a></li> "; //ve truoc
			#}
			$paging.=$paging1; 
			#if(((int)(($curPg-1)/$mxP+1)*$mxP) < $totalPages)  
			#{
				#$paging .=" <a href='".$url."&curPage=".($end+1)."' class=\"{$class_paging}\" >&#8250;</a> "; //ke
				$paging .=" <li> <a href='".$url."&p=".($curPg+1)."' class=\"{$class_paging}\" >&raquo;</a> </li> "; //ke
				
				$paging .=" <li> <a href='".$url."&p=".($totalPages)."' class=\"{$class_paging}\" >Trang cuối</a></li>  "; //ve cuoi
			#}
		}
		$r3['curPage']=$curPg;
		$r3['source']=$r2;
		$r3['paging']=$paging;
		$r3['total']=$totalRows;
		#echo '<pre>';var_dump($r3);echo '</pre>';
		return $r3;
	}
function catchuoi($chuoi,$gioihan){
// nếu độ dài chuỗi nhỏ hơn hay bằng vị trí cắt
// thì không thay đổi chuỗi ban đầu
if(strlen($chuoi)<=$gioihan)
{
return $chuoi;
}
else{
/*
so sánh vị trí cắt
với kí tự khoảng trắng đầu tiên trong chuỗi ban đầu tính từ vị trí cắt
nếu vị trí khoảng trắng lớn hơn
thì cắt chuỗi tại vị trí khoảng trắng đó
*/
if(strpos($chuoi," ",$gioihan) > $gioihan){
$new_gioihan=strpos($chuoi," ",$gioihan);
$new_chuoi = substr($chuoi,0,$new_gioihan)."...";
return $new_chuoi;
}
// trường hợp còn lại không ảnh hưởng tới kết quả
$new_chuoi = substr($chuoi,0,$gioihan)."...";
return $new_chuoi;
}
}

function stripUnicode($str){
  if(!$str) return false;
   $unicode = array(
     'a'=>'á|à|ả|ã|ạ|ă|ắ|ằ|ẳ|ẵ|ặ|â|ấ|ầ|ẩ|ẫ|ậ',
     'A'=>'Á|À|Ả|Ã|Ạ|Ă|Ắ|Ằ|Ẳ|Ẵ|Ặ|Â|Ấ|Ầ|Ẩ|Ẫ|Ậ',
     'd'=>'đ',
     'D'=>'Đ',
     'e'=>'é|è|ẻ|ẽ|ẹ|ê|ế|ề|ể|ễ|ệ',
   	  'E'=>'É|È|Ẻ|Ẽ|Ẹ|Ê|Ế|Ề|Ể|Ễ|Ệ',
   	  'i'=>'í|ì|ỉ|ĩ|ị',	  
   	  'I'=>'Í|Ì|Ỉ|Ĩ|Ị',
     'o'=>'ó|ò|ỏ|õ|ọ|ô|ố|ồ|ổ|ỗ|ộ|ơ|ớ|ờ|ở|ỡ|ợ',
   	  'O'=>'Ó|Ò|Ỏ|Õ|Ọ|Ô|Ố|Ồ|Ổ|Ỗ|Ộ|Ơ|Ớ|Ờ|Ở|Ỡ|Ợ',
     'u'=>'ú|ù|ủ|ũ|ụ|ư|ứ|ừ|ử|ữ|ự',
   	  'U'=>'Ú|Ù|Ủ|Ũ|Ụ|Ư|Ứ|Ừ|Ử|Ữ|Ự',
     'y'=>'ý|ỳ|ỷ|ỹ|ỵ',
     'Y'=>'Ý|Ỳ|Ỷ|Ỹ|Ỵ'
   );
   foreach($unicode as $khongdau=>$codau) {
     	$arr=explode("|",$codau);
   	  $str = str_replace($arr,$khongdau,$str);
   }
return $str;
}// Doi tu co dau => khong dau

function changeTitle($str)
{
	$str = stripUnicode($str);
	$str = mb_convert_case($str,MB_CASE_LOWER,'utf-8');
	$str = trim($str);
	$str=preg_replace('/[^a-zA-Z0-9\ ]/','',$str); 
	$str = str_replace("  "," ",$str);
	$str = str_replace(" ","-",$str);
	return $str;
}
function getCurrentPageURL() {
    $pageURL = 'http';
    if (@$_SERVER["HTTPS"] == "on") {$pageURL .= "s";}
    $pageURL .= "://";
    if ($_SERVER["SERVER_PORT"] != "80") {
        $pageURL .= $_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"].$_SERVER["REQUEST_URI"];
    } else {
        $pageURL .= $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
    }
	$pageURL = explode("&p=", $pageURL);
    return $pageURL[0];
}
function create_thumb($file, $width, $height, $folder,$file_name,$zoom_crop='1'){

// ACQUIRE THE ARGUMENTS - MAY NEED SOME SANITY TESTS?

$new_width   = $width;
$new_height   = $height;

 if ($new_width && !$new_height) {
        $new_height = floor ($height * ($new_width / $width));
    } else if ($new_height && !$new_width) {
        $new_width = floor ($width * ($new_height / $height));
    }
	
$image_url = $folder.$file;
$origin_x = 0;
$origin_y = 0;
// GET ORIGINAL IMAGE DIMENSIONS
$array = getimagesize($image_url);
if ($array)
{
    list($image_w, $image_h) = $array;
}
else
{
     die("NO IMAGE $image_url");
}
$width=$image_w;
$height=$image_h;

// ACQUIRE THE ORIGINAL IMAGE
$image_ext = @trim(strtolower(end(explode('.', $image_url))));
switch(strtoupper($image_ext))
{
     case 'JPG' :
     case 'JPEG' :
         $image = imagecreatefromjpeg($image_url);
		 $func='imagejpeg';
         break;
     case 'PNG' :
         $image = imagecreatefrompng($image_url);
		 $func='imagepng';
         break;
	 case 'GIF' :
	 	 $image = imagecreatefromgif($image_url);
		 $func='imagegif';
		 break;

     default : die("UNKNOWN IMAGE TYPE: $image_url");
}

// scale down and add borders
	if ($zoom_crop == 3) {

		$final_height = $height * ($new_width / $width);

		if ($final_height > $new_height) {
			$new_width = $width * ($new_height / $height);
		} else {
			$new_height = $final_height;
		}

	}

	// create a new true color image
	$canvas = imagecreatetruecolor ($new_width, $new_height);
	imagealphablending ($canvas, false);

	// Create a new transparent color for image
	$color = imagecolorallocatealpha ($canvas, 255, 255, 255, 0);

	// Completely fill the background of the new image with allocated color.
	imagefill ($canvas, 0, 0, $color);

	// scale down and add borders
	if ($zoom_crop == 2) {

		$final_height = $height * ($new_width / $width);
		
		if ($final_height > $new_height) {
			
			$origin_x = $new_width / 2;
			$new_width = $width * ($new_height / $height);
			$origin_x = round ($origin_x - ($new_width / 2));

		} else {

			$origin_y = $new_height / 2;
			$new_height = $final_height;
			$origin_y = round ($origin_y - ($new_height / 2));

		}

	}

	// Restore transparency blending
	imagesavealpha ($canvas, true);

	if ($zoom_crop > 0) {

		$src_x = $src_y = 0;
		$src_w = $width;
		$src_h = $height;

		$cmp_x = $width / $new_width;
		$cmp_y = $height / $new_height;

		// calculate x or y coordinate and width or height of source
		if ($cmp_x > $cmp_y) {

			$src_w = round ($width / $cmp_x * $cmp_y);
			$src_x = round (($width - ($width / $cmp_x * $cmp_y)) / 2);

		} else if ($cmp_y > $cmp_x) {

			$src_h = round ($height / $cmp_y * $cmp_x);
			$src_y = round (($height - ($height / $cmp_y * $cmp_x)) / 2);

		}

		// positional cropping!
		if (@$align) {
			if (strpos ($align, 't') !== false) {
				$src_y = 0;
			}
			if (strpos ($align, 'b') !== false) {
				$src_y = $height - $src_h;
			}
			if (strpos ($align, 'l') !== false) {
				$src_x = 0;
			}
			if (strpos ($align, 'r') !== false) {
				$src_x = $width - $src_w;
			}
		}

		imagecopyresampled ($canvas, $image, $origin_x, $origin_y, $src_x, $src_y, $new_width, $new_height, $src_w, $src_h);

    } else {

        // copy and resize part of an image with resampling
        imagecopyresampled ($canvas, $image, 0, 0, 0, 0, $new_width, $new_height, $width, $height);

    }
	


$new_file=$file_name.'_'.$new_width.'x'.$new_height.'.'.$image_ext;
// SHOW THE NEW THUMB IMAGE
if($func=='imagejpeg') $func($canvas, $folder.$new_file,100);
else $func($canvas, $folder.$new_file,floor ($quality * 0.09));

return $new_file;
}
function ChuoiNgauNhien($sokytu){
$chuoi="ABCDEFGHIJKLMNOPQRSTUVWXYZWabcdefghijklmnopqrstuvwxyzw0123456789";
for ($i=0; $i < $sokytu; $i++){
	$vitri = mt_rand( 0 ,strlen($chuoi) );
	$giatri= $giatri . substr($chuoi,$vitri,1 );
}
return $giatri;
} 
/*
function load_view($file){
	ob_start();
	include _template.$file."_tpl.php";
	$content = ob_get_contents();
	ob_end_clean();
	return $content;
}

function check_browser(){
	$useragent = $_SERVER['HTTP_USER_AGENT'];

	if (preg_match('|MSIE ([0-9].[0-9]{1,2})|',$useragent,$matched)) {
			$browser_version=$matched[1];
			$browser = 'IE';
	} elseif (preg_match( '|Opera ([0-9].[0-9]{1,2})|',$useragent,$matched)) {
			$browser_version=$matched[1];
			$browser = 'Opera';
	} elseif(preg_match('|Firefox/([0-9\.]+)|',$useragent,$matched)) {
			$browser_version=$matched[1];
			$browser = 'Firefox';
	} elseif(preg_match('|Safari/([0-9\.]+)|',$useragent,$matched)) {
			$browser_version=$matched[1];
			$browser = 'Safari';
	} else {
			// browser not recognized!
			$browser_version = 0;
			$browser= 'other';
	}
	return $browser;
}

function check_yahoo($nick_yahoo='nthaih'){
	$file = @fopen("http://opi.yahoo.com/online?u=".$nick_yahoo."&m=t&t=1","r");
	$read = @fread($file,200);
	
	if($read==false || strstr($read,"00"))
		$img = '<img src="media/images/yahoo_offline.gif" width="155" height="46" border="0" />';
	else
		$img = '<img src="media/images/yahoo_online.gif" width="155" height="46" border="0" />';
	return '<a href="ymsgr:sendIM?'.$nick_yahoo.'">'.$img.'</a>';
}

function check_skype($nick_skype='ha.ngoc.thai'){
#		if(strlen(@file_get_contents("http://mystatus.skype.com/bigclassic/".$nick_skype))>2000)
		$img = '<img src="media/images/skype_online.gif" width="93" height="46" border="0" />';
#		else
#			$img = '<img src="media/images/skype_offline.gif" width="93" height="46" border="0" />';
	//alert(strlen(@file_get_contents("http://mystatus.skype.com/bigclassic/".$nick_skype)));
	return '<a href="skype:'.$nick_skype.'?call">'.$img.'</a>';
}

function tran($s){
	global $translate;
	#return $translate['Họ tên'];
	return strtr($s, $translate);
}

function redirect_error($n){
	switch ($n) {
		case '404' :
			echo "<center><h1>PAGE NOT FOUND</h1></center>";
			#echo "<script language='javascript'> window.location = 'error_404.html' </-------------script>";
			exit();
		default :
			alert('Kiem tra lai redirect_error');
			exit();
	}
}

function bodau2($s){
	$s = chuanhoa($s);
	$s = stripslashes($s);
	return $s;
}
function parent_alert($s){
	echo '<script language="javascript"> parent.alert("'.$s.'") </script>';
}

function parent_redirect($ur=''){
	echo '<script language="javascript">parent.location = "'.site($ur).'" </script>';
	exit();
}
function back($n=1){
	echo '<script language="javascript"> history.go('.-$n.'); </script>';
}
function goto($ur=''){
	echo '<script language="javascript">window.location = "'.$ur.'" </script>';
	exit();
}
//////////////  URL  //////////////////
///////////////////////////////////////////
function site($s=''){
	if(!DEBUG)
		$s = url_encode($s);
	return 'index.php?'.$s;

	$ur = 'index.php?'.$s;
	return url_encode($s);
	return $ur;
}

function url_encode($s){
	return  base64_encode($s);
}

function url_decode($s)	{
	return base64_decode($s);
}

function get_url(){
	$get = array();
	
	$query_str = !DEBUG ? url_decode($_SERVER['QUERY_STRING']) : $_SERVER["QUERY_STRING"];
	
	$parts = explode('&',$query_str);
	$get['com'] = $parts[0];
	for($i=1; $i<count($parts); $i++){
		$seg = explode( '=', $parts[$i]);
		$get[$seg[0]] = $seg[1];
	}
	$get['com'] = str_replace('-','/',$get['com']);
	return $get;
}


function check_login(){
	if(!isset($_SESSION['site_log']) || $_SESSION['site_log']==false)
		$_GET["com"] = "login";
}

function get_file($com, $act){
	#$com = isset($_GET['com']) ? $_GET['com'] : "index";
	$act = empty($act) ? '' : '_'.$act;
	$file['mod'] = "app/mod/".$com.$act."_mod.php";
	$file['ctr'] = "app/ctr/".$com.$act.".php";
	$file['view'] = "app/view/".$com.$act."_tpl.php";
	return $file;
}

function error_404(){
	if( DEBUG )
		header("Location: ../errors/error_404.php?com=".$_GET['com']);
	else
		header("Location: ../errors/error_404.php");
}

function top_content(){
	require_once "view/layout/top_tpl.php";
}

function bottom_content(){
	require_once "view/layout/bottom_tpl.php";
}

function main_content(){
	$file = get_file();	
	$error_nopage = 0;
	#dump($file);
	if( file_exists($file['mod'])) 
		require_once $file['mod'];
	if( file_exists($file['ctr'])){
		require_once $file['ctr'];
		$error_nopage ++;
	}
	if( file_exists($file['view'])){
		require_once $file['view'];
		$error_nopage++;
	}
	if($error_nopage == 0)
		error_404();
}




//////////////  FORM  //////////////////
///////////////////////////////////////////
function form_select($conf, $vals){
	$name = $conf['n'];
	$v = $conf['v'];
	$t = $conf['t'];
	$s = $conf['s'];
	$danh_muc = '<select id="$name" name="$name">';
	$danh_muc .= '<option value=""> ---- Select ---- </option>';
	for($i=0; $i<count($vals); $i++){
		$danh_muc .= "<option value=".$vals[$i][$v];
		if($vals[$i][$v]==$s) 
			$danh_muc .= " selected ";
		$danh_muc .= ">";
		$danh_muc .= $vals[$i][$t];
		$danh_muc .= '</option>';
	}
	$danh_muc .= '</select>';
	return $danh_muc;
}

function form_select_2($conf, $vals){
	$name = $conf['n'];
	$v = $conf['v'];
	$t = $conf['t'];
	$s = $conf['s'];
	$danh_muc = '<select id="$name" name="$name">';
	$danh_muc .= '<option value=""> ---- Chọn danh mục ---- </option>';
	for($i=0; $i<count($vals); $i++){
		$danh_muc .= "<option value=".$vals[$i][$v];
		if($vals[$i][$v]==$s) 
			$danh_muc .= " selected ";
		$danh_muc .= ">";
		$danh_muc .= $vals[$i][$t."_vi"]." - ".$vals[$i][$t."_en"];
		$danh_muc .= '</option>';
	}
	$danh_muc .= '</select>';
	return $danh_muc;
}
// echo form_select(array('n'=>'id_cat', 'v'=>'id', 't'=>'ten_vi', 's'=>$id_cat), $news_cats);

//////////////  PHAN TRANG  //////////////////
///////////////////////////////////////////

	function getUrl()
	{
		if(strpos($_SERVER['QUERY_STRING'],'&curPage')!==false)
			$url='?'.substr($_SERVER['QUERY_STRING'],0,strpos($_SERVER['QUERY_STRING'],'&curPage'));
		else
			$url='?'.$_SERVER['QUERY_STRING'];
		return $url;
	}

*/
#----------------------------------------------------------	
function check($s){
	echo "<pre>";
	print_r($s);
	echo "</pre>";
}
function getIP(){
	if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
    $ip = $_SERVER['HTTP_CLIENT_IP'];
} elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
    $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
} else {
    $ip = $_SERVER['REMOTE_ADDR'];
}
return $ip;
}
function getBrowser(){
	return $_SERVER['HTTP_USER_AGENT'];
}

function cutString($str,$len=200,$more=''){
	if ($str=="" || $str==NULL) return $str;
	if (is_array($str)) return $str;
	$str = trim($str);
	if (strlen($str) <= $len) return $str;
	$str = substr($str,0,$len);
	if ($str != "") {
	if (!substr_count($str," ")) {
	if ($more) $str .= " ...";
	return $str;
	}
	while(strlen($str) && ($str[strlen($str)-1] != " ")) {
	$str = @substr($str,0,-1);
	}
	$str = substr($str,0,-1);
	if ($more){ $str .=$more;}else{
					$str .= ' ...';
				}   
					
	}
	return $str;
}
function checkValidUrl($url){
	 $regex = "|^http(s)?://[a-z0-9-]+(.[a-z0-9-]+)*(:[0-9]+)?(/.*)?$|i";   
     return preg_match($regex, $url);
}
function getYoutubeIdFromUrl($url) {
    $parts = parse_url($url);
    if(isset($parts['query'])){
        parse_str($parts['query'], $qs);
        if(isset($qs['v'])){
            return $qs['v'];
        }else if($qs['vi']){
            return $qs['vi'];
        }
    }
    if(isset($parts['path'])){
        $path = explode('/', trim($parts['path'], '/'));
        return $path[count($path)-1];
    }
    return false;
}
function videoType($url) {
    if (strpos($url, 'youtube') > 0) {
        return 'youtube';
    } elseif (strpos($url, 'vimeo') > 0) {
        return 'vimeo';
    } else {
        return false;
    }
}
function showEr(){
    error_reporting(E_ALL);
}
if(!function_exists("myformat")){
   function myformat($num,$ext=' đ',$default = false){
       if($num==0){
         if(!$default){
             return 0;
         }else{
             return myconfig("default_price");
         }
       }else{
           return @number_format($num, 0,'', '.').$ext;
       }
    }
}
function getLocation($address)	{ 
	
	$prepAddr = str_replace(' ','+',$address);
	$geocode=file_get_contents('http://maps.google.com/maps/api/geocode/json?address='.$prepAddr.'&sensor=false');
	$output= json_decode($geocode);
	$latitude = $output->results[0]->geometry->location->lat;
	$longitude = $output->results[0]->geometry->location->lng;
	return array("x"=>$latitude,"y"=>$longitude);
	}
function getThumb($url,$type=0){
	//return "timthumb.php
	
}
function isAjaxRequest(){
	if (isset($_SERVER['HTTP_X_REQUESTED_WITH']) AND strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest') 
		return true;
	return false;
}
function initSeo(&$data){
	global $config;
	$data['seo_title'] = $_POST['seo_title'];
	$data['seo_keyword'] = $_POST['seo_keyword'];
	$data['seo_description'] = $_POST['seo_description'];
	//if(!$data['seo_title']))[

	/*
	
	$title = '';
	$desc = '';
	$key = '';
	foreach($config['lang'] as $k=>$v){
		if(isset($data['ten_'.$v]) & !$title){
			$title = $data['ten_'.$v];
		}
		if(isset($data['mota_'.$v]) & !$desc){
			$desc = strip_tags($data['mota_'.$v]);
		}
		if(isset($data['mota_'.$v]) & !$key){
			$key = strip_tags($data['mota_'.$v]);
		}
		
	}
	if(!$data['seo_title']){
		$data['seo_title'] = ($title);
	}
	if(!$data['seo_description']){
		$data['seo_description'] = ($desc);
	}
		if(!$data['seo_description']){
		$data['seo_description'] = ($title);
	}
	
	if(!$data['seo_keyword']){
		if($key){
		
			$key=url_title($key);

			$ar = array();
			
			foreach(custom_shuffle(explode(" ",$key)) as $k=>$v){
				if($k <= 30){
					$ar[] = $v;
				}
			}
			
			$data['seo_keyword'] = magic_quote(implode(',',$ar));
		
		}else{
			$data['seo_keyword'] = ($title);
		}
		
	}
	*/
}
 function url_title($str, $separator = 'dash', $lowercase = TRUE)
	{
		
		if ($separator == 'dash')
		{
			$search		= '_';
			$replace	= '-';
		}
		else
		{
			$search		= '-';
			$replace	= '_';
		}
		
		$trans = array(
						'&\#\d+?;'				=> '',
						'&\S+?;'				=> '',
						//'\s+'					=> $replace,
						'/([^\pL\.\ ]+)/u'		=> '',
						//'[^a-z0-9\-\._]'		=> '',
						$replace.'+'			=> $replace,
						$replace.'$'			=> $replace,
						'^'.$replace			=> $replace,
						'\.+$'					=> ''
						
					);

		$str = strip_tags($str);
		$str = str_replace('(','',$str);
		$str = str_replace('.','',$str);
		$str = str_replace(')','',$str);
		$str = str_replace(',','',$str);
		foreach ($trans as $key => $val)
		{
			$str = preg_replace("#".$key."#i", $val, $str);
		}
		$str = str_replace('-','',$str);
		
		$str = str_replace('-','',$str);
		if ($lowercase === TRUE)
		{
			$str = mb_strtolower($str,'UTF-8');
		}
		
		return trim(stripslashes($str));
	}
/*
* return an array whose elements are shuffled in random order.
*/
function custom_shuffle($my_array = array()) {
  $copy = array();
  while (count($my_array)) {
    // takes a rand array elements by its key
    $element = array_rand($my_array);
    // assign the array and its value to an another array
    $copy[$element] = $my_array[$element];
    //delete the element from source array
    unset($my_array[$element]);
  }
  return $copy;
}

/* init add table */
function initAdd($table=_table,$cate = false){
	global $d,$stt,$cate,$list,$cat;
	if(!isset($_GET['id'])){
	$sql="select * from #_".$table;
	$d->query($sql);
	$stt = $d->num_rows()+1;
	}
	$table = str_replace("_danhmuc","",$table);
	$table = str_replace("_list","",$table);
	$table = str_replace("_cat","",$table);

	$d->query("SHOW TABLES LIKE '#_".$table."_danhmuc'");

	if($d->num_rows()==1){
	
		$sql = "select * from #_".$table."_danhmuc"." order by stt asc";
		$d->query($sql);
		$rs = $d->result_array();
		$is_list = false;
		$d->reset();
		$d->query("SHOW TABLES LIKE '#_".$table."_list'");
		if($d->num_rows()==1){
			$is_list = true;
		}
		$is_cat = false;
		$d->reset();
		$d->query("SHOW TABLES LIKE '#_".$table."_cat'");
		if($d->num_rows()==1){
			$is_cat = true;
		}
		foreach($rs as $k=>$v){
			$cate[$v['id']] = $v['ten_vi'];/* ten_vi la bat buoc */
			if($is_list){
				$sql = "select * from #_".$table."_list where id_danhmuc = ".$v['id']." order by stt asc";
				$d->query($sql);
				$rs_list = $d->result_array();
				$ar_tmp = array();
				foreach($rs_list as $k2=>$v2){
					$ar_tmp[$v2['id']] = $v2['ten_vi'];
					if($is_cat){
						$sql = "select * from #_".$table."_cat where id_list = ".$v2['id']." order by stt asc";
						
						$d->query($sql);
						$rs_cat = $d->result_array();
						$ar_tmp_cat = array();
						foreach($rs_cat as $k3=>$v3){
							$ar_tmp_cat[$v3['id']] = $v3['ten_vi'];
						}
						
						$cat[$v2['id']] = $ar_tmp_cat;
					
						
					}
				}
				$list[$v['id']] = $ar_tmp;
				
				
				
			}
		
		}
	
	}
		

}
function get_main_item2($item, $lv = 3) {
    //global $cate,$list,$cat;
    global $cate, $list, $cat;
	
    if (count($cate) > 0) {
        $str = '';
        $str2 = '';
        $str3 = '';
        $json = json_encode(array());
        $json2 = $json3 = $json;

        $long = '<div style="margin:13px 0" class="col-sm-12"><div class="form-group"><label for="" class="col-sm-3 control-label">';

        $str = '<select id="id_danhmuc" required  class="form-control col-sm-6 id_danhmuc_chk" name="id_danhmuc"><option value="0">-Chọn danh mục-</option>';
        $check = 0;
        if (isset($item)) {
            $check = $item['id_danhmuc'];
        }
        foreach ($cate as $k => $v) {
            $slt = '';
            if ($k == $check) {
                $slt = 'selected';
            }
            $str.= '<option value="' . $k . '" ' . $slt . '>' . $v . '</option>';
        }
        $title = "Danh mục bài viết";
        if (count($list) > 0) {
            $title = "Danh mục cấp 1";
            $rtitle = "Danh mục cấp 2";
            $json = json_encode($cate);
            $check = 0;
            if (isset($item)) {
                $check = $item['id_list'];
            }
            $json2 = json_encode($list);
            $str2 = '<select required id="id_list" class="form-control col-sm-6 id_list_chk" name="id_list"><option value="0">-Chọn danh mục-</option>';
            if (isset($item)) {

                foreach ($list[$item['id_danhmuc']] as $k => $v) {

                    $slt = '';
                    if ($k == $check) {
                        $slt = 'selected';
                    }

                    $str2.= '<option value="' . $k . '" ' . $slt . '>' . $v . '</option>';
                }
            }

            $str2 = $long . $rtitle . ':</label> <div class="col-sm-6">' . $str2 . '</select></div></div></div>';
            if (@count($cat) > 0) {
                $title = "Danh mục cấp 1";
                $rtitle = "Danh mục cấp 2";
                $r2title = "Danh mục cấp 3";
                $json3 = json_encode($cat);
                $check = 0;


                if (isset($item)) {
                    $check = $item['id_cat'];
                }
                $json3 = json_encode($cat);
                $str3 = '<select id="id_cat" required class="form-control col-sm-6 id_cat_chk" name="id_cat"><option value="0">-Chọn danh mục-</option>';
                if (isset($item)) {

                    foreach ($cat[$item['id_list']] as $k => $v) {

                        $slt = '';
                        if ($k == $check) {
                            $slt = 'selected';
                        }

                        $str3.= '<option value="' . $k . '" ' . $slt . '>' . $v . '</option>';
                    }
                }

                $str3 = $long . $r2title . ':</label> <div class="col-sm-6">' . $str3 . '</select></div></div></div>';
            }
        }




        $str = $long . $title . ':</label> <div class="col-sm-6">' . $str . '</select></div></div></div>';
        if ($lv == 1) {
            return $str;
        } else {
            echo '<script>$().ready(function(){setCategory(' . $json . ',' . $json2 . ',' . $json3 . ');});</script>';
        }
        if ($lv == 2) {



            return $str . $str2;
        }

        if ($lv == 3) {

            return $str . $str2 . $str3;
        }
    }
}
	
	
	
	
	
	
	
	
	
	function smart_resize_image($file,
                              $width              = 0, 
                              $height             = 0, 
                              $proportional       = true, 
                              $output             = 'file', 
                              $delete_original    = true, 
                              $use_linux_commands = false ) {
							
							  
      
    if ( $height <= 0 && $width <= 0 ) return false;

    # Setting defaults and meta
    $info                         = getimagesize($file);
    $image                        = '';
    $final_width                  = 0;
    $final_height                 = 0;
    list($width_old, $height_old) = $info;

	

	if(($width_old < $width) | ($height_old < $height)){
	
		return false;

	}

    # Calculating proportionality
    if ($proportional) {
      if      ($width  == 0)  $factor = $height/$height_old;
      elseif  ($height == 0)  $factor = $width/$width_old;
      else                    $factor = min( $width / $width_old, $height / $height_old );

      $final_width  = round( $width_old * $factor );
      $final_height = round( $height_old * $factor );
    }
    else {
      $final_width = ( $width <= 0 ) ? $width_old : $width;
      $final_height = ( $height <= 0 ) ? $height_old : $height;
    }
	ini_set('memory_limit', '-1');
    # Loading image to memory according to type
    switch ( $info[2] ) {
      case IMAGETYPE_JPEG:  $image = imagecreatefromjpeg($file);  break;
      case IMAGETYPE_GIF:   $image = imagecreatefromgif($file);   break;
      case IMAGETYPE_PNG:   $image = imagecreatefrompng($file);   break;
      default: return false;
    }
    
    
    # This is the resizing/resampling/transparency-preserving magic
    $image_resized = imagecreatetruecolor( $final_width, $final_height );
    if ( ($info[2] == IMAGETYPE_GIF) || ($info[2] == IMAGETYPE_PNG) ) {
      $transparency = imagecolortransparent($image);

      if ($transparency >= 0) {
        $transparent_color  = imagecolorsforindex($image, $trnprt_indx);
        $transparency       = imagecolorallocate($image_resized, $trnprt_color['red'], $trnprt_color['green'], $trnprt_color['blue']);
        imagefill($image_resized, 0, 0, $transparency);
        imagecolortransparent($image_resized, $transparency);
      }
      elseif ($info[2] == IMAGETYPE_PNG) {
        imagealphablending($image_resized, false);
        $color = imagecolorallocatealpha($image_resized, 0, 0, 0, 127);
        imagefill($image_resized, 0, 0, $color);
        imagesavealpha($image_resized, true);
      }
    }
    imagecopyresampled($image_resized, $image, 0, 0, 0, 0, $final_width, $final_height, $width_old, $height_old);
    
    # Taking care of original, if needed
    if ( $delete_original ) {
      if ( $use_linux_commands ) exec('rm '.$file);
      else @unlink($file);
    }

    # Preparing a method of providing result
    switch ( strtolower($output) ) {
      case 'browser':
        $mime = image_type_to_mime_type($info[2]);
        header("Content-type: $mime");
        $output = NULL;
      break;
      case 'file':
        $output = $file;
      break;
      case 'return':
        return $image_resized;
      break;
      default:
      break;
    }
    
    # Writing image according to type to the output destination
    switch ( $info[2] ) {
      case IMAGETYPE_JPEG:  imagejpeg($image_resized, $output);   break;
      case IMAGETYPE_GIF:   imagegif($image_resized, $output);    break;
      case IMAGETYPE_PNG:   imagepng($image_resized, $output);    break;
      default: return false;
    }

    return true;
  }
  
  function advanceStatictis(){	
		global $d;
		$is_add = 0;
		$d->query("select * from #_statistics where st_ip='".@$_SERVER['REMOTE_ADDR']."' and st_week = '".date("W")."' and st_day = '".date("d")."' order by st_time desc");
		if($d->num_rows() == 0){
				$is_add = 1;
		}else{
			$rs = $d->fetch_array();
			if($rs['st_time']+300 < time()){
				$is_add = 1;
			}
		}
		if($is_add){
			$sql = "insert into #_statistics(st_time,st_week,st_month,st_day,st_year,st_ip,st_url) value(".time().",".date("W").",".date("m").",".date("d").",".date("Y").",'".$_SERVER['REMOTE_ADDR']."','')";
			$d->query($sql);
		}	
		$sql = "select * from #_statistics where st_year = '".date("Y")."' and st_week = '".date("W")."'";
		$d->query($sql);
		$statistics['week'] = $d->num_rows();
		$sql = "select * from #_statistics where st_year = '".date("Y")."' and st_month = '".date("m")."'";
		$d->query($sql);
		$statistics['month'] = $d->num_rows();
		$sql = $sql = "select * from #_statistics";
		$d->query($sql);
		$statistics['all'] = $d->num_rows();
		
		
		
		return $statistics;
  
  
  }
function addingSeo($rs) {

    global $keyword, $description;
    if ($rs['seo_keyword']) {
        $keyword = $rs['seo_keyword'];
    }

    if ($rs['seo_description']) {
        $description = $rs['seo_description'];
    }
}