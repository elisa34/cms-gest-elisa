<?php

namespace SuperbThemesCustomizer;

use SuperbThemesCustomizer\Utils\CustomizerItem;
use SuperbThemesCustomizer\Utils\CustomizerType;
use SuperbThemesCustomizer\CustomizerPanels;

class CustomizerSections
{
    const HEADER_METASLIDER = 'superbthemes_customizer_section_header_metaslider';
    const HEADER_DEFAULT = 'superbthemes_customizer_section_header_default';
    const NAVIGATION = 'superbthemes_customizer_section_navigation';
    const WIDGETS = 'superbthemes_customizer_section_widgets';
    const BLOG = 'superbthemes_customizer_section_blog';
    const SINGLE = 'superbthemes_customizer_section_single';
    const SIDEBAR = 'superbthemes_customizer_section_sidebar';
    const FOOTER = 'superbthemes_customizer_section_footer';
    const COPYRIGHT = 'superbthemes_customizer_section_copyright';
    const WOOCOMMERCE = 'superbthemes_customizer_section_woocommerce';
    const COLOR_SCHEME = 'superbthemes_customizer_section_color_scheme';

    public function __construct()
    {
        new CustomizerItem(self::COLOR_SCHEME, array(
            "type" => CustomizerType::SECTION,
            "label" =>  __('Colors', 'petite-stories'),
            "description" => __('Customize the color scheme of the theme.', 'petite-stories'),
            "parents" => array("")
        ));

        new CustomizerItem(self::NAVIGATION, array(
            "type" => CustomizerType::SECTION,
            "label" => __('Navigation', 'petite-stories'),
            "description" => __('Customize the navigation.', 'petite-stories'),
            "parents" => array(CustomizerPanels::LAYOUT)
        ));

        if (class_exists("MetaSliderPlugin") || class_exists("MetaSliderPro")) {
            new CustomizerItem(self::HEADER_METASLIDER, array(
                "type" => CustomizerType::SECTION,
                "label" => __('MetaSlider Header', 'petite-stories'),
                "description" => __('MetaSlider Header requires the MetaSlider plugin. Using the MetaSlider header will replace the default theme header.', 'petite-stories'),
                "parents" => array(CustomizerPanels::HEADER)
            ));
        }
        new CustomizerItem(self::HEADER_DEFAULT, array(
            "type" => CustomizerType::SECTION,
            "label" => __('Header', 'petite-stories'),
            "description" => __('Customize the default theme header. These settings do not apply if you\'re using the MetaSlider header.', 'petite-stories'),
            "parents" => array(CustomizerPanels::HEADER)
        ));
        new CustomizerItem(self::WIDGETS, array(
            "type" => CustomizerType::SECTION,
            "label" => __('Header Widgets', 'petite-stories'),
            "description" => __('Customize the header widgets..', 'petite-stories'),
            "parents" => array(CustomizerPanels::LAYOUT)
        ));
        new CustomizerItem(self::BLOG, array(
            "type" => CustomizerType::SECTION,
            "label" => __('Blog', 'petite-stories'),
            "description" => __('Customize the blog feed.', 'petite-stories'),
            "parents" => array(CustomizerPanels::LAYOUT)
        ));
        new CustomizerItem(self::SINGLE, array(
            "type" => CustomizerType::SECTION,
            "label" => __('Posts / Pages', 'petite-stories'),
            "description" => __('Customize Posts and Pages.', 'petite-stories'),
            "parents" => array(CustomizerPanels::LAYOUT)
        ));
        new CustomizerItem(self::SIDEBAR, array(
            "type" => CustomizerType::SECTION,
            "label" => __('Sidebar', 'petite-stories'),
            "description" => __('Customize the sidebar.', 'petite-stories'),
            "parents" => array(CustomizerPanels::LAYOUT)
        ));
        new CustomizerItem(self::FOOTER, array(
            "type" => CustomizerType::SECTION,
            "label" => __('Footer', 'petite-stories'),
            "description" => __('Footer description here', 'petite-stories'),
            "parents" => array(CustomizerPanels::LAYOUT)
        ));
        new CustomizerItem(self::COPYRIGHT, array(
            "type" => CustomizerType::SECTION,
            "label" =>  __('Copyright', 'petite-stories'),
            "description" => __('Customize the copyright text in the footer.', 'petite-stories'),
            "parents" => array("")
        ));
    }
}
