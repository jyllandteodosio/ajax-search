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
    
    
//      $(".set > a").on("click", function() {
//        if ($(this).hasClass("active")) {
//          $(this).removeClass("active");
//          $(this).siblings(".content").slideUp(200);
//          $(".set > a i").removeClass("fa-angle-up").addClass("fa-angle-down");
//        } else {
//          $(".set > a i").removeClass("fa-angle-up").addClass("fa-angle-down");
//          $(this).find("i").removeClass("fa-angle-down").addClass("fa-angle-up");
//          $(".set > a").removeClass("active");
//          $(this).addClass("active");
//          $(".content").slideUp(200);
//          $(this).siblings(".content").slideDown(200);
//        }
//      });
    

    
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
    
});