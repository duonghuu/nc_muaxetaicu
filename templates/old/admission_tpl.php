<h2 class="title-global"><?=_admission?></h2>
<?php

	foreach($result as $k=>$v){	
		echo '<p><a title="'.$v['ten_'.$lang].'" href="admission/'.$v['id'].'/'.$v['tenkhongdau'].'.html">'.$v['ten_'.$lang].'</a></p>';
	}

?>