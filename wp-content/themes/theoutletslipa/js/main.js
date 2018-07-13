jQuery(function($){
    
    var $windowHeight = $(window).height(),
        $siteHeader = $('.site-header').height();
    $('.section-home-banner').height($windowHeight - $siteHeader);
    
    
    var swiper = new Swiper('.swiper-container', {
      pagination: {
        el: '.swiper-pagination',
      },
    });
    
    $('.tab-link').click( function() {
	
        var tabID = $(this).attr('data-tab');
        $(this).addClass('active').siblings().removeClass('active');
        $('#tab-'+tabID).addClass('active').siblings().removeClass('active');
    });

    
    var allPanels = $('.accordion-wrap > .content').hide();
    $('.accordion-wrap > .content.active').slideDown();
    $('.accordion-wrap > .title > a').click(function() {
          $this = $(this);
          $target =  $this.parent().next();

          if(!$target.hasClass('active')){
             allPanels.removeClass('active').slideUp('slow');
             $target.addClass('active').slideDown('slow');
          }

        return false;
    });
       
    $('.wpbc_structure_form .form-group:nth-child(-n+4)').wrapAll('<div class="first-column-form"></div>');
    $('.wpbc_structure_form > .form-group:nth-child(-n+8)').wrapAll('<div class="second-column-form"></div>'); 
    $('.wpbc_structure_form > .form-group:nth-child(-n+12)').wrapAll('<div class="third-column-form"></div>'); 
    $('.wpbc_structure_calendar').detach().insertAfter(".first-column-form");
    $('.second-column-form').prepend('<span class="addon-title">Add-ons:</span>');
    $('.wpbc_structure_form').append('<p>Submission of this form does not guarantee your booking. Please wait for notification via email or mobile for confirmation.</p>');
    
    
    $('.layout-change').on('click', function(){
        if($(this).hasClass('style-list')) {
            $(this).parents('.section-query').removeClass('layout-thumb').addClass('layout-list');
            console.log('list');
        } else if($(this).hasClass('style-thumb')){
            $(this).parents('.section-query').removeClass('layout-list').addClass('layout-thumb');
        }
    });
    
    
    $('.query-promos .image-wrap img').centerImage();
    $('.featured-image-modal img').centerImage();
    
    
    var modalBody = $('.modal-body').height();
//    $('.modal-image').css('height', modalBody);
    
});