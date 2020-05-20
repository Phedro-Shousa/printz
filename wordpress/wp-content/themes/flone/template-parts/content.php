<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package flone
 */

$blog_columns = flone_get_option('blog_columns', 1);

// columns support
$lg_item    = floor(12 / $blog_columns);

$column_classes = array();
$column_classes[] = 'col-xs-12';
$column_classes[] = 'col-sm-12';
$column_classes[] = 'col-md-12';
$column_classes[] = 'col-lg-'. $lg_item;

$column_classes = implode(' ', $column_classes);

if(is_single()){
	$column_classes = 'col-12';
}
?>

<div class="<?php echo esc_attr($column_classes); ?>">
	<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

		<div class="blog-wrap-2 mb-30">

			<?php if(is_single()): ?>

			<?php the_title( '<h1 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h1>' ); ?>
            <div class="post-meta">
				
				<?php if(flone_get_option('single_show_author', '1')): ?>
	            	<?php flone_posted_by(); ?>
	            	<span class="post-separator">/</span>
	            <?php endif; ?>

	            <?php if(flone_get_option('single_show_date', '1') ): ?>
					<?php flone_posted_on(); ?>
	            	<span class="post-separator">/</span>
	            <?php endif; ?>

            	<?php if(flone_get_option('single_show_categories', '1')){
                	flone_posted_in();
                } ?>
            </div>

        	<?php endif; ?>

			<?php flone_post_thumbnail(); ?>

	        <div class="blog-content-2">


				<?php if( !is_single() ): ?>

				<?php the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' ); ?>
	            <div class="post-meta">

	            	<?php if(flone_get_option('show_author', '1')): ?>
		            	<?php flone_posted_by(); ?>
		            	<span class="post-separator">/</span>
	            	<?php endif; ?>
					
					<?php if(flone_get_option('show_date', '1') ): ?>
						<?php flone_posted_on(); ?>
		            	<span class="post-separator">/</span>
	            	<?php endif; ?>

	            	<?php if(flone_get_option('show_categories', '1')){
	                	flone_posted_in();
	                } ?>

	            </div>
	        	<?php endif; ?>
	           

				<div class="entry-content">

	           <?php if(is_search() || is_archive()):

	           		the_content( sprintf(
	           			wp_kses(
	           				/* translators: %s: Name of current post. Only visible to screen readers */
	           				__( 'Continue reading<span class="screen-reader-text"> "%s"</span>', 'flone' ),
	           				array(
	           					'span' => array(
	           						'class' => array(),
	           					),
	           				)
	           			),
	           			get_the_title()
	           		) );

	           		wp_link_pages( array(
						'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'flone' ),
						'after'  => '</div>',
					) );

	           		else:
	           	?><?php
					the_content( sprintf(
						wp_kses(
							/* translators: %s: Name of current post. Only visible to screen readers */
							__( 'Continue reading<span class="screen-reader-text"> "%s"</span>', 'flone' ),
							array(
								'span' => array(
									'class' => array(),
								),
							)
						),
						get_the_title()
					) );

					wp_link_pages( array(
						'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'flone' ),
						'after'  => '</div>',
					) );
					?>
				<?php endif; ?>

				</div><!-- .entry-content -->

				<?php if( is_single( ) ):
					$has_share = flone_get_option('single_show_social_share', '0');
					$tag_class = ( has_tag() ) ? ' has_tag' : ' no_tag';
					$comment_class = ( comments_open() || get_comments_number() ) ? ' has_comment' : ' no_comment';
					$admin_class = is_user_logged_in() ? ' ' : ' not_logged_in';
				?>
				<div class="entry-footer tag-share <?php echo esc_attr($has_share ? 'has_share' : ''); ?> <?php echo esc_attr( $tag_class . $comment_class . $admin_class ); ?>">
					<div class="entry-footer-left">

						<?php flone_comments_link(); ?>
						
						<?php if(flone_get_option('single_show_tags', '1') && has_tag( )): ?>
							<?php flone_posted_in_tags(); ?>
						<?php endif; ?>

						<?php
							edit_post_link(
								sprintf(
									wp_kses(
										/* translators: %s: Name of current post. Only visible to screen readers */
										__( 'Edit <span class="screen-reader-text">%s</span>', 'flone' ),
										array(
											'span' => array(
												'class' => array(),
											),
										)
									),
									get_the_title()
								),
								'<span class="edit-link">',
								'</span>'
							);
						?>
					</div>
                    <?php
	                    if(function_exists('flone_get_social_share_html') && flone_get_option('single_show_social_share', '0')){
	                    	echo flone_get_social_share_html();
	                    }
                    ?>
                </div>
            	<?php endif; ?>

	        </div>
	    </div>

	</article><!-- #post-<?php the_ID(); ?> -->
</div>
