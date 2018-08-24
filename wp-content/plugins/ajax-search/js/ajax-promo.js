jQuery(function($){
    function debounce(func, wait, immediate) {
        var timeout;
        return function() {
            var context = this, args = arguments;
            var later = function() {
                timeout = null;
                if (!immediate) func.apply(context, args);
            };
            var callNow = immediate && !timeout;
            clearTimeout(timeout);
            timeout = setTimeout(later, wait);
            if (callNow) func.apply(context, args);
        };
    };
    
    var base_url = location.hostname !== 'localhost' ? location.hostname : 'http://localhost:8888/theoutletslipa';
    
    if(location.hostname != 'localhost') {
        var url = 'http://beta.theloop.ph/theoutletslipa/wp-json/ajax-search/v1/promos-events';
    } else {
        var url = 'http://localhost:8888/theoutletslipa/wp-json/ajax-search/v1/promos-events';
    }
    
    // Initial Load
    var search_term = '';
    var category = $('.select-category select').val() ? $('.select-category select').val() : '';
    var page = '';
    var type = $('.filter-promo-input').data('type');
    
    get_promos(search_term, page, type);
    
    // On input of first 3 characters or when Enter is pressed
    $('.filter-promo-input').keyup(debounce(function(e) {
        var search_term = $(this).val();
        var category = $('.select-category select').val() ? $('.select-category select').val() : '';
        var page = '';
        var type = $(this).data('type');
        
        if( search_term.length > 2 || e.which == 13 ) {
//            console.log('Searched for: ' + search_term);
//            console.log('Category: ' + category);
            
            get_promos(search_term, page, type);
        }
    }, 1000));
    
    // On select of category
    $('.select-category select').on('change', function() {
        var search_term = $('.filter-promo-input').val();
        var category = $('.select-category select').val() ? $('.select-category select').val() : '';
        var page = '';
        var type = $('.filter-promo-input').data('type');
        
//        console.log('Searched for: ' + search_term);
//        console.log('Category: ' + category);

        get_promos(search_term, category, page, type);
    });
    
    // AJAX call for get shops
    function get_promos( search_term, page, type ) {
        var params = {
            'search'    : search_term,
            'page'      : page,
            'type'      : type,
        };

        $.ajax({
            method: 'GET',
            url: url,
            data: params,
            beforeSend: function loader() {
                $('.layout-thumb .promo-results').text('');
                $('.layout-thumb .promo-results').append('<div class="loader">Loading...</div>');
            },
            success: function(data, textStatus, jqXHR) {
                $('.layout-thumb .promo-results').text('');
                console.log(data);
                
                if(data.promos.length > 0) {
                    
                    $.each(data.promos, function(key, value) {
                        
                        if(value.thumb_url) {
                            var thumb = '<img src="'+value.thumb_url+'" alt="'+value.thumb_alt+'"/>'
                        } 
                        
                        
                        var promos =   '<article class="'+ value.article_classes +'" id="'+value.article_id+'">'
                                +'<div class="article-wrap">'
                                    +'<div class="featured-image">'
                                        +'<div class="image-wrap">'
                                            +thumb
                                        +'</div>'
                                    +'</div>'

                                    +'<div class="detail-wrap">'
                                        +'<div class="entry-content">'
                                            +'<h2>'
                                                +'<a href="'
                                                    +value.promo_link
                                                +'">'
                                                +value.promo_name
                                                +'</a>'
                                            +'</h2>'
                                            +value.promo_excerpt
                                            +'<a href="'
                                                +value.promo_link
                                            +'" class="read-more">Read More<i class="fas fa-angle-double-right"></i></a>'
                                        +'</div>'
                                    +'</div>'

                                +'</div>'
                            +'</article>';
                        
                        $('.layout-thumb .promo-results').append(promos);
                    });
                    
                    if(data.max_num_pages > 1) {
                        var page_links = '';
                        for(var i = 1; i <= data.max_num_pages; i++) {
                            if(i == data.current_page) {
                                var current = 'current-page'
                            } else {
                                var current = '';
                            }
                            
                            page_links += '<li><a href="" data-page="'+i+'" class="page-link '+current+'">'+i+'<a></li>'
                        }
                        
                        var pagination = '<div class="pagination"><ul>'+page_links+'</ul></div>';
                        
                        $('.layout-thumb .promo-results').append(pagination);
                    }
                } else {
                    $('.layout-thumb .promo-results').append('No Promos or Events found.');
                }
                $('.query-promos .image-wrap img').centerImage();
            }
        });
    }
    
    // Pagination
    
    $('body').on('click', '.pagination a.page-link', function(e) {
        e.preventDefault();
        
        var page = $(this).data('page');
        var search_term = $('.filter-promo-input').val();
        var category = $('.select-category select').val() ? $('.select-category select').val() : '';
        var type = $('.filter-promo-input').data('type');
        
//        console.log('clicked page ' + page);
//        console.log('Searched for: ' + search_term);
//        console.log('Category: ' + category);

        get_promos(search_term, page, type);
    });
    
});