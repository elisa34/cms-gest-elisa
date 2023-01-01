<?php

namespace SuperbThemesCustomizer;

use SuperbThemesCustomizer\Utils\CustomizerItem;
use SuperbThemesCustomizer\Utils\CustomizerType;

class CustomizerPanels
{
    const LAYOUT = 'superbthemes_customizer_panel_LAYOUT';
    const WOOCOMMERCE = 'superbthemes_customizer_panel_WOOCOMMERCE';
    const NAVIGATION = 'superbthemes_customizer_panel_NAVIGATION';
    const HEADER = 'superbthemes_customizer_panel_HEADER';

    const SHOULD_REFOCUS_TO_PANEL = array();

    public function __construct()
    {
        new CustomizerItem(self::LAYOUT, array(
            "type" => CustomizerType::PANEL,
            "label" =>  __('Layout', 'petite-stories'),
            "description" => __('Layout Customization', 'petite-stories')
        ));
        new CustomizerItem(self::WOOCOMMERCE, array(
            "type" => CustomizerType::PANEL,
            "label" =>  __('WooCommerce', 'petite-stories'),
            "description" => __('WooCommerce Customization', 'petite-stories')
        ));
        new CustomizerItem(self::NAVIGATION, array(
            "type" => CustomizerType::PANEL,
            "label" =>  __('Navigation', 'petite-stories'),
            "description" => __('Navigation Customization', 'petite-stories')
        ));
        new CustomizerItem(self::HEADER, array(
            "type" => CustomizerType::PANEL,
            "label" =>  __('Header', 'petite-stories'),
            "description" => __('Header Customization', 'petite-stories')
        ));
    }
}
