<div class="section-query layout-thumb">
    
        
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
            <div class="layout-change style-thumb">
                <i class="fas fa-th-large"></i>
            </div>
            <div class="layout-change style-list">
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

                <article class="<?php $allClasses = get_post_class(); foreach ($allClasses as $class) { echo $class . " "; } ?> <?php if($count % 2){echo 'even';}; ?>" id="post-<?php the_ID(); ?>">
                    <div class="article-wrap">
                    
                    <div class="featured-image">
                        <div class="image-wrap">
                            <?php  if(has_post_thumbnail()){
                            $thumb_id = get_post_thumbnail_id(); $thumb_url = wp_get_attachment_image_src($thumb_id,'featured-image', true); $alt = get_post_meta($thumb_id, '_wp_attachment_image_alt', true);?>

                                <img src="<?php echo $thumb_url[0]; ?>" alt="<?php if(strLen($alt)>0){echo $alt;}else{the_title();} ?>"/>

                            <?php } else {
                                ?>
                                
                                <div class="featured-name"><div class="store-name"><?php echo the_title(); ?></div></div>
                            
                            
                            <?php
                            }?>
                        </div>
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
                                    
                                    if( $custom_taxonomy ) {
                                        foreach ( $custom_taxonomy as $term ) {
                                          echo $term->name;
                                        }
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