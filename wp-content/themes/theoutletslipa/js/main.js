jQuery(function($){
    
    var $windowHeight = $(window).height(),
        $siteHeader = $('.site-header').height();
    $('.section-home-banner').height($windowHeight - $siteHeader);
    
    
    var swiper = new Swiper('.swiper-container', {
      pagination: {
        el: '.swiper-pagination',
        clickable: true
      },
        preventClicks: false,
        autoplay: {
            delay: 5000,
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
//       
//    $('.wpbc_structure_form .form-group:nth-child(-n+4)').wrapAll('<div class="first-column-form"></div>');
//    $('.wpbc_structure_form > .form-group:nth-child(-n+8)').wrapAll('<div class="second-column-form"></div>'); 
//    $('.wpbc_structure_form > .form-group:nth-child(-n+12)').wrapAll('<div class="third-column-form"></div>'); 
//    $('.wpbc_structure_calendar').detach().insertAfter(".first-column-form");
//    $('.second-column-form').prepend('<span class="addon-title">Add-ons:</span>');
//    $('.wpbc_structure_form').append('<p>Submission of this form does not guarantee your booking. Please wait for notification via email or mobile for confirmation.</p>');
    
    
    $('.fieldlights1 select').attr('disabled', 'disabled');
//    $(".time-select select").on('change', function() {
//        if ($('.fieldlights1 select:contains("PM")')){
//            console.log('remove disable');
//        } else {
//            $('.fieldlights1 select').attr('disabled', 'disabled');
//        }
//    });
    
    
    $('.time-select select').change(function (e) {

        
//        if ( $('.starttime1 select').find(":selected").text().toLowerCase().indexOf('pm') >= 0 || $('.endtime1 select').find(":selected").text().toLowerCase().indexOf('pm') >= 0 || $('.endtime1 select').find(":selected").text().toLowerCase().indexOf('mn') >= 0) {
//            $('.fieldlights1 select').prop('disabled', false);
//        }
        
        
        if($('.starttime1 select option:selected').text() == '06:00 PM' 
          || $('.starttime1 select option:selected').text() == '08:00 PM' 
           || $('.starttime1 select option:selected').text() == '10:00 PM'
          || $('.starttime1 select option:selected').text() == '12:00 MN'
          || $('.endtime1 select option:selected').text() == '06:00 PM' 
          || $('.endtime1 select option:selected').text() == '08:00 PM' 
           || $('.endtime1 select option:selected').text() == '10:00 PM'
          || $('.endtime1 select option:selected').text() == '12:00 MN') {
            $('.fieldlights1 select').prop('disabled', false);
        } else {
            $('.fieldlights1 select').prop('disabled', true);
        }
        
        
    });
    
    $('.layout-change').on('click', function(){
        if($(this).hasClass('style-list')) {
            $(this).parents('.section-query').removeClass('layout-thumb').addClass('layout-list');
            console.log('list');
        } else if($(this).hasClass('style-thumb')){
            $(this).parents('.section-query').removeClass('layout-list').addClass('layout-thumb');
        }
    });
    
    $('.shop-results .featured-image .image-wrap img').centerImage('inside');
    $(window).on('resize',function(){
        $('.query-promos .image-wrap img').centerImage();
        $('.featured-image-modal img').centerImage();
        $('.shop-results .featured-image .image-wrap img').centerImage('inside');
    });
    $(window).trigger('resize');
    
    
    
    var modalBody = $('.modal-body').height();
//    $('.modal-image').css('height', modalBody);
    
    $('.scroll span').click(function () {
        $('html,body').animate({
            scrollTop: $(".section-featured-pages").offset().top - 80
        }, 1000);
    });
    
    
    
});