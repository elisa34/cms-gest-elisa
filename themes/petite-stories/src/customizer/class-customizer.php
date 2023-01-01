<?php

namespace SuperbThemesCustomizer;

use SuperbThemesCustomizer\CustomizerPanels;
use SuperbThemesCustomizer\CustomizerSections;
use SuperbThemesCustomizer\CustomizerControls;

use SuperbThemesCustomizer\Utils\RefocusButtonControl;
use SuperbThemesCustomizer\Utils\CustomizerRefocusButton;

class CustomizerController
{
	private static $CustomizerObject = false;
	private static $RefocusButtons = array();

	public function __construct()
	{
		add_action('customize_register', array($this, 'superbthemes_customizer_customize_register_init'));
		add_action('customize_controls_print_styles', array($this, 'superbthemes_customizer_customizer_scripts'));
		add_action('customize_controls_print_footer_scripts', array($this, 'superbthemes_customizer_customizer_footer_scripts'));
		add_action('customize_preview_init', array($this, 'superbthemes_customizer_preview_scripts'));
		add_action('customize_controls_enqueue_scripts', array($this, 'superbthemes_customizer_scripts'));
		add_action('wp_head', array($this, 'superbthemes_customizer_css_final_output'));
		add_action('wp_enqueue_scripts', array($this, 'superbthemes_customizer_js_final_output'), 0);
	}

	public function superbthemes_customizer_customize_register_init($wp_customize)
	{
		self::$CustomizerObject = $wp_customize;
		new CustomizerPanels();
		new CustomizerSections();
		new CustomizerControls();

		/* Overwrite values */
		$this->OverwriteValues();
		/* */

		self::$CustomizerObject = false;
	}


	private function OverwriteValues()
	{
		$wp_customize = self::$CustomizerObject;
		if (isset($wp_customize->selective_refresh)) {
			$wp_customize->selective_refresh->add_partial('blogname', array(
				'selector'        => '.logofont',
				'render_callback' => array($this, 'superbthemes_customizer_customize_partial_blogname'),
			));
			$wp_customize->selective_refresh->add_partial('blogdescription', array(
				'selector'        => '.logodescription',
				'render_callback' => array($this, 'superbthemes_customizer_customize_partial_blogdescription'),
			));
		}

		$wp_customize->get_control('custom_logo')->priority = 0;
		$wp_customize->get_section('background_image')->panel = 'petite-stories-site-bg-panel';
		$wp_customize->get_control('background_color')->section = 'background_image';

		$wp_customize->get_control('header_textcolor')->section = CustomizerSections::COLOR_SCHEME;
		$wp_customize->get_control('header_textcolor')->label = __('Logo Text Color', 'petite-stories');
		$wp_customize->get_control('header_textcolor')->description = __('Sets the text colors for the logo.', 'petite-stories');
		$wp_customize->get_control('header_textcolor')->priority = 99;

		$wp_customize->get_control('header_image')->section = CustomizerPanels::HEADER . CustomizerSections::HEADER_DEFAULT;
		$wp_customize->get_section(CustomizerPanels::HEADER . CustomizerSections::HEADER_DEFAULT)->title = __('Default Header', 'petite-stories');
	}

	public function superbthemes_customizer_preview_scripts()
	{
		wp_enqueue_script('petite-stories-customizer-preview', get_template_directory_uri() . '/js/customizer-preview.js', array('customize-preview'), wp_get_theme()->Version, true);
		wp_localize_script('petite-stories-customizer-preview', 'petite_stories_customizer_preview_variables', array(
			'COLOR_VARIABLES' => array(
				CustomizerControls::COLOR_SCHEME_FOREGROUND,
				CustomizerControls::COLOR_SCHEME_BACKGROUND,
				CustomizerControls::COLOR_SCHEME_LIGHT_1,
				CustomizerControls::COLOR_SCHEME_LIGHT_2,
				CustomizerControls::COLOR_SCHEME_LIGHT_3,
				CustomizerControls::COLOR_SCHEME_DARK_1,
				CustomizerControls::COLOR_SCHEME_DARK_2,
				CustomizerControls::COLOR_SCHEME_DARK_3
			),
			'COLOR_VARIABLES_VARIANTS' => array(
				array('REGULAR' => CustomizerControls::COLOR_SCHEME_PRIMARY, 'DARK' => CustomizerControls::COLOR_SCHEME_PRIMARY_DARK),
				array('REGULAR' => CustomizerControls::COLOR_SCHEME_SECONDARY, 'DARK' => CustomizerControls::COLOR_SCHEME_SECONDARY_DARK),
				array('REGULAR' => CustomizerControls::COLOR_SCHEME_TERTIARY, 'DARK' => CustomizerControls::COLOR_SCHEME_TERTIARY_DARK),
			)
		));
	}

