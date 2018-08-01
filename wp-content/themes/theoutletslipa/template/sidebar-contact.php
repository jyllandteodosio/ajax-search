<div class="one-third">
    <div class="sidebar-wrap">
        <h3 class="sidebar-title"><?php echo get_field('sidebar_title'); ?></h3>
        <?php if( have_rows('details') ): ?>
            <div class="contact-details">
            <?php $count = 0; while( have_rows('details') ): the_row(); ?>

                <div class="details">
                    <div class="text"><?php echo get_sub_field('icon'); ?>
                        <?php if (get_sub_field('link')) {?><a href="<?php echo get_sub_field('link'); ?>"><?php } ?>
                        <span><?php echo get_sub_field('text'); ?></span>
                        <?php if (get_sub_field('link')) {?></a><?php } ?>
                    </div>
                </div>

            <?php $count++; endwhile; ?>
            </div>
        <?php endif; ?>
    </div>
</div>