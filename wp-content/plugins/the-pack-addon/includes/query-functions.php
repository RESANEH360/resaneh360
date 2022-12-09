<?php

/*Meta Fields*/
function thepack_metaa_fields()
{
    return [
        'tag' => esc_html__('Tag', 'thepackpro'),
        'cat' => esc_html__('Category color', 'thepackpro'),
        'cat_bg' => esc_html__('Category background color', 'thepackpro'),
        'title' => esc_html__('Post title & permalink', 'thepackpro'),
        'title_nolink' => esc_html__('Post title no permalink', 'thepackpro'),
        'title_single' => esc_html__('Single post title', 'thepackpro'),
        'time' => esc_html__('Date', 'thepackpro'),
        'share' => esc_html__('Share button', 'thepackpro'),
        'thumb' => esc_html__('Thumbnail', 'thepackpro'),
        'excerpt' => esc_html__('Excerpt', 'thepackpro'),
        'space' => esc_html__('Space with separator', 'thepackpro'),
        'clear' => esc_html__('Clear section', 'thepackpro'),
        'clear10' => esc_html__('Clear with 10px width', 'thepackpro'),
        'h5' => esc_html__('Clear with 5px height', 'thepackpro'),
        'h10' => esc_html__('Clear with 10px height', 'thepackpro'),
        'w10' => esc_html__('Width 10px', 'thepackpro'),
        'hr' => esc_html__('Horizontal line', 'thepackpro'),
        'btn' => esc_html__('Readmore Button', 'thepackpro'),
        'author' => esc_html__('Author', 'thepackpro'),
        'comment' => esc_html__('Comment No', 'thepackpro'),
    ];
}

/*Meta Fields*/
function thepack_orderby_post()
{
    return [
        'none' => esc_html__('No order', 'thepackpro'),
        'ID' => esc_html__('Post ID', 'thepackpro'),
        'author' => esc_html__('Author', 'thepackpro'),
        'title' => esc_html__('Title', 'thepackpro'),
        'date' => esc_html__('Published date', 'thepackpro'),
        'modified' => esc_html__('Modified date', 'thepackpro'),
        'parent' => esc_html__('By parent', 'thepackpro'),
        'rand' => esc_html__('Random order', 'thepackpro'),
        'comment_count' => esc_html__('Comment count', 'thepackpro'),
        'menu_order' => esc_html__('Menu order', 'thepackpro'),
        'post__in' => esc_html__('By include order', 'thepackpro'),
    ];
}

function thepaack_drop_taxolist()
{
    $args = [
        'public' => true,
        '_builtin' => false

    ];
    $output = 'names';
    $operator = 'or';

    $taxonomies = get_taxonomies($args, $output, $operator);

    return $taxonomies;
}

if (!function_exists('thepack_postedd_on')) :
    /**
     * Prints HTML with meta information for the current post-date/time and author.
     */
    function thepack_postedd_on()
    {
        $time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';

        $time_string = sprintf(
            $time_string,
            esc_attr(get_the_date('c')),
            esc_html(get_the_date())
        );

        $posted_on = sprintf(
            _x('%s', 'post date', 'thepackpro'),
            $time_string
        );

        return '<span class="magnews-posted-on leffect-1"><i class="dashicons dashicons-calendar-alt"></i>' . $posted_on . '</span>';
    }
endif;