	public function superbthemes_customizer_scripts()
	{
		wp_enqueue_script('petite-stories-customizer', get_template_directory_uri() . '/js/customizer.js', array('customize-preview'), wp_get_theme()->Version, true);
		wp_localize_script('petite-stories-customizer', 'petite_stories_customizer_variables', array(
			'COLOR_VARIABLES_VARIANTS' => array(
				array('REGULAR' => CustomizerControls::COLOR_SCHEME_PRIMARY, 'DARK' => CustomizerControls::COLOR_SCHEME_PRIMARY_DARK),
				array('REGULAR' => CustomizerControls::COLOR_SCHEME_SECONDARY, 'DARK' => CustomizerControls::COLOR_SCHEME_SECONDARY_DARK),
				array('REGULAR' => CustomizerControls::COLOR_SCHEME_TERTIARY, 'DARK' => CustomizerControls::COLOR_SCHEME_TERTIARY_DARK),
			)
		));
	}

	public function superbthemes_customizer_customizer_scripts()
	{
		wp_enqueue_style('petite-stories-customizer-css', get_template_directory_uri() . '/css/customizer.css', array(), wp_get_theme()->Version);
	}

	public function superbthemes_customizer_customizer_footer_scripts()
	{
		echo '<script id="superbthemes-customizer-refocus-buttons">';
		foreach (self::$RefocusButtons as $RefocusButton) {
			echo "
			wp.customize.control( '" . esc_attr($RefocusButton->GetWrapperId()) . "', function( control ) {
				control.container.find( '.superbthemes-customizer-refocus-button' ).on( 'click', function() {
					wp.customize." . esc_html($RefocusButton->GetType()) . "( '" . esc_attr($RefocusButton->GetRefocusId()) . "' ).focus();
					} );
					} );
					";
		}
		echo '</script>';
	}

	public static function AddRefocusButtonToScripts($button)
	{
		if ($button instanceof CustomizerRefocusButton) {
			self::$RefocusButtons[] = $button;
		}
	}

	public static function GetCustomizerObject()
	{
		return self::$CustomizerObject;
	}

	/**
	 * Render the site title for the selective refresh partial.
	 *
	 * @return void
	 */
	public function superbthemes_customizer_customize_partial_blogname()
	{
		bloginfo('name');
	}

	/**
	 * Render the site tagline for the selective refresh partial.
	 *
	 * @return void
	 */
	public function superbthemes_customizer_customize_partial_blogdescription()
	{
		bloginfo('description');
	}

	public function superbthemes_customizer_js_final_output()
	{
		if (
			CustomizerControls::GetSelectedOrDefault(CustomizerControls::BLOGFEED_COLUMNS_STYLE) === CustomizerControls::BLOGFEED_TWO_COLUMNS_MASONRY ||
			CustomizerControls::GetSelectedOrDefault(CustomizerControls::BLOGFEED_COLUMNS_STYLE) === CustomizerControls::BLOGFEED_THREE_COLUMNS_MASONRY
		) {
			wp_enqueue_script('petite-stories-colcade-masonry', get_template_directory_uri() . '/js/lib/colcade.js', array('jquery'), wp_get_theme()->Version, false);
			wp_enqueue_script('petite-stories-colcade-masonry-init', get_template_directory_uri() . '/js/colcade-init.js', false, wp_get_theme()->Version, true);
		}
	}

