<?php if (!defined('ABSPATH')) {
    die;
}

$tp_codstar_prefix = '_thepack';

CSF::createOptions($tp_codstar_prefix, [
    'menu_title' => 'The Pack',
    'menu_slug' => 'the-pack',
    'theme' => 'light',
    'menu_icon' => 'dashicons-buddicons-community',
    'menu_position' => 3,
    'show_sub_menu'   => false,
    'framework_title' => 'The Pack <small>by webangon</small>',
]);

if (class_exists('The_Pack_Pro')) {
    //echo 'Pro';
}

CSF::createSection($tp_codstar_prefix, [
    'id' => 'tp_general',
    'title' => 'General',
    'icon' => 'dashicons dashicons-dashboard',

    'fields' => [
        [
            'id' => 'gmap_key',
            'type' => 'text',
            'title' => esc_html__('Google map key', 'thepack'),
            'desc' => sprintf('Get map key  %s', '<a href="https://developers.google.com/maps/documentation/javascript/get-api-key" target="_blank">api key</a>'),
        ],

        [
            'id' => 'preloader',
            'type' => 'switcher',
            'title' => __('Page preloader', 'thepack'),
        ],

        [
            'id' => 'prebg',
            'type' => 'color',
            'output' => '.tp-page-loader-wrap',
            'output_mode' => 'background-color',
            'dependency' => ['preloader', '==', 'true'],
            'title' => __('Preloader background', 'thepack'),
        ],

        [
            'id' => 'pretheme',
            'type' => 'color',
            'output' => '.tp-page-loader-wrap .loader',
            'output_mode' => 'border-color',
            'dependency' => ['preloader', '==', 'true'],
            'title' => __('Preloader theme', 'thepack'),
        ],

    ]

]);

CSF::createSection($tp_codstar_prefix, [
    'id' => 'tp_sec2',
    'title' => __('Script and Style', 'thepack'),
    'icon' => 'dashicons dashicons-carrot',
]);

CSF::createSection($tp_codstar_prefix, [
    'parent' => 'tp_sec2',
    'class' => 'thepack-three-col',
    'icon' => 'dashicons dashicons-drumstick',
    'title' => __('Script files', 'thepack'),
    'fields' => [

        [
            'id' => 'scrollreveal',
            'type' => 'switcher',
            'title' => __('Scrollreveal', 'thepack'),
            'default' => 'yes',
            'help' => __('On scroll animation library', 'thepack'),
        ],

        [
            'id' => 'circle-progress',
            'type' => 'switcher',
            'title' => __('Circle progress', 'thepack'),
            'default' => 'yes',
            'help' => __('Circular progressbar', 'thepack'),
        ],

        [
            'id' => 'plyr',
            'type' => 'switcher',
            'title' => __('Plyr video', 'thepack'),
            'default' => 'yes',
            'help' => __('Plyr video library', 'thepack'),
        ],

        [
            'id' => 'countdown',
            'type' => 'switcher',
            'title' => __('Countdown', 'thepack'),
            'default' => 'yes',
            'help' => __('jQuery date counter library', 'thepack'),
        ],

        [
            'id' => 'slick',
            'type' => 'switcher',
            'title' => __('Slick', 'thepack'),
            'default' => 'yes',
            'help' => __('Slick slider library', 'thepack'),
        ],

        [
            'id' => 'beerslider',
            'type' => 'switcher',
            'title' => __('Before after slider', 'thepack'),
            'default' => 'yes',
            'help' => __('Before after comparison slider', 'thepack'),
        ],

        [
            'id' => 'fitvideos',
            'type' => 'switcher',
            'title' => __('Fit videos', 'thepack'),
            'default' => 'yes',
            'help' => __('Fit videos to screen', 'thepack'),
        ],

        [
            'id' => 'jarallax',
            'type' => 'switcher',
            'title' => __('Parallax background', 'thepack'),
            'default' => 'yes',
            'help' => __('jarallax library for parallax background', 'thepack'),
        ],

        [
            'id' => 'flex-images',
            'type' => 'switcher',
            'title' => __('Justified gallery', 'thepack'),
            'default' => 'yes',
            'help' => __('justified grid gallery', 'thepack'),
        ],
    ]

]);