function thepack_social_post_share()
{
    if (has_post_thumbnail()) {
        $share_image = wp_get_attachment_image_src(get_post_thumbnail_id(), '');
        $share_image = $share_image[0];
        $share_image_portrait = wp_get_attachment_image_src(get_post_thumbnail_id(), '');
        $share_image_portrait = $share_image_portrait[0];
    } else {
        $share_image = '';
        $share_image_portrait = '';
    }
    $share_excerpt = strip_tags(get_the_excerpt(), '<b><i><strong><a>');
    $html = '<div class="xld_sharelist">
        <a href="http://www.facebook.com/sharer.php?u=' . rawurlencode(get_the_permalink()) . '" ><i class="fa fa-facebook"></i></a>
        <a href="http://twitter.com/intent/tweet?text=' . rawurlencode(get_the_title()) . '&amp;url=' . rawurlencode(get_the_permalink()) . '"><i class="fa fa-twitter"></i></a>
        <a href="http://www.linkedin.com/shareArticle?mini=true&amp;url=' . rawurlencode(get_the_permalink()) . '&amp;title=' . rawurlencode(get_the_title()) . '&amp;summary=' . rawurlencode($share_excerpt) . '&amp;source=' . rawurlencode(get_bloginfo('name')) . '"><i class="fa fa-linkedin"></i></a>
        <a href="http://pinterest.com/pin/create/button/?url=' . rawurlencode(get_the_permalink()) . '&amp;media=' . rawurlencode($share_image_portrait) . '&amp;description=' . rawurlencode(get_the_title()) . '"><i class="fa fa-pinterest"></i></a>

    </div>';

    return $html;
}

function thepack_builder_comment()
{
    if (!post_password_required()) {
        $num_comments = get_comments_number();

        if (comments_open()) {
            if ($num_comments == 0) {
                $comments = esc_html__('0 Comment', 'thepackpro');
            } elseif ($num_comments > 1) {
                $comments = $num_comments . esc_html__(' Comments', 'thepackpro');
            } else {
                $comments = esc_html__('1 Comment', 'thepackpro');
            }
            $write_comments = $comments;
        } else {
            $write_comments = esc_html__('off', 'thepackpro');
        }

        return '<span class="post-comment leffect-1"><i class="dashicons dashicons-admin-comments"></i>' . $write_comments . '</span>';
    }
}

function thepack_builder_author()
{
    return '<span class="post-meta-author leffect-1">
            <span class="meta-author-name"><i class="dashicons dashicons-admin-users"></i>' . get_the_author_posts_link() . '</span>
        </span>';
}

function thepack_builder_width_10()
{
    return '<span class="width10"></span>';
}

function thepack_builder_post_title()
{
    global $post;
    $id = $post->ID;

    return '<h2 class="title"><a href="' . get_the_permalink($id) . '">' . get_the_title($id) . '</a></h2>';
}

function thepack_builder_readmore($readmore)
{
    global $post;
    $id = $post->ID;

    return '<a class="btn-more" href="' . get_the_permalink($id) . '">Read More</a>';
}

function thepack_builder_post_title_nolink()
{
    global $post;
    $id = $post->ID;

    return '<h2 class="title">' . get_the_title($id) . '</h3>';
}

/*Space*/

function thepack_builder_post_spacer()
{
    $out = '<hr class="hr-sep">';

    return $out;
}

/*Space*/

function thepack_builder_spacemeta()
{
    $out = '<span class="meta-space leffect-1">-</span>';

    return $out;
}

function thepack_builder_clearifix()
{
    $out = '<div class="meta-clearing-color"></div>';

    return $out;
}

function thepack_builder_clearifixh5()
{
    $out = '<div class="meta-clearing height5"></div>';

    return $out;
}

function thepack_builder_clearifixh10()
{
    $out = '<div class="meta-clearing height10"></div>';

    return $out;
}

/**
 * Display category background based on theme options
 */

if (!function_exists('thepack_builder_singlecat_bg')) :

    function thepack_builder_singlecat_bg($default = true)
    {
        if ('post' == get_post_type()) {
            $categories = get_the_category();
            $separator = ' ';

            $output = '';
            if ($categories) {
                foreach ($categories as $category) {
                    /* getting cat bg color.$term_data = get_term_meta( $category->term_id, '_custom_taxonomy_options', true );$style = $term_data ? 'style=background:'.$term_data["cat_color"].'' : '';*/

                    $output .= '<a class="cat-bg" href="' . get_category_link($category->term_id) . '">' . $category->cat_name . '</a>' . $separator;
                }
                $cat = trim($output, $separator);

                return '<span class="catbg-wrap">' . $cat . '</span>';
            }
        }
    }
