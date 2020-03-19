var isIE, ua = navigator.userAgent;
var Yheight = 0;
var Xwidth = 0;
var Allheight = 0;

function changeURL(url,hdtitle){
	window.history.pushState({},"", url);
	var title_home = $('#title_home').val();
	if(hdtitle!='')
		$('#hdtitle').html(title_home + ' - ' + hdtitle);
	
	$('#changlanguage_redirect').val(url);		
}

function ResizeWindows() {
  Allheight = 640;
  Yheight = $(window).height();
  Xwidth = $(window).width();
	     if(Yheight<Allheight){
            $('#container').css({'width':Xwidth});
	        $('#container').css({'height':Allheight});
			$('#background, #background img').css({'width':Xwidth});
	        $('#background, #background img').css({'height':Allheight});
            $('#background-home li img').css({'width':'auto'});
	        $('#background-home, #background-home li img').css({'height':Allheight});
			$('footer').css({'bottom':'auto','top':Allheight-25});
         }else{
	        $('#container').css({'width':Xwidth});
	        $('#container').css({'height':Yheight});	
            $('#background, #background img').css({'width':Xwidth});
	        $('#background, #background img').css({'height':Yheight});
			$('#background-home li img').css({'width':'auto'});
	        $('#background-home, #background-home li img').css({'height':Yheight});
			$('footer').css({'bottom':0, 'top':'auto'});
         }
		var ContentHeight = $('#container').height();
		$('#center, #home-news, .overlay').css({'height':ContentHeight-25});	
		$('.news').css({'height':ContentHeight-290});	
		$('.scroll-news').css({'height':ContentHeight-350});
		$('.content-bg,.content-bg-full').css({'height':ContentHeight-256});
		$('#scroll').css({'height':ContentHeight-310});
		$('.content-bg-full, .link-top-news, .product-list, .product-list-inner').css({'width':Xwidth-212});
		$('.slidemenu-item.product, .product-details').css({'height':ContentHeight-120});
		$('.slidemenu-item.project').css({'height':400, 'width':760});
		$('.popup-nav').css({'left': Xwidth/2-337});
		$('.pic-center').css({'margin-top': Yheight/2-257});
	    $('.pic-center').css({'margin-left': Xwidth/2-300});
		$('.all-project').css({'margin-top': Yheight/2-350});
		$('.projects-main').css({'margin-top':Yheight/2-380});
		$('.slidemenu-ipad').css({'height': ContentHeight-110});
		  if( Xwidth < 1150){
			  $('.content-bg').css({'width':Xwidth-214});
			  $('.product-list, .product-list-inner, .slidemenu-ipad').css({'margin-left':216});
			  $('.slidemenu-item.product').css({'width':Xwidth});
			  $('.products-main').css({'margin-left': Xwidth/2-190});
			  $('.projects-main').css({'margin-left': Xwidth/2-290});
			  $('.product-list li a, .menu-product li h1, .sub-menu h2 a').css({'font-size': 12});
			  $('.slidemenu-navwrap').css({'left':720});
			  $('.project-content').css({'left': 640});
			  $('.project-big').css({'margin-top':82, 'width':605, 'height':394});
			  $('.project-big .project-center').css({'width':605, 'height':394});
			  $('.project-big .project-center li img').css({'width':605, 'height':394});
			  $('.project-big .project-center li').css({'width':605, 'height':394});
			  $('.project-big .project-center ul').css({'margin-left':0});
			  $('.project-big .detail-prev, .project-big .detail-next').css({'top':350});
		  }else{
			  $('.content-bg').css({'width':'70%'});
			  $('.product-list, .product-list-inner, .slidemenu-ipad').css({'margin-left':300});
			  $('.slidemenu-item.product').css({'width':Xwidth-200});
			  $('.products-main').css({'margin-left': Xwidth/2-280});
			  $('.projects-main').css({'margin-left': Xwidth/2-380});
			  $('.product-list li a, .menu-product li h1, .sub-menu h2 a').css({'font-size': 14});
			  $('.slidemenu-navwrap').css({'left':806});
			  $('.project-content').css({'left': 770});  
			  $('.project-big').css({'margin-top':40,'width':724, 'height':471});
			  $('.project-big .project-center').css({'width':724, 'height':471});
			  $('.project-big .project-center li img').css({'width':724, 'height':471});
			  $('.project-big .project-center li').css({'width':724, 'height':471});
			  $('.project-big .project-center ul').css({'margin-left':0});
			  $('.project-big .detail-prev, .project-big .detail-next').css({'top':430});
			  
			  
		  }
		  
			    if ($('.slidemenu-product').length) {
				  var allItem = $('.slidemenu-product .slidemenu-item.product').length;
				  var widthItem = $('.slidemenu-product .slidemenu-item.product').width();
	             $('.slidemenu-product ul').width(allItem * widthItem + widthItem);
	            }
				
				 if ($('.slidemenu-project').length) {
				  var allItem = $('.slidemenu-project .slidemenu-item.project').length;
				  var widthItem = $('.slidemenu-project .slidemenu-item.project').width()+20;
	             $('.slidemenu-project ul').width(allItem * widthItem + widthItem);
	            }
				
				if( Xwidth <= 1024){
		        $('nav').css({'left':-220});
		        $('nav').append('<div class="menu"></div>');
		        $('.menu').click(function () {
				  $('.menu').fadeOut(200, 'linear');
				$('nav').animate({'left':0},300,'linear');
				 $('body').append('<div class="hover-bg"></div>');
				$('.hover-bg').hover(function () {
					$('nav').animate({'left':-220},200,'linear');
					$('.menu').delay(200).fadeIn(200, 'linear');
					 $('.hover-bg').remove();
					});
				 return false;
			  });
					  
			   }else{
				   $('nav').css({'left':0});
				   $('.menu').remove();
				   $('.hover-bg').remove();
			   }
				
}

