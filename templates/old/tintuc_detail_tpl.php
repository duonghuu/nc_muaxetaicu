<div class="news-content">
<div class="title-global"><h2><?=$tintuc_detail[0]['ten_'.$lang]?></h2>
<div class="date"><?=date("d-m-Y",$tintuc_detail[0]['ngaytao'])?></div></div>


<div class="box_containerlienhe">
<div class="description"><?=$tintuc_detail[0]['mota_'.$lang]?></div>   
<div class="content">             
      <?=$tintuc_detail[0]['noidung_'.$lang]?><br />           
	  <?php
	  if(count($tintuc_khac) > 0) { ?>
        <div class="othernews">
             <h1><?=$more?></h1>
             <ul>          
                <?php foreach($tintuc_khac as $tinkhac){?>
                <li>&raquo;&nbsp;<a href="<?=$com?>/<?=$tinkhac['id']?>/<?=$tinkhac['tenkhongdau']?>.html" style="text-decoration:none;" title="<?=htmlentities($tinkhac['ten_'.$lang], ENT_QUOTES, "UTF-8")?>"><?=$tinkhac['ten_'.$lang]?></a> <span class="date">(<?=make_date($tinkhac['ngaytao'])?>)</span></li>
                <?php }?>
             </ul>
        </div>
		<?php } ?>

</div>
</div>
</div>