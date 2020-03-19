
<div class="box_containerlienhe">
<div class="title-global"><h2><?=$title_cat?></h2></div>
<div class="wap_box_new">
 	<?php for($i = 0, $count_tintuc = count($tintuc); $i < $count_tintuc; $i++){ ?>
        <div class="box_new">
            <a href="<?=$com?>/<?=$tintuc[$i]['id']?>/<?=$tintuc[$i]['tenkhongdau']?>.html"><img src="<?php if($tintuc[$i]['photo']!=NULL)echo _upload_tintuc_l.$tintuc[$i]['photo'];else echo 'images/noimage.gif';?>" /><h4><?=$tintuc[$i]['ten_'.$lang]?></h4></a>                  
			<div class='date'><?=date("d/m/Y",$tintuc[$i]['ngaytao'])?></div>
            <p><?=cutString(strip_tags($tintuc[$i]['mota_'.$lang]),100,"...")?></p>
            <a class="chitiet" href="<?=$com?>/<?=$tintuc[$i]['id']?>/<?=$tintuc[$i]['tenkhongdau']?>.html"><?=_read_cotinue?></a>
        </div><!---END .box_new-->
       <?php if(($i+1)%2==0) echo '<div class="clear"></div>' ?>
    <?php } ?>
 <div class="clear"></div>    
</div><!---END .wap_box_new-->
 <div class="phantrang" ><?=$paging['paging']?></div>
<div class="clear"></div>
</div>