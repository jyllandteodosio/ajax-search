<div class="section-query">
    
        
        <div class="section-filter filter-shop">
            <div class="search-container">
                <input type="submit" value="&#xf002"/>
                <input type="search" placeholder="Search Shop"/>
            </div>
            <div class="select-category">
                <select>
                    <option>All</option>
                    <option>Fashion Apparel</option>
                    <option>Shop</option>
                    <option>Service</option>
                    <option>Sports & Active Lifestyle</option>
                </select>
            </div>
            <div class="layout-change layout-thumb">
                <i class="fas fa-th-large"></i>
            </div>
            <div class="layout-change layout-list">
                <i class="fas fa-bars"></i>
            </div>
        </div>
    

            <?php $query = new WP_Query(array(
                    'orderby'           => 'title', 
                    'posts_per_page'    => 10,
                    'post_type'         => 'outlets',
                    'tax_query'      => array(
                        array(
                            'taxonomy' => 'outlet_category',
                            'field' => 'slug',
                            
                            'terms' => array ('food-drink'),
                            'operator' => 'NOT IN'
                        )
                    )

                )); 
                
                if($query->have_posts()):
                $count = 0;
                while($query->have_posts()) : $query->the_post(); 
                
            
            ?>

                <article <?php echo post_class(); ?>>
                    <div class="article-wrap <?php if($count % 2){echo 'even';}; ?>">
                    
                    <div class="featured-image">
                        <a href="<?php the_permalink(); ?>" class="image-wrap">
                            <?php  if(has_post_thumbnail()){
                            $thumb_id = get_post_thumbnail_id(); $thumb_url = wp_get_attachment_image_src($thumb_id,'featured-image', true); $alt = get_post_meta($thumb_id, '_wp_attachment_image_alt', true);?>

                                <img src="<?php echo $thumb_url[0]; ?>" alt="<?php if(strLen($alt)>0){echo $alt;}else{the_title();} ?>"/>

                            <?php } else {
                                ?>
                                <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/default-bg.png" alt="<?php if(strLen($alt)>0){echo $alt;}else{the_title();} ?>"/>
                            <?php
                            }?>
                        </a>
                    </div>
                    
                    
                    <div class="detail-wrap">
                        <div class="entry-content">
                            <ul>
                                <?php $status = get_field('status'); ?>
                                <li><i class="fas fa-clock-o"></i><span><?php echo get_field('time'); ?></span></li>
                                <?php if ($status) { ?><li><i class=""></i><span>Soon to Open</span></li><?php } ?>
                                <li><i class="fas fa-phone"></i><span><?php echo get_field('phone'); ?></span></li>
                                <li><i class="fas fa-map-marker"></i><span><?php echo get_field('location'); ?></span></li>
                                <li><i class="fas fa-tag"></i>
                                <?php  
                                    $custom_taxonomy = the_terms( $post->ID, 'outlet_category');
                                    foreach ( $custom_taxonomy as $term ) {
                                      echo $term->name;
                                    }
                                ?>
                                </li>
                            </ul>
                        </div>
                    </div>
                        
                    </div>
                </article>


                <?php $count++; endwhile; ?>
        
                <?php wp_reset_postdata(); global $initialoffset; $initialoffset = $query->found_posts; ?>


                <?php endif; ?>          
            
    
    

</div>