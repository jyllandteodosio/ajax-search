<div class="pitch-slider <?php if(get_field('switch_layout')) { echo 'switch-right'; } ?>">
    
    <?php if(get_field('switch_layout')) { ?>
<!--        test-->
    <?php } ?>
    
    <div class="one-half first">
        <div class="pitch-image">
            <?php if( have_rows('pitch_slider') ): ?>
                <div class="swiper-wrapper">
                <?php while( have_rows('pitch_slider') ): the_row(); ?>

                    <div class="swiper-slide">
                       <?php echo get_sub_field('image'); ?>
                    </div>

                <?php endwhile; ?>
                </div>
            <?php endif; ?>
        </div>
    </div>
    
    <div class="one-half">
        <div class="pitch-content">
            <?php if( have_rows('pitch_slider') ): ?>
                <div class="swiper-wrapper">
                <?php while( have_rows('pitch_slider') ): the_row(); ?>

                    <div class="swiper-slide">
                        <?php echo get_sub_field('content'); ?>
                        <p class="inquiry-form"><?php echo get_sub_field('file_icon'); ?><a href="<?php echo get_sub_field('file')['url']; ?>" target="_blank"><?php echo get_sub_field('file_title'); ?></a></p>
                    </div>

                <?php endwhile; ?>
                </div>
            <?php endif; ?>
        </div>
    </div>

</div>