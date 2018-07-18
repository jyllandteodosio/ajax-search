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
    
    var base_url = location.hostname !== 'localhost' ? location.hostname : 'http://localhost/theoutletslipa';
    
    // Initial Load
    var search_term = '';
    var category = $('.select-category select').val() ? $('.select-category select').val() : '';
    var page = '';
    var type = $('.filter-shop-input').data('type');
    
    get_shops(search_term, category, page, type);
    
    // On input of first 3 characters or when Enter is pressed
    $('.filter-shop-input').keyup(debounce(function(e) {
        var search_term = $(this).val();
        var category = $('.select-category select').val() ? $('.select-category select').val() : '';
        var page = '';
        var type = $(this).data('type');
        
        if( search_term.length > 2 || e.which == 13 ) {
//            console.log('Searched for: ' + search_term);
//            console.log('Category: ' + category);
            
            get_shops(search_term, category, page, type);
        }
    }, 1000));
    
    // On select of category
    $('.select-category select').on('change', function() {
        var search_term = $('.filter-shop-input').val();
        var category = $('.select-category select').val() ? $('.select-category select').val() : '';
        var page = '';
        var type = $('.filter-shop-input').data('type');
        
//        console.log('Searched for: ' + search_term);
//        console.log('Category: ' + category);

        get_shops(search_term, category, page, type);
    });
    
    // AJAX call for get shops
    function get_shops( search_term, category, page, type ) {
        var params = {
            'search'    : search_term,
            'category'  : category,
            'page'      : page,
            'type'      : type,
        };

        $.ajax({
            method: 'GET',
            url: base_url + '/wp-json/ajax-search/v1/shops',
            data: params,
            beforeSend: function loader() {
                $('.layout-thumb .shop-results').text('');
                $('.layout-thumb .shop-results').append('<div class="loader">Loading...</div>');
            },
            success: function(data, textStatus, jqXHR) {
                $('.layout-thumb .shop-results').text('');
                console.log(data);

                if(data.shops.length > 0) {
                    
                    $.each(data.shops, function(key, value) {
                        
                        if(value.thumb_url) {
                            var thumb = '<img src="'+value.thumb_url+'" alt="'+value.thumb_alt+'"/>'
                        } else {
                            var thumb = '<div class="featured-name"><div class="store-name">'+value.store_name+'</div></div>';
                        }
                        
                        if(value.status) {
                            var status_text = '<li><i class=""></i><span>Soon to Open</span></li>';
                        }
                        
                        if(value.tags.length > 0) {
                            var tags = '';
                            $.each(value.tags, function(index, tag) {
                                tags += '<a href="'+tag.link+'" rel="tag">'+tag.name+'</a> ';
                            });
                        }
                        
                        var shop =   '<article class="'+ value.article_classes +'" id="'+value.article_id+'">'
                                        +'<div class="article-wrap">'
                                            +'<div class="featured-image">'
                                                +'<div class="image-wrap">'
                                                    +thumb
                                                +'</div>'
                                            +'</div>'

                                            +'<div class="detail-wrap">'
                                                +'<div class="entry-content">'
                                                    +'<ul>'
                                                        +'<li><i class="fas fa-clock-o"></i><span>'+value.time+'</span></li>'
                                                        +status_text
                                                        +'<li><i class="fas fa-phone"></i><span>'+value.phone+'</span></li>'
                                                        +'<li><i class="fas fa-map-marker"></i><span>'+value.location+'</span></li>'
                                                        +'<li><i class="fas fa-tag"></i>'
                                                        +tags
                                                        +'</li>'
                                                    +'</ul>'
                                                +'</div>'
                                            +'</div>'

                                        +'</div>'
                                    +'</article>';
                        
                        $('.layout-thumb .shop-results').append(shop);
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
                        
                        $('.layout-thumb .shop-results').append(pagination);
                    }
                } else {
                    $('.layout-thumb .shop-results').append('No shops found.');
                }
            }
        });
    }
    
    // Pagination
    
    $('body').on('click', '.pagination a.page-link', function(e) {
        e.preventDefault();
        
        var page = $(this).data('page');
        var search_term = $('.filter-shop-input').val();
        var category = $('.select-category select').val() ? $('.select-category select').val() : '';
        var type = $('.filter-shop-input').data('type');
        
//        console.log('clicked page ' + page);
//        console.log('Searched for: ' + search_term);
//        console.log('Category: ' + category);

        get_shops(search_term, category, page, type);
    });
    
});