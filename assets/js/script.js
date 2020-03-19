function initOverlayProductImage(){
	

}
function initLazyload(){
	$(".product-image img").lazyload({
    threshold : 200,
	effect : "fadeIn"
	});


}
function initMenu(){		
	$(".s-child").parent().addClass("s");
	$(".title-link").click(function(){
		$(this).next().slideToggle();
		
		return false;
		
	})
 $("#main-nav  li").each(function(){
			
		if($(this).find("ul").length){
			
			$obj = $(this).find("ul").first();
			$w = $obj.find("li.f").first().find("a").width();
			
			$obj.find("li.f").each(function(){
				
				if($(this).find("a").width() > $w){
					
					$w = $(this).find("a").width();
					
				}
			})
			$obj.css("width",$w+20);
			
		}
		
	}); 
	$("#main-nav  li > ul > li").each(function(){
		
		if($(this).find("ul").length){
			$obj = $(this).find("ul").first();
			$w = $obj.find("li.t").first().find("a").width();
			$obj.find("li.t").each(function(){
				if($(this).find("a").width() > $w){
					$w = $(this).find("a").width();
				}
			})
			
			$obj.css("width",$w+10);
			
		}
		
	});
	
	$("#main-nav ul").css({visibility:"visible"});
	
}
function initIndexSlider(){

	$('.qpage').bxSlider({
		
		pager:false
		
		
		
	});
	//setTimeout(function(){
	//$('.bx-loading').remove();
	//},500);
}
function showMsg($type,$msg){
			Lobibox.notify($type, {
							size: 'mini',
							msg: $msg,
							showClass: 'fadeInDown',
							hideClass: 'fadeUpDown',
                });
}
function initAjax(options){
  var defaults = { 
    url:      '', 
    type:    'post', 
	data:null,
    dataType:  'html', 
    error:  function(e){console.log(e)},
	success:function(){return false;},
	beforeSend:function(){},
  }; 

  // Overwrite default options 
  // with user provided ones 
  // and merge them into "options". 
  var options = $.extend({}, defaults, options); 
	$.ajax({
		url:options.url,
		data:options.data,
		success:options.success,
		error:options.error,
		type:options.type,
		dataType:options.dataType,
		
	})
	

}
function addCart(){
	
		$("#add-cart").click(function(){
		$color = 0;
		$size = 0;
		$id = $(this).data("id");
		$qty = parseInt($("#qty").val());
		if($("#p_color").length){
			if($("#p_color .color_item.active").length){
				$color = $("#p_color .color_item.active").data("id");
			}else{
				showMsg("warning","Vui lòng chọn màu cho sản phẩm!");
				$("html, body").animate({ scrollTop: $("#p_color").offset().top }, 500);
				return false;
			}
			
		}
		if($("#p_size").length){
			if($("#p_size .size_item.active").length){
				$size = $("#p_size .size_item.active").data("id");
			}else{
				showMsg("warning","Vui lòng chọn kích thước cho sản phẩm!");
				$("html, body").animate({ scrollTop: $("#p_size").offset().top }, 500);
				return false;
			}
			
		}
		doAddCart($(this).data("name"),$id,$qty,$color,$size);
		return false;
});  

}
function doAddCart($name,$id,$qty,$color,$size){
	NProgress.start();
	initAjax({
		url:"ajax/add-cart.html",
		data:{id:$id,qty:$qty,color:$color,size:$size},
		success:function(data){
			
			$(".cart-num").html(data);
			showMsg("success","Thêm sản phẩm "+$name+" vào giỏ thành công");
			NProgress.done();
		}
	})
return false;		
}
$().ready(function(){
	 $('[data-toggle="tooltip"]').tooltip();
	$(".product-item-wrap").each(function(){
		
		//$(this).find(".wrap").append('<div class="hover_shine"></div>');
	})
	addCart();
initLazyload();
$("#loading").hide();
initOverlayProductImage();
initIndexSlider();
	//$("ul.qpage").quickPager({pageSize: 6});
$(".box-left.product ul > li").hover(function(){
	//$(this).find("ul").show();
},function(){
//	$(this).find("ul").hide();
})
setTimeout(function(){
initMenu();
},500);
$("#search-btn").click(function(){

	window.location.href = base_url+"/search.html&keyword="+$("input[name='keyword']").val();
	return false;
})
if($("#slider1_container").length){
	initSlider();
	}
	initFancybox();
})


