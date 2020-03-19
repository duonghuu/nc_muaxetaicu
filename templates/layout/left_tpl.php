
 <section>
		<?php
			$rs_product_danhmuc = array();		
			$d->query("select id,tenkhongdau from #_product_danhmuc where hienthi = 1 order by stt desc");
			foreach($d->result_array() as $k=>$v){
				$rs_product_danhmuc[$v['id']] = $v['tenkhongdau'];
			}
			
			
			
		
		?>
        <div class="box-left">
			<div class="right-title">
				<h2 style="">danh mục sản phẩm</h2>
			</div>
           
            <div class="content product no-bd">
				<ul>
              <?php 
				$d->query("select tenkhongdau,id,ten_$lang from #_product_danhmuc ");
				$alias = array();
				foreach($d->result_array() as $k=>$v){
							echo '<li><a href="san-pham/'.$v['id'].'_'.$v['tenkhongdau'].'.html" title="'.$v['ten_'.$lang].'">'.$v['ten_'.$lang].'</a></li>'; 
							
						
						}
				?>
				</ul>
            </div>
        </div>
    </section>
	<div class='space'></div>
	
	
	
	





	<section>

        <div class="box-left">
			<div class="right-title">
					<h2>Hỗ trợ trực tuyến</h2>
			</div>
           
            <div class="content support">
				<div class="hotline">
					<span>Hotline :</span> <div class="x"><?=str_replace("-","<br />",$result_hotline['hotline_'.$lang])?></div>
					<div class="clearfix"></div>
				</div>
				<?php
					$d->query("select * from #_yahoo where hienthi = 1 order by stt desc");
					foreach($d->result_array() as $k=>$v){
						echo '<div class="sp-item"><div><a href="skype:'.$v['skype'].'?chat" alt="Chat với tôi" style="margin-right:3px"><img src="assets/img/skype-mini.png" /></a><a href="ymsgr:sendIM?'.$v['yahoo'].'" title="Chat với tôi"><img src="assets/img/yahoo-mini.png" /></a>&nbsp;&nbsp;'.$v['ten'].'</div>';
						echo '<div class="phone">'.$v['dienthoai'].'</div>';
						echo '<div class="email">'.$v['email'].'</div>';
						echo '</div>';
					
					
					}
				
				?>
              
				
            </div>
        </div>
    </section>
	

	
	<div class='space'></div>
<section>
<div class="box-left">
	<div class="right-title">
		<h2><?=_counter?></h2>
	</div>
	<div class="content analytics">
		<?php $ana = count_online();?>
		<div class="s1"><img src="assets/img/s1.png" />Đang online : <span class="red"><?=$ana['dangxem']?></span></div>
		<div class="s2"><img src="assets/img/s2.png" />Thống kê tuần : <span class="red"><?=$ana['advance']['week']?></span></div>
		<div class="s3"><img src="assets/img/s3.png" />Thống kê tháng : <span class="red"><?=$ana['advance']['month']?></span></div>
		<div class="s3"><img src="assets/img/s4.png" />Tổng : <span class="red"><?=$ana['advance']['all']?></span></div>
	</div>
</div>

</section>
<div class="space"></div>
	<section>
        <div class="box-left">
            <div class="right-title">
                <h2>Fan page</h2>
            </div>
            <div class="content">
                
                    <div id="fb-root"></div>
                    <script>(function(d, s, id) {
                            var js, fjs = d.getElementsByTagName(s)[0];
                            if (d.getElementById(id))
                                return;
                            js = d.createElement(s);
                            js.id = id;
                            js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&appId=744714818880270&version=v2.0";
                            fjs.parentNode.insertBefore(js, fjs);
                        }(document, 'script', 'facebook-jssdk'));</script>
                    <div  style="margin-left:0;margin-top:5px;"class="fb-like-box" data-href="<?= $result_hotline['facebook'] ?>" data-width="222" data-colorscheme="light" data-show-faces="true" data-header="true" data-stream="false" data-show-border="true"></div>

                
            </div>
        </div>
    </section>
