<?php

namespace SuperbThemesCustomizer\Modules\Navigation;

use SuperbThemesCustomizer\CustomizerControls;

class NavigationLayoutLarge
{
    public function __construct()
    {
        $this->Render();
    }

    public function Render()
    {
?>
        <nav id="primary-site-navigation" class="primary-menu main-navigation clearfix">
            <?php new NavigationMobile(); ?>
            <div class="top-nav-wrapper">
                <div class="content-wrap navigation-layout-large">
                    <div class="header-content-container navigation-layout-large">
                        <div class="header-content-author-container">
                            <?php if (false !== get_theme_mod(CustomizerControls::NAVIGATION_AUTHOR_IMAGE) && !empty(get_theme_mod(CustomizerControls::NAVIGATION_AUTHOR_IMAGE))) : ?>
                                <div class="header-author-container-img-wrapper" <?php echo 'style="background-image: url(' . esc_url(wp_get_attachment_image_url(get_theme_mod(CustomizerControls::NAVIGATION_AUTHOR_IMAGE))) . ')"'; ?>>
                                </div>
                            <?php endif; ?>
                            <div class="header-author-container-text-wrapper">
                                <span class="header-author-name"><?php echo esc_html(get_theme_mod(CustomizerControls::NAVIGATION_AUTHOR_NAME)); ?></span>
                                <span class="header-author-tagline"><?php echo esc_html(get_theme_mod(CustomizerControls::NAVIGATION_AUTHOR_TAGLINE)); ?></span>
                            </div>
                        </div>
                        <div class="logo-container navigation-layout-large">
                            <?php if (has_custom_logo()) : ?>
                                <?php the_custom_logo(); ?>
                            <?php endif; ?>
                            <a class="logofont site-title" href="<?php echo esc_url(home_url('/')); ?>" rel="home"><?php bloginfo('name'); ?></a>
                            <?php if (get_theme_mod('navigation_hide_tagline') == '') : ?>
                                <p class="logodescription site-description"><?php bloginfo('description'); ?></p>
                            <?php endif; ?>
                        </div>
                        <div class="header-content-some-container">
                            <?php
                            $some_text = get_theme_mod(CustomizerControls::NAVIGATION_RIGHTALIGNED_BUTTON_TEXT);
                            $some_link = get_theme_mod(CustomizerControls::NAVIGATION_RIGHTALIGNED_BUTTON_LINK);
                            $some_link = $some_link === false || empty($some_link) ? "#" : $some_link;
                            if ($some_text !== false && !empty($some_text)) :
                            ?>
                                <a href="<?php echo esc_url($some_link); ?>" target="_blank"><?php echo esc_html($some_text); ?></a>
                            <?php endif; ?>
                        </div>
                    </div>
                    <?php new NavigationMenu(); ?>
                </div>
            </div>
        </nav>
<?php
    }
}
