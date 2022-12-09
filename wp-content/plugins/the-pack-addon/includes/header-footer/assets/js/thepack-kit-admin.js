(function( $ ) {
    'use strict';

    $(function (){
        var $elementor_root_menu = $('#menu-posts-elementor_library.wp-has-current-submenu'),
            $thepack_option_root = $('#toplevel_page_the-pack');

        if($elementor_root_menu.length && $elementor_root_menu.find('a.current').length == 0 && $thepack_option_root.length > 0){
            $elementor_root_menu.removeClass('wp-has-current-submenu wp-menu-open').addClass('wp-not-current-submenu');
            $elementor_root_menu.children('a').removeClass('wp-has-current-submenu wp-menu-open').addClass('wp-not-current-submenu')
            $thepack_option_root.removeClass('wp-not-current-submenu').addClass('wp-has-current-submenu wp-menu-open');
            $thepack_option_root.children('a').removeClass('wp-not-current-submenu').addClass('wp-has-current-submenu wp-menu-open');
            $thepack_option_root.find('ul > li:last-child').addClass('current').find('a').addClass('current');
        }
    })

})( jQuery );