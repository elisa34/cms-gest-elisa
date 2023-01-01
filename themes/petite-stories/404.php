<?php

use SuperbThemesCustomizer\CustomizerController;

/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package Petite Stories
 */

get_header(); ?>

<div id="content" class="site-content clearfix">
	<?php $petite_stories_container_class = !is_page_template('elementor_header_footer') ? 'content-wrap' : 'content-none'; ?>
	<div class="<?php echo esc_html($petite_stories_container_class); ?>">
		<div id="primary" class="featured-content content-area full-width-template add-blog-to-sidebar">
			<main id="main" class="fbox site-main">
				<section class="error-404 not-found bg-image-404" style="background-image:url('<?php echo esc_url( get_template_directory_uri() . "/src/images/404-bg.png"); ?>')">
					<header class="page-header">
						<h1 class="page-title error-404-headline"><?php esc_html_e('Ooops!', 'petite-stories'); ?></h1>
						<p class="error-404-description"><?php esc_html_e('It seems like this page is no longer here', 'petite-stories'); ?></p>
					</header><!-- .page-header -->

					<div class="page-content">
						<div class="fourofour-home">
							<a href="<?php echo  esc_url(home_url()); ?>"><?php esc_html_e('Go to homepage', 'petite-stories'); ?></a>
						</div>
					</div><!-- .page-content -->

				</section><!-- .error-404 -->
				<section class="error-404 try-new-posts">
					<h2 class="try-new-post-headline"><?php esc_html_e('... or try one of our popular posts', 'petite-stories'); ?></h2>
					<div class="all-blog-articles">
						<?php CustomizerController::MaybeGetMasonryColumnOutput(); ?>
						<?php
						$args = ["posts_per_page" => 6];
						$loop_query = new WP_Query($args);
						if ($loop_query->have_posts()) {
							while ($loop_query->have_posts()) {
								$loop_query->the_post();
								get_template_part('template-parts/content', get_post_format());
							}
						}
						?>
					</div>
				</section>
			</main><!-- #main -->
		</div><!-- #primary -->
	</div>
</div><!-- #content -->

<?php
get_footer();