CSF::createSection($tp_codstar_prefix, [
    'parent' => 'tp_sec2',
    'title' => __('Style files', 'thepack'),
    'class' => 'thepack-three-col',
    'icon' => 'dashicons dashicons-buddicons-replies',
    'fields' => [

        [
            'id' => 'beerslider-styl',
            'type' => 'switcher',
            'title' => __('Beerslider', 'thepack'),
            'default' => 'yes',
            'help' => __('Before after comparison slider', 'thepack'),
        ],

        [
            'id' => 'plyr-styl',
            'type' => 'switcher',
            'title' => __('Plyr video', 'thepack'),
            'default' => 'yes',
            'help' => __('Plyr video library', 'thepack'),
        ],

        [
            'id' => 'slick-styl',
            'type' => 'switcher',
            'title' => __('Slick', 'thepack'),
            'default' => 'yes',
            'help' => __('Slick slider library', 'thepack'),
        ],

        [
            'id' => 'animate-styl',
            'type' => 'switcher',
            'title' => __('Animate', 'thepack'),
            'default' => 'yes',
            'help' => __('Custom moving animations', 'thepack'),
        ],

    ]
]);

CSF::createSection($tp_codstar_prefix, [
    'id' => 'tp_secthm',
    'title' => __('Widgets', 'thepack'),
    'icon' => 'dashicons dashicons-admin-generic',
]);

