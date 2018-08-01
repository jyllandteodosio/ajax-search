jQuery(function($){
    
 
    
    $('.shop-results .featured-image .image-wrap img').centerImage('inside');
    $(window).on('resize',function(){
        $('.query-promos .image-wrap img').centerImage();
        $('.featured-image-modal img').centerImage();
        $('.shop-results .featured-image .image-wrap img').centerImage('inside');
    });
    $(window).trigger('resize');
    
    
    
    
});