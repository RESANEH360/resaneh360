(function($) {
    "use strict";

    $(document).ready(function() {

        var import_running = false;
        $(document).on('click', '.btn-import-xml.import', function(e){  
          if (import_running) return false;
          if (!confirm('All current content including images will be deleted !')) return false;
            var el = $(this);
            var xml   = el.data('xml');
            var frontpage   = el.data('front');
            var demo_holder = el.parent().parent();
            var importqueue = [],
            processqueue = function(){
              if (importqueue.length != 0){
                var importaction = importqueue.shift();
                $.ajax({
                  type: 'POST',
                  url: janelove.ajax_url,
                  data: {
                    action: importaction,
                    xml: xml,
                    frontpage: frontpage,
                  },
                  success: processqueue
                });
              }
              else {
                demo_holder.removeClass('running');
                setTimeout(function(){ window.open(janelove.site_url, '_blank'); }, 2000);
                import_running = false;
              }
            };

          importqueue.push('the_pack_clean_data');
          importqueue.push('the_pack_import_xml');
          //importqueue.push('niobis_import_options');

          if (importqueue.length == 0) return false;

          import_running = true;
          demo_holder.addClass('running');
          processqueue();

          return false;
        });

        var contain = $('.demo-inner');
        contain.imagesLoaded(function() {
            contain.masonry({
                itemSelector: '.demo',
                isAnimated: false,
                transitionDuration: '7.5s'
            });
        });


        $(document).on('click', '.page-link', function(e){
          e.preventDefault();
          $('.xlimwrap').addClass('loading');  

            var page_no = $(this).data('page-number');

          var ajax_data = {
            page : page_no,
          };
          process_demo_tab(ajax_data);

      });

      function process_demo_tab($data){
        $.ajax({
          type: 'POST',
          url: janelove.ajax_url,
          data: {
            action: 'display_import_page',
            data : $data,
          },   

          beforeSend: function() {

            $(".xlimwrap").animate({ scrollTop: 0 }, "slow");
        },   
        
          success: function(data, textStatus, XMLHttpRequest) {

              $('.xlimwrap').removeClass('loading');
              $('.xlimwrap').html(data);

              $('.demo-inner').masonry({
                  itemSelector: '.demo',
                  isAnimated: false,
                  transitionDuration: 0
              });

              $('.demo-inner').masonry('reloadItems');

              $('.demo-inner').imagesLoaded( function() {
              $('.demo-inner').masonry('layout');
              });

          },

        });
     }


    });

})(jQuery);