	public function superbthemes_customizer_css_final_output()
	{ ?>
		<style type="text/css">
			/** BACKGROUND BOX FOR NAVIGATION */
			<?php if (
				(is_home() && CustomizerControls::GetSelectedOrDefault(CustomizerControls::BLOGFEED_FEATURED_IMAGE_STYLE) != CustomizerControls::BLOGFEED_FEATURED_IMAGE_CHOICE_FULL_IMAGE && self::superbthemes_customizer_blog_first_row_has_thumbnail())
				|| (is_single() && CustomizerControls::GetSelectedOrDefault(CustomizerControls::SINGLE_FEATURED_IMAGE_STYLE) != CustomizerControls::SINGLE_FEATURED_IMAGE_CHOICE_FULL_IMAGE && has_post_thumbnail())
			) : ?>body.blog header.site-header::before,
			body.post-template-default.single.single-post.single-format-standard header.site-header::before {
				content: "";
				height: 300px;
				position: absolute;
				top: 100%;
				left: 0;
				width: 100%;
				background-color: var(--petite-stories-secondary);
				z-index: -99;
			}

			@media screen and (max-width: 700px) {

				body.blog header.site-header::before,
				body.post-template-default.single.single-post.single-format-standard header.site-header::before {
					height: 140px;
					margin-top: -1px;
				}
			}

			<?php if (is_home()) : ?>@media screen and (min-width: 993px) {
				.featured-content {
					margin-right: 2%;
				}

				.featured-sidebar {
					padding: 10px 20px 20px 20px;
					background: var(<?php echo esc_html(CustomizerControls::COLOR_SCHEME_BACKGROUND); ?>);
					border-radius: 8px;
				}
			}

			<?php endif; ?><?php endif; ?>
			/** */

			<?php if (CustomizerControls::GetSelectedOrDefault(CustomizerControls::NAVIGATION_LAYOUT_STYLE) === CustomizerControls::NAVIGATION_LAYOUT_CHOICE_LARGE) : ?>.content-wrap.navigation-layout-large {
				width: 1480px;
				padding: 0;
			}

			.header-content-container.navigation-layout-large {
				padding: 25px 0 20px;
			}

			.header-content-author-container,
			.header-content-some-container {
				display: flex;
				align-items: center;
				min-width: 300px;
				max-width: 300px;
			}

			.header-content-some-container {
				justify-content: right;
			}

			.header-content-some-container a {
				text-align: center;
			}

			.logo-container.navigation-layout-large {
				text-align: center;
				width: 100%;
				max-width: calc(100% - 600px);
				padding: 0 10px;
			}

			.header-author-container-img-wrapper {
				min-width: 60px;
				min-height: 60px;
				max-width: 60px;
				max-height: 60px;
				margin-right: 10px;
				border-radius: 50%;
				border-style: solid;
				border-width: 2px;
				border-color: var(--petite-stories-primary);
				overflow: hidden;
				background-size: contain;
				background-repeat: no-repeat;
				background-position: center;
			}

			.header-author-container-text-wrapper .header-author-name {
				display: block;
				font-size: 22px;
				font-weight: 500;
				font-family: 'Pacifico', lato, helvetica;
				color: var(--petite-stories-dark-2);
			}

			.header-author-container-text-wrapper .header-author-tagline {
				margin: 0;
				font-weight: 500;
				font-size: 14px;
				display: block;
				color: var(--petite-stories-light-3);
				font-style: italic;
			}

			.logo-container a.custom-logo-link {
				margin-top: 0px;
			}

			.navigation-layout-large .site-title {
				font-size: 40px;
				margin: 0 0 15px 0;
			}

			p.logodescription {
				margin-top: 0;
			}

			.header-content-some-container a {
				background-color: var(--petite-stories-primary);
				border-radius: 25px;
				padding: 15px 25px;
				font-family: 'Poppins';
				font-weight: 600;
				font-size: 13px;
				text-decoration: none;
				display: inline-block;
				-webkit-transition: 0.2s all;
				-o-transition: 0.2s all;
				transition: 0.2s all;
			}

			.header-content-some-container a:hover {
				background-color: var(--petite-stories-primary-dark);
			}

			.navigation-layout-large .center-main-menu {
				max-width: 100%;
			}

			.navigation-layout-large .center-main-menu .pmenu {
				text-align: center;
				float: none;
			}

			.navigation-layout-large .center-main-menu .wc-nav-content {
				justify-content: center;
			}


			<?php endif; ?>.custom-logo-link img {
				width: auto;
				max-height: <?php echo absint(CustomizerControls::GetSelectedOrDefault(CustomizerControls::SITE_IDENTITY_LOGO_HEIGHT)); ?>px;
			}

			<?php if (CustomizerControls::GetSelectedOrDefault(CustomizerControls::BLOGFEED_COLUMNS_STYLE) === CustomizerControls::BLOGFEED_ONE_COLUMNS) : ?>.all-blog-articles {
				display: block;
			}

			.add-blog-to-sidebar .all-blog-articles .blogposts-list {
				width: 100%;
				max-width: 100%;
				flex: 100%;
			}

			<?php endif; ?><?php if (CustomizerControls::GetSelectedOrDefault(CustomizerControls::BLOGFEED_COLUMNS_STYLE) === CustomizerControls::BLOGFEED_TWO_COLUMNS) : ?>.add-blog-to-sidebar .all-blog-articles .blogposts-list .entry-header {
				display: -webkit-box;
				display: -ms-flexbox;
				display: flex;
				-ms-flex-wrap: wrap;
				flex-wrap: wrap;
				width: 100%;
			}

			.add-blog-to-sidebar .all-blog-articles .blogposts-list .entry-header .entry-meta {
				-webkit-box-ordinal-group: 0;
				-ms-flex-order: -1;
				order: -1;
				margin: -3px 0 3px 0;
			}

			.add-blog-to-sidebar .all-blog-articles .blogposts-list p {
				margin: 0;
			}

			<?php endif; ?><?php if (CustomizerControls::GetSelectedOrDefault(CustomizerControls::BLOGFEED_COLUMNS_STYLE) === CustomizerControls::BLOGFEED_THREE_COLUMNS) : ?>.add-blog-to-sidebar .all-blog-articles .blogposts-list {
				width: 31%;
				max-width: 31%;
				-webkit-box-flex: 31%;
				-ms-flex: 31%;
				flex: 31%;
				margin-bottom: 30px;
			}

			.add-blog-to-sidebar .all-blog-articles .blogposts-list .entry-header {
				display: -webkit-box;
				display: -ms-flexbox;
				display: flex;
				-ms-flex-wrap: wrap;
				flex-wrap: wrap;
				width: 100%;
			}

			.add-blog-to-sidebar .all-blog-articles .blogposts-list .entry-header .entry-meta {
				-webkit-box-ordinal-group: 0;
				-ms-flex-order: -1;
				order: -1;
				margin: 0;
				margin-top: 5px;
			}

			.add-blog-to-sidebar .all-blog-articles .blogposts-list p {
				margin: 0;
			}

			@media (max-width: 1024px) {
				.add-blog-to-sidebar .all-blog-articles .blogposts-list {
					width: 48%;
					max-width: 48%;
					-webkit-box-flex: 48%;
					-ms-flex: 48%;
					flex: 48%;
				}

				.add-blog-to-sidebar .all-blog-articles .blogposts-list h2 {
					font-size: 26px;
				}
			}

			@media (max-width: 600px) {
				.add-blog-to-sidebar .all-blog-articles .blogposts-list {
					width: 100%;
					max-width: 100%;
					-webkit-box-flex: 100%;
					-ms-flex: 100%;
					flex: 100%;
				}
			}

			<?php endif; ?><?php if (CustomizerControls::GetSelectedOrDefault(CustomizerControls::BLOGFEED_GRID_BG_BG) == '1') : ?>.add-blog-to-sidebar .all-blog-articles .blogposts-list {
				background: var(--petite-stories-secondary);
				border-radius: 8px;
			}

			.add-blog-to-sidebar .all-blog-articles .blogposts-list .content-wrapper {
				padding: 20px 10px 30px;
			}

			<?php endif; ?><?php if (
								CustomizerControls::GetSelectedOrDefault(CustomizerControls::BLOGFEED_COLUMNS_STYLE) === CustomizerControls::BLOGFEED_TWO_COLUMNS_MASONRY ||
								CustomizerControls::GetSelectedOrDefault(CustomizerControls::BLOGFEED_COLUMNS_STYLE) === CustomizerControls::BLOGFEED_THREE_COLUMNS_MASONRY
							) : ?>.add-blog-to-sidebar .all-blog-articles .blogposts-list {
				width: 100%;
				max-width: 100%;
			}

			.petite-stories-colcade-column {
				-webkit-box-flex: 1;
				-webkit-flex-grow: 1;
				-ms-flex-positive: 1;
				flex-grow: 1;
				margin-right: 2%;
			}

			.petite-stories-colcade-column.petite-stories-colcade-last {
				margin-right: 0;
			}

			<?php endif; ?><?php if (CustomizerControls::GetSelectedOrDefault(CustomizerControls::BLOGFEED_COLUMNS_STYLE) === CustomizerControls::BLOGFEED_TWO_COLUMNS_MASONRY) : ?>.petite-stories-colcade-column {
				max-width: 48%;
			}

			@media screen and (max-width: 800px) {
				.petite-stories-colcade-column {
					max-width: 100%;
				}

				.petite-stories-colcade-column:not(.petite-stories-colcade-first) {
					display: none !important;
				}

				.petite-stories-colcade-column.petite-stories-colcade-first {
					display: block !important;
				}
			}

			<?php endif; ?><?php if (CustomizerControls::GetSelectedOrDefault(CustomizerControls::BLOGFEED_COLUMNS_STYLE) === CustomizerControls::BLOGFEED_THREE_COLUMNS_MASONRY) : ?>.petite-stories-colcade-column {
				max-width: 31%;
			}

			@media screen and (max-width: 1024px) {
				.petite-stories-colcade-column {
					max-width: 48%;
				}

				.petite-stories-colcade-column.petite-stories-colcade-last {
					display: none;
				}
			}

			@media screen and (max-width: 600px) {
				.petite-stories-colcade-column {
					max-width: 100%;
				}

				.petite-stories-colcade-column:not(.petite-stories-colcade-first) {
					display: none !important;
				}

				.petite-stories-colcade-column.petite-stories-colcade-first {
					display: block !important;
				}
			}

			<?php endif; ?><?php if (CustomizerControls::GetSelectedOrDefault(CustomizerControls::BLOGFEED_FEATURED_IMAGE_STYLE) == CustomizerControls::BLOGFEED_FEATURED_IMAGE_CHOICE_COVER_IMAGE) : ?>.blogposts-list .featured-thumbnail {
				border-radius: 8px;
				height: 500px;
				background-size: cover;
				background-position: center;
			}

			.related-posts-posts .blogposts-list .featured-thumbnail {
				height: 300px;
			}

			<?php endif; ?><?php if (CustomizerControls::GetSelectedOrDefault(CustomizerControls::BLOGFEED_FEATURED_IMAGE_STYLE) == CustomizerControls::BLOGFEED_FEATURED_IMAGE_CHOICE_FULL_IMAGE_COVER_BLUR) : ?>.blogposts-list .featured-thumbnail {
				border-radius: 8px;
				height: 500px;
				display: flex;
				align-items: center;
				justify-content: center;
				overflow: hidden;
			}

			.related-posts-posts .blogposts-list .featured-thumbnail {
				height: 300px;
			}

			.blogposts-list .featured-thumbnail img {
				z-index: 1;
				border-radius: 0;
				width: auto;
				height: auto;
				max-height: 100%;
			}

			.blogposts-list .featured-thumbnail .featured-img-category {
				z-index: 2;
			}

			.blogposts-list .featured-img-bg-blur {
				border-radius: 8px;
				width: 100%;
				height: 100%;
				position: absolute;
				top: 0;
				left: 0;
				background-size: cover;
				background-position: center;
				filter: blur(5px);
				opacity: .5;
			}

			<?php endif; ?><?php if (CustomizerControls::GetSelectedOrDefault(CustomizerControls::SINGLE_FEATURED_IMAGE_STYLE) == CustomizerControls::SINGLE_FEATURED_IMAGE_CHOICE_COVER_IMAGE) : ?>.featured-thumbnail-cropped {
				min-height: 460px;
			}

			@media screen and (max-width: 1024px) {
				.featured-thumbnail-cropped {
					min-height: 300px;
				}
			}

			<?php endif; ?><?php if (CustomizerControls::GetSelectedOrDefault(CustomizerControls::SINGLE_FEATURED_IMAGE_STYLE) == CustomizerControls::SINGLE_FEATURED_IMAGE_CHOICE_FULL_IMAGE_COVER_BLUR) : ?>.featured-thumbnail-cropped {
				position: relative;
				border-radius: 8px;
				min-height: 460px;
				display: flex;
				align-items: center;
				justify-content: center;
				overflow: hidden;
			}

			@media screen and (max-width: 1024px) {
				.featured-thumbnail-cropped {
					min-height: 300px;
				}
			}

			.featured-thumbnail-cropped img {
				width: auto;
				height: auto;
				max-height: 100%;
			}

			.featured-thumbnail-cropped .featured-img-bg-blur {
				border-radius: 8px;
				width: 100%;
				height: 100%;
				position: absolute;
				top: 0;
				left: 0;
				background-size: cover;
				background-position: center;
				filter: blur(5px);
				opacity: .5;
			}

			.featured-thumbnail-cropped img {
				z-index: 1;
			}

			<?php endif; ?>

			/** COLOR SCHEME **/
			:root {
				<?php echo esc_html(CustomizerControls::COLOR_SCHEME_PRIMARY); ?>: <?php echo esc_html(CustomizerControls::GetSelectedOrDefault(CustomizerControls::COLOR_SCHEME_PRIMARY)); ?>;
				<?php echo esc_html(CustomizerControls::COLOR_SCHEME_PRIMARY_DARK); ?>: <?php echo esc_html(CustomizerControls::GetSelectedOrDefault(CustomizerControls::COLOR_SCHEME_PRIMARY_DARK)); ?>;
				<?php echo esc_html(CustomizerControls::COLOR_SCHEME_SECONDARY); ?>: <?php echo esc_html(CustomizerControls::GetSelectedOrDefault(CustomizerControls::COLOR_SCHEME_SECONDARY)); ?>;
				<?php echo esc_html(CustomizerControls::COLOR_SCHEME_SECONDARY_DARK); ?>: <?php echo esc_html(CustomizerControls::GetSelectedOrDefault(CustomizerControls::COLOR_SCHEME_SECONDARY_DARK)); ?>;
				<?php echo esc_html(CustomizerControls::COLOR_SCHEME_TERTIARY); ?>: <?php echo esc_html(CustomizerControls::GetSelectedOrDefault(CustomizerControls::COLOR_SCHEME_TERTIARY)); ?>;
				<?php echo esc_html(CustomizerControls::COLOR_SCHEME_TERTIARY_DARK); ?>: <?php echo esc_html(CustomizerControls::GetSelectedOrDefault(CustomizerControls::COLOR_SCHEME_TERTIARY_DARK)); ?>;
				<?php echo esc_html(CustomizerControls::COLOR_SCHEME_FOREGROUND); ?>: <?php echo esc_html(CustomizerControls::GetSelectedOrDefault(CustomizerControls::COLOR_SCHEME_FOREGROUND)); ?>;
				<?php echo esc_html(CustomizerControls::COLOR_SCHEME_BACKGROUND); ?>: <?php echo esc_html(CustomizerControls::GetSelectedOrDefault(CustomizerControls::COLOR_SCHEME_BACKGROUND)); ?>;
				<?php echo esc_html(CustomizerControls::COLOR_SCHEME_LIGHT_1); ?>: <?php echo esc_html(CustomizerControls::GetSelectedOrDefault(CustomizerControls::COLOR_SCHEME_LIGHT_1)); ?>;
				<?php echo esc_html(CustomizerControls::COLOR_SCHEME_LIGHT_2); ?>: <?php echo esc_html(CustomizerControls::GetSelectedOrDefault(CustomizerControls::COLOR_SCHEME_LIGHT_2)); ?>;
				<?php echo esc_html(CustomizerControls::COLOR_SCHEME_LIGHT_3); ?>: <?php echo esc_html(CustomizerControls::GetSelectedOrDefault(CustomizerControls::COLOR_SCHEME_LIGHT_3)); ?>;
				<?php echo esc_html(CustomizerControls::COLOR_SCHEME_DARK_1); ?>: <?php echo esc_html(CustomizerControls::GetSelectedOrDefault(CustomizerControls::COLOR_SCHEME_DARK_1)); ?>;
				<?php echo esc_html(CustomizerControls::COLOR_SCHEME_DARK_2); ?>: <?php echo esc_html(CustomizerControls::GetSelectedOrDefault(CustomizerControls::COLOR_SCHEME_DARK_2)); ?>;
				<?php echo esc_html(CustomizerControls::COLOR_SCHEME_DARK_3); ?>: <?php echo esc_html(CustomizerControls::GetSelectedOrDefault(CustomizerControls::COLOR_SCHEME_DARK_3)); ?>;
			}

			/** COLOR SCHEME **/
		</style>
<?php
	}