endif;

/**
 * Estimate time required to read the article
 *
 * @return string
 */
function thepack_builder_reading_time()
{
    $word_count = floor(str_word_count(get_the_content()) / 120);
    if ($word_count >= 1) {
        $out = sprintf(_n('%d min', '%d min', $word_count, 'thepackpro'), $word_count);

        return '<span class="reading-time leffect-1">' . $out . ' Read</span>';
    }
}

/**
 * Display category based on theme options
 */

if (!function_exists('thepack_builder_single_cat')) :

    function thepack_builder_single_cat($default = true)
    {
        if ('post' == get_post_type()) {
            $categories = get_the_category();
            if ($default == true) {
                $separator = ' ';
            } else {
                $separator = ' ,';
            }

            $output = '';
            if ($categories) {
                foreach ($categories as $category) {
                    $output .= '<a class="bgcat-links" href="' . get_category_link($category->term_id) . '">' . $category->cat_name . '</a>' . $separator;
                }
                $cat = trim($output, $separator);

                return '<span class="leffect-1"><i class="dashicons dashicons-open-folder"></i>' . $cat . '</span>';
            }
        }
    }
endif;

if (!function_exists('thepack_builder_tag_post')) :

    /**
     * Prints HTML with meta information for the categories, tags and comments.
     */
    function thepack_builder_tag_post()
    {
        if ('post' == get_post_type()) {
            $posttags = get_the_tags();
            $separator = '';
            $output = '';
            if ($posttags) {
                foreach ($posttags as $tag) {
                    $output .= '<span><a href="' . get_tag_link($tag->term_id) . '">' . $tag->name . '</a></span>' . $separator;
                }

                $tags = trim($output, $separator);

                return '<span class="tags-links leffect-1">' . $tags . '</span>';
            }
        }
    }
endif;

//Custom excerpt

function thepack_builder_excerptscode($limit)
{
    if ($limit > '0') {
        global $post;
        $id = $post->ID;
        $outpu = wp_trim_words(get_the_content(), $limit, '');

        return '<p class="post-entry">' . $outpu . '</p>';
    }
}

function thepack_builder_folio_excerpt($limit)
{
    if ($limit > '0') {
        global $post;
        $id = $post->ID;

        if (has_excerpt($id)) {
            $string = get_the_excerpt();
        } else {
            $string = get_the_content();
        }

        $excerpt = strip_tags($string);
        $excerpt = substr($excerpt, 0, $limit);
        $outpu = $excerpt;

        return '<p class="post-entry">' . $outpu . '</p>';
    }
}

/**
 * Display post tag,category,date,author
 */

function thepack_build_postmeta($metas = '', $excerpt_length = '', $readmore = '', $thumbsize = '')
{
    if (!is_array($metas)) {
        $metas = explode(',', $metas);
    }
    if (is_array($metas)) {
        $outz = '';
        foreach ($metas as $meta) {
            $out = '';

            switch ($meta) {
                case 'tag':
                    $out = thepack_builder_tag_post();
                    break;

                case 'cat':
                    $out = thepack_builder_single_cat(false);
                    break;

                case 'cat_bg':
                    $out = thepack_builder_singlecat_bg(false);
                    break;

                case 'time':
                    $out = thepack_postedd_on();
                    break;

                case 'title':
                    $out = thepack_builder_post_title();
                    break;

                case 'hr':
                    $out = thepack_builder_post_spacer();
                    break;

                case 'clear':
                    $out = thepack_builder_clearifix();
                    break;

                case 'clear10':
                    $out = thepack_builder_clearifix();
                    break;

                case 'h5':
                    $out = thepack_builder_clearifixh5();
                    break;

                case 'h10':
                    $out = thepack_builder_clearifixh10();
                    break;

                case 'btn':
                    $out = thepack_builder_readmore($readmore);
                    break;

                case 'reading':
                    $out = thepack_builder_reading_time();
                    break;

                case 'share':
                    $out = magnews_share_post();
                    break;

                case 'space':
                    $out = thepack_builder_spacemeta();
                    break;

                case 'view':
                    $out = thepack_builder_post_title();
                    break;

                case 'title_nolink':
                    $out = thepack_builder_post_title_nolink();
                    break;

                case 'author':
                    $out = thepack_builder_author();
                    break;

                case 'w10':
                    $out = thepack_builder_width_10();
                    break;

                case 'comment':
                    $out = thepack_builder_comment();
                    break;

                case 'excerpt':
                    $out = thepack_builder_excerptscode($excerpt_length);
                    break;
            }

            if (!empty($meta)) {
                $outz .= $out;
            }
        }
        echo '<div class="meta-wrap">' . $outz . '</div>';
    }
}