function NewsNext(){
	$('#nextBtn a').trigger('click');
}
function ProjectNext(){
	$('a.slidemenu-right').trigger('click');
}
function loadProjectNext(){
	$('.slidemenu-project ul li a.news_active').trigger('click');
}

function viewNews(){
	var href = $('.news_active').attr('href');
	if($(href).length){
		$('.news_active').trigger('click');

	}else
		setTimeout(viewNews,3500);	
}


$(window).resize(function () {
    ResizeWindows();
	setTimeout(picAlign, 100); 
	if($('.allvideo').length){
		 $('.close-video').trigger('click');
	   }else{
		  null;
     }
	
	
});
window.onorientationchange = ResizeWindows;
$(document).ready(function () {
	$(document).scrollTop(0);
	 ResizeWindows();
	 // $("body").queryLoader({
     //   completeAnimation: "grow"
  //  });
	 $('#thumb-slider').simplyScroll();
	
	 //SEARCH INPUT//	
	 var txtholder = 'HỌ VÀ TÊN (*) CÔNG TY ĐỊA CHỈ ĐIỆN THOẠI (*) EMAIL (*) FULL NAME (*) ADDRESS TEL (*) PHONE (*) COMPANY';
    var txtRep = "";
    $('input').focus(function () {
        txtRep = $(this).val();
        if (txtholder.indexOf(txtRep) >= 0) {
            $(this).val("");
        }
    });
   $('input').focusout(function () {
        if ($(this).val() == "") $(this).val(txtRep);
    });
	   var cur_text="";
	   $('textarea').focus(function(){
		cur_text =  $(this).val();
		if(cur_text == 'NỘI DUNG' || cur_text == 'COMMENT' || cur_text == 'NỘI DUNG (*)' || cur_text == 'COMMENT (*)')
			$(this).val('')}).focusout(function(){
				if($(this).val() == "") 
				  $(this).val(cur_text)
	});
	
	$('.social li a, a.lang, a.lang-en, a.download, a.details, a.details-en, .close, .open')
	.append('<span class="hover"></span>').each(function () {
        var $span = $('> span.hover', this).css('opacity', 0);
        $(this).hover(function () {
            $span.stop().fadeTo(500, 1);
        }, function () {
            $span.stop().fadeTo(500, 0);
        });
    });
	
	$('.menu-product li').click(function (e) {
        e.stopPropagation();
       });
	 //CHANGE PAGE FADING//	
	 $('nav li a, header a, .black a, .product-wrap li a, .news li a, a.details, a.details-en, .link li a, .sub-menu h2 a').click(function(event){
		event.preventDefault();
		linkLocation = this.href;
		ScrollHide();
		$('#center, #background, #background-home, #fullbackground').fadeOut(500, 'linear');
		setTimeout(redirectPage, 1000);
		 return false;
	});
	function redirectPage() {
		window.location = linkLocation;
	}
       if ($('.product-wrap').length) {
		 $('.product-wrap').easySlider({showSlides:4, prevId:'prevBtn',nextId:'nextBtn'}); 
	   }
	   if ($('.news-wrap').length) {
		 $('.news-wrap').easySlider({showSlides:2, prevId:'prevBtn',nextId:'nextBtn'}); 
	   }
	   if ($('.products-main').length) {
		 $('.products-main').delay(300).easySlider({showSlides:1, numeric: true, continuous:true}); 
	   }
	   
	   
	   
		
		//HOME PAGE//	
		 if ($('#home-page').length) {
			  $('#fullbackground-loader, #fullbackground').remove();
			  ResizeWindows();
			  ScrollHide();
			  $('#background-home ul').find('li:first').fadeIn(400, 'linear');
			  $('#home-news').find('.product-des:first').css({'display':'block'});
			  $('#list-product ul').find('li:first').addClass('current');
			  $('#home-news, #list-product').delay(500).fadeIn(400, 'linear');
			  setTimeout(ScrollNice, 1000);
			  
			 $('#list-product li a').click(function () {
				$('#list-product li').removeClass('current');
				$('.product-des').fadeOut(300, 'linear');
				$('#background-home li').fadeOut(400, 'linear');
				$(this).parent().addClass('current');
				var productdes = $(this).attr('href');
				var productpic = $(this).attr('href')+('-pic');
			     $(productdes).delay(500).fadeIn(300, 'linear');
				 $(productpic).fadeIn(400, 'linear');
				 return false;
			  });	
			
			 $('.close').click(function () {
				 $(this).fadeOut(200, 'linear');
				 $('#home-news, #logo-partners').fadeOut(400, 'linear');
				 $('.open').delay(500).fadeIn(200, 'linear');
				 $('#list-product').delay(500).animate({'right':70},300,'easeOutQuad');
				 ScrollHide();
				  return false;
			   });	
			   
			    $('.open').click(function () {
				 $(this).fadeOut(200, 'linear');
				 $('#list-product').animate({'right':450},300,'easeOutQuad');
				 $('.close').delay(500).fadeIn(200, 'linear');
				 $('#home-news, #logo-partners').delay(500).fadeIn(400, 'linear');
				 setTimeout(ScrollNice, 1000);
				 return false;
				});
				
			 return false;	
		 }
		 //ABOUT PAGE - SERVICE PAGE - DISTRIBUTION PAGE - NEWS PAGE - CONTACT PAGE//
		  if ($('#text-page').length) {
			   $('#fullbackground-loader, #fullbackground').remove();
			   ResizeWindows();
			   ScrollHide();
			   setTimeout(ScrollNice, 600);
			  $('#background').fadeIn(400, 'linear');
			  $('.content-bg, .content-bg-full').delay(500).fadeIn(400, 'linear');
			  $('.product-top, .link-top, .link-top-news').delay(1000).fadeIn(400, 'linear');
			   
			      $('.product-wrap li a').mouseenter( function(){
				    $('.product-wrap li').stop().animate({'opacity':0.2},200,'linear');
				    $(this).parent().animate({'opacity':1},300,'linear');
				    $(this).find('span').fadeIn(300, 'linear');
				  	}).mouseleave(function(){
					$('.product-wrap li').stop().animate({'opacity':1},300,'linear');
					$(this).find('span').fadeOut(200, 'linear')
				   });
				   
				  if ($('.tab-news').length) { 
				      
					  $('.list li a').click(function () {
						ScrollHide();
			          $('.list li').removeClass('current');
				      $('.content-bg-full .tab-news').fadeOut(300, 'linear');
			    	  $(this).parent().addClass('current');
				      var news = $(this).attr('href');
			           $(news).delay(500).fadeIn(300, 'linear');
					   setTimeout(ScrollNice, 600);
				        return false;
			        });	
					
					
					if($('.news_active').length){
						var cur_index = $('.news-wrap ul li').index($('.news-wrap ul li a.news_active').parent());
						for(i=0;i<cur_index;i++){
							setTimeout(NewsNext,800 * (i+1));
						} 
						viewNews();
					}else{
						$('.content-bg-full .tab-news:first').fadeIn(400, 'linear');
					}
				  }
				  
				
				  
			 return false;
	              
		 }
	   //PRODUCTS PAGE//
	    if ($('#products-page').length) {
			  $('#fullbackground-loader, #fullbackground').remove();
			   ResizeWindows();
			  $('#background').fadeIn(400, 'linear');
			  $('.product-list, .product-list-inner').delay(500).fadeIn(400, 'linear');
			  $('.products-main').delay(1000).fadeIn(400, 'linear');
			   
			   $('.product-item').click( function(){
				    $(this).find('.black').fadeIn(300, 'linear');
					 $('.submenu').delay(500).fadeIn(200, 'linear');
                     return false;
				  	}).mouseleave(function(){
					  $(this).find('.black').fadeOut(200, 'linear');
					  $('.submenu').fadeOut(200, 'linear');
					  return false;
				   });
				     $('.product-item span').mouseenter( function(){
						 $('.black').stop().fadeOut(200, 'linear');
						 return false;
					  });
			
	         return false;      
		 }
	    //PRODUCTS DETAILS PAGE//
		 if ($('#product-details-page').length) {
			   ResizeWindows();
			   loadVideo();
			   if ($('.picture-details').length) {
				   $('body').append('<div class="loadicon"></div>');
					   setTimeout(loadPicture, 1000);
				}
			  $('.category span:first-child').addClass('current');
			  $('.slidemenu-product .slidemenu-item.product').first().addClass('centerframe');
			  $('.slidemenu-ipad').MenuList({numeric: true});
			  slide = 0;
			  $('.product-list-inner').delay(500).fadeIn(400, 'linear');
			  $('.product-details').delay(1000).fadeIn(400, 'linear');
			  $('.category span a.no').click(function () {
						ScrollHide();
			          $('.category span').removeClass('current');
				      $('.bg-product').fadeOut(300, 'linear');
			    	  $(this).parent().addClass('current');
				      var productset = $(this).attr('href');
			          $(productset).fadeIn(300, 'linear');
					   $(productset).find('#scroll-text').getNiceScroll().resize(0,0).show();
	                   $(productset).find('#scroll-text').scrollTop(0);
	                   $(productset).find('#scroll-text').niceScroll({touchbehavior:true,cursorcolor:"#737373"});
				        return false;
			   });	
			   
			   
			 $('.category span a.pic').click(function(){
			 var linkpic = $(this).attr('href'); 
			 $('.overlay-dark').fadeIn(300, 'linear');
			 $('.close-pic').delay(300).fadeIn(300, 'linear');
		  	   $(linkpic).delay(600).fadeIn(400, 'linear');
				$('.close-pic').click(function(){
					$('.overlay-dark').fadeOut(200, 'linear');
					$('.close-pic').fadeOut(200, 'linear');
					$(linkpic).fadeOut(300, 'linear');
			    });
		     return false;
		  });
		      if ((navigator.userAgent.indexOf('iPhone') != -1) || (navigator.userAgent.indexOf('iPod') != -1) || (navigator.userAgent.indexOf('iPad') != -1)|| (navigator.userAgent.indexOf('Android') != -1)) {
			   if($('#background-slide').length){
	            if($('#slide-home').length){
		         var allpic = new Array();
		         $('#slide-home img').each(function(index, element) {
		          if( $(this).attr('src') != null ){allpic.push({image :  $(this).attr('src')});}});
			       $('#background-slide').fullbackground({autoplay:0, transition:1,transition_speed:300, slides:allpic});
	             }
	           }
			  }else{
			   if($('#background-slide').length){
	            if($('#slide-home').length){
		         var allpic = new Array();
		         $('#slide-home img').each(function(index, element) {
		          if( $(this).attr('src') != null ){allpic.push({image :  $(this).attr('src')});}});
			       $('#background-slide').fullbackground({autoplay:0, transition:1,transition_speed:1000, slides:allpic});
	             }
	           }
			  }
		  
	         return false; 
		 }
		 
		 //PROJECTS PAGE//
		 if ($('#projects-page').length) {
			   ResizeWindows();
			    $('#fullbackground-loader, #fullbackground').remove();
			   if ($('.projects').length) {
					$('body').append('<div class="loadicon"></div>');
					  setTimeout(loadProject, 1000);
				}
			 $('.slidemenu-project .slidemenu-item.project').first().addClass('centerframe');
			  $('.slidemenu-project').MenuList({numeric: false});
			  slide = 1;
			  $('#background').fadeIn(400, 'linear');
			  $('.projects-main').delay(1000).fadeIn(400, 'linear');
			   $('a.view-details').click(function(){
			    var linkpic = $(this).attr('href'); 
		    	$('.overlay-dark').fadeIn(200, 'linear');
		    	$('.close-pic').delay(300).fadeIn(200, 'linear');
			     $(linkpic).delay(500).fadeIn(400, 'linear');
		  	      $(linkpic).find('.project-big').delay(600).fadeIn(400, 'linear');
				   $('.close-pic, .overlay-dark').click(function(){
					$('.overlay-dark').fadeOut(200, 'linear');
					$('.close-pic').fadeOut(200, 'linear');
					$(linkpic).fadeOut(300, 'linear');
			    });
				
		   return false;
	        });
			
		if($('.slidemenu-project ul li a.news_active').length){
			setTimeout(loadProjectNext, 4000);
			setTimeout(ScrollNice, 5000);
		}
		
		var cur_index = $('.slidemenu-project ul li').index($('.slidemenu-project ul li a.news_active').parent().parent().parent());
		for(i=0;i<cur_index;i++){
			setTimeout(ProjectNext,1000 * (i+1));
		} 
	    
	       return false; 
		 }
});
function loadPicture(){
		var loadUrl = $('a.picture-details').attr('href'); 
		$.ajax({
			url: loadUrl,
			cache:false,
			success: function(data) {
				$('.all').append(data);
				if($('.pic-big').length){
		           $('.pic-big').children().each(function(index, element) {
			       $('.group'+(index+1)).easySlider({showSlides:1, prevId:'prevBtn'+index ,nextId:'nextBtn'+index,  continuous: true, popup:true});
				     $('.loadicon').remove(); 
                   });	
				$('li .nailthumb-container').nailthumb({width:500,height:514, fitDirection:'center center', method:'resize'});
				Yheight = $(window).height();
                Xwidth = $(window).width();   
				$('.popup-nav').css({'left': Xwidth/2-337});
		        $('.pic-center').css({'margin-top': Yheight/2-257});
	            $('.pic-center').css({'margin-left': Xwidth/2-300});
	      }
	  }
  });
}
function loadProject(){
		var loadUrl = $('a.projects').attr('href'); 
		$.ajax({
			url: loadUrl,
			cache:false,
			success: function(data) {
				$('.all-project').append(data);
				if($('.project-big').length){
		           $('.project-big').children().each(function(index, element) {
					 ResizeWindows();
					 if( Xwidth < 1152){
				     $('.group'+(index+1)).css({'width':605});
				      $('.group'+(index+1)).easySlider({showSlides:1, prevId:'prevBtn'+index ,nextId:'nextBtn'+index, picdetails:true});
					 }else{
				     $('.group'+(index+1)).css({'width':724});
				     $('.group'+(index+1)).easySlider({showSlides:1, prevId:'prevBtn'+index ,nextId:'nextBtn'+index, picdetails:true});
					}
					$('.view-details').fadeIn(200, "linear"); 
					$('.loadicon').remove(); 
					
                    
              });	
	      }
	  }
  });
};
function loadVideo(){
		var loadUrl = $('a.video-details').attr('href'); 
		$.ajax({
			url: loadUrl,
			cache:false,
			success: function(data) {
				$('.allvideo').append(data);
				$('video').VideoJS();
				 $('.allvideo .video-list').css({'margin-top': -2000, 'margin-left':-2000});
				 $('.category span a.vid').click(function(){
					 $('.allvideo .video-list').css({'margin-top': Yheight/2-360/2, 'margin-left': Xwidth/2-570/2});
					  $('#center').css({'z-index':0});
			           var linkvideo = $(this).attr('href');
					   $('.allvideo').css({'z-index':9100});
		            	$('.overlay-dark').fadeIn(300, 'linear');
		  	            $(linkvideo).delay(300).animate({'opacity':1,},500,'linear').css({'z-index':9999});
						$('.close-video').delay(1000).fadeIn(300, 'linear');
						 $('.close-video').click(function(){
						    $('.video-list').delay(300).animate({'opacity':0},500,'linear').css({'z-index':-9999});
					        $('.overlay-dark').delay(500).fadeOut(300, 'linear');
					        $('.allvideo').css({'z-index':-9999});
							$('.close-video').fadeOut(200, 'linear');
						     $(linkvideo).find('video')[0].pause();
							   $('#center').css({'z-index':999});
							   $('.allvideo .video-list').css({'margin-top': -2000, 'margin-left':-2000});
					         return false;
			             });
		                return false;
		            });
	  }
  });
}
function picAlign (){
    ResizeWindows();
	if ($('.slidemenu-product').length) {
	$('.slidemenu-ipad').MenuList();
	}
	if ($('.slidemenu-project').length) {
	$('.slidemenu-project').MenuList();
	}
}
function ScrollNice(){
	  $('#scroll').getNiceScroll().resize(0,0).show();
	  $('#scroll').scrollTop(0);
	  $('#scroll').niceScroll({touchbehavior:true,cursorcolor:"#737373"});
	  $('.scroll-news').getNiceScroll().resize(0,0).show();
	  $('.scroll-news').scrollTop(0);
	  $('.scroll-news').niceScroll({touchbehavior:true,cursorcolor:"#737373"});
	  $('#scroll-text').getNiceScroll().resize(0,0).show();
	  $('#scroll-text').scrollTop(0);
	  $('#scroll-text').niceScroll({touchbehavior:true,cursorcolor:"#737373"});
}
function ScrollHide(){
	 $('#scroll').getNiceScroll().hide();
	 $('.scroll-news').getNiceScroll().hide();
	 $('.bg-product #scroll-text').getNiceScroll().hide();
}
 

