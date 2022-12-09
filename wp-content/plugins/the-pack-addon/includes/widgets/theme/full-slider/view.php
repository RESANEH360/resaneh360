<?php

use Elementor\Plugin;

$excerpt = $settings['excerpt']['size'];
$per_page = $settings['posts_per_page']['size'];
$meta = thepack_buildermeta_to_string($settings['metas']);

$cat = $settings['cat_query'];
$id = $settings['id_query'];


if ($settings['query_type'] == 'category') {
    $query_args = [
        'post_type' => 'post',
        'posts_per_page' => $per_page,
        'tax_query' => [
            [
                'taxonomy' => 'category',
                'field' => 'term_id',
                'terms' => $cat,
            ],
        ],
    ];
}

if ($settings['query_type'] == 'individual') {
    $query_args = [
        'post_type' => 'post',
        'posts_per_page' => $per_page,
        'post__in' => $id,
        'orderby' => 'post__in'
    ];
}

$slider_options = [
    'arrows' => ('yes' === $settings['arrow']),
    'auto' => ('yes' === $settings['auto']),
    'transition' => $settings['transition'],
    'speed' => $settings['speed']['size'],
];

$previkn = $settings['picon']['value'] ? '<div class="khbprnx khbnxt"><i class="' . $settings['picon']['value'] . '"></i></div>' : '';
$nextikn = $settings['nicon']['value'] ? '<div class="khbprnx khbprev"><i class="' . $settings['nicon']['value'] . '"></i></div>' : '';
$arrow   = $settings['arrow'] ? '<div class="khbpnwrap">'.$previkn . $nextikn.'</div>' : '';
$dot     = $settings['dot'] ? '<div class="swiper-pagination"></div>' : '';


$loop = new \WP_Query($query_args); ?>

<div class="thepack-slider-four thepack-swiper swiper">
  <?php echo '<div class="swiper-wrapper" data-slick =\''.wp_json_encode($slider_options).'\'>';?>
      <?php if ($loop->have_posts()) : ?>
              <?php while ($loop->have_posts()) : $loop->the_post();
               ?>

                  <div  class="swiper-slide inner">
                     <div class="inrwrapper lazyload" <?php echo thepack_bg_images(); ?>>   
                      <div class="excerpt-wrap">
                        <div class="inrexcerpt">
                          <?php thepack_build_postmeta($meta,$excerpt);?>
                        </div>
                      </div>                                            
                    </div>
                  </div>
       
              <?php endwhile; ?>

              <?php wp_reset_postdata(); ?>
              
      <?php endif;?>
  </div>
  <?php echo $arrow.$dot;?>
</div>

