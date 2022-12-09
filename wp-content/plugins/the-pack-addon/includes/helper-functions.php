<?php
use Elementor\Icons_Manager;

// Exit if accessed directly
if (!defined('ABSPATH')) {
    exit;
}

function the_pack_render_icon($icon, $class = '')
{
    if ($icon['library'] == 'svg') {
        $out = wp_get_attachment_image($icon['value']['id'], 'full', '', ['class' => $class]);
    } else {
        ob_start();
        Icons_Manager::render_icon($icon, ['class' => $class, 'aria-hidden' => 'true']);
        $out = ob_get_clean();
    }

    return $out;
}

function render_nav_menu($menu)
{
    $args = [
        'echo' => false,
        'menu' => $menu,
        'walker' => new \The_Pack_Nav_Walker(),
        'items_wrap' => '<ul class="tp-menu-wrap">%3$s</ul>'
    ];

    if ($menu) {
        return wp_nav_menu($args);
    }
}

function menu_item_class($menu)
{
    $icon = $menu['icon'];
    $menu_location = $menu['menu_register'];
    $sub_type = $menu['sub_type'];
    $menu_item_class = [
        'menu-item',
        'menu-item-type-custom',
    ];

    if ('yes' === $menu['has_sub']) {
        if ('no' !== $menu['sub_menu'] && 'mega' === $sub_type) {
            $item_class = ' menu-item-has-children current-menu-parent menu-item-has-mega';
            array_push($menu_item_class, 'menu-item-has-children', 'tp_mega_menu');
        }
        if ($menu_location && 'default' === $sub_type) {
            array_push($menu_item_class, 'menu-item-has-children', 'nocls');
        }
        if (!empty($icon['value'])) {
            array_push($menu_item_class, 'menu-item-has-icon');
        }
    }

    $classes = implode(' ', $menu_item_class);

    return $classes;
}

function sub_menu_default($menu_id)
{
    $args = [
        'menu' => $menu_id,
        'menu_id' => '',
        'menu_class' => 'sub-menu',
        'container' => '',
    ];

    wp_nav_menu($args);
}

function rendor_custom_nav_menu($setting_menu)
{
    ?>
    <ul class="tp-menu-wrap">

		<?php foreach ($setting_menu as $menu) {
        $icon = $menu['icon'];
        $sub_id = (int) $menu['sub_menu'];
        $sub_type = $menu['sub_type'];
        $menu_location = $menu['menu_register'];
        $item_class = '';
        $classes = menu_item_class($menu); ?>
            <li class="<?php echo esc_attr($classes); ?>">

                <a href="<?php echo esc_url($menu['link']['url']); ?>">
                <span class="menu-item-main-info">
                    <?php
                    if (!empty($icon['value'])) :
                        if (is_string($icon['value'])) :
                            ?>
                            <span class="menu-item-icon <?php echo esc_attr($icon['value']); ?>"></span>
	                    <?php else : ?>

	                    <?php
                        endif;
        endif; ?>

                    <span class="menu-item-text">
                        <?php echo esc_html($menu['item_text']); ?>
                    </span>
                </span>
                </a>
				<?php
                if ($menu['has_sub'] && 'mega' === $sub_type && 'no' !== $menu['sub_menu']) :
                    echo '<div class="xlmegamenu-content-wrapper">' . do_shortcode('[THEPACK_INSERT_TPL id="' . $sub_id . '"]') . '</div>'; elseif ($menu['has_sub'] && $menu_location) :
                    sub_menu_default($menu_location);

        endif; ?>
            </li>
			<?php
    } ?>
    </ul>
	<?php
}

function thepack_get_that_link($link)
{
    $url = isset($link['url']) ? 'href="' . esc_url($link['url']) . '"' : '';
    $ext = isset($link['is_external']) ? ' target= "_blank" ' : '';
    $nofollow = isset($link['nofollow']) ? ' rel= "nofollow" ' : '';
    $link = $url . $ext . $nofollow;

    return $link;
}

