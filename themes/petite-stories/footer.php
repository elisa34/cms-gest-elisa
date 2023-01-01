<?php

/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Petite Stories
 */

?>


<footer id="colophon" class="site-footer clearfix">

	<div class="content-wrap">
		<?php if (is_active_sidebar('footerwidget-1')) : ?>
			<div class="site-footer-widget-area">
				<?php dynamic_sidebar('footerwidget-1'); ?>
			</div>
		<?php endif; ?>

	</div>

	<div class="site-info">
		&copy;<?php echo date('Y'); ?> <?php bloginfo('name'); ?>
		<span class="footer-info-right">
			<?php echo __(' | WordPress Theme by', 'petite-stories') ?> <a href="<?php echo esc_url('https://superbthemes.com/', 'petite-stories'); ?>"><?php echo __(' SuperbThemes', 'petite-stories') ?></a>
		</span>
	</div><!-- .site-info -->


</footer><!-- #colophon -->


<div id="smobile-menu" class="mobile-only"></div>
<div id="mobile-menu-overlay"></div>

<?php wp_footer(); ?>
</body>

</html>