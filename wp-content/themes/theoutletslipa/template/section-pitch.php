<section class="section-pitch-map">
    <div class="wrap">
        <div class="two-thirds first">
            <h2 class="section-title"><?php echo get_field('page_title'); ?></h2>
            <div class="container-pitch" style="background-image:url('<?php echo get_field('background_image')['url']; ?>');">
                <a href="<?php echo get_field('featured_page'); ?>">
                <div class="wrap-pitch">
                    <h3 class="page-title"><?php echo get_field('page_description'); ?></h3>
                    <span class="pitch-btn"><?php echo get_field('button_text'); ?></span>
                </div>
                </a>
            </div>
        </div>
        <div class="one-third">
            <h2 class="section-title"><?php echo get_field('map_title'); ?></h2>
            <div class="google-maps" id="map">
                <!--iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3871.1635114151736!2d121.16825851475832!3d14.008317095071588!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x33bd6954af152581%3A0xe7da0ae1ad862d9c!2sThe+Outlets+at+Lipa!5e0!3m2!1sen!2sph!4v1530624629370" width="370" height="370" frameborder="0" style="border:0" allowfullscreen></iframe-->
                
            </div>
            <script>
                // Initialize and add the map
            function initMap() {
                // The location of Uluru
                var uluru = {
                    lat: 14.008499 , 
                    lng: 121.170447
                };
                // The map, centered at Uluru
                var map = new google.maps.Map(
                  document.getElementById('map'), {
                      zoom: 15, 
                      center: uluru
                  }
                );
                var iconBase = 'http://localhost:8888/theoutletslipa/wp-content/themes/theoutletslipa/images/';
                // The marker, positioned at Uluru
                var marker = new google.maps.Marker({
                    position: uluru, 
                    map: map,
                    icon: iconBase + 'mapmarker.png'
                });
            }
            </script>
            <script async defer
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBxLx9yIUsbOccwllzrabs8aVI8-TD5pWU&callback=initMap">
    </script>
            
            <a href="<?php echo get_field('google_maps_link', 8); ?>" target="_blank" class="get-directions"><?php echo get_field('google_maps_text', 8); ?></a>
            <a href="<?php echo get_field('waze_link', 8); ?>" target="_blank" class="get-directions"><?php echo get_field('waze_text', 8); ?></a>
        </div>
    </div>
</section>