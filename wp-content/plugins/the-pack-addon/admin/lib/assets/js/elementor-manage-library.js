(function ($) {

   'use strict';

    var THEPACK_LIB;

    THEPACK_LIB = {

        init: function () {

            window.elementor.on(
                'document:loaded',
                window._.bind(THEPACK_LIB.onPreviewLoaded, THEPACK_LIB)
            );
        },

        onPreviewLoaded: function () {

            var main_wrap = $('#elementor-preview-iframe').contents();
            var wrapper_html = "<div style='display:none;' class='tp-lib-wrap'>"
                                    +"<div class='lib-inner-wrap'>"
                                        +"<div class='header'>"
                                            +"<div class='lhead'>"
                                                +"<h2 class='lib-logo'>Library</h2>"
                                                +"<h2 class='back-to-home'>Back to template</h2>"
                                            +"</div>"
                                            +"<div class='centerhead'>"
                                                +"<ul>"
                                                   +"<li data-type='element' class='active'>Elements</li>"
                                                   +"<li data-type='section'>Section</li>"
                                                   +"<li data-type='header-footer'>Header footer</li>"
                                                   +"<li data-type='theme-builder'>Theme builder</li>"
                                                   +"<li data-type='page'>Page</li>"
                                                +"<ul>"
                                            +"</div>"                                            
                                            +"<div class='rhead'>"
                                                +"<i class='eicon-sync'></i>"
                                                +"<i class='lib-close eicon-close'></i>"
                                            +"</div>"                                            
                                        +"</div>"
                                        +"<div class='lib-inner'>"
                                            +"<div class='search-input'>"
                                                +"<input class='xl-search' type='text' placeholder='Type & hit enter'>"
                                            +"</div>"
                                            +"<div class='lib-content'>"
                                            +"</div>"
                                            +"<div class='tp-loader'>"
                                            +"</div>"
                                        +"</div>"
                                    +"</div>"
                                    +"<div data-type='element' class='xl-settings'></div>"
                                +"</div>";

            main_wrap.find('.elementor-add-template-button').after("<div class='elementor-add-section-area-button the-pack-add-button' style='background:black;margin-left:10px;'><i class='eicon-flash'></i></div>");

            $('#elementor-editor-wrapper').append(wrapper_html);
            main_wrap.find('.the-pack-add-button').click(function(){

                $('#elementor-editor-wrapper').find('.tp-lib-wrap').show();
                var ajax_data = {
                    page : '1',
                    category:'',
                    type : 'element',
                };
                process_data(ajax_data);

            });

            $(document).on('click', '.insert-tmpl', function(e) {

                var tmpl_id = $(this).data('id');
                var parent_site = $(this).data('parentsite');
                $('.lib-inner').addClass('loading');
                if ( $(this).hasClass('sites')) {
                    var ajax_action = 'the_pack_import_sites_xml';
                    var ele_tmpl = false;
                } else {
                    var ajax_action = 'the_pack_import_template';
                    var ele_tmpl = true;
                }
                if (!ele_tmpl){
                    if (!confirm('All current content including images will be deleted !')) {
                        $('.lib-inner').removeClass('loading');
                        return false;
                    }
                }
                

                $.ajax({
                    type: 'POST',
                    url: ajaxurl, 
                    data: {
                      action: ajax_action,
                      id: tmpl_id,
                      parent_site: parent_site,
                    },
                    beforeSend: function() {

                        $(".lib-inner").animate({ scrollTop: 0 }, "slow");
                    },                    
                    success: function(data, textStatus, XMLHttpRequest) {
 
                        if ( ele_tmpl ){

                            var xl_data = JSON.parse(data); 
                            elementor.getPreviewView().addChildModel(xl_data, {silent: 0});
                            $('.lib-content').removeClass('loading');
                            $('#elementor-editor-wrapper').find('.tp-lib-wrap').hide();

                        } else {

                            $('.lib-inner').removeClass('loading');
                            window.location.href = thepack_lib_params.site;
                        }

                    },
                    error: function (jqXHR, exception) {
                        console.log(exception);
                    }, 

                  });
            });

            $(document).on('click', '.rhead .eicon-sync', function(e) {
                $('.lib-inner').addClass('loading');
                $('.xl-search').val('');
                $.ajax({
                    type: 'POST',
                    url: ajaxurl,
                    data: {
                      action: 'xl_tab_reload_template',
                    },
                    success: function(data, textStatus, XMLHttpRequest) {
                        $('.xl-loader').hide();
                        var ajax_data = {
                            page : '1',
                            category:'',
                            type : 'element',
                        };
                        process_data(ajax_data);                        
                    },
                  });
            });

            $(document).on('click', '.lib-img-wrap', function(e) {
                var live_link = $(this).data('preview');
                var win = window.open( live_link, '_blank');
                if (win) {
                    //Browser has allowed it to be opened
                    win.focus();
                } else {
                    //Browser has blocked it
                    alert('Please allow popups for this website');
                } 
            });

            $(document).on('click', '.page-link', function(e) {
                $('.lib-inner').addClass('loading');
                var page_no = $(this).data('page-number');
                var category = $('#elementor-editor-wrapper').find('.xl-settings').attr('data-catsettings');
                var type = $('#elementor-editor-wrapper').find('.xl-settings').attr('data-type');
                var search = $('#elementor-editor-wrapper').find('.xl-settings').attr('data-search');
                $('#elementor-editor-wrapper').find('.xl-settings').attr('data-pagesettings', page_no);
                var ajax_data = {
                    page: page_no,
                    category: category,
                    type : type,
                    search : search,
                };
                process_data(ajax_data);
            });

            $(document).on('click', '.filter-wrap a', function(e) {
                var category = $(this).data('cat');
                $('#elementor-editor-wrapper').find('.xl-settings').attr('data-catsettings', category);
                $('.lib-inner').addClass('loading');
                var ajax_data = {
                    page : '1',
                    category:category,
                };
                process_data(ajax_data);
            });

            $(document).on('keypress', '.xl-search', function(e) {
                if(e.which == 13) {
                    var search = $(this).val();
                    $('#elementor-editor-wrapper').find('.xl-settings').attr('data-search', search);
                    var type = $('#elementor-editor-wrapper').find('.xl-settings').attr('data-type');
                    $('.lib-inner').addClass('loading');
                    var ajax_data = {
                        page : '1',
                        type : type,
                        search : search,
                    };
                    process_data(ajax_data);
                }
            });

            // Top type filter
            $(document).on('click', '.centerhead li', function(e) {
                var type = $(this).data('type');
                $(this).addClass("active").siblings().removeClass("active");
                $('#elementor-editor-wrapper').find('.xl-settings').attr('data-type', type);
                $('.lib-inner').addClass('loading');
                $('.xl-search').val('');
                $('#elementor-editor-wrapper').find('.xl-settings').attr('data-search','');
                var ajax_data = {
                    page : '1',
                    category:'',
                    type : type,
                };
                process_data(ajax_data);
            });

            function process_data($data){

                  $.ajax({
                    type: 'POST',
                    url: ajaxurl,
                    data: {
                      action: 'process_ajax',
                      data : $data,
                    },

                    beforeSend: function() {

                        $(".lib-inner").animate({ scrollTop: 0 }, "slow");
                    },

                    success: function(data, textStatus, XMLHttpRequest) {

                        $('.lib-inner').removeClass('loading');
                        $('.lib-content').html(data);
                        if ( data == '0'){
                            $('.rhead .eicon-sync').trigger('click');
                        }

                        $('.item-wrap').masonry({
                            itemSelector: '.item',
                            isAnimated: false,
                            transitionDuration: 0
                        });

                        $('.item-wrap').masonry('reloadItems');
                        $('.item-wrap').masonry('layout');

                        $('.item-wrap').imagesLoaded( function() {
                        $('.item-wrap').masonry('layout');
                        });
                    },

                  });
            }

            $('#elementor-editor-wrapper').find('.lib-close').click(function(){
                $('#elementor-editor-wrapper').find('.tp-lib-wrap').hide();
                $('.live-preview').html('');
                $('.lib-content').show();
                $('.back-to-home').hide();
            });
        },

    };

    $(window).on('elementor:init', THEPACK_LIB.init);

})(jQuery);