function thepack_builder_btn($link, $text)
{
    $url = $link['url'];
    $ext = $link['is_external'];
    $nofollow = $link['nofollow'];
    $url = (isset($url) && $url) ? ' href=' . esc_url($url) . '' : '';
    $ext = (isset($ext) && $ext) ? ' target= "_blank"' : '';
    $nofollow = (isset($url) && $url) ? ' rel= "nofollow"' : '';
    $link = $url . ' ' . $ext . ' ' . $nofollow;

    $btn = $text ? '<a ' . $link . ' class="tour-btn">' . $text . '</a>' : '';

    return $btn;
}

function thepack_build_html($option, $tag = '', $cls = '')
{
    if ($option) {
        $class = $cls ? 'class="' . $cls . '"' : '';
        if ($tag) {
            return '<' . $tag . ' ' . $class . '>' . $option . '</' . $tag . '>';
        } else {
            return $option;
        }
    }
}

function thepack_icon_svg($option, $class = '')
{
    if ($option['library'] == 'svg') {
        return wp_get_attachment_image($option['value']['id'], 'full');
    } else {
        return '<i class="' . $class . ' ' . $option['value'] . '"></i>';
    }
}

function thepack_get_builder_logo($id, $class, $link)
{
    if ($id) {
        $link = $link ? $link : home_url('/');

        return '<a class="tpsite-logo ' . $class . '" href="' . esc_url($link) . '">' . wp_get_attachment_image($id, 'full') . '</a>';
    }
}

function thepack_buildermeta_to_string($items)
{
    if (!is_array($items) || empty($items)) {
        return;
    }
    foreach ($items as $item) {
        $metaf[] = $item['meta'];
    }

    return implode(',', $metaf);
}

function thepack_drop_menu_select()
{
    $menus = wp_get_nav_menus();
    $items = [];
    $i = 0;
    foreach ($menus as $menu) {
        if ($i == 0) {
            $default = $menu->slug;
            $i++;
        }
        $items[$menu->slug] = $menu->name;
    }

    $addsizes = [
        '' => esc_html__('No menu', 'thepack'),
    ];
    $newsizes = array_merge($items, $addsizes);

    //return array_combine($newsizes, $newsizes);
    return $items;
}

function thepack_image_size_choose()
{
    $image_sizes = get_intermediate_image_sizes();
    $addsizes = [
        'full' => esc_html__('Full size', 'thepack'),
    ];
    $newsizes = array_merge($image_sizes, $addsizes);

    return array_combine($newsizes, $newsizes);
}

/*Meta Fields*/

function thepack_background_position()
{
    return [
        'center' => esc_html__('Default', 'thepack'),
        'left top' => esc_html__('Left top', 'thepack'),
        'left center' => esc_html__('Left center', 'thepack'),
        'left bottom' => esc_html__('Left bottom', 'thepack'),
        'right top' => esc_html__('Right top', 'thepack'),
        'right center' => esc_html__('Right center', 'thepack'),
        'right bottom' => esc_html__('Left top', 'thepack'),
        'center bottom' => esc_html__('Center bottom', 'thepack'),
        'center top' => esc_html__('Center top', 'thepack'),
        'center center' => esc_html__('Center center', 'thepack'),
    ];
}

function thepack_animations()
{
    return [
        '' => esc_html__('No animation', 'thepack'),
        'reveal-top' => esc_html__('Animate from top', 'thepack'),
        'reveal-bottom' => esc_html__('Animate from bottom', 'thepack'),
        'reveal-left' => esc_html__('Animate from left', 'thepack'),
        'reveal-right' => esc_html__('Animate from right', 'thepack'),
    ];
}

