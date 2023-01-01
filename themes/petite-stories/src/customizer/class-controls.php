<?php

namespace SuperbThemesCustomizer;

use SuperbThemesCustomizer\Utils\CustomizerItem;
use SuperbThemesCustomizer\Utils\CustomizerType;
use SuperbThemesCustomizer\CustomizerPanels;
use SuperbThemesCustomizer\CustomizerSections;

class CustomizerControls
{
    const COLOR_SCHEME_FOREGROUND = '--petite-stories-foreground';
    const COLOR_SCHEME_BACKGROUND = '--petite-stories-background';
    const COLOR_SCHEME_PRIMARY = '--petite-stories-primary';
    const COLOR_SCHEME_PRIMARY_DARK = '--petite-stories-primary-dark';
    const COLOR_SCHEME_SECONDARY = '--petite-stories-secondary';
    const COLOR_SCHEME_SECONDARY_DARK = '--petite-stories-secondary-dark';
    const COLOR_SCHEME_TERTIARY = '--petite-stories-tertiary';
    const COLOR_SCHEME_TERTIARY_DARK = '--petite-stories-tertiary-dark';
    const COLOR_SCHEME_LIGHT_1 = '--petite-stories-light-1';
    const COLOR_SCHEME_LIGHT_2 = '--petite-stories-light-2';
    const COLOR_SCHEME_LIGHT_3 = '--petite-stories-light-3';
    const COLOR_SCHEME_DARK_1 = '--petite-stories-dark-1';
    const COLOR_SCHEME_DARK_2 = '--petite-stories-dark-2';
    const COLOR_SCHEME_DARK_3 = '--petite-stories-dark-3';

    const HEADER_METASLIDER_SHORTCODE = 'header_metaslider_overwrite';

    const HEADER_TITLE = 'header_img_text';
    const HEADER_TAGLINE = 'header_img_text_tagline';
    const HEADER_BUTTON_TEXT = 'header_img_button_text';
    const HEADER_BUTTON_LINK = 'header_img_button_link';

    const SITE_IDENTITY_LOGO_HEIGHT = 'navigation_logo_height';
    const SITE_IDENTITY_HIDE_TAGLINE = 'navigation_hide_tagline';

    const NAVIGATION_LAYOUT_STYLE = 'navigation_layout_style';
    const NAVIGATION_LAYOUT_CHOICE_SMALL = 'navigation_layout_style_choice_small';
    const NAVIGATION_LAYOUT_CHOICE_LARGE = 'navigation_layout_style_choice_large';
    const NAVIGATION_AUTHOR_IMAGE = 'navigation_large_author_image';
    const NAVIGATION_AUTHOR_NAME = 'navigation_large_author_name';
    const NAVIGATION_AUTHOR_TAGLINE = 'navigation_large_author_tagline';
    const NAVIGATION_RIGHTALIGNED_BUTTON_TEXT = 'navigation_large_rightalignedbutton_text';
    const NAVIGATION_RIGHTALIGNED_BUTTON_LINK = 'navigation_large_rightalignedbutton_link';

    ////
    const BLOGFEED_COLUMNS_STYLE = 'blogfeed_columns_style';
    //
    const BLOGFEED_ONE_COLUMNS = 'blogfeed_onecolumn';
    const BLOGFEED_TWO_COLUMNS = 'blogfeed_twocolumn';
    const BLOGFEED_THREE_COLUMNS = 'blogfeed_three_columns';
    const BLOGFEED_TWO_COLUMNS_MASONRY = 'blogfeed_twocolumn_masonry';
    const BLOGFEED_THREE_COLUMNS_MASONRY = 'blogfeed_three_colums_masonry';
    /////
    const BLOGFEED_GRID_BG_BG = 'BLOGFEED_GRID_BG_BG';
    /////
    const BLOGFEED_SHOW_READMORE_BUTTON = 'blogfeed_show_readmore_button';
    ////
    const BLOGFEED_FEATURED_IMAGE_STYLE = 'blogfeed_featured_image_style';
    //
    const BLOGFEED_FEATURED_IMAGE_CHOICE_FULL_IMAGE = 'blogfeed_featured_image_style_fullimage';
    const BLOGFEED_FEATURED_IMAGE_CHOICE_COVER_IMAGE = 'blogfeed_featured_image_style_cover';
    const BLOGFEED_FEATURED_IMAGE_CHOICE_FULL_IMAGE_COVER_BLUR = 'blogfeed_featured_image_style_coverblur';
    ////
    const BLOGFEED_FEATURED_IMAGE_PLACEHOLDER = 'blogfeed_featured_image_placeholder';

