<?php
/**
 * The template for displaying all single posts.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package DHN
 */

get_header(); ?>

	<div id="primary" class="container">

		<?php if ( is_active_sidebar( 'above-content' ) ) { ?>
			<div class="row">
				<div class="twelve columns">
					<?php dynamic_sidebar( 'above-content' ); ?>
				</div>
			</div>
		<?php } ?>

		<div class="row">
			<div class="twelve columns">
				
			<?php
			while ( have_posts() ) : the_post();

				?>
					<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
						<header class="entry-header">

							<?php
								if ( is_single() ) {
									the_title( '<h2 class="entry-title">', '</h2>' );
								} else {
									the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
								}
							?>

						</header><!-- .entry-header -->

						<div class="entry-content">
							<?php
								if (is_archive()) {
									the_excerpt();
								}
								else {			
									the_content( sprintf(
										/* translators: %s: Name of current post. */
										wp_kses( __( 'Continue reading %s <span class="meta-nav">&rarr;</span>', 'dhn' ), array( 'span' => array( 'class' => array() ) ) ),
										the_title( '<span class="screen-reader-text">"', '"</span>', false )
									) );
								}

								wp_link_pages( array(
									'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'dhn' ),
									'after'  => '</div>',
								) );
							?>
						</div>
					</article>

					<div class="single-box">
						<div class="row">
							<div class="eight columns">
								<h4>Department</h4>
								<p>
									<?php
									$institutionId = get_post_meta(get_the_ID(), 'institution', true);

									echo '<a class="more-link" href="'.get_permalink($institutionId).'">'.get_the_title($institutionId).'</a>';
									?>
								</p>
								<h4>Project members</h4>
								<p>
									<?php
									echo get_post_meta(get_the_ID(), 'project_members', true);
									?>
								</p>
							</div>
							<div class="four columns">
								<h4>Project website</h4>
								<a class="more-link" target="_blank" href="<?php echo get_post_meta(get_the_ID(), 'link', true); ?>"><?php echo get_post_meta(get_the_ID(), 'link', true); ?></a>
							</div>
						</div>
					</div>
				<?php

			endwhile; // End of the loop.
			?>

			</div>
		</div>
	</div>

<?php
get_sidebar();
get_footer();
