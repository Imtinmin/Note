/**
 * 评价商品js
 * 李志伟
 * 2017年3月2日10:19:30
 */

$(function(){
	/*字数限制*/
	$("textarea").on("input propertychange", function() {
		var $this = $(this),
		_val = $this.val(),
		count = "";
		if (_val.length > 150) {
			$this.val(_val.substring(0, 150));
		}
		count = 150 - $this.val().length;
		$("#text-count").text(count);
	});
})

$(document).ready(function(){
	var style=$('#style').val();
	$(".star a").click( function () {
		$(this).prevAll().find("img").attr("src",temp+"/"+style+"/public/images/star_red.png");
		$(this).prevAll().attr("sel", "red");
		$(this).find("img").attr("src",temp+"/"+style+"/public/images/star_red.png");
		$(this).attr("sel", "red");
		$(this).nextAll().find("img").attr("src",temp+"/"+style+"/public/images/star.png");
		$(this).nextAll().attr("sel", "");
	});
	$(".star a").mouseover(function(){
		$(this).prevAll().find("img").attr("src",temp+"/"+style+"/public/images/star_red.png");
		$(this).find("img").attr("src",temp+"/"+style+"/public/images/star_red.png");
		$(this).nextAll().find("img").attr("src",temp+"/"+style+"/public/images/star.png");
	});
	$(".star a").mouseout(function(){
		$(this).parent().find("a img").attr("src",temp+"/"+style+"/public/images/star.png");
		$(this).parent().find("a[sel=red] img").attr("src",temp+"/"+style+"/public/images/star_red.png");
	});
});

//加载事件
function loadFunction(){
	//上传图片悬浮显示删除
	$('.evaluate_right_imgs>li').mouseover(function(){
		$(this).children('span').css('display',"block");
	})
	$('.evaluate_right_imgs>li').mouseout(function(){
		$(this).children('span').css('display',"none");
	})
	
	/**
	 * 删除图片
	 * @param {Object} even
	 */
	$('.evaluate_right_imgs>li>span').click(function(){
		var rate_content=$(this).parents('.rate_content');
		
		$(this).parent().remove();  //必须写到前面不然等图片没了就无法移除！待后期验证先这样无问题 李志伟
		var imgsrc=$(this).parent().attr("data-img");
		$.ajax({
			type:"post",
			url:__URL(shop_main+"/components/deleteimgupload"),
			data:{"imgsrc":imgsrc},
			success:function(res){
				imgsLength(rate_content);
			}
		});
	})
}

/**
 * 获取当前商品所上传的图片个数
 * @param {Object} even
 */
function imgsLength(even){
	 var imgs_count=even.find('.evaluate_right_imgs>li').length;
	 even.find('.evaluate_right_four').html(imgs_count+'/5');
 if(imgs_count==5){
  	 	 even.find('[type="file"]').attr('disabled',"disabled");
 }else{
	 even.find('[type="file"]').removeAttr("disabled"); 
 }
}

/**
 * 上传图片
 */
function UploadImage(event) {
	var file_upload = $(event).attr("id");
	$.ajaxFileUpload({
		url : __URL(shop_main+'/components/imgupload'), // 用于文件上传的服务器端请求地址
		secureuri : false, // 一般设置为false
		fileElementId : file_upload, // 文件上传空间的id属性 <input type="file" id="file" name="file" />
		dataType : 'text', // 返回值类型 一般设置为json
		async : false,
		success : function(res){ // 服务器成功响应处理函数
			$('#'+file_upload).parents('.rate_content').find('.evaluate_right_imgs').append('<li style="background-image: url('+upload+'/' + res + ');" data-img="' + res + '"><span>删除</span></li>');
			var eve=$('#'+file_upload).parents('.rate_content');
			imgsLength(eve);
			loadFunction();
		}
	});

}

//保存评价
//type 1评价 2追评
function doSubmit(type){
	var ajaxUrl=__URL(shop_main+"/order/addgoodsevaluateagain");
	var flag = false;
	var goodsEvaluateArr = new Array();
	$(".evaluate").each(function(i){
		var order_id = $(this).attr("oid");
		var order_goods_id = $(this).attr("ogid");
		var content = $(this).find("textarea").val();
		if(content == ""){
			flag = true;
			return false;
		}
		content = content==''?'好评':content;
		var imgs_arr = new Array();
		$(this).find('.evaluate_right_imgs').find('li').each(function(e){
			var imgsrc=$(this).attr("data-img");
			imgs_arr.push(imgsrc);
		})
		var evaluateArr = new Object();
		
		if(type==1){
			var is_anonymous = $(this).find("input[type='checkbox']").is(':checked');
			var scores = $(this).find(".star a[sel=red]:last").attr("val");
			if(scores == 1){
				var explain_type = 3;
			}
			if(scores >1 && scores <4){
				var explain_type = 2;
			}
			if(scores >3 && scores <6){
				var explain_type = 1;
			}
			evaluateArr.is_anonymous = is_anonymous;
			evaluateArr.scores = scores;
			evaluateArr.explain_type = explain_type;
			ajaxUrl=__URL(shop_main+"/order/addgoodsevaluate");
		}
		evaluateArr.order_id = order_id;
		evaluateArr.order_goods_id = order_goods_id;
		evaluateArr.content = content;
		evaluateArr.imgs = imgs_arr.toString();
		goodsEvaluateArr.push(evaluateArr);
	});
	if(flag){
		$.msg("请输入要评价的内容");
		return;
	}

	var order_id = $("#order_id").val();
	var order_no = $("#order_no").val();
	if($("#isSub").val()=='true'){
		$("#isSub").val("false");
		$("#btn_submit").css("background-color", '#ddd');
		$.ajax({
			url:ajaxUrl,
			type:'post',
			data:{"goodsEvaluate": JSON.stringify(goodsEvaluateArr), "order_id": order_id, "order_no": order_no},
			dataType:'json',
			success:function(data){
				if(data == 1){
					$.msg('评价成功');
					setTimeout(function(){
						location.href = __URL(shop_main+"/member/orderlist")
					},1000);
				}
			}
		})
	}
}