function jl_elementor_animation()
{
    return [
        '' => esc_html__('No animation', 'thepack'),
        'bounce' => esc_html__('Bounce', 'thepack'),
        'flash' => esc_html__('Flash', 'thepack'),
        'pulse' => esc_html__('Pulse', 'thepack'),
        'rubberBand' => esc_html__('Rubber band', 'thepack'),
        'shake' => esc_html__('Shake', 'thepack'),
        'headShake' => esc_html__('Headshake', 'thepack'),
        'swing' => esc_html__('Swing', 'thepack'),
        'tada' => esc_html__('Tada', 'thepack'),
        'wobble' => esc_html__('Wobble', 'thepack'),
        'jello' => esc_html__('Jello', 'thepack'),
        'bounceIn' => esc_html__('Bounce In', 'thepack'),
        'fadeIn' => esc_html__('Fade In', 'thepack'),
        'rotateIn' => esc_html__('Rotate In', 'thepack'),
        'rollIn' => esc_html__('Roll In', 'thepack'),
        'zoomIn' => esc_html__('Zoom In', 'thepack'),
        'elementor-animation-buzz-out' => esc_html__('Buzz out', 'thepack'),
        'jlspin' => esc_html__('Spin', 'thepack'),
        'tp-float-y' => esc_html__('Float Y', 'thepack'),
        'tp-rotate' => esc_html__('Rotate', 'thepack'),
        'tp-float-y-and-rotate' => esc_html__('Float Y & rotate', 'thepack'),

        'ThePack-animOne' => esc_html__('Floating 1', 'thepack'),
        'ThePack-animTwo' => esc_html__('Floating 2', 'thepack'),
        'ThePack-animThree' => esc_html__('Floating 3', 'thepack'),
        'ThePack-animFour' => esc_html__('Floating 4', 'thepack'),
        'ThePack-animFive' => esc_html__('Floating 5', 'thepack'),

    ];
}

function thepack_bg_images($id = '', $thumb = '')
{
    if ($id) {
        $id = $id;
    } else {
        global $post;
        $id = get_post_thumbnail_id($post->ID);
    }

    $featured_image = wp_get_attachment_image_src($id, $thumb);
    if (!$featured_image) {
        return;
    };
    $image_url = $featured_image[0];
    $lazy = 'data-bg=' . $image_url . '';

    $bg_image = 'background-image:url(' . $image_url . ');';
    $out = ($bg_image) ? 'style=' . $bg_image . '' : '';

    return $lazy;
}

function thepack_overlay_link($url)
{
    $url = [];
    $url = isset($url['url']) ? esc_url($url['url']) : '';
    $target = isset($url['is_external']) ? 'target="_blank"' : '';
    $link = $url ? '<a ' . $target . ' class="tp-overlaylink" href="' . $url . '"></a>' : '';

    return $link;
}

function thepack_ft_images($id = '', $thumb = '')
{
    return wp_get_attachment_image($id, $thumb);
}

function thepack_human_size_byte($bytes, $base = '1024')
{
    if ($bytes == '0') {
        return 0;
    } else {
        $i = floor(log($bytes) / log($base));
        if ($base == '1024') {
            $sizes = ['B', 'KB', 'MB', 'GB', 'TB'];
        } else {
            $sizes = ['', 'K', 'M', 'G', 'T'];
        }

        return sprintf('%.02F', $bytes / pow($base, $i)) * 1 . ' ' . $sizes[$i];
    }
}

function extract_plyr_video($url, $type)
{
    if ($type == 'yt') {
        preg_match("/^(?:http(?:s)?:\/\/)?(?:www\.)?(?:m\.)?(?:youtu\.be\/|youtube\.com\/(?:(?:watch)?\?(?:.*&)?v(?:i)?=|(?:embed|v|vi|user)\/))([^\?&\"'>]+)/", $url, $matches);
        $out = '<div class="plyr__video-embed" data-plyr-provider="youtube" data-plyr-embed-id="' . $matches[1] . '"></div>';
    } elseif ($type == 'vm') {
        preg_match("/(https?:\/\/)?(www\.)?(player\.)?vimeo\.com\/([a-z]*\/)*([0-9]{6,11})[?]?.*/", $url, $output_array);
        $out = '<div class="plyr__video-embed" data-plyr-provider="vimeo" data-plyr-embed-id="' . $output_array[5] . '"></div>';
    } else {
        //self hosted
    }

    return $out;
}

