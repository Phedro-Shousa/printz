<?php
	$show_breadcrumb = flone_get_meta_otpion('show_breadcrumb', '1');
	if( $show_breadcrumb):
?>
<div class="breadcrumb-area pt-35 pb-35 bg-gray-3">
    <div class="container">
        <div class="breadcrumb-content text-center">
            <?php
				if(function_exists('is_woocommerce')){
		          if( is_woocommerce() ){

		           	woocommerce_breadcrumb();

		          } else {
		          	
                  	 flone_breadcrumbs();

		          }
		         } else {
		         	
                  	flone_breadcrumbs();

		         }
            ?>
        </div>
    </div>
</div>
<?php endif; ?>