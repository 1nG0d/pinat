$(document).ready(function() {

loadcart();

//Каруcелька Header_inner
  $("#owl-head").owlCarousel({
          items : 4,
          singleItem: true,
          slideSpeed : 2000,
          paginationSpeed : 10,
          rewindSpeed : 20,
          pagination: true,
          paginationNumbers: false,
          navigation : false,// Show next and prev buttons  
          autoPlay: 10000,
          scrollPerPage: true,
       //   rewindNav: false,    
          itemsDesktop : [1199,4],
          itemsDesktopSmall : [980,3],
          itemsTablet: [768,2],
          itemsMobile : [479,1]
  });	
	
	$(".top_menu a, .up, .menu_bottom a, #cooperation").mPageScroll2id({offset: 95});
	
	//Аякс отправка форм
	//Документация: http://api.jquery.com/jquery.ajax/
	$("#coopForm").submit(function() {
		$.ajax({
			type: "GET",
			url: "../mail/coopMail.php",
			data: $("#coopForm").serialize()
		}).done(function() {
			alert("Дякуємо, співробітник ТМ Пінат звя'яжеться з Вами!");
			setTimeout(function() {
				$.fancybox.close();
			}, 1000);
		});
		return false;
	});
	
	$("#vacancy").submit(function() {
		$.ajax({
			type: "GET",
			url: "../mail/vacanxcMail.php",
			data: $("#vacancy").serialize()
		}).done(function() {
			alert("Дякуємо, співробітник ТМ Пінат звя'яжеться з Вами!");
			setTimeout(function() {
				$.fancybox.close();
			}, 1000);
		});
		return false;
	});
	
	$("#mainForm").submit(function() {
		var pageurl;
		var pagelink = window.location.pathname;
			switch (pagelink) {
				case '/pinatShop/carten.php':
					pageurl='../mail/mainen.php';
				break;
					case '/pinatShop/cartru.php':
					pageurl='../mail/mainru.php';
				break;
				default:
					pageurl='../mail/main.php';
			}
		$.ajax({
			type: "POST",
			url: pageurl,
			data: $("#mainForm").serialize()
		}).done(function() {
			//alert("Дякуємо за зроблене замовлення, співробітник ТМ Пінат звя'яжеться з Вами!");
			var link=location.href;
			var res;
			if( $(".pay input:checked").val()=="Сплати банківською картою" || $(".pay input:checked").val()=="Оплатить банковской картой" ||$(".pay input:checked").val()=="bank card") 
			{
				 res = link.replace("confirm", "payment");
			}
			 else res = link.replace("confirm", "thanks");
			location.href = res;
		});
		return false;
	});
// ---------------------STORE--------------------------
	$('.addItemToCart').click(function(){
		var product_id=$(this).attr("product_id");
		$.ajax({
			type:"POST",
			url: "../pinatShop/include/addtocart.php",
			dataType:"html",
			data: "id="+product_id,
			cache: false,
			success: function(data){
				loadcart();
			}
		
	});
	});
	
	function loadcart(){
		$.ajax({
			type:"POST",
			url: "../pinatShop/include/loadcart.php",
			dataType:"html",
			cache: false,
			success: function(data)
			{
				 if (data=="0"){
					 $('#cartCntItems').html("0");
				 }
				 else {
					   $('#cartCntItems').html($.trim(data));
					   }	   
			}
	});
				 }
		
	$('.count-input').change(function() {
					
				 var iid=$(this).attr("iid");
				 var incount=$("#input-id"+iid).val();
				 $.ajax({
					type:"POST",
					url: "../pinatShop/include/count-input.php",
					data: "id="+iid+"&count="+incount,
					dataType:"html",
					cache: false,
					success: function(data){
					$("#input-id"+iid).val(data);
					loadcart();
					
					var priceproduct=$("#product_price"+iid+"").attr("price");
					result_total=Number(priceproduct)*Number(data);
					
					$("#product_price"+iid+"").html(result_total+ " грн.");
					result_sum();
					}
				 });
				
				
			});
			
	function result_sum(){
		$.ajax({
			type:"POST",
			url: "../pinatShop/include/resultSum.php",
			dataType:"html",
			cache: false,
			success: function(data) {
				$(".resultSum").html(data);
			}
		});
	}
//-----------------------endSTORE-----------------------------------------------
});


// New Functions
function hideShowDiv(opt){
      $(opt).toggle('slow');
}

function slideUpDiv(opt){
    $(opt).slideUp('normal');
}
function slideDownDiv(opt){
    $(opt).slideDown('normal');
}   

function hideArrow(arrowUp1,arrowDown1) {
    var object1 = document.getElementById(arrowUp1);
    var object2 = document.getElementById(arrowDown1);

object1.style.display == 'inline-block' ? object1.style.display = 'none' : object1.style.display = 'inline-block';
    
object2.style.display == 'none' ? object2.style.display = 'inline-block' : object2.style.display = 'none';
}
//-------------------------------------ShowMinMenu-----------------------------------

function ShowMinMenu(){
	$('.min_menu').css('display','none');
	$('.top_menu').css('display','block');
}

function HideMenu() {
	$('.min_menu').css('display','block');
	$('.top_menu').css('display','none');
}

if (window.outerWidth<360) {
	$("nav.top_menu a").click(function HideMenu() {
		$('.min_menu').css('display','block');
		$('.top_menu').css('display','none');
	});
}

if (window.outerWidth<480)  {
	var link,lin;
	lin=window.location.pathname;
	switch (lin) {
		case '/':
			link="pinatShop/index.php"; 
			$(".min_menu .right_menu>a").attr("href",link);
			break;
		case '/en.html':	
			link="pinatShop/en.php";
			$(".min_menu .right_menu>a").attr("href",link);
			break;
		case '/ua.php':
			link="pinatShop/ua.php";
			$(".min_menu .right_menu>a").attr("href",link);
			break;
		default:
			link='#';
			$(".min_menu .right_menu>a").attr("href",link);
	}
		
}
//--------------------------------------------
function make_pay(){

 $.get("payment/makeform.php", //Если ВСЕ ОК - Запросим сгенерированную форму без перезагрузки страницы
 {
 	price: $('#price').val(), //В качестве параметра передадим сумму (введенную в поле)
 	desc: $('#desc').val()
 },  
 	onAjaxSuccess //Функция, которая сработает если ВСЕ ОК
	   
 );
 
 function onAjaxSuccess(data)
 {
 // Здесь мы получаем данные в переменную data
 $('#form_responce').html(data); //И передаем эту форму в невидимое поле form_responce
 $('#form_responce form').submit(); //Сразу же автоматически сабмитим эту форму, так как всеравно клиент её не видит
 }
}
 