function thepack_breadcum($args)
{
    // Set variables for later use

    $home_text = isset($args['home']) ? $args['home'] : '';
    $author_archive = isset($args['author_archive']) ? $args['author_archive'] : '';
    $search = isset($args['search']) ? $args['search'] : '';
    $error = isset($args['error']) ? $args['error'] : '';
    $delimiter_text = isset($args['delimiter']) ? $args['delimiter'] : '';

    $here_text = '';
    $home_link = home_url('/');
    $link_before = '<span typeof="v:Breadcrumb">';
    $link_after = '</span>';
    $link_attr = ' rel="v:url" property="v:title"';
    $link = $link_before . '<a' . $link_attr . ' href="%1$s">%2$s</a>' . $link_after;
    $delimiter = '<span class="delimiter">' . $delimiter_text . '</span>';              // Delimiter between crumbs
    $before = '<span class="current">'; // Tag before the current crumb
    $after = '</span>';                // Tag after the current crumb
    $page_addon = '';                       // Adds the page number if the query is paged
    $breadcrumb_trail = '';
    $category_links = '';

    /**
     * Set our own $wp_the_query variable. Do not use the global variable version due to
     * reliability
     */
    $wp_the_query = $GLOBALS['wp_the_query'];
    $queried_object = $wp_the_query->get_queried_object();

    // Handle single post requests which includes single pages, posts and attatchments
    if (is_singular()) {
        /**
         * Set our own $post variable. Do not use the global variable version due to
         * reliability. We will set $post_object variable to $GLOBALS['wp_the_query']
         */
        $post_object = sanitize_post($queried_object);

        // Set variables
        $title = apply_filters('the_title', $post_object->post_title);
        $parent = $post_object->post_parent;
        $post_type = $post_object->post_type;
        $post_id = $post_object->ID;
        $post_link = $before . $title . $after;
        $parent_string = '';
        $post_type_link = '';

        if ('post' === $post_type) {
            // Get the post categories
            $categories = get_the_category($post_id);
            if ($categories) {
                // Lets grab the first category
                $category = $categories[0];

                $category_links = get_category_parents($category, true, $delimiter);
                $category_links = str_replace('<a', $link_before . '<a' . $link_attr, $category_links);
                $category_links = str_replace('</a>', '</a>' . $link_after, $category_links);
            }
        }

        if (!in_array($post_type, ['post', 'page', 'attachment'])) {
            $post_type_object = get_post_type_object($post_type);
            $archive_link = esc_url(get_post_type_archive_link($post_type));

            $post_type_link = sprintf($link, $archive_link, $post_type_object->labels->singular_name);
        }

        // Get post parents if $parent !== 0
        if (0 !== $parent) {
            $parent_links = [];
            while ($parent) {
                $post_parent = get_post($parent);

                $parent_links[] = sprintf($link, esc_url(get_permalink($post_parent->ID)), get_the_title($post_parent->ID));

                $parent = $post_parent->post_parent;
            }

            $parent_links = array_reverse($parent_links);

            $parent_string = implode($delimiter, $parent_links);
        }

        // Lets build the breadcrumb trail
        if ($parent_string) {
            $breadcrumb_trail = $parent_string . $delimiter . $post_link;
        } else {
            $breadcrumb_trail = $post_link;
        }

        if ($post_type_link) {
            $breadcrumb_trail = $post_type_link . $delimiter . $breadcrumb_trail;
        }

        if ($category_links) {
            $breadcrumb_trail = $category_links . $breadcrumb_trail;
        }
    }

    // Handle archives which includes category-, tag-, taxonomy-, date-, custom post type archives and author archives
    if (is_archive()) {
        if (is_category()
             || is_tag()
             || is_tax()
        ) {
            // Set the variables for this section
            $term_object = get_term($queried_object);
            $taxonomy = $term_object->taxonomy;
            $term_id = $term_object->term_id;
            $term_name = $term_object->name;
            $term_parent = $term_object->parent;
            $taxonomy_object = get_taxonomy($taxonomy);
            $current_term_link = $before . $taxonomy_object->labels->singular_name . ': ' . $term_name . $after;
            $parent_term_string = '';

            if (0 !== $term_parent) {
                // Get all the current term ancestors
                $parent_term_links = [];
                while ($term_parent) {
                    $term = get_term($term_parent, $taxonomy);

                    $parent_term_links[] = sprintf($link, esc_url(get_term_link($term)), $term->name);

                    $term_parent = $term->parent;
                }

                $parent_term_links = array_reverse($parent_term_links);
                $parent_term_string = implode($delimiter, $parent_term_links);
            }

            if ($parent_term_string) {
                $breadcrumb_trail = $parent_term_string . $delimiter . $current_term_link;
            } else {
                $breadcrumb_trail = $current_term_link;
            }
        } elseif (is_author()) {
            $breadcrumb_trail = $author_archive . $before . $queried_object->data->display_name . $after;
        } elseif (is_date()) {
            // Set default variables
            $year = $wp_the_query->query_vars['year'];
            $monthnum = $wp_the_query->query_vars['monthnum'];
            $day = $wp_the_query->query_vars['day'];

            // Get the month name if $monthnum has a value
            if ($monthnum) {
                $date_time = DateTime::createFromFormat('!m', $monthnum);
                $month_name = $date_time->format('F');
            }

            if (is_year()) {
                $breadcrumb_trail = $before . $year . $after;
            } elseif (is_month()) {
                $year_link = sprintf($link, esc_url(get_year_link($year)), $year);

                $breadcrumb_trail = $year_link . $delimiter . $before . $month_name . $after;
            } elseif (is_day()) {
                $year_link = sprintf($link, esc_url(get_year_link($year)), $year);
                $month_link = sprintf($link, esc_url(get_month_link($year, $monthnum)), $month_name);

                $breadcrumb_trail = $year_link . $delimiter . $month_link . $delimiter . $before . $day . $after;
            }
        } elseif (is_post_type_archive()) {
            $post_type = $wp_the_query->query_vars['post_type'];
            $post_type_object = get_post_type_object($post_type);

            $breadcrumb_trail = $before . $post_type_object->labels->singular_name . $after;
        }
    }

    // Handle the search page
    if (is_search()) {
        $breadcrumb_trail = $search . $before . get_search_query() . $after;
    }

    // Handle 404's
    if (is_404()) {
        $breadcrumb_trail = $before . $error . $after;
    }

    // Handle paged pages
    if (is_paged()) {
        $current_page = get_query_var('paged') ? get_query_var('paged') : get_query_var('page');
        $page_addon = $before . sprintf(esc_html__(' ( Page %s )'), number_format_i18n($current_page)) . $after;
    }

    $breadcrumb_output_link = '';
    $breadcrumb_output_link .= '<div class="xlbreadcrumb"><div class="inner">';
    if (is_home()
         || is_front_page()
    ) {
        // Do not show breadcrumbs on page one of home and frontpage
        if (is_paged()) {
            $breadcrumb_output_link .= $here_text . $delimiter;
            $breadcrumb_output_link .= '<a href="' . $home_link . '">' . $home_text . '</a>';
            $breadcrumb_output_link .= $page_addon;
        }
    } else {
        $breadcrumb_output_link .= '<a href="' . $home_link . '" rel="v:url" property="v:title">' . $home_text . '</a>';
        $breadcrumb_output_link .= $delimiter;
        $breadcrumb_output_link .= $breadcrumb_trail;
        $breadcrumb_output_link .= $page_addon;
    }
    $breadcrumb_output_link .= '</div></div><!-- .breadcrumbs -->';

    return $breadcrumb_output_link;
}