    ////
    const SINGLE_FEATURED_IMAGE_STYLE = 'SINGLE_featured_image_style';
    //
    const SINGLE_FEATURED_IMAGE_CHOICE_FULL_IMAGE = 'SINGLE_featured_image_style_fullimage';
    const SINGLE_FEATURED_IMAGE_CHOICE_COVER_IMAGE = 'SINGLE_featured_image_style_cover';
    const SINGLE_FEATURED_IMAGE_CHOICE_FULL_IMAGE_COVER_BLUR = 'SINGLE_featured_image_style_coverblur';
    ////
    const SINGLE_HIDE_RELATED_POSTS = 'postpage_show_hide_relatedposts';


    private static $CONTROL_DEFAULTS = array(
        self::SITE_IDENTITY_LOGO_HEIGHT => 65,
        self::BLOGFEED_COLUMNS_STYLE => self::BLOGFEED_THREE_COLUMNS_MASONRY,
        self::BLOGFEED_GRID_BG_BG => "",
        self::BLOGFEED_FEATURED_IMAGE_STYLE => self::BLOGFEED_FEATURED_IMAGE_CHOICE_FULL_IMAGE_COVER_BLUR,
        self::SINGLE_FEATURED_IMAGE_STYLE => self::SINGLE_FEATURED_IMAGE_CHOICE_FULL_IMAGE_COVER_BLUR,
        self::NAVIGATION_LAYOUT_STYLE => self::NAVIGATION_LAYOUT_CHOICE_LARGE,
        self::SINGLE_HIDE_RELATED_POSTS => "1",
        // COLORS
        self::COLOR_SCHEME_FOREGROUND => '#2d2d2d',
        self::COLOR_SCHEME_BACKGROUND => '#ffffff',
        self::COLOR_SCHEME_PRIMARY => '#ffc5c5',
        self::COLOR_SCHEME_PRIMARY_DARK => '#e1a7a7',
        self::COLOR_SCHEME_SECONDARY => '#ffeee2',
        self::COLOR_SCHEME_SECONDARY_DARK => '#e1d0c4',
        self::COLOR_SCHEME_TERTIARY => '#e9fbff',
        self::COLOR_SCHEME_TERTIARY_DARK => '#cbdde1',
        self::COLOR_SCHEME_LIGHT_1 => '#fff9c4',
        self::COLOR_SCHEME_LIGHT_2 => '#efefef',
        self::COLOR_SCHEME_LIGHT_3 => '#a0816a',
        self::COLOR_SCHEME_DARK_1 => '#717171',
        self::COLOR_SCHEME_DARK_2 => '#614d47',
        self::COLOR_SCHEME_DARK_3 => '#ffc106',
    );