function thepack_pro_single_title($arg)
{
    if (is_category()) {
        /* translators: Category archive title. 1: Category name */
        $title = single_cat_title($arg['cat'], false);
    } elseif (is_tag()) {
        /* translators: Tag archive title. 1: Tag name */
        $title = single_cat_title($arg['tag'], false);
    } elseif (is_author()) {
        $title = sprintf($arg['author'] . '%s', '<span class="archive-highlight">' . get_the_author() . '</span>');
    //$title = get_the_author( 'Author: ', true );
    } elseif (is_year()) {
        /* translators: Yearly archive title. 1: Year */
        $title = sprintf($arg['yarchive'], '<span class="archive-highlight">' . get_the_date('F Y', 'yearly archives date format') . '</span>');
    } elseif (is_month()) {
        /* translators: Monthly archive title. 1: Month name and year */
        $title = sprintf($arg['marchive'], '<span class="archive-highlight">' . get_the_date('F Y', 'monthly archives date format') . '</span>');
    } elseif (is_404()) {
        /* translators: Daily archive title. 1: Date */
        $title = $arg['notfound'];
    } elseif (is_post_type_archive()) {
        /* translators: Post type archive title. 1: Post type name */
        $title = post_type_archive_title('', false);
    } elseif (is_tax()) {
        $tax = get_taxonomy(get_queried_object()->taxonomy);
        /* translators: Taxonomy term archive title. 1: Taxonomy singular name, 2: Current taxonomy term */
        $title = single_term_title('', false);
    } elseif (is_search()) {
        $title = sprintf($arg['search'] . '%s', '<span class="archive-highlight">' . get_search_query() . '</span>');
    } elseif (is_home() && is_front_page()) {
        $title = esc_html__('Home', 'thepack-pro');
    } elseif (is_singular()) {
        $title = get_the_title();
    } else {
        $title = esc_html__('Archives', 'thepack-pro');
    }

    return $title;
}

function thepack_drop_cat()
{
    foreach (get_taxonomies() as $item) {
        $comma_string[] = $item;
    }

    $args = [
        'taxonomy' => $comma_string,
    ];
    $categories_obj = get_categories($args);
    $categories = [];

    foreach ($categories_obj as $pn_cat) {
        $categories[$pn_cat->cat_ID] = $pn_cat->cat_name . '-' . $pn_cat->taxonomy;
    }

    return $categories;
}

function thepack_list_post_type()
{
    $args = [
        'public' => true,
        '_builtin' => false,
    ];

    $output = 'names'; // names or objects, note names is the default
    $operator = 'or'; // 'and' or 'or'

    $post_types = get_post_types($args, $output, $operator);
    $list = [];
    foreach ($post_types as $cpost) {
        $list[$cpost] = $cpost;
    }

    return $list;
}

