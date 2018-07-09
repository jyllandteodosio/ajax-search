<div class="sidebar-wrap">
   
    
    
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
</div>