    public function __construct()
    {
        /*
        *
        * COLOR SCHEME
        *
        */
        new CustomizerItem(self::COLOR_SCHEME_PRIMARY, array(
            "type" => CustomizerType::CONTROL_COLOR,
            "label" => __('Primary', 'petite-stories'),
            "description" => __('Sets the primary colors for the theme.', 'petite-stories'),
            "section" => CustomizerSections::COLOR_SCHEME,
            "default" => self::$CONTROL_DEFAULTS[self::COLOR_SCHEME_PRIMARY]
        ));

        new CustomizerItem(self::COLOR_SCHEME_SECONDARY, array(
            "type" => CustomizerType::CONTROL_COLOR,
            "label" => __('Secondary', 'petite-stories'),
            "description" => __('Sets the secondary colors for the theme.', 'petite-stories'),
            "section" => CustomizerSections::COLOR_SCHEME,
            "default" => self::$CONTROL_DEFAULTS[self::COLOR_SCHEME_SECONDARY]
        ));

        new CustomizerItem(self::COLOR_SCHEME_TERTIARY, array(
            "type" => CustomizerType::CONTROL_COLOR,
            "label" => __('Tertiary', 'petite-stories'),
            "description" => __('Sets the tertiary colors for the theme.', 'petite-stories'),
            "section" => CustomizerSections::COLOR_SCHEME,
            "default" => self::$CONTROL_DEFAULTS[self::COLOR_SCHEME_TERTIARY]
        ));


        //
        new CustomizerItem(self::COLOR_SCHEME_PRIMARY_DARK, array(
            "type" => CustomizerType::CONTROL_COLOR,
            "label" => __('Primary Dark', 'petite-stories'),
            "description" => __('Sets the primary dark colors for the theme.', 'petite-stories'),
            "section" => 'petite-stories-color-scheme-dark-variations',
            "default" => self::$CONTROL_DEFAULTS[self::COLOR_SCHEME_PRIMARY_DARK]
        ));

        new CustomizerItem(self::COLOR_SCHEME_SECONDARY_DARK, array(
            "type" => CustomizerType::CONTROL_COLOR,
            "label" => __('Secondary Dark', 'petite-stories'),
            "description" => __('Sets the secondary dark colors for the theme.', 'petite-stories'),
            "section" => 'petite-stories-color-scheme-dark-variations',
            "default" => self::$CONTROL_DEFAULTS[self::COLOR_SCHEME_SECONDARY_DARK]
        ));

        new CustomizerItem(self::COLOR_SCHEME_TERTIARY_DARK, array(
            "type" => CustomizerType::CONTROL_COLOR,
            "label" => __('Tertiary Dark', 'petite-stories'),
            "description" => __('Sets the tertiary dark colors for the theme.', 'petite-stories'),
            "section" => 'petite-stories-color-scheme-dark-variations',
            "default" => self::$CONTROL_DEFAULTS[self::COLOR_SCHEME_TERTIARY_DARK]
        ));



        /*
        *
        * HEADER METASLIDER
        *
        */
        new CustomizerItem(self::HEADER_METASLIDER_SHORTCODE, array(
            "type" => CustomizerType::CONTROL_TEXT,
            "label" => __('MetaSlider Shortcode', 'petite-stories'),
            "description" => __('Add your MetaSlider slider shortcode in this field to use the Slider as your header. This will be used instead of the default theme header.', 'petite-stories'),
            "section" => CustomizerPanels::HEADER . CustomizerSections::HEADER_METASLIDER,
            "priority" => 1,
        ));

        /*
        *
        * HEADER DEFAULT
        *
        */
        /* Header */
        new CustomizerItem(self::HEADER_TITLE, array(
            "type" => CustomizerType::CONTROL_TEXT,
            "label" => __('Title', 'petite-stories'),
            "description" => __('The title text displayed in your header.', 'petite-stories'),
            "section" => CustomizerPanels::HEADER . CustomizerSections::HEADER_DEFAULT,
        ));
        new CustomizerItem(self::HEADER_TAGLINE, array(
            "type" => CustomizerType::CONTROL_TEXT,
            "label" => __('Tagline', 'petite-stories'),
            "description" => __('The tagline text displayed in your header.', 'petite-stories'),
            "section" => CustomizerPanels::HEADER . CustomizerSections::HEADER_DEFAULT,
        ));
        new CustomizerItem(self::HEADER_BUTTON_TEXT, array(
            "type" => CustomizerType::CONTROL_TEXT,
            "label" => __('Button Text', 'petite-stories'),
            "description" => __('The button text displayed in your header.', 'petite-stories'),
            "section" => CustomizerPanels::HEADER . CustomizerSections::HEADER_DEFAULT,
        ));
        new CustomizerItem(self::HEADER_BUTTON_LINK, array(
            "type" => CustomizerType::CONTROL_TEXT,
            "label" => __('Button Link', 'petite-stories'),
            "description" => __('The link used by the button in your header.', 'petite-stories'),
            "section" => CustomizerPanels::HEADER . CustomizerSections::HEADER_DEFAULT,
        ));

        /*
        *
        * SITE IDENTITY
        *
        */
        new CustomizerItem(self::SITE_IDENTITY_LOGO_HEIGHT, array(
            "type" => CustomizerType::CONTROL_RANGE,
            "label" => __('Logo Height', 'petite-stories'),
            "description" => __('Sets the height limit for the logo image, if once is selected.', 'petite-stories'),
            "section" => 'title_tagline',
            "priority" => 1,
            "default" => self::$CONTROL_DEFAULTS[self::SITE_IDENTITY_LOGO_HEIGHT],
            "range" => array(
                'min' => 25,
                'max' => 200,
                'step' => 1
            )
        ));

        new CustomizerItem(self::SITE_IDENTITY_HIDE_TAGLINE, array(
            "type" => CustomizerType::CONTROL_CHECKBOX,
            "label" => __('Hide Tagline Only', 'petite-stories'),
            "section" => 'title_tagline',
            "default" => 0
        ));

        /*
        *
        * NAVIGATION
        *
        */
        /* Layout */
        new CustomizerItem(self::NAVIGATION_LAYOUT_STYLE, array(
            "type" => CustomizerType::CONTROL_RADIO_IMAGE,
            "label" => __('Navigation Layout', 'petite-stories'),
            "description" => __('Select the layout of the navigation area on your website.', 'petite-stories'),
            "priority" => 1,
            "section" => CustomizerPanels::LAYOUT . CustomizerSections::NAVIGATION,
            "default" => self::$CONTROL_DEFAULTS[self::NAVIGATION_LAYOUT_STYLE],
            "choices" => array(
                self::NAVIGATION_LAYOUT_CHOICE_SMALL =>  '<svg xmlns="http://www.w3.org/2000/svg" width="119.958" height="37.94" viewBox="0 0 119.958 37.94"><title>' . esc_html__("Small Navigation Layout", "petite-stories") . '</title><g transform="translate(-49.021 -37.125)"><rect width="30.966" height="8.753" transform="translate(57.387 44.969)" /><rect width="9.966" height="3.753" transform="translate(151 47.469)" /><rect width="9.966" height="3.753" transform="translate(137 47.469)" /><rect width="9.966" height="3.753" transform="translate(123 47.469)" /><rect width="9.966" height="3.753" transform="translate(109 47.469)" /><path d="M373.5,57.034H254.566v37.94H374.524V57.034ZM256.559,92.981V59.027H372.532V92.981Z" transform="translate(-205.545 -19.909)"></path></g></svg>',
                self::NAVIGATION_LAYOUT_CHOICE_LARGE =>  '<svg xmlns="http://www.w3.org/2000/svg" width="119.958" height="37.94" viewBox="0 0 119.958 37.94"><title>' . esc_html__("Full Navigation Layout", "petite-stories") . '</title><g transform="translate(-49.021 -82.628)"><rect width="32.966" height="10.753" transform="translate(93.051 90.845)" /><rect width="13.094" height="5.722" rx="2.861" transform="translate(147.871 93.361)" /><g transform="translate(1.483)"><rect width="9.966" height="3.753" transform="translate(123.534 108.469)" /><rect width="9.966" height="3.753" transform="translate(137.534 108.469)" /><rect width="9.966" height="3.753" transform="translate(67.534 108.469)" /><rect width="9.966" height="3.753" transform="translate(109.534 108.469)" /><rect width="9.966" height="3.753" transform="translate(95.534 108.469)" /><rect width="9.966" height="3.753" transform="translate(81.534 108.469)" /></g><path d="M373.5,57.034H254.566v37.94H374.524V57.034ZM256.559,92.981V59.027H372.532V92.981Z" transform="translate(-205.545 25.594)" /><g transform="translate(-0.484)"><rect width="9.966" height="2.753" transform="translate(68.387 93.095)" /><rect width="9.966" height="1.753" transform="translate(68.387 97.595)" /><circle cx="4.516" cy="4.516" r="4.516" transform="translate(57.871 91.706)" /></g></g></svg>',
            )
        ));

        new CustomizerItem(self::NAVIGATION_AUTHOR_IMAGE, array(
            "type" => CustomizerType::CONTROL_IMAGE,
            "label" => __('Author Image', 'petite-stories'),
            "description" => __('If the Full Navigation Layout is active, sets the author image in the top left side of the navigation layout.', 'petite-stories'),
            "section" => CustomizerPanels::LAYOUT . CustomizerSections::NAVIGATION,
            "default" => "",
            "priority" => 1,
        ));

        new CustomizerItem(self::NAVIGATION_AUTHOR_NAME, array(
            "type" => CustomizerType::CONTROL_TEXT,
            "label" => __('Author Name', 'petite-stories'),
            "description" => __('If the Full Navigation Layout is active, sets the author name in the top left side of the navigation.', 'petite-stories'),
            "section" => CustomizerPanels::LAYOUT . CustomizerSections::NAVIGATION,
            "priority" => 1,
        ));

        new CustomizerItem(self::NAVIGATION_AUTHOR_TAGLINE, array(
            "type" => CustomizerType::CONTROL_TEXT,
            "label" => __('Author Tagline', 'petite-stories'),
            "description" => __('If the Full Navigation Layout is active, sets the author tagline in the top left side of the navigation.', 'petite-stories'),
            "section" => CustomizerPanels::LAYOUT . CustomizerSections::NAVIGATION,
            "priority" => 1,
        ));

        new CustomizerItem(self::NAVIGATION_RIGHTALIGNED_BUTTON_TEXT, array(
            "type" => CustomizerType::CONTROL_TEXT,
            "label" => __('Right-Aligned Button Text', 'petite-stories'),
            "description" => __('If the Full Navigation Layout is active, sets the text of the button in the top right side of the navigation.', 'petite-stories'),
            "section" => CustomizerPanels::LAYOUT . CustomizerSections::NAVIGATION,
            "priority" => 1,
        ));

        new CustomizerItem(self::NAVIGATION_RIGHTALIGNED_BUTTON_LINK, array(
            "type" => CustomizerType::CONTROL_TEXT,
            "label" => __('Right-Aligned Button Link', 'petite-stories'),
            "description" => __('If the Full Navigation Layout is active, sets the link of the button in the top right side of the navigation.', 'petite-stories'),
            "section" => CustomizerPanels::LAYOUT . CustomizerSections::NAVIGATION,
            "priority" => 1,
        ));


        /*
        *
        * BLOG FEED
        *
        */
        /* Layout */
        new CustomizerItem(self::BLOGFEED_COLUMNS_STYLE, array(
            "type" => CustomizerType::CONTROL_RADIO_IMAGE,
            "label" => __('Blog Feed Column Layout', 'petite-stories'),
            "description" => __('Select the layout of the columns on your blog feed.', 'petite-stories'),
            "section" => CustomizerPanels::LAYOUT . CustomizerSections::BLOG,
            "default" => self::$CONTROL_DEFAULTS[self::BLOGFEED_COLUMNS_STYLE],
            "choices" => array(
                self::BLOGFEED_ONE_COLUMNS => '<svg xmlns="http://www.w3.org/2000/svg" width="119.958" height="119.939" viewBox="0 0 119.958 119.939"><title>' . esc_html__("1-Column Layout", "petite-stories") . '</title><g transform="translate(-154 -253)"><g transform="translate(-100.545 196.091)"><rect width="76.966" height="33.753" transform="translate(275.933 66.878)" /><rect width="73.583" height="1.984" transform="translate(275.933 104.646)" /><rect width="65.932" height="1.984" transform="translate(275.933 111.672)" /><rect width="76.966" height="33.753" transform="translate(275.933 122.027)" /><rect width="73.583" height="1.984" transform="translate(275.933 159.795)" /><rect width="65.932" height="1.984" transform="translate(275.933 166.821)" /><path d="M373.5,57.034H254.566v119.94H374.524V57.034ZM256.559,174.981V59.027H372.532V174.981Z" /></g></g></svg>',
                self::BLOGFEED_TWO_COLUMNS =>  '<svg xmlns="http://www.w3.org/2000/svg" width="119.958" height="119.94" viewBox="0 0 119.958 119.94"><title>' . esc_html__("2-Column Layout", "petite-stories") . '</title><g transform="translate(-154.021 -390.53)"><g transform="translate(-100.545 196.091)"><rect width="46.966" height="32.983" transform="translate(262.528 202.372)" /><rect width="43.902" height="1.984" transform="translate(262.528 239.371)" /><rect width="41.881" height="1.984" transform="translate(262.528 246.396)" /><rect width="44.466" height="32.983" transform="translate(319.515 202.308)" /><rect width="41.693" height="1.984" transform="translate(319.515 239.307)" /><rect width="39.688" height="1.984" transform="translate(319.515 246.332)" /><rect width="44.466" height="32.983" transform="translate(319.515 260.712)" /><rect width="41.693" height="1.984" transform="translate(319.515 297.711)" /><rect width="39.688" height="1.984" transform="translate(319.515 304.736)" /><rect width="46.895" height="32.983" transform="translate(262.528 260.712)" /><rect width="43.902" height="1.984" transform="translate(262.528 297.711)" /><rect width="41.859" height="1.984" transform="translate(262.528 304.736)" /><path d="M373.5,194.439H254.566v119.94H374.524V194.439ZM256.559,312.386V196.432H372.532V312.386Z" /></g></g></svg>',
                self::BLOGFEED_THREE_COLUMNS => '<svg xmlns="http://www.w3.org/2000/svg" width="119.958" height="119.939" viewBox="0 0 119.958 119.939"><title>' . esc_html__("3-Column Layout", "petite-stories") . '</title><g transform="translate(-154.042 -557.096)"><g transform="translate(-100.545 196.091)"><rect width="29.776" height="32.983" transform="translate(262.549 368.937)" /><rect width="27.004" height="1.984" transform="translate(262.549 405.936)" /><rect width="24.998" height="1.984" transform="translate(262.549 412.961)" /><rect width="29.776" height="32.983" transform="translate(299.678 368.937)" /><rect width="27.004" height="1.984" transform="translate(299.678 405.936)" /><rect width="24.998" height="1.984" transform="translate(299.678 412.961)" /><rect width="29.776" height="32.983" transform="translate(336.615 368.873)" /><rect width="27.004" height="1.984" transform="translate(336.615 405.872)" /><rect width="24.998" height="1.984" transform="translate(336.615 412.898)" /><rect width="29.776" height="32.983" transform="translate(262.549 427.277)" /><rect width="27.004" height="1.984" transform="translate(262.549 464.276)" /><rect width="24.998" height="1.984" transform="translate(262.549 471.302)" /><rect width="29.776" height="32.983" transform="translate(299.678 427.277)" /><rect width="27.004" height="1.984" transform="translate(299.678 464.276)" /><rect width="24.998" height="1.984" transform="translate(299.678 471.302)" /><rect width="29.776" height="32.983" transform="translate(336.615 427.214)" /><rect width="27.004" height="1.984" transform="translate(336.615 464.212)" /><rect width="24.998" height="1.984" transform="translate(336.615 471.238)" /><path d="M373.519,361.005H254.587V480.944H374.545V361.005ZM256.579,478.952V363H372.553V478.952Z" /></g></g></svg>',
                self::BLOGFEED_TWO_COLUMNS_MASONRY => '<svg width="120" height="120" viewBox="0 0 120 120" xmlns="http://www.w3.org/2000/svg"><title>' . esc_html__("2-Column Masonry Layout", "petite-stories") . '</title><g><rect x="1" y="1" width="118" height="118" rx="3" fill="none" stroke-width="2"/><rect x="6" y="6" width="51" height="20" rx="4" /><rect x="6" y="30" width="28" height="4" rx="2" /><rect x="6" y="38" width="16" height="4" rx="2" /><rect x="63" y="78" width="51" height="20" rx="4" /><rect x="63" y="102" width="28" height="4" rx="2" /><rect x="63" y="110" width="16" height="4" rx="2" /><rect x="6" y="50" width="51" height="48" rx="4" /><rect x="6" y="102" width="28" height="4" rx="2" /><rect x="6" y="110" width="16" height="4" rx="2" /><rect x="63" y="6" width="51" height="48" rx="4" /><rect x="63" y="58" width="28" height="4" rx="2" /><rect x="63" y="66" width="16" height="4" rx="2" /></g></svg>',
                self::BLOGFEED_THREE_COLUMNS_MASONRY => '<svg width="120" height="120" viewBox="0 0 120 120" fill="none" xmlns="http://www.w3.org/2000/svg"><title>' . esc_html__("3-Column Masonry Layout", "petite-stories") . '</title><g><rect x="1" y="1" width="118" height="118" rx="3" fill="none" stroke-width="2"/><rect x="6" y="6" width="32" height="20" rx="4" /><rect x="6" y="30" width="28" height="4" rx="2" /><rect x="6" y="38" width="16" height="4" rx="2" /><rect x="82" y="6" width="32" height="20" rx="4" /><rect x="82" y="30" width="28" height="4" rx="2" /><rect x="82" y="38" width="16" height="4" rx="2" /><rect x="6" y="50" width="32" height="48" rx="4" /><rect x="6" y="102" width="28" height="4" rx="2" /><rect x="6" y="110" width="16" height="4" rx="2" /><rect x="82" y="50" width="32" height="48" rx="4" /><rect x="82" y="102" width="28" height="4" rx="2" /><rect x="82" y="110" width="16" height="4" rx="2" /><rect x="44" y="6" width="32" height="48" rx="4" /><rect x="44" y="58" width="28" height="4" rx="2" /><rect x="44" y="66" width="16" height="4" rx="2" /><rect x="44" y="78" width="32" height="20" rx="4" /><rect x="44" y="102" width="28" height="4" rx="2" /><rect x="44" y="110" width="16" height="4" rx="2" /></g></svg>'
            )
        ));

        new CustomizerItem(self::BLOGFEED_GRID_BG_BG, array(
            "type" => CustomizerType::CONTROL_CHECKBOX,
            "label" => __('Item Boxes in Column Grid', 'petite-stories'),
            "description" => __('Enabling this setting will add a box with a background around each item in the column grid.', 'petite-stories'),
            "section" => CustomizerPanels::LAYOUT . CustomizerSections::BLOG,
            "default" => 0
        ));

        new CustomizerItem(self::BLOGFEED_SHOW_READMORE_BUTTON, array(
            "type" => CustomizerType::CONTROL_CHECKBOX,
            "label" => __('Show "Continue reading" Button', 'petite-stories'),
            "description" => __('Enabling this setting will add a "Continue reading" button below every blog post excerpt, if "Show Full Posts" is not enabled.', 'petite-stories'),
            "section" => CustomizerPanels::LAYOUT . CustomizerSections::BLOG,
            "default" => 0
        ));

        new CustomizerItem(self::BLOGFEED_FEATURED_IMAGE_STYLE, array(
            "type" => CustomizerType::CONTROL_RADIO,
            "label" => __('Featured Image Layout', 'petite-stories'),
            "description" => __('Select the layout of the featured images on your blog feed.', 'petite-stories'),
            "section" => CustomizerPanels::LAYOUT . CustomizerSections::BLOG,
            "default" => self::$CONTROL_DEFAULTS[self::BLOGFEED_FEATURED_IMAGE_STYLE],
            "choices" => array(
                self::BLOGFEED_FEATURED_IMAGE_CHOICE_FULL_IMAGE => "Full Image",
                self::BLOGFEED_FEATURED_IMAGE_CHOICE_COVER_IMAGE => "Scale to fit Recommended Size",
                self::BLOGFEED_FEATURED_IMAGE_CHOICE_FULL_IMAGE_COVER_BLUR => "Keep Full Image, But Fill Background to Recommended Size"
            )
        ));

        new CustomizerItem(self::BLOGFEED_FEATURED_IMAGE_PLACEHOLDER, array(
            "type" => CustomizerType::CONTROL_CHECKBOX,
            "label" => __('Display Placeholder Featured Image', 'petite-stories'),
            "description" => __('Enabling this setting will display a placeholder featured image for all posts that do not have a featured image set.', 'petite-stories'),
            "section" => CustomizerPanels::LAYOUT . CustomizerSections::BLOG,
            "default" => 0
        ));


        /*
        *
        * SINGLE / POSTS & PAGES / POSTS / PAGES
        *
        */
        /* Layout */
        new CustomizerItem(self::SINGLE_FEATURED_IMAGE_STYLE, array(
            "type" => CustomizerType::CONTROL_RADIO,
            "label" => __('Featured Image Layout', 'petite-stories'),
            "description" => __('Select the layout of the featured images on your blog feed.', 'petite-stories'),
            "section" => CustomizerPanels::LAYOUT . CustomizerSections::SINGLE,
            "default" => self::$CONTROL_DEFAULTS[self::SINGLE_FEATURED_IMAGE_STYLE],
            "choices" => array(
                self::SINGLE_FEATURED_IMAGE_CHOICE_FULL_IMAGE => "Full Image",
                self::SINGLE_FEATURED_IMAGE_CHOICE_COVER_IMAGE => "Scale to fit Recommended Size",
                self::SINGLE_FEATURED_IMAGE_CHOICE_FULL_IMAGE_COVER_BLUR => "Keep Full Image, But Fill Background to Recommended Size"
            )
        ));

        new CustomizerItem(self::SINGLE_HIDE_RELATED_POSTS, array(
            "type" => CustomizerType::CONTROL_CHECKBOX,
            "label" => __('Hide Related Posts', 'petite-stories'),
            "description" => __('Enabling this setting will hide the related posts section.', 'petite-stories'),
            "section" => CustomizerPanels::LAYOUT . CustomizerSections::SINGLE,
            "default" => self::$CONTROL_DEFAULTS[self::SINGLE_HIDE_RELATED_POSTS]
        ));
    }
	
	public static function OverwriteDefault($control, $value){
		self::$CONTROL_DEFAULTS[$control] = $value;
	}

    public static function GetSelectedOrDefault($control)
    {
        $theme_mod = \get_theme_mod($control);
        if (($theme_mod || empty($theme_mod)) && $theme_mod !== false) {
            return $theme_mod;
        }

        return self::GetDefault($control);
    }

    public static function GetDefault($control)
    {
        if (isset(self::$CONTROL_DEFAULTS[$control])) {
            return self::$CONTROL_DEFAULTS[$control];
        }

        return false;
    }
}
