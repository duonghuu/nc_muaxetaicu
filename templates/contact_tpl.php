<link href="assets/css/lienhe.css" type="text/css" rel="stylesheet" />
<link href="assets/css/map.css" type="text/css" rel="stylesheet" />
<script language="javascript">
function js_submit(){
	if(isEmpty(document.getElementById('tenlienhe'), "<?=fill._c_fullname?>")){
		document.getElementById('tenlienhe').focus();
		return false;
	}
	
	if(isEmpty(document.getElementById('diachi'), "<?=fill._c_address?>")){
		document.getElementById('diachi').focus();
		return false;
	}
	
	if(isEmpty(document.getElementById('dienthoai'), "<?=fill._c_phone?>")){
		document.getElementById('dienthoai').focus();
		return false;
	}
	

	
	if(!check_email(document.frm.email.value)){
		alert("Email <?=not_valid?>");
		document.frm.email.focus();
		return false;
	}
	
	if(isEmpty(document.getElementById('tieude'), "<?=fill._c_title?>")){
		document.getElementById('tieude').focus();
		return false;
	}
	
	if(isEmpty(document.getElementById('noidung'), "<?=fill._c_content?>")){
		document.getElementById('noidung').focus();
		return false;
	}
	
	document.frm.submit();
}
</script>

<div class="">

		
<div class="box_containerlienhe" style="">
<div class="title-global"><h2><?=_contact?></h2><div class="clearfix"></div></div>
   <div class="content">
            <div class="fix-title"><?=$company_contact['noidung_'.$lang];?> </div>
			<div class="col-md-12  col-sm-12 col-xs-12">
				 <div class="row">
					 <ul class="list_map">
            	
            </ul>
			
            	<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=true"></script>

		    <script type="text/javascript">
		   var map;
		   var infowindow;
		   var marker= new Array();
		   var old_id= 0;
		   var infoWindowArray= new Array();
		   var infowindow_array= new Array();function initialize(){
			   var defaultLatLng = new google.maps.LatLng(<?=$lienhe_rs['map_x']?>,<?=$lienhe_rs['map_y']?>);
			   var myOptions= {
				   zoom: 16,
				   center: defaultLatLng,
				   scrollwheel : false,
				   mapTypeId: google.maps.MapTypeId.ROADMAP
				};
				map = new google.maps.Map(document.getElementById("map_canvas"), myOptions);map.setCenter(defaultLatLng);
			    
			   var arrLatLng = new google.maps.LatLng(<?=$lienhe_rs['map_x']?>,<?=$lienhe_rs['map_y']?>);
			   infoWindowArray[7895] = '<div class="map_description"><div class="map_title"><?=$result_hotline['ten_'.$lang]?></div><div>Địa Chỉ : <?=$result_hotline['diachi_'.$lang]?> - Điện thoại: <?=$result_hotline['dienthoai_'.$lang]?>  </div></div>';
			   loadMarker(arrLatLng, infoWindowArray[7895], 7895);
			   
			   
			   moveToMaker(7895);}
			   function loadMarker(myLocation, myInfoWindow, id)
			   {marker[id] = new google.maps.Marker({position: myLocation, map: map, visible:true});
			   var popup = myInfoWindow;infowindow_array[id] = new google.maps.InfoWindow({ content: popup});
			   google.maps.event.addListener(marker[id], 'mouseover', function() {if (id == old_id) return;
			   if (old_id > 0) infowindow_array[old_id].close();infowindow_array[id].open(map, marker[id]);old_id = id;});
			   google.maps.event.addListener(infowindow_array[id], 'closeclick', function() {old_id = 0;});
			   }function moveToMaker(id){
			   var location = marker[id].position;map.setCenter(location);
			   if (old_id > 0) infowindow_array[old_id].close();infowindow_array[id].open(map, marker[id]);old_id = id;
			   }</script>
           <div id="map_canvas"></div>
           
				 </div><!-- col -->
				
				 </div>
             <div class="clear"></div><br />  	                   
            
            <div class="box_contact_r">
			<div class="col-md-12 col-sm-12 col-xs-12">
			
			<form method="post" name="frm" action="">

      <table width="100%" cellpadding="5" cellspacing="0" border="0" class="tablelienhe">
                        <tr>
                        <td><?=_c_fullname?>:<span style="color:red;">*</span></td>
						<td><input name="tenlienhe" type="text" class="input" id="tenlienhe" size="40" /></td>
                        </tr>                        
                         <tr>
                        <td><?=_c_address?>:<span style="color:red;">*</span></td>
						<td><input name="diachi" id="diachi" type="text"  class="input" size="40" /></td>
                        </tr>
                        <tr>
                        <td><?=_c_phone?>:<span style="color:red;">*</span></td>
						<td><input name="dienthoai" type="text" class="input" id="dienthoai" size="40"/></td>
                        </tr>
                        <tr>
                        <td>Email<span style="color:red;">*</span></td>
						<td><input name="email" id="email" type="text" class="input" size="40"  /></td>
                        </tr>                                                  
                        <tr>
                        <td><?=_c_title?>:<span style="color:red;">*</span></td>
						<td>
						<input name="tieude" type="text" class="input" id="tieude" size="40"  />
						</td>
                        </tr>                         
                        <tr>
                        <td><?=_c_content?>:<span style="color:red;">*</span></td>
						<td>
                        <textarea name="noidung" cols="35" rows="5" class="ta_noidung" id="noidung" style="background-color:#FFFFFF; color:#666666;"></textarea>
                        </td>
                        </tr>
                         <tr>
                         <td>&nbsp;</td>
                        <td> 
                    <input class="button" type="button" value="<?=_c_send?>" onclick="js_submit();" />
                    <input class="button" type="button" value="<?=_c_reset?>" onclick="document.frm.reset();" />
                                                         
                        </td>
						</tr>
                        </table>   
	             </form>
				 </div><!-- col -->
				 
				  <div class="clearfix"></div>
				</div>
                
                <div class="clear"></div>
               
           
           
            </div>
</div>
</div>