	public function superbthemes_customizer_blog_first_row_has_thumbnail()
	{
		/* ** Only Display Navigation::before BG Color if First Row Has Thumbnail ** */
		global $wp_query;
		if (have_posts()) {
			$petite_stories_has_first_row_image = false;
			$petite_stories_has_first_row_current_idx = 0;
			switch (CustomizerControls::GetSelectedOrDefault(CustomizerControls::BLOGFEED_COLUMNS_STYLE)) {
				case CustomizerControls::BLOGFEED_ONE_COLUMNS:
					$petite_stories_has_first_row_idx_max = 1;
					break;
				case CustomizerControls::BLOGFEED_TWO_COLUMNS:
					$petite_stories_has_first_row_idx_max = 2;
					break;
				case CustomizerControls::BLOGFEED_THREE_COLUMNS:
				default:
					$petite_stories_has_first_row_idx_max = 3;
					break;
			}
			foreach ($wp_query->posts as $petite_stories_current_post_in_loop) {
				if ($petite_stories_has_first_row_current_idx >= $petite_stories_has_first_row_idx_max) {
					break;
				}
				$this_has_image = has_post_thumbnail($petite_stories_current_post_in_loop->ID);
				if ($this_has_image) {
					$petite_stories_has_first_row_image = true;
					break;
				}
				$petite_stories_has_first_row_current_idx++;
			}

			return $petite_stories_has_first_row_image;
		}
		/* **************************************************************************************** */
	}

	public static function MaybeGetMasonryColumnOutput()
	{
		$selected_blog_style = CustomizerControls::GetSelectedOrDefault(CustomizerControls::BLOGFEED_COLUMNS_STYLE);
		if (
			$selected_blog_style === CustomizerControls::BLOGFEED_TWO_COLUMNS_MASONRY ||
			$selected_blog_style === CustomizerControls::BLOGFEED_THREE_COLUMNS_MASONRY
		) {
			$col_amount = $selected_blog_style === CustomizerControls::BLOGFEED_TWO_COLUMNS_MASONRY ? 2 : 3;
			for ($i = 1; $i <= $col_amount; $i++) {
				echo '<div class="petite-stories-colcade-column' . ($i === $col_amount ? ' petite-stories-colcade-last' : ($i === 1 ? ' petite-stories-colcade-first' : '')) . '"></div>';
			}
		}
	}
}
