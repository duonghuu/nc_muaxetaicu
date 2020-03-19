
					<section>
<div class="index-content small-content">
					<div class="title-global">
					
						<h2 class="green"><?=$title_cat?></h2>
						<div class="clearfix"></div>
					</div>
					

				
					
					<div class="col-xs-12">
						<div class="content fix-row">
							<?php
								$i=0;
								foreach($tintuc as $k2=>$v2){
									$i++;
									echo '<div class="col-xs-4 "><div class="fix-row list-item">';
										echo '<div class="small-item">';
										
										$photo = 'http://img.youtube.com/vi/'.getYoutubeIdFromUrl($v2['link']).'/0.jpg';
										echo '<div class="item-img"><a href="'.$com.'/'.$v2['id'].'/'.$v2['tenkhongdau'].'.html"  title="'.$v2['ten_'.$lang].'"><img class="img-responsive" src="'.$photo.'" alt="'.$v2['ten_'.$lang].'"/></a></div>';
										echo '</div>';
									
									
									echo '<a href="'.$com.'/'.$v2['id'].'/'.$v2['tenkhongdau'].'.html" title="'.$v['ten_'.$lang].'" class="anim view">'.$v2['ten_'.$lang].'</a>';
									echo '</div>';
									echo '</div>';
									if($i==3){
										echo '<div class="clearfix"></div>';
									}
									
								
								
								
								
								
								
								
								}
							
							
							
							
							
							?>
							
							<div class="clearfix"></div>
						</div>
					</div>
				</div>
			
					
					
					
					
					
					
					
					
					
					
					
					
					
					
					
					
					<?=$paging['paging']?>
			
				</section>