function isEmpty(el,text){
	//var el = document.getElementById(id);
	var str = el.value;
	
	if (str != "")
		while (str.charAt(0) == " ")
			str = str.substr(1, str.length);
	
	//return str == "" ? true : false;
	if(str != "") return false;
	if(typeof(text) != 'undefined')	alert(text);
	el.value = '';
	el.focus();
	return true;
}

function isNumber(el, text){
	//var el = document.getElementById(id);
	var str = "0123456789";
	for(var j=0; j < el.value.length; j++){
		if(str.indexOf(el.value.charAt(j))==-1){
			if( typeof(text) != 'undefined' )
				alert(text);
			el.value = '';
			el.focus();	
			return false;
		}
	}
	return true;
}

function isPhone(el, text){
	//var el = document.getElementById(id);
	var str = "0123456789. ()-";
	var result = true;
	for(var j=0; j < el.value.length; j++){
		if(str.indexOf(el.value.charAt(j))==-1){
			result = false;
			break;
		}
	}
	if(el.value.length < 7) result = false;
	if(!result){	
		el.focus();
		if(typeof(text)!='undefined')	alert(text);
	}
	return result;
}

function check_email(email)
{
	emailRegExp = /^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.([a-z]){2,4})$/;
	return emailRegExp.test(email);
}

function isEmail(el, text){
	//var el = document.getElementById(id);
	emailRegExp = /^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.([a-z]){2,4})$/;
	if(!emailRegExp.test(el.value)){
		if(typeof(text)!='undefined')	alert(text);
		el.focus();
		return false;
	}
	return true;
}

function isEmail_2(s){   
  if (s=="") return true;//false;
  if(s.indexOf(" ")>0) return false;
  if(s.indexOf("@")==-1) return false;
  var i = 1;
  var sLength = s.length;
  if (s.indexOf(".")==-1) return false;
  if (s.indexOf("..")!=-1) return false;
  if (s.indexOf("@")!=s.lastIndexOf("@")) return false;
  if (s.lastIndexOf(".")==s.length-1) return false;
  var str="abcdefghikjlmnopqrstuvwxyz-@._"; 
  for(var j=0;j<s.length;j++)
	if(str.indexOf(s.charAt(j))==-1)
		return false;
  return true;
}

function compare(value_1, value_2){
	if(value_1 < value_2)
		return -1;
	if(value_1 > value_2)
		return 1;
	return 0;
}
function initFancybox(){
	$(".fancybox").fancybox();
}

function addToCartWithOption($id,$name){
	doAddCart($name,$id,1,0,0);
	return false;
}
function addToCart(id,$name){
	$.ajax({
		type:'post',
		url:base_url+"/gio-hang/addcart.html",
		data:{id:id},
		dataType:'json',
		success:function(data){
			//console.log(data);
			$(".cart-num").html(data.num);
				//showTooltip(lang.addProduct+" "+$name+" "+lang.toShopcart+" "+lang.success);
			$(".source-cart a").html(data.num);
			swal("Thông báo!", "Thêm sản phâm "+$name+" vào giỏ hàng thành công!", "success")
			
		
		}
		
		
	
	})
	return false;
	
	
	


}
function popup(message,close,onUnload,height) {
	if(!height){
		height = 100;
	
	}
	if(!$("#avgund").length){
		$("body").append("<a id='avgund'></a>");
	}
	$tpl = '<div style="padding:4px;text-align:center">'+message+"</div>";
	if(close){
		$tpl+= "<div class='avgund-wrap-button'><button class='avgund-button avg-close'>OK</button>";
	}
	$('#avgund').avgrund({
	height: height,
	holderClass: 'custom',
	showClose: true,
	closeDiaglog : close,
	showCloseText: 'Close',
	enableStackAnimation: true,
	//onBlurContainer: '.container',
	setEvent: 'click', // use your event like 'mouseover', 'touchmove', etc.
	onLoad: function (elem) {  }, // set custom call before popin is inited..
	onUnload: onUnload, // ..and after it was closed
	template: $tpl
	
});
				$("#avgund").click();
}