function thepack_drop_posts($post_type)
{
    $args = [
        'numberposts' => -1,
        'post_type' => $post_type
    ];

    $posts = get_posts($args);
    $list = [];
    foreach ($posts as $cpost) {
        $list[$cpost->ID] = $cpost->post_title;
    }

    return $list;
}

function thepack_folio_cat($taxonomy)
{
    global $post;
    $output = '';
    $terms = wp_get_post_terms($post->ID, $taxonomy);
    $separator = ', ';
    if ($terms) {
        foreach ($terms as $term) {
            $term_link = get_term_link($term);
            $tax_id = get_term($term->term_id, $taxonomy);
            /*Count tax posts $count = $tax_id->count*/
            $output .= '<span class="gallery-cat">' . $term->name . '</span>' . $separator;
        }
        echo trim($output, $separator);
    }
}

function thepack_builder_post_pagination($type, $loop, $show)
{
    if ($show == null) {
        return;
    }

    global $wp_query;
    if ($type) {
        $p = $wp_query;
    } else {
        $p = $loop;
    }
    $total_pages = $p->max_num_pages;
    $big = 999999999;
    $args = [
        'base' => str_replace($big, '%#%', esc_url(get_pagenum_link($big))),
        'format' => '?page=%#%',
        'total' => $p->max_num_pages,
        'current' => max(1, get_query_var('paged')),
        'show_all' => false,
        'end_size' => 1,
        'mid_size' => 1,
        'prev_next' => true,
        'prev_text' => '&larr;',
        'next_text' => '&rarr;',
        'type' => 'list',
    ];
    if ($total_pages > 1) {
        echo '<div class="tp-post-pagination">';
        echo paginate_links($args);
        echo '</div>';
    }
}

function thepack_previous_post_id($post_id)
{
    global $post;
    $oldGlobal = $post;
    $post = get_post($post_id);
    $previous_post = get_previous_post();
    $post = $oldGlobal;
    if ('' == $previous_post) {
        return false;
    }

    return $previous_post->ID;
}

function thepack_next_post_id($post_id)
{
    global $post;
    $oldGlobal = $post;
    $post = get_post($post_id);
    $next_post = get_next_post();
    $post = $oldGlobal;
    if ('' == $next_post) {
        return false;
    }

    return $next_post->ID;
}

add_filter('wp_list_comments_args', function ($args) {
    $args['callback'] = 'thepack_pro_comment_callback';

    return $args;
});

function thepack_pro_comment_callback($comment, $args, $depth)
{
    if ('div' === $args['style']) {
        $tag = 'div';
        $add_below = 'comment';
    } else {
        $tag = 'li';
        $add_below = 'div-comment';
    } ?>
<<?php echo esc_attr($tag); ?><?php comment_class(empty($args['has_children']) ? '' : 'parent') ?>
    id="comment-<?php comment_ID() ?>">
    <?php if ('div' != $args['style']) : ?>
    <div id="div-comment-<?php comment_ID() ?>" class="article">
        <?php endif; ?>

        <div class="author-pic"><?php if ($args['avatar_size'] != 0) {
        echo get_avatar($comment, 100);
    } ?>
        </div>
        <div class="details">

            <?php printf(__('<h4 class="user-name">%s</h4>', 'thepackpro'), get_comment_author_link()); ?>
            <span class="user-date"><?php printf(__('%1$s', 'thepackpro'), get_comment_date()); ?></span>

            <?php if ($comment->comment_approved == '0') : ?>
            <em class="comment-awaiting-moderation"><?php esc_attr_e('Your comment is awaiting moderation.', 'thepac'); ?></em>
            <?php endif; ?>

            <p class="user-comment"><?php echo get_comment_text(); ?>
            <p>
                <?php comment_reply_link(array_merge($args, [
                    'add_below' => $add_below,
                    'depth' => $depth,
                    'max_depth' => $args['max_depth']
                ])); ?>

        </div>

        <?php if ('div' != $args['style']) : ?>
    </div>
    <?php endif; ?>
    <?php
}
