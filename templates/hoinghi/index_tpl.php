<div id="large">
<link href="assets/ResponsiveSlides.js-master/responsiveslides.css" type="text/css" rel="stylesheet" />
<script src="assets/ResponsiveSlides.js-master/responsiveslides.min.js" type="text/javascript" ></script>
<div id="wrap-content-hn col-xs-12 col-sm-12 col-md-12 rel" style="margin-top:90px" >
<div class="">
<?php 
	foreach($tintuc as $k=>$v){
		echo '<div class=" col-md-2 col-sm-4 col-sx-3 item-root rel root-'.$k.' " >';
			echo '<div class="fix-row"><div class="event-item shadow">';
			
			
			
			
			echo '<ul class="rslides" id="slider_'.$k.'">';
				$list = json_decode($v['gallery']);
				if($v['photo']){
					echo '<li><img src="'._upload_news_l.$v['photo'].'" class=""></li>';
				}
				foreach($list as $k2=>$v2){
					echo '<li><img src="'.$v2.'"/></li>';
				}
      
			echo '</ul>';
		echo '<div class="overlay-name " data-index="'.$k.'">';
			echo '<a href="hoi-nghi-va-su-kien/'.$v['id'].'/'.$v['tenkhongdau'].'.html" title="'.$v['ten_'.$lang].'">'.$v['ten_'.$lang].'</a>';		
		echo '</div>';
		echo '</div>';
		echo '</div>';
		echo '</div>';
	
	
	}


?>
<div id="content-opacity" style='display:none;position:absolute;left:185px' >


<div id="block-air" >
<div class="loader"></div>
	<div class="title tt-border"><h3 class="zirkon pull-left"><?=$title_cat?></h3><div class="oz-bbt"></div><div style="clear:both"></div></div>
	<div class="clearfix"></div>
	<div class="content wrap-content">
	<div class="clearfix"></div>
		<div class="scroll content-scroll">
			<div class="inner-content">
				
			</div>	
			
		</div>
		<div class="btn-advance"><a class="back-link" href="<?=$com?>.html">BACK</a></div>
		<div class="clearfix"></div>
	</div>
	

</div>

<script>
$().ready(function(){
	<?php foreach($tintuc as $k=>$v){ ?>
	if($("#slider_<?=$k?> li").length > 1){
	 $("#slider_<?=$k?>").responsiveSlides({
        maxwidth: 800,
        speed: <?=150*(rand(1,9))?>
      });
	 }
	
	<?php 
	}
	?>
	$(".back-link").click(function(){
		$("#content-opacity").fadeOut(function(){
			for($i=0;$i<=5;$i++){
				$(".root-"+$i).fadeIn().animate({"opacity":1,"visibility":"inherit","margin-left":0},500*$i);
				$(".item-root").removeClass("current-object");
			}
		})
		return false;
	})
	$(".overlay-name").click(function(){
		$a = $(this).find("a");
		$index = $(this).data("index");
		$(".root-"+$index).addClass("current-object");
		for($i=0;$i<=5;$i++){
			
			if($i!=$index){
				$(".root-"+$i).not(".current-object").animate({"opacity":0,"visibility":"hidden","margin-left":-(185)},500*$i).fadeOut();
			}
			
			
		}
		setTimeout(function(){
			options= new Array();
			options.url = $a.attr("href");
			options.dataType = 'json';
			options.success = function(data){
				$("#block-air h3.zirkon").html(data.name);
				$("#block-air .inner-content").html(data.content);
				
				$("#content-opacity").fadeIn();
				updateLine();
				initScrollBarVs();
				
				console.log(data);
				return false;
			};
			initAjax(options);
		
		
		},5*300);
			//$(".current-object").animate({"margin-left":-(185),"top":0},1000);
		return false;
		});
		
		
	

})

</script>
</div>
</div>

<style>
.event-item:hover{}
.event-item{position:relative;width:170px;height:350px;overflow:hidden;background:rgba(255,255,255,.6);border:4px solid rgba(255,255,255,.5)}
.event-item .overlay-name a{color:#fff}
.event-item .overlay-name{position: absolute;
width: 100%;
font-family: uvn_bai_sau_nheregular;
font-size: 20px;
text-align: center;
background: rgba(0,0,0,0.6);
padding: 5px 0;
bottom: 0;
z-index: 5;}
.clearfix{clear:both}

</style>


</div>
</div>
<div id="small">
<div id="content">
<div id="content">
<div class="scroll">
<link href="assets/css/news.css" type="text/css" rel="stylesheet" />
<div class="box_containerlienhe">
<div class="title-global"><h2><?=$title_cat?></h2></div>
<div class="wrap-box-news">
 	<?php foreach($tintuc as $k=>$v){ ?>
        <div class="col-xs-6 col-md-3 col-sm-4 news-item">
			<div class="fix-row">
				<div class="col-xs-12">
					<div class="fix-row">
						<div class="wrap-album">
					
						<?php
						
							$photo = ($v['photo']) ? $v['photo'] : 'images/noimage.gif';
							if(!checkValidUrl($photo)){
								$photo = _upload_tintuc_l.$photo;
							}
						
						?>
						
						<a href="<?=$com?>/<?=$v['id']?>/<?=$v['tenkhongdau']?>.html" title="<?=$v['ten_'.$lang]?>"><img class="img-thumbnail" src="<?=$photo?>" /></a>
						<div class="link-retail">
							<div class="rel">
								<a class="" href="album/<?=$v['id']?>/<?=$v['tenkhongdau']?>.html" title="<?=$v['ten_'.$lang]?>"><?=$v['ten_'.$lang]?></a>
							</div>
						</div>
						</div>
					</div>
				</div>
				
				
			</div><!-- end row -->
        </div><!---END .box_new-->
       <?php if(($i+1)%2==0) echo '<div class="clearfix"></div>' ?>
    <?php } ?>
 <div class="clear"></div>    
</div><!---END .wrap-box-news-->
 <div class="phantrang" ><?=$paging['paging']?></div>
<div class="clear"></div>
</div>
</div>
</div>
</div>
<style>
	.wrap-album{position:relative}
	.wrap-album img{border-radius:0}
	.wrap-album .link-retail .rel{width:100%;height:100%;cursor: hand;
cursor: pointer;}
	.wrap-album .link-retail{position:absolute;bottom:0;background:rgba(0,0,0,.7);width:100%;height:100%;top:0;left:0;display:none}
	
	.wrap-album .link-retail a{position: absolute;
	color:#fff;
	font-size:20px;
	font-family:uvn_bai_sau_nheregular;
width: 100%;
/* text-align: center; */
top: 0;
left: 0;
right: 0;
bottom: 0;
margin: auto;
text-align: center;
display: table;}
	

</style>
<script>
$().ready(function(){
	$(".wrap-album").hover(function(){
		$(this).find(".link-retail").fadeIn();
	
	},function(){
	$(this).find(".link-retail").fadeOut();
	})
	$(".wrap-album .rel").click(function(){
		$(this).find("a").click();
	})
})
</script>


</div>