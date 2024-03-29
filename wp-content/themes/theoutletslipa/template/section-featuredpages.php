<section class="section-featured-pages">
    <div class="one-third first">
        <div class="swiper-container">
        <?php if( have_rows('first_column') ): ?>
            <div class="swiper-wrapper">
            <?php while( have_rows('first_column') ): the_row(); ?>

                <div class="swiper-slide" style="background-image:url('<?php echo get_sub_field('background')['url'];?>');">
                    
                        <div class="content-wrap">
                            <a href="<?php echo get_sub_field('tag_link'); ?>"><span class="tag"><?php echo get_sub_field('tag'); ?></span></a>
                            <a href="<?php echo get_sub_field('link'); ?>"><h2 class="page-title"><?php echo get_sub_field('title'); ?></h2></a>
                            <?php if(get_sub_field('link_text')) { ?>
                                <a href="<?php echo get_sub_field('link'); ?>" class="view-page"><span class="link"><?php echo get_sub_field('link_text'); ?><i class="fas fa-angle-right"></i></span></a>
                            <?php } ?>
                        </div>
                    
                </div>

            <?php endwhile; ?>
            </div>
        <?php endif; ?>
        <!-- Add Pagination -->
        <div class="swiper-pagination"></div>
        </div>
    </div>
    <div class="one-third">
        <div class="swiper-container">
        <?php if( have_rows('second_column') ): ?>
            <div class="swiper-wrapper">
            <?php while( have_rows('second_column') ): the_row(); ?>

                <div class="swiper-slide" style="background-image:url('<?php echo get_sub_field('image')['url'];?>');">
                        <div class="content-wrap">
                            <a href="<?php echo get_sub_field('tag_link'); ?>"><span class="tag"><?php echo get_sub_field('tag'); ?></span></a>
                            <a href="<?php echo get_sub_field('link'); ?>"><h2 class="page-title"><?php echo get_sub_field('title'); ?></h2></a>
                            <?php if(get_sub_field('link_text')) { ?>
                                <a href="<?php echo get_sub_field('link'); ?>" class="view-page"><span class="link"><?php echo get_sub_field('link_text'); ?><i class="fas fa-angle-right"></i></span></a>
                            <?php } ?>
                        </div>
                </div>

            <?php endwhile; ?>
            </div>
        <?php endif; ?>
        <!-- Add Pagination -->
        <div class="swiper-pagination"></div>
        </div>
    </div>
    <div class="one-third">
        <div class="swiper-container">
        <?php if( have_rows('third_column') ): ?>
            <div class="swiper-wrapper">
            <?php while( have_rows('third_column') ): the_row(); ?>

                <div class="swiper-slide" style="background-image:url('<?php echo get_sub_field('background')['url'];?>');">
                    
                        <div class="content-wrap">
                            <a href="<?php echo get_sub_field('tag_link'); ?>"><span class="tag"><?php echo get_sub_field('tag'); ?></span></a>
                            <a href="<?php echo get_sub_field('link'); ?>"><h2 class="page-title"><?php echo get_sub_field('title'); ?></h2></a>
                            <?php if(get_sub_field('link_text')) { ?>
                                <a href="<?php echo get_sub_field('link'); ?>" class="view-page"><span class="link"><?php echo get_sub_field('link_text'); ?><i class="fas fa-angle-right"></i></span></a>
                            <?php } ?>
                        </div>
                    
                </div>

            <?php endwhile; ?>
            </div>
        <?php endif; ?>
        <!-- Add Pagination -->
        <div class="swiper-pagination"></div>
        </div>
    </div>
</section>



    
      
    
    
  <?php echo get_sub_field(''); ?>