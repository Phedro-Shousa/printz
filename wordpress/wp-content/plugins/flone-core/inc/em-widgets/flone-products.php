<?php
namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Flone_Products extends Widget_Base {

    public function get_name() {
        return 'flone_products';
    }
    
    public function get_title() {
        return __( 'Products', 'flone' );
    }

    public function get_icon() {
        return 'eicon-products';
    }
    public function get_categories() {
        return [ 'flone' ];
    }

	public function flone_content_fields(){
		$this->start_controls_section(
		    'content_section_1',
		    [
		        'label' => __( 'Content', 'flone' ),
		    ]
		);

		$this->add_control(
		    'style',
		    [
		        'label' => __( 'Product style', 'flone' ),
		        'type' => Controls_Manager::SELECT,
		        'default' => '1',
		        'options' => [
		            '1' => __( 'One', 'flone' ),
		            '2' => __( 'Two', 'flone' ),
		            '3' => __( 'Three', 'flone' ),
		            '4' => __( 'Four', 'flone' ),
		        ],
		    ]
		);
		$this->add_control(
		    'product_type',
		    [
		        'label' => __( 'Select Product Pype', 'flone' ),
		        'type' => Controls_Manager::SELECT,
		        'default' => 'recent',
		        'options' => [
		            'recent' => __( 'Recent Products', 'flone' ),
		            'best_selling' => __( 'Best Selling Products', 'flone' ),
		            'featured' => __( 'Featured Products', 'flone' ),
		            'sale' => __( 'Sale Products', 'flone' ),
		            'top_rated' => __( 'Top Rated Products', 'flone' ),
		            'mixed_order' => __( 'Mixed order Products', 'flone' ),
		        ],
		    ]
		);
		$this->add_control(
		    'select_category',
		    [
		        'label' => __( 'Select Product Categories', 'flone' ),
		        'type' => Controls_Manager::SELECT2,
		        'label_block' => true,
		        'multiple' => true,
		        'options' => flone_get_taxonomies('product_cat'),
		    ]
		);
		$this->add_group_control(
		    Group_Control_Image_Size::get_type(),
		    [
		        'name' => 'image_size',
		        'default' => 'large',
		        'separator' => 'none',
		    ]
		);
		$this->add_control(
		  'per_page',
		  [
		     'label'   => __( 'Number Of Product To Display', 'flone' ),
		     'description' => __('Specify number of products that you want to show. Set 0 to get all products ', 'flone'),
		     'type'    => Controls_Manager::NUMBER,
		     'default' => 4,
		     'min'     => 0,
		     'max'     => 100,
		     'step'    => 1,
		  ]
		);

		$this->add_control(
		    'columns',
		    [
		        'label' =>__( 'Columns', 'flone' ),
		        'type' => Controls_Manager::SELECT,
		        'default' => '4',
		        'options' => [
		            '2' =>__( '2', 'flone' ),
		            '3' =>__( '3', 'flone' ),
		            '4' =>__( '4', 'flone' ),
		            '5' =>__( '5', 'flone' ),
		        ],
		    ]
		);


		// ordering
		$this->add_control(
            'custom_order',
            [
                'label' => __( 'Custom order', 'flone' ),
                'type' => Controls_Manager::SWITCHER,
                'return_value' => '1',
                'default' => '0',
            ]
        );

        $this->add_control(
            'order',
            [
                'label' => __( 'order', 'flone' ),
                'type' => Controls_Manager::SELECT,
                'default' => 'DESC',
                'options' => [
                    'DESC'  => __('Descending','flone'),
                    'ASC'   => __('Ascending','flone'),
                ],
                'condition' => [
                    'custom_order' => '1',
                ]
            ]
        );

        $this->add_control(
            'orderby',
            [
                'label' => __( 'Orderby', 'flone' ),
                'type' => Controls_Manager::SELECT,
                'default' => 'none',
                'options' => [
                    'none'          => __('None','flone'),
                    'ID'            => __('ID','flone'),
                    'date'          => __('Date','flone'),
                    'name'          => __('Name','flone'),
                    'title'         => __('Title','flone'),
                    'comment_count' => __('Comment count','flone'),
                    'meta_value_num'=> __('Meta value Number','flone'),
                    'rand'          => __('Random','flone'),
                ],
                'condition' => [
                    'custom_order' => '1',
                ]
            ]
        );
    

	$this->end_controls_section(); // Content fields end
}


// style fields
public function flone_style_fields(){
	$this->start_controls_section(
	    'style_section_1',
	    [
	        'label' => __( 'Stying Options', 'flone' ),
	        'tab' => Controls_Manager::TAB_STYLE,
	    ]
	);

	// product styling
	$this->add_control(
	  'columns_gap',
	  [
	  	'label' => __( 'Gap Between Columns', 'flone' ),
	  	'type' => Controls_Manager::SLIDER,
	  	'size_units' => [ 'px' ],
	  	'range' => [
	  		'px' => [
	  			'min' => 0,
	  			'max' => 100,
	  			'step' => 1,
	  		],
	  	],
	  	'default' => [
	  		'unit' => 'px',
	  		'size' => 15,
	  	],
	     'selectors' => [
	         '{{WRAPPER}}  div[class^="col-"]' => 'padding-left: {{SIZE}}{{UNIT}};padding-right: {{SIZE}}{{UNIT}};',
	     ],
	  ]
	);

	// product title typography
	$this->add_group_control(
	    Group_Control_Typography::get_type(),
	    [
	        'name' => 'product_title_typography',
	        'label' => __( 'Product Title Typography', 'flone' ),
	        'scheme' => Scheme_Typography::TYPOGRAPHY_1,
	        'selector' => '
	        	{{WRAPPER}} h2,
	        	{{WRAPPER}} .product-wrap .product-content .title-price-wrap h3 a,
	        	{{WRAPPER}} .product-wrap-2 .product-content-2 .title-price-wrap-2 h3 a,
	        	{{WRAPPER}} .product-wrap-5 .flone-product-content h3 a
	        '
	    ]
	);
	// product title color
	$this->add_control(
	    'product_title_color',
	    [
	        'label'     => __( 'Product Title Color', 'flone' ),
	        'type'      => Controls_Manager::COLOR,
	        'selectors' => [
	            '{{WRAPPER}} h2' => 'color: {{VALUE}};',
	            '{{WRAPPER}} .product-wrap .product-content .title-price-wrap h3 a' => 'color: {{VALUE}};',
	            '{{WRAPPER}} .product-wrap-2 .product-content-2 .title-price-wrap-2 h3 a' => 'color: {{VALUE}};',
	            '{{WRAPPER}} .product-wrap-5 .flone-product-content h3 a' => 'color: {{VALUE}};',
	        ],
	    ]
	);
	// product title hover color
	$this->add_control(
	    'product_title_hover_color',
	    [
	        'label'     => __( 'Product Title Hover Color', 'flone' ),
	        'type'      => Controls_Manager::COLOR,
	        'selectors' => [
	            '{{WRAPPER}} .product-wrap .product-content a:hover h2' => 'color: {{VALUE}};',
	            '{{WRAPPER}} .product-wrap-2 .product-content-2 .title-price-wrap-2 h3 a:hover' => 'color: {{VALUE}};',
	            '{{WRAPPER}} .product-wrap-5 .flone-product-content h3 a:hover' => 'color: {{VALUE}};',
	        ],
	        'separator' => 'after',
	    ]
	);
	// product price typography
	$this->add_group_control(
	    Group_Control_Typography::get_type(),
	    [
	        'name' => 'product_price_typography',
	        'label' => __( 'Product Price Typography', 'flone' ),
	        'scheme' => Scheme_Typography::TYPOGRAPHY_1,
	        'selector' => '
	        	{{WRAPPER}} .woocommerce-Price-amount.amount
	        '
	    ]
	);
	// product price color
	$this->add_control(
	    'product_price_color',
	    [
	        'label'     => __( 'Product Price Color', 'flone' ),
	        'type'      => Controls_Manager::COLOR,
	        'selectors' => [
	            '{{WRAPPER}} .woocommerce-Price-amount.amount' => 'color: {{VALUE}};',
	            '{{WRAPPER}} .product-wrap-2 .price-2 del span.woocommerce-Price-amount' => 'color: {{VALUE}};',
	        ],
	    ]
	);
	// product old price color
	$this->add_control(
	    'product_old_price_color',
	    [
	        'label'     => __( 'Product Old Price Color', 'flone' ),
	        'type'      => Controls_Manager::COLOR,
	        'selectors' => [
	            '{{WRAPPER}} .price del .woocommerce-Price-amount.amount' => 'color: {{VALUE}};',
	            '{{WRAPPER}} .product-wrap-2 .product-content-2 .title-price-wrap-2 .price del .woocommerce-Price-amount.amount' => 'color: {{VALUE}};',
	        ],
	    ]
	);
	// product old price seperator color
	$this->add_control(
	    'product_old_price_seperator_color',
	    [
	        'label'     => __( 'Product Old Price Separator Color', 'flone' ),
	        'type'      => Controls_Manager::COLOR,
	        'selectors' => [
	            '{{WRAPPER}} .price del .woocommerce-Price-currencySymbol::before' => 'background-color: {{VALUE}};',
	        ],
	        'separator' => 'after',
	    ]
	);

	// hover action styling
	// item BG color
	$this->add_control(
	    'hover_action_bg_color',
	    [
	        'label'     => __( 'Hover Action BG Color', 'flone' ),
	        'type'      => Controls_Manager::COLOR,
	        'selectors' => [
	            '{{WRAPPER}} .product-wrap-5 .product-action-4' => 'background-color: {{VALUE}};',
	        ],
	        'condition' => [
	            'style' => array( '3' ),
	        ],
	    ]
	);
	// item BG color
	$this->add_control(
	    'item_bg_color',
	    [
	        'label'     => __( 'Hover Action Item BG Color', 'flone' ),
	        'type'      => Controls_Manager::COLOR,
	        'selectors' => [
	            '{{WRAPPER}} .product-wrap .product-img .product-action > div' => 'background-color: {{VALUE}};',
	            '{{WRAPPER}} .product-wrap-2 .product-img .product-action-2 a' => 'background-color: {{VALUE}};',
	            '{{WRAPPER}} .product-wrap-5 .product-action-4 .pro-same-action a' => 'background-color: {{VALUE}};',
	        ],
	    ]
	);
	// item text and icon color
	$this->add_control(
	    'item_text_and_icon_color',
	    [
	        'label'     => __( 'Hover Action Item Text And Icon Color', 'flone' ),
	        'type'      => Controls_Manager::COLOR,
	        'selectors' => [
	            '{{WRAPPER}} .woocommerce .product-wrap .product-img .product-action .pro-same-action a' => 'color: {{VALUE}};',
	            '{{WRAPPER}} .product-wrap-2 .product-img .product-action-2 a' => 'color: {{VALUE}};',
	            '{{WRAPPER}} .product-wrap-5 .product-action-4 .pro-same-action a' => 'color: {{VALUE}};',
	            '{{WRAPPER}} .yith-wcwl-wishlistexistsbrowse.show a i' => 'color: {{VALUE}};',
	            '{{WRAPPER}} .product-wrap-5 .yith-wcwl-wishlistexistsbrowse.show a i' => 'color: {{VALUE}};',
	        ],
	    ]
	);
	// item Hover BG color
	$this->add_control(
	    'item_hover_bg_color',
	    [
	        'label'     => __( 'Hover Action Item Hover BG Color', 'flone' ),
	        'type'      => Controls_Manager::COLOR,
	        'selectors' => [
	            '{{WRAPPER}} .product-wrap .product-img .product-action > div:hover' => 'background-color: {{VALUE}};',
	            '{{WRAPPER}} .product-wrap-2 .product-img .product-action-2 a:hover' => 'background-color: {{VALUE}};',
	            '{{WRAPPER}} .product-wrap-5 .product-action-4 .pro-same-action a:hover' => 'background-color: {{VALUE}};',
	        ],
	    ]
	);
	// item Hover Text and icon color
	$this->add_control(
	    'item_hover_text_and_icon_color',
	    [
	        'label'     => __( 'Hover Action Item Hover Text And Icon Color', 'flone' ),
	        'type'      => Controls_Manager::COLOR,
	        'selectors' => [
	            '{{WRAPPER}} .woocommerce .flone-product-wrap .product-img .flone-product-action div:hover a' => 'color: {{VALUE}};',
	            '{{WRAPPER}} .yith-wcwl-wishlistexistsbrowse.show:hover a i' => 'color: {{VALUE}};',
	            '{{WRAPPER}} .product-wrap-2 .product-img .product-action-2 a:hover i' => 'color: {{VALUE}};',
	            '{{WRAPPER}} .product-wrap-5 .yith-wcwl-wishlistexistsbrowse.show a:hover i' => 'color: {{VALUE}};',
	        ],
	        'separator' => 'after',
	    ]
	);

	// slaeflash styling
	// saleflash typography
	$this->add_group_control(
	    Group_Control_Typography::get_type(),
	    [
	        'name' => 'saleflash_typography',
	        'label' => __( 'Saleflash Typography', 'flone' ),
	        'scheme' => Scheme_Typography::TYPOGRAPHY_1,
	        'selector' => '
	        	{{WRAPPER}} .woocommerce span.onsale
	        '
	    ]
	);
	// saleflash color
	$this->add_control(
	    'saleflash_color',
	    [
	        'label'     => __( 'Saleflash Text Color', 'flone' ),
	        'type'      => Controls_Manager::COLOR,
	        'selectors' => [
	            '{{WRAPPER}} .woocommerce span.onsale' => 'color: {{VALUE}};',
	        ],
	    ]
	);
	// saleflash bg color
	$this->add_control(
	    'saleflash_bg_color',
	    [
	        'label'     => __( 'Saleflash BG Color', 'flone' ),
	        'type'      => Controls_Manager::COLOR,
	        'selectors' => [
	            '{{WRAPPER}} .woocommerce span.onsale' => 'background-color: {{VALUE}};',
	        ],
	    ]
	);

	

	$this->end_controls_section(); // title style section
}

protected function _register_controls() {

	$this->flone_content_fields();
	$this->flone_style_fields();
}

protected function render( $instance = [] ) {

    $settings = $this->get_settings_for_display();
    $id = substr( $this->get_id_int(), 0, 3 );

    // generate args
    $args = array(
         'post_type'             => 'product',
         'post_status'           => 'publish',
         'ignore_sticky_posts'   => 1,
         'posts_per_page'        => ( $settings['per_page'] == 0 ) ? -1 : $settings['per_page'],
    	 'cache_results'          => false,
    	 'update_post_meta_cache' => false,
    	 'update_post_term_cache' => false,
    );

    switch ($settings['product_type']) {
	    case 'best_selling':
	        $args['meta_key']   = 'total_sales';
	        $args['orderby']    = 'meta_value_num';
	        $args['order']      = 'desc';
	        break;

	    case 'top_rated':
	        $args['meta_key']   = '_wc_average_rating';
	        $args['orderby']    = 'meta_value_num';
	        $args['order']      = 'desc';
	        break;
	    case 'featured':
			$args['tax_query'][] = array(
				'taxonomy' => 'product_visibility',
				'field'    => 'name',
				'terms'    => 'featured',
				'operator' => 'IN',
			);
	        break;
	    case 'sale':
	        $args['post__in'] = array_merge( array( 0 ), wc_get_product_ids_on_sale() );
	        break;

	    default:
	        $args['orderby']    = 'date';
	        $args['order']      = 'desc';
	        break;
	}

	// custom order
	if( $settings['custom_order'] == 'yes'){
	    $args['orderby'] = $settings['orderby'];
	    $args['order']   = $settings['order'];
	}

	// tax query
	if( $settings['select_category'] ){
		$args['tax_query'][] = array(
		    array(
		    	'taxonomy' => 'product_cat',
		    	'field'    => 'slug',
		    	'terms'    => $settings['select_category'],
		    ),
		);
	}

    ob_start(); ?>

<div class="flone_products_area woocommerce">

	<?php

		$wp_query = new \WP_Query($args);

		if( $wp_query->have_posts() ){
			wc_setup_loop( array(
				'columns'      => $settings['columns'],
			) );

			echo '<div class="row products columns-'. esc_attr( wc_get_loop_prop( 'columns' ) ). '">';
			while ( $wp_query->have_posts() ) {
				$wp_query->the_post();

				global $product;
				$gallery_ids = $product->get_gallery_image_ids();

				$secondary_img = isset($gallery_ids[0]) ? $gallery_ids[0] : '';

				$crop_size = $settings['image_size_size'] ? $settings['image_size_size'] : 'woocommerce_thumbnail';
				$image_size = apply_filters( 'single_product_archive_thumbnail_size', $crop_size );

				 if($settings['style'] == '2'):
				 ?>

				 	<div <?php wc_product_class('col-lg-4 col-md-6 col-sm-6 col-xs-12 product'); ?>>
						<div class="flone-product-wrap product-wrap-2 mb-25 scroll-zoom">
						    <div class="product-img">
						        <a href="<?php the_permalink(); ?>">
						            <?php
						            	echo woocommerce_get_product_thumbnail( $image_size );

						            	if($secondary_img){
						            		echo wp_get_attachment_image( $secondary_img, $image_size, false, array('class' => 'hover-img') );
						            	}
						            ?>
						        </a>
						        <?php flone_show_product_loop_sale_flash(); ?>
						        <div class="flone-product-action product-action-2">
						            <?php woocommerce_template_loop_add_to_cart(); ?>
						            <a title="Quick View" href="#" data-toggle="modal" data-target="#exampleModal" data-quick-id="<?php echo esc_attr($product->get_id()) ?>" class="quickview"><i class="fa fa-eye"></i></a>

									<?php
										if(function_exists('flone_compare_button')){
											flone_compare_button();
										}
									?>
						        </div>
						    </div>
						    <div class="flone-product-content product-content-2">
						        <div class="flone-title-price-wrap title-price-wrap-2">
						            <h3><a href="<?php the_permalink( ) ?>"><?php the_title(); ?></a></h3>
						            <div class="price-2">
						                <?php woocommerce_template_loop_price(); ?>
						            </div>
						        </div>
						        <div class="flone-pro-wishlist pro-wishlist-2">
						            <?php
						            	if(function_exists('flone_add_to_wishlist_button')){
						            		echo flone_add_to_wishlist_button();
						            	}
						            ?>
						        </div>
						    </div>
						</div>
				 	</div>

				<?php elseif($settings['style'] == '3'): ?>
					<div <?php wc_product_class('col-lg-4 col-md-6 col-sm-6 col-xs-12 product'); ?>>
						<div class="flone-product-wrap product-wrap-5 mb-25 scroll-zoom">
						    <div class="product-img">
						        <a href="<?php the_permalink(); ?>">
						            <?php
						            	echo woocommerce_get_product_thumbnail( $image_size );
						            ?>
						        </a>
						        <?php flone_show_product_loop_sale_flash(); ?>
						        <div class="flone-product-action product-action-4">
						            <?php
						            	if(function_exists('flone_add_to_wishlist_button')){
						            		echo flone_add_to_wishlist_button();
						            	}
						            ?>
						            <div class="pro-same-action pro-cart">
						                <?php woocommerce_template_loop_add_to_cart(); ?>
						            </div>
						            <div class="pro-same-action pro-compare">
						                <?php
						                	if(function_exists('flone_compare_button')){
						                		flone_compare_button();
						                	}
						                ?>
						            </div>
						            <div class="pro-same-action pro-quickview">
						                <a title="Quick View" href="#" data-toggle="modal" data-target="#exampleModal" data-quick-id="<?php echo esc_attr($product->get_id()) ?>" class="quickview"><i class="pe-7s-look"></i></a>
						            </div>
						        </div>
						    </div>
						    <div class="flone-product-content product-content-5 text-center">
						        <h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
						        <?php woocommerce_template_loop_price(); ?>
						    </div>
						</div>
					</div>

					<?php elseif( $settings['style'] == '4' ): ?>
						<div <?php wc_product_class('col-lg-4 col-md-6 col-sm-6 col-xs-12 product'); ?>>
							<div class="product-wrap-3 mb-20 scroll-zoom">
							    <div class="product-img">

							        <a href="<?php the_permalink(); ?>">
							            <?php
							            	echo woocommerce_get_product_thumbnail( $image_size );
							            ?>
							        </a>

							        <?php flone_show_product_loop_sale_flash(); ?>

							        <div class="product-content-3-wrap">
							            <div class="product-content-3">
							                <div class="product-title">
							                    <h3><a href="<?php the_permalink() ?>"><?php the_title(); ?></a></h3>
							                </div>
							                <div class="price-3">
							                   <?php woocommerce_template_loop_price(); ?>
							                </div>
							                <div class="product-action-3">
							                    <?php woocommerce_template_loop_add_to_cart(); ?>
							                    <a title="Quick View" href="#" data-toggle="modal" data-target="#exampleModal" data-quick-id="<?php echo esc_attr($product->get_id()) ?>" class="quickview"><i class="pe-7s-look"></i></a>

							                    <?php
							                    	if(function_exists('flone_compare_button')){
							                    		flone_compare_button();
							                    	}
							                    ?>
							                </div>
							            </div>
							        </div>
							    </div>
							</div>
						</div>

					<?php else : ?>

						<div <?php wc_product_class('col-lg-4 col-md-6 col-sm-6 col-xs-12 product'); ?>>
						    <div class="flone-product-wrap product-wrap mb-25 scroll-zoom">
						        <div class="product-img">
							        <a href="<?php the_permalink(); ?>">
							            <?php
							            	echo woocommerce_get_product_thumbnail( $image_size );

							            	if($secondary_img){
							            		echo wp_get_attachment_image( $secondary_img, $image_size, false, array('class' => 'hover-img') );
							            	}
							            ?>
							        </a>
							        <?php flone_show_product_loop_sale_flash(); ?>
						            <div class="flone-product-action product-action <?php if(class_exists('YITH_WCWL')){ echo esc_attr('has_wishlist'); } else { echo esc_attr('no_wishlist'); } ?>">
						                <?php
						                	if(function_exists('flone_add_to_wishlist_button')){
						                		echo flone_add_to_wishlist_button();
						                	}
						                ?>
						                <div class="pro-same-action pro-cart">
						                    <?php woocommerce_template_loop_add_to_cart(); ?>
						                </div>
						                <div class="pro-same-action pro-quickview">
						                    <a title="Quick View" href="#" data-toggle="modal" data-target="#exampleModal" data-quick-id="<?php echo esc_attr($product->get_id()) ?>" class="quickview"><i class="pe-7s-look"></i></a>
						                </div>
						            </div>
						        </div>
						        <div class="flone-product-content product-content text-center">
						            <a href="<?php the_permalink(); ?>">
						                <h2><?php the_title(); ?></h2>
						            </a>
						            <?php woocommerce_template_loop_price(); ?>
						        </div>
						    </div>
						</div>

					<?php endif;
			} wp_reset_postdata();
			echo '</div>';
		}
	?>

</div>

    <?php echo ob_get_clean();
}

} // end class

Plugin::instance()->widgets_manager->register_widget_type( new Flone_Products() );