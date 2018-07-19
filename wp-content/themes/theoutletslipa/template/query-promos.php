<div class="section-query query-promos">
    
    <div class="wrap">
            <div class="section-filter filter-promos">
                <div class="search-container">
                    <input type="submit" value="&#xf002"/>
                    <input type="search" placeholder="Search Keyword"/>
                </div>
            </div>

            <?php $query = new WP_Query(array(
                    'orderby'           => 'title', 
                    'posts_per_page'    => 10,
                    'post_type'         => 'promos_and_events',
                    

                )); 
                
                if($query->have_posts()):
                $count = 0;
                while($query->have_posts()) : $query->the_post(); 
                
            
            ?>

                <article class="<?php $allClasses = get_post_class(); foreach ($allClasses as $class) { echo $class . " "; } ?> <?php if($count % 2){echo 'even';}; ?>" id="post-<?php the_ID(); ?>">
                    <div class="article-wrap">
                    
                    <div class="featured-image">
                        <div class="image-wrap">
                            <?php  if(has_post_thumbnail()){
                            $thumb_id = get_post_thumbnail_id(); $thumb_url = wp_get_attachment_image_src($thumb_id,'featured-image', true); $alt = get_post_meta($thumb_id, '_wp_attachment_image_alt', true);?>

                                <img src="<?php echo $thumb_url[0]; ?>" alt="<?php if(strLen($alt)>0){echo $alt;}else{the_title();} ?>"/>

                            <?php } else {
                                ?>
                                <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/default-bg.png" alt="<?php if(strLen($alt)>0){echo $alt;}else{the_title();} ?>"/>
                            <?php
                            }?>
                        </div>
                    </div>
                    
                    
                    <div class="detail-wrap">
                        <div class="entry-content">
                            <h2><?php echo the_title(); ?></h2>
                            <?php if (!has_excerpt()){ the_advanced_excerpt(); echo '<a href="#modal-' . get_the_ID() . '"class="read-more" data-toggle="modal" data-target="#modal-' . get_the_ID() . '">Read More <i class="fas fa-angle-double-right"></i></a>'; } else { echo '<p>'; echo the_excerpt(); echo '<a href="' . get_the_permalink() . '"class="read-more">Read More <i class="fas fa-angle-double-right"></i></a>'; echo '</p>'; }?>
                        </div>
                    </div>
                        
                    </div>
                </article>
    
    
                <!-- Modal HTML -->
                <div id="modal-<?php echo the_ID(); ?>" class="modal fade">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="close" data-dismiss="modal" aria-hidden="true"><i class="fas fa-times"></i></div>
                            <div class="modal-image">
                                <div class="featured-image-modal">
                                    <div class="image-wrap">
                                        <?php  if(has_post_thumbnail()){
                                        $thumb_id = get_post_thumbnail_id(); $thumb_url = wp_get_attachment_image_src($thumb_id,'featured-image', true); $alt = get_post_meta($thumb_id, '_wp_attachment_image_alt', true);?>

                                            <img src="<?php echo $thumb_url[0]; ?>" alt="<?php if(strLen($alt)>0){echo $alt;}else{the_title();} ?>"/>

                                        <?php } else {
                                            ?>
                                            <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/default-bg.png" alt="<?php if(strLen($alt)>0){echo $alt;}else{the_title();} ?>"/>
                                        <?php
                                        }?>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-body">
                                <h2><?php echo the_title(); ?></h2>
                                <?php echo the_content(); ?>
                            </div>
                        </div>
                    </div>
                </div>
    
    
                


                <?php $count++; endwhile; ?>
        
                <?php wp_reset_postdata(); global $initialoffset; $initialoffset = $query->found_posts; ?>


                <?php endif; ?>          
            
    
    </div>

</div>