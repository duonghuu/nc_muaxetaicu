<?php	
$d->reset();
$sql_contact = "select * from #_hotline ";
$d->query($sql_contact);
$rs = $d->fetch_array();
$d->reset();
$d->query("select * from #_yahoo where id = 13");
$support = $d->fetch_array();
$d->reset();
$d->query("select * from #_social where hienthi = 1"); 
$social = $d->result_array();
$d->reset();
$d->query("select * from #_footer "); 
$footer = $d->fetch_array();	

$d->reset();
$d->query("select * from #_social where hienthi = 1"); 
$social = $d->result_array();
?>
<footer id="footer">
  <div class="ft-top ">
    <div class="container">
      <div class="ft-flex">
        <div class="ft-info">
          <div class="content"><?=$footer['noidung_'.$lang]?></div> 
          <div class="mxhft"><span>Mạng xã hội: </span>
					<?php foreach($social as $k=>$v){
						echo '<a href="'.$v['link'].'" title="'.$v['ten'].'" target="_blank"><img src="'._upload_hinhanh_l.$v['photo'].'" alt="" /></a>';		
					}

					?>
					<?php $ana = count_online();?>
          </div>
          <ul class="ft-thongke">
            <li>Đang online: <span><?=$ana['dangxem']?></span></li>
            <li>Truy cập tháng: <span><?=$ana['advance']['month']?></span></li>
            <li>Tổng truy cập: <span><?=$ana['advance']['all']?></span></li>
          </ul> 
        </div>
        <div class="ft-baiviet">
          <p class="ft-tit"><span>HỖ TRỢ KHÁCH HÀNG</span></p>
          <?php 
          $d->query("select * from #_project where hienthi = 1 order by stt desc");
          echo '<ul>';
          foreach($d->result_array() as $k=>$v){
            echo '<li><a href="ho-tro-khach-hang/'.$v['id'].'/'.$v['tenkhongdau'].'.html" title="'.$v['ten_'.$lang].'">'.$v['ten_'.$lang].'</a></li>';
          }
          echo '</ul>';
          ?>
        </div>
        
    </div>
  </div>
</div>
<div class="copyright">
  <div class="container">
    <div class="ft-wrap">
      <p class="text">Copyright © 2020 by SALON ÔTÔ TIẾN THÔNG. All rights reserved.
       Designed by Nina Co., Ltd</p>
      
      <?php /*
<li><?=_thongkethang?>: <span><?=$trongthang;?></span></li> <li><?=_ngayhomqua?>: <span><?=$homqua;?></span></li> 
      */?> 
    </div>
  </div>
</div>
</footer>