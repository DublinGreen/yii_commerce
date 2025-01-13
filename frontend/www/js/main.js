jQuery('.product_add_cart').hide();
jQuery(document).ready(function() {
	ProductPreview();
	Slider();
	Cart();
	
	function Slider(){
		if( jQuery('#column .flexslider').get(0) != null){
			jQuery('#column .flexslider').flexslider({
				animation: "slide"
			});
		}
		
		
		if( jQuery('.product_gallery .flexslider').get(0) != null){
			jQuery('.product_gallery .flexslider').flexslider({
				animation: "fade",
				controlNav: "thumbnails"
			});
		}
		if( jQuery('.slider').get(0) != null){
			var Slide = jQuery('.slider').slider({ tooltip: 'hide'})
				.on('slide', function(ev){
					var arr = jQuery(this).slider('getValue');
					jQuery('.price_left input').val(arr[0]);
					jQuery('.price_right input').val(arr[1]);
				});
			jQuery( ".price_left input[type='text'], .price_right input[type='text']" ).change(function() {
				var left = jQuery('.price_left input').val();
				var right = jQuery('.price_right input').val();
				var newValue = [ parseInt(left), parseInt(right) ];
				Slide.slider('setValue', newValue);
				jQuery('#price-form').submit();
			});
		}
		
		jQuery('.slides li img').elevateZoom({
		scrollZoom : true,
		tint:true,
		tintColour:'#F90', 
		tintOpacity:0.5,
   });
	}
	function ProductPreview(){
		jQuery('.product_add_cart').hide();
		jQuery('.product_preview').hover(function(){
			jQuery(this).children('.product_add_cart').show();},
			function(){jQuery(this).children('.product_add_cart').hide();}
		);
	}
	function Cart(){
		jQuery('#mainContent').on('change','.cart .quantity',function(e) {
			//e.preventDefault();		
			var pid = jQuery(this).siblings('.pid').text();
			var val = jQuery(this).val();
			var href = jQuery(this).siblings('.addlink').text()+'?cart=1&quantity='+val;
			
			//alert(val);
			//$(spinnertarget).spin("large", "white");
			jQuery('#mainContent').load(href, function(){
				//$(spinnertarget).spin(false);
			});
		});
	}
});
