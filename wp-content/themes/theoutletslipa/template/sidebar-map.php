<div class="one-third">

    <div class="sidebar-wrap">
        <div class="sidebar-details">
            <div id="map">
            
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
        </div>
        <?php if( have_rows('sidebar_content') ): ?>
            <div class="sidebar-details">
            <?php $count = 0; while( have_rows('sidebar_content') ): the_row(); ?>

                <div class="details">
                     <?php if (get_sub_field('sidebar_title')) { ?>
                        <h3 class="sidebar-title"><?php echo get_sub_field('sidebar_title'); ?></h3>
                    <?php } ?>
                    <?php echo get_sub_field('sidebar_content'); ?>
                </div>

            <?php $count++; endwhile; ?>
            </div>
        <?php endif; ?>
        <a href="<?php echo get_field('google_maps_link', 8); ?>" target="_blank" class="get-directions"><?php echo get_field('google_maps_text', 8); ?></a>
        <a href="<?php echo get_field('waze_link', 8); ?>" target="_blank" class="get-directions"><?php echo get_field('waze_text', 8); ?></a>
    </div>
</div>