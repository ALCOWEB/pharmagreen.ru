


  $('.add_to_cart_link').on('click', function(event){
      event.preventDefault();
	  var id = this.dataset.productId;
	  var data = $(this).serialize();
	 $.ajax({
	    url: 'http://pharmagreen.ru/shop/cart/ajax-add?id='+id,
	    type: 'POST',
	    data: data,
		 beforeSend: function() {
			 console.log('do otpravki')
		 },
		 complete: function() {
			 console.log('posle otpravki')

		 },
	    success: function(res){
	        console.log(res);
			$('.header_account_list.mini_cart_wrapper').html(res);
			setTimeout(function(){
				$(function(){$('.mini_cart,.off_canvars_overlay').addClass('active');})
			}, 50);
		//	$('.mini_cart,.off_canvars_overlay').addClass('active');

			// $(document).ready(function() {
			// 	$('.mini_cart,.off_canvars_overlay').addClass('active')
			// });

	      // $('.mini_cart,.off_canvars_overlay').addClass('active');


	    },
	    error: function(){
	       alert('Error!');
	    }
	 });
	 return false;
     });



	$('form.add_to_cart_form').on('beforeSubmit', function(event) {
		event.preventDefault();
		var form = $(this);
		var data = form.serializeArray();
		// отправляем данные на сервер
		$.ajax({
			url: form.attr('action'),
			//url: '/shop/cart/ajax-test',
			type: form.attr('method'),
			data: data,
			success: function(result){
				console.log(result);
				$('.header_account_list.mini_cart_wrapper').html(result);
				setTimeout(function(){
					$(function(){$('.mini_cart,.off_canvars_overlay').addClass('active');})
				}, 50);
				// $('.mini_cart,.off_canvars_overlay').addClass('active');
			},

			error: function(){
				alert('Error!');
			}
		})
		return false; // отменяем отправку данных формы
	});

	$('form.fast_order').on('beforeSubmit', function(event) {
		event.preventDefault();
		var form = $(this);
		var data = form.serializeArray();
			
		return false; // отменяем отправку данных формы
	});



   $('a.add_to_wish_list_link').on('click', function(event){
      event.preventDefault();
	  var id = this.dataset.productId;
	 $.ajax({
	    url: 'http://pharmagreen.ru/cabinet/wishlist/add-ajax?id='+id,
	    type: 'POST',
		 beforeSend: function() {
			 console.log('do otpravki')
		 },
		 complete: function() {
			 console.log('posle otpravki')

		 },
		 success: function(res){
			 console.log(res);
			 $('.header_account_list.header_wishlist').html(res);
		 },
		 error: function(){
			 alert('Error!');
		 }
	 });
	   return false;
     });


	 $(document).on('click', '.remove_from_cart', function (event) {
	  event.preventDefault();
	  var id = this.dataset.productId;
	  var data = $(this).serialize();
	  $.ajax({
		  url: '/shop/cart/remove-ajax?id='+id,
		  type: 'POST',
		  data: data,
		  success: function(res){
			  console.log(res);
			  $('.header_account_list.mini_cart_wrapper').html(res);
			  $('.mini_cart').addClass('active');

			  // $('.mini_cart,.off_canvars_overlay').addClass('active');

		  },
		  error: function(){
			  alert('Error!');
		  }
	  });
	  return false;
  });
  $(document).on('click', '.remove_from_wishlist', function (event) {
	  event.preventDefault();
	  var id = this.dataset.productId;
	  var data = $(this).serialize();
	  $.ajax({
		  url: '/cabinet/wishlist/delete-ajax?id='+id,
		  type: 'POST',
		  data: data,
		  success: function(res){
			  console.log(res);


			  // $('.mini_cart,.off_canvars_overlay').addClass('active');

		  },
		  error: function(){
			  alert('Error!');
		  }
	  });
	  return false;
  });



