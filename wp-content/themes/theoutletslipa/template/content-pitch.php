<div class="pitch-slider">
    
    <div class="one-half first">
        <div class="pitch-image">
            <?php if( have_rows('pitch_slider') ): ?>
                <div class="swiper-wrapper">
                <?php while( have_rows('pitch_slider') ): the_row(); ?>

                    <div class="swiper-slide">
                        <img src="<?php echo get_sub_field('image')['url'];?>">
                    </div>

                <?php endwhile; ?>
                </div>
            <?php endif; ?>
            <!-- Add Pagination -->
            <div class="swiper-pagination"></div>
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