CSF::createSection($tp_codstar_prefix, [
    'title' => 'Free widgets',
    'parent' => 'tp_secthm',
    'class' => 'thepack-three-col',
    'icon' => 'dashicons dashicons-chart-pie',
    'fields' => [

        [
            'id' => 'accordion',
            'type' => 'switcher',
            'title' => esc_html__('Accordion', 'thepack'),
            'default' => 'yes',
        ],
        [
            'id' => 'altimagegrid',
            'type' => 'switcher',
            'title' => esc_html__('Imagegrid alt', 'thepack'),
            'default' => 'yes',
        ],

        [
            'id' => 'before_after',
            'type' => 'switcher',
            'title' => esc_html__('Before after', 'thepack'),
            'default' => 'yes',
        ],

        [
            'id' => 'button_dbl',
            'type' => 'switcher',
            'title' => esc_html__('Dual Button', 'thepack'),
            'default' => 'yes',
        ],

        [
            'id' => 'button_info',
            'type' => 'switcher',
            'title' => esc_html__('Info button', 'thepack'),
            'default' => 'yes',
        ],

        [
            'id' => 'card_slider',
            'type' => 'switcher',
            'title' => esc_html__('Card slider', 'thepack'),
            'default' => 'yes',
        ],

        [
            'id' => 'carousel_parallax',
            'type' => 'switcher',
            'title' => esc_html__('Carousel Parallax', 'thepack'),
            'default' => 'yes',
        ],

        [
            'id' => 'changelog',
            'type' => 'switcher',
            'title' => esc_html__('Changelog', 'thepack'),
            'default' => 'yes',
        ],

        [
            'id' => 'circular_phone',
            'type' => 'switcher',
            'title' => esc_html__('Circular Phone', 'thepack'),
            'default' => 'yes',
        ],

        [
            'id' => 'cliendgrid',
            'type' => 'switcher',
            'title' => esc_html__('Client', 'thepack'),
            'default' => 'yes',
        ],

        [
            'id' => 'contact_form',
            'type' => 'switcher',
            'title' => esc_html__('Contact Form', 'thepack'),
            'default' => 'yes',
        ],

        [
            'id' => 'counter_1',
            'type' => 'switcher',
            'title' => esc_html__('Counter 1', 'thepack'),
            'default' => 'yes',
        ],

        [
            'id' => 'counter_2',
            'type' => 'switcher',
            'title' => esc_html__('Counter 2', 'thepack'),
            'default' => 'yes',
        ],

        [
            'id' => 'counter_circle',
            'type' => 'switcher',
            'title' => esc_html__('Circle counter', 'thepack'),
            'default' => 'yes',
        ],

        [
            'id' => 'counter_circle',
            'type' => 'switcher',
            'title' => esc_html__('Circle counter', 'thepack'),
            'default' => 'yes',
        ],

        [
            'id' => 'cta2',
            'type' => 'switcher',
            'title' => esc_html__('CTA 2', 'thepack'),
            'default' => 'yes',
        ],

        [
            'id' => 'cta_link',
            'type' => 'switcher',
            'title' => esc_html__('Link CTA', 'thepack'),
            'default' => 'yes',
        ],

        [
            'id' => 'ctabg_button',
            'type' => 'switcher',
            'title' => esc_html__('CTA button', 'thepack'),
            'default' => 'yes',
        ],

        [
            'id' => 'datecounter',
            'type' => 'switcher',
            'title' => esc_html__('Date timer', 'thepack'),
            'default' => 'yes',
        ],

        [
            'id' => 'eventlisting',
            'type' => 'switcher',
            'title' => esc_html__('Event Listing', 'thepack'),
            'default' => 'yes',
        ],

        [
            'id' => 'eventlisting',
            'type' => 'switcher',
            'title' => esc_html__('Event Listing', 'thepack'),
            'default' => 'yes',
        ],

        [
            'id' => 'featurebox',
            'type' => 'switcher',
            'title' => esc_html__('Feature Box', 'thepack'),
            'default' => 'yes',
        ],

        [
            'id' => 'flipcard',
            'type' => 'switcher',
            'title' => esc_html__('Flip Card', 'thepack'),
            'default' => 'yes',
        ],

        [
            'id' => 'gallery_2',
            'type' => 'switcher',
            'title' => esc_html__('Gallery 2', 'thepack'),
            'default' => 'yes',
        ],

        [
            'id' => 'slider_shop',
            'type' => 'switcher',
            'title' => esc_html__('Shop slider', 'thepack'),
            'default' => 'yes',
        ],

        [
            'id' => 'gallery_carousel',
            'type' => 'switcher',
            'title' => esc_html__('Gallery carousel', 'thepack'),
            'default' => 'yes',
        ],

        [
            'id' => 'gmap',
            'type' => 'switcher',
            'title' => esc_html__('Google Map', 'thepack'),
            'default' => 'yes',
        ],

        [
            'id' => 'heading_1',
            'type' => 'switcher',
            'title' => esc_html__('Heading 1', 'thepack'),
            'default' => 'yes',
        ],

        [
            'id' => 'heading_2',
            'type' => 'switcher',
            'title' => esc_html__('Heading 2', 'thepack'),
            'default' => 'yes',
        ],

        [
            'id' => 'heading_4',
            'type' => 'switcher',
            'title' => esc_html__('Heading 4', 'thepack'),
            'default' => 'yes',
        ],

        [
            'id' => 'heading_dot',
            'type' => 'switcher',
            'title' => esc_html__('Dot heading', 'thepack'),
            'default' => 'yes',
        ],

        [
            'id' => 'heading_line',
            'type' => 'switcher',
            'title' => esc_html__('Heading Line', 'thepack'),
            'default' => 'yes',
        ],

        [
            'id' => 'hover_background',
            'type' => 'switcher',
            'title' => esc_html__('Hover background', 'thepack'),
            'default' => 'yes',
        ],

        [
            'id' => 'hoverbg_fullscreen',
            'type' => 'switcher',
            'title' => esc_html__('Hover background', 'thepack'),
            'default' => 'yes',
        ],

        [
            'id' => 'iconbox',
            'type' => 'switcher',
            'title' => esc_html__('Iconbox', 'thepack'),
            'default' => 'yes',
        ],

        [
            'id' => 'iconbox_alternate',
            'type' => 'switcher',
            'title' => esc_html__('Icon alt', 'thepack'),
            'default' => 'yes',
        ],

        [
            'id' => 'image_hotspot',
            'type' => 'switcher',
            'title' => esc_html__('Hotspot', 'thepack'),
            'default' => 'yes',
        ],

        [
            'id' => 'image_layer',
            'type' => 'switcher',
            'title' => esc_html__('Image layer', 'thepack'),
            'default' => 'yes',
        ],

        [
            'id' => 'imagecaption',
            'type' => 'switcher',
            'title' => esc_html__('Image caption', 'thepack'),
            'default' => 'yes',
        ],

        [
            'id' => 'imgbgbox_2',
            'type' => 'switcher',
            'title' => esc_html__('Image box 2', 'thepack'),
            'default' => 'yes',
        ],

        [
            'id' => 'imgbgbox_4',
            'type' => 'switcher',
            'title' => esc_html__('Imagebox 4', 'thepack'),
            'default' => 'yes',
        ],

        [
            'id' => 'imgbox_1',
            'type' => 'switcher',
            'title' => esc_html__('Imagebox 1', 'thepack'),
            'default' => 'yes',
        ],

        [
            'id' => 'imgbox_4',
            'type' => 'switcher',
            'title' => esc_html__('Imagebox 4', 'thepack'),
            'default' => 'yes',
        ],

        [
            'id' => 'imgslickcarousel',
            'type' => 'switcher',
            'title' => esc_html__('Image slide', 'thepack'),
            'default' => 'yes',
        ],

        [
            'id' => 'joblisting',
            'type' => 'switcher',
            'title' => esc_html__('Job Listing', 'thepack'),
            'default' => 'yes',
        ],

        [
            'id' => 'links_1',
            'type' => 'switcher',
            'title' => esc_html__('Link', 'thepack'),
            'default' => 'yes',
        ],

        [
            'id' => 'minibox',
            'type' => 'switcher',
            'title' => esc_html__('Mini Box', 'thepack'),
            'default' => 'yes',
        ],

        [
            'id' => 'mega_menu',
            'type' => 'switcher',
            'title' => esc_html__('Mega Menu', 'thepack'),
            'default' => 'yes',
        ],

        [
            'id' => 'opening_hours',
            'type' => 'switcher',
            'title' => esc_html__('Opening hours', 'thepack'),
            'default' => 'yes',
        ],

        [
            'id' => 'pricing_1',
            'type' => 'switcher',
            'title' => esc_html__('Price 1', 'thepack'),
            'default' => 'yes',
        ],

        [
            'id' => 'pricing_4',
            'type' => 'switcher',
            'title' => esc_html__('Pricing 4', 'thepack'),
            'default' => 'yes',
        ],

        [
            'id' => 'process_1',
            'type' => 'switcher',
            'title' => esc_html__('Process 1', 'thepack'),
            'default' => 'yes',
        ],

        [
            'id' => 'process_2',
            'type' => 'switcher',
            'title' => esc_html__('Process 2', 'thepack'),
            'default' => 'yes',
        ],

        [
            'id' => 'progressbar_1',
            'type' => 'switcher',
            'title' => esc_html__('Progressbar 1', 'thepack'),
            'default' => 'yes',
        ],

        [
            'id' => 'progressbar_2',
            'type' => 'switcher',
            'title' => esc_html__('Progressbar 2', 'thepack'),
            'default' => 'yes',
        ],

        [
            'id' => 'roundbox',
            'type' => 'switcher',
            'title' => esc_html__('Round box', 'thepack'),
            'default' => 'yes',
        ],

        [
            'id' => 'separator',
            'type' => 'switcher',
            'title' => esc_html__('Separator', 'thepack'),
            'default' => 'yes',
        ],

        [
            'id' => 'single_slider',
            'type' => 'switcher',
            'title' => esc_html__('Image Slide', 'thepack'),
            'default' => 'yes',
        ],

        [
            'id' => 'slidercarousel',
            'type' => 'switcher',
            'title' => esc_html__('Carousel slide', 'thepack'),
            'default' => 'yes',
        ],

        [
            'id' => 'sliderparallax',
            'type' => 'switcher',
            'title' => esc_html__('Parallax Slide', 'thepack'),
            'default' => 'yes',
        ],

        [
            'id' => 'social_icon',
            'type' => 'switcher',
            'title' => esc_html__('Social 1', 'thepack'),
            'default' => 'yes',
        ],

        [
            'id' => 'tab',
            'type' => 'switcher',
            'title' => esc_html__('Tab', 'thepack'),
            'default' => 'yes',
        ],

        [
            'id' => 'team_1',
            'type' => 'switcher',
            'title' => esc_html__('Team 1', 'thepack'),
            'default' => 'yes',
        ],

        [
            'id' => 'team_2',
            'type' => 'switcher',
            'title' => esc_html__('Team 2', 'thepack'),
            'default' => 'yes',
        ],

        [
            'id' => 'testimonial_1',
            'type' => 'switcher',
            'title' => esc_html__('Testimonial 1', 'thepack'),
            'default' => 'yes',
        ],

        [
            'id' => 'testimonial_5',
            'type' => 'switcher',
            'title' => esc_html__('Testimonial 5', 'thepack'),
            'default' => 'yes',
        ],

        [
            'id' => 'textlink',
            'type' => 'switcher',
            'title' => esc_html__('Text link', 'thepack'),
            'default' => 'yes',
        ],

        [
            'id' => 'thumb_text_layer',
            'type' => 'switcher',
            'title' => esc_html__('Image Text Layer', 'thepack'),
            'default' => 'yes',
        ],

        [
            'id' => 'timeline_1',
            'type' => 'switcher',
            'title' => esc_html__('Timeline 1', 'thepack'),
            'default' => 'yes',
        ],

        [
            'id' => 'timeline_alt',
            'type' => 'switcher',
            'title' => esc_html__('Timeline alt', 'thepack'),
            'default' => 'yes',
        ],

        [
            'id' => 'titmeline_3',
            'type' => 'switcher',
            'title' => esc_html__('Timeline 3', 'thepack'),
            'default' => 'yes',
        ],

        [
            'id' => 'tourlisting',
            'type' => 'switcher',
            'title' => esc_html__('Tour Listing', 'thepack'),
            'default' => 'yes',
        ],

        [
            'id' => 'date_listing',
            'type' => 'switcher',
            'title' => esc_html__('Date listing', 'thepack'),
            'default' => 'yes',
        ],

        [
            'id' => 'typed_text',
            'type' => 'switcher',
            'title' => esc_html__('Typing letter', 'thepack'),
            'default' => 'yes',
        ],

        [
            'id' => 'video_image',
            'type' => 'switcher',
            'title' => esc_html__('Video Image', 'thepack'),
            'default' => 'yes',
        ],

        [
            'id' => 'video_plyr',
            'type' => 'switcher',
            'title' => esc_html__('Plyr Video', 'thepack'),
            'default' => 'yes',
        ],

        [
            'id' => 'videobg-pop',
            'type' => 'switcher',
            'title' => esc_html__('Video Pop 2', 'thepack'),
            'default' => 'yes',
        ],

        [
            'id' => 'case_grid',
            'type' => 'switcher',
            'title' => esc_html__('Case grid', 'thepack'),
            'default' => 'yes',
        ],

        [
            'id' => 'sidebar_link',
            'type' => 'switcher',
            'title' => esc_html__('Sidebar link', 'thepack'),
            'default' => 'yes',
        ],

        [
            'id' => 'pricing_text',
            'type' => 'switcher',
            'title' => esc_html__('Pricing Text', 'thepack'),
            'default' => 'yes',
        ],

        [
            'id' => 'image_grid_slider',
            'type' => 'switcher',
            'title' => esc_html__('Image grid slider', 'thepack'),
            'default' => 'yes',
        ],

        [
            'id' => 'breadcum',
            'type' => 'switcher',
            'title' => esc_html__('Breadcrumb', 'thepack'),
            'default' => 'yes',
        ],

        [
            'id' => 'scroll_to',
            'type' => 'switcher',
            'title' => esc_html__('Scroll to next', 'thepack'),
            'default' => 'yes',
        ],

        [
            'id' => 'blog-grid',
            'type' => 'switcher',
            'title' => esc_html__('Blog grid', 'thepack'),
            'default' => 'yes',
        ],

        [
            'id' => 'taxonomy',
            'type' => 'switcher',
            'title' => esc_html__('Taxonomy', 'thepack'),
            'default' => 'yes',
        ],

        [
            'id' => 'recent_post',
            'type' => 'switcher',
            'title' => esc_html__('Recent post', 'thepack'),
            'default' => 'yes',
        ],

        [
            'id' => 'dynamic_title',
            'type' => 'switcher',
            'title' => esc_html__('Dynamic title', 'thepack'),
            'default' => 'yes',
        ],

        [
            'id' => 'search_form',
            'type' => 'switcher',
            'title' => esc_html__('Search form', 'thepack'),
            'default' => 'yes',
        ],

        [
            'id' => 'post_comment',
            'type' => 'switcher',
            'title' => esc_html__('Post comment', 'thepack'),
            'default' => 'yes',
        ],

        [
            'id' => 'post_content',
            'type' => 'switcher',
            'title' => esc_html__('Post content', 'thepack'),
            'default' => 'yes',
        ],

        [
            'id' => 'post_meta',
            'type' => 'switcher',
            'title' => esc_html__('Post meta', 'thepack'),
            'default' => 'yes',
        ],

        [
            'id' => 'full-slider',
            'type' => 'switcher',
            'title' => esc_html__('Full width slider', 'thepack'),
            'default' => 'yes',
        ],

        [
            'id' => 'star-rating',
            'type' => 'switcher',
            'title' => esc_html__('Star rating', 'thepack'),
            'default' => 'yes',
        ],

    ]
]);  

if (class_exists('The_Pack_Pro')) {
}

CSF::createSection($tp_codstar_prefix, [
    'id' => 'tgnrl',
    'title' => 'Extra',
    'icon' => 'dashicons dashicons-admin-plugins',
    'fields' => [

        [
            'id' => 'image_size',
            'type' => 'repeater',
            'title' => 'Image Size',
            'fields' => [
                [
                    'id' => 'name',
                    'type' => 'text',
                    'title' => 'Name',
                    'desc' => 'Image size name',
                ],

                [
                    'id' => 'width',
                    'type' => 'text',
                    'title' => 'Width',
                    'desc' => 'Image width in px',
                ],

                [
                    'id' => 'height',
                    'type' => 'text',
                    'title' => 'Height',
                    'desc' => 'Image height in px',
                ],

                [
                    'id' => 'crop',
                    'type' => 'switcher',
                    'title' => 'Crop',
                    'desc' => 'Hard crop image',
                    'default' => 'yes',
                ],

            ],
        ],

    ]
]);
