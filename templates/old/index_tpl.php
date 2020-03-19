<?php
	$d->reset();
	$sql_hotline="select diachi,dienthoai,email,ten,fax from #_hotline limit 0,1";
	$d->query($sql_hotline);
	$result_hotline=$d->fetch_array();



?>

			<div class="wrap-tab-index">
				<div class="tab-index">
					
						<ul id="myTab" class="nav nav-tabs">
						  <li class="active"><a href="#home" data-toggle="tab"><?=_customer_album?></a></li>
						  <li class=""><a href="#profile" data-toggle="tab"><?=_news?></a></li>
						  <li class=""><a href="#share" data-toggle="tab"><?=_share?></a></li>
						</ul>
						<div id="myTabContent" class="tab-content">
						  <div class="tab-pane fade active in" id="home">
							<div id="content-1" class="content horizontal-images">
							<ul>
							<?php
								$d->reset();
								$d->query("select * from #_gallery where hienthi = 1 order by rand()");
								$result = $d->result_array();
								foreach($result as $k=>$v){
									$d->reset();
									$d->query("select * from #_photo where com = '".$v['type']."' and id_cat = ".$v['id']." order by rand()");
									
									$count = $d->num_rows();
									$fetch = $d->fetch_array();
									
									if(videoType($fetch['photo'])=='youtube'){
														
										$fetch['photo'] = 'http://img.youtube.com/vi/'.getYoutubeIdFromUrl($fetch['photo']).'/0.jpg';
									}else{
										if(!checkValidUrl($fetch['photo'])){
											$fetch['photo'] = _upload_hinhanh_l.$fetch['photo'];
										}
									}
									
									
									if($count > 0){
										
										
										echo '<li><a title="'.$v['ten_'.$lang].'" href="'.$v['type'].'/'.$v['id'].'/'.$v['tenkhongdau'].'.html" /><img src="'.$fetch['photo'].'" height="128px"/></a></li>';
										
										
									}
									
								}
								
							
							
							
							?>
							
								</ul>
							</div>
							
							
							
							
							
							
							
						  </div>
						  <div class="tab-pane fade" id="profile">
							<script src="assets/js/jquery-simple-pagination-plugin.js" type="text/javascript"></script>
							<?php
								
							?>
							
							<div class="wap_box_new" id="news-box-index">
									<?php
									$d->reset();
									$d->query("select * from #_news where loaitin='news' order by stt,id desc");
									$rs = $d->result_array();
									?>
									<table>
									<?php
										foreach($rs as $k=>$v){
										?>
										<tr><td>
										<div class="box_new">
											<a href="news/<?=$v['id']?>/<?=$v['tenkhongdau']?>.html"><img src="<?=_upload_hinhanh_l.$v['photo']?>"><h4><?=$v['ten_'.$lang]?></h4></a>                  
											<div class="date"><?=date("d/m/Y",$v['ngaytao'])?></div>
											<p><?=cutString(strip_tags($v['mota_'.$lang]))?></p>
											<a class="chitiet" href="news/<?=$v['id']?>/<?=$v['tenkhongdau']?>.html"><?=_read_cotinue?></a>
										</div><!---END .box_new-->
										</td></tr>
										<?php
										}
									
									?>
										
									</table>
									
										  
							  <div class="my-navigation">
									<ul class="pagination pagination-sm">
									  <li><a class="simple-pagination-previous" href="javascript:void(0)">&laquo;</a></li>
									 <li><a class="simple-pagination-next" href="javascript:void(0)">&raquo;</a></li>
									</div>
									
								</div>  
								<div class="clear"></div>    
						
							
							
							
							
							
							
							
							
						  </div>
						  <div class="tab-pane fade" id="share" style="background:#fff">
						  <div class="wrap-fb">
						  <?php
							$d->reset();
							$social = "select * from #_config where type='social' and `key`='facebook'";
							$d->query($social);
							$social = $d->fetch_array();	
							
							?>
							<div id="fb-root"></div>
<div id="fb-root"></div>
<script>

(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&appId=744714818880270&version=v2.0";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>							<div class="fb-like-box" data-href="<?=$social['content']?>" data-width="700" data-height="500" data-colorscheme="light" data-show-faces="true" data-header="true" data-stream="true" data-show-border="true"></div>
							
							
							
		
</div><!-- end wrap-fbb -->		
							
							
							
						  </div>
						</div>		
 
				</div>
				<div class="support">
					<div class="title">
						<?=_support_online?>
					</div>
					<div class="content">
						<div class="hotline">
						<i></i>
							<span>HOTLINE :</span><?=$result_hotline['dienthoai']?>
						</div>
						<p></p>
						<div class="email">
						<i></i>
							<span>EMAIL :</span> <?=$result_hotline['email']?>
						</div>
					</div>
				</div>
				
			  </div>
			
