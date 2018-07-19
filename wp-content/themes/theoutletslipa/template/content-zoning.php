<div class="zoning-map">
    
    <div class="two-thirds first">
        <?php echo do_shortcode('[mapplic id="221"]'); ?>
    </div>
    
    <div class="one-third">
        <h3><?php echo get_field('zoning_map_title'); ?></h3>
        <div class="map-image"><img src="<?php echo get_field('image')['url']; ?>" ></div>
        <?php if( have_rows('accordion') ): ?>
            <div class="accordion">
            <?php $count = 0; while( have_rows('accordion') ): the_row(); ?>

                <div class="accordion-wrap">
                    <div class="title"><a href="" style="color: <?php echo get_sub_field('color'); ?>;"><?php echo get_sub_field('title'); ?><i class="fa fa-angle-down" style="color: <?php echo get_sub_field('color'); ?>;"></i></a></div>
                    <div class="content <?php if($count === 0){echo 'active';}; ?>"><?php echo get_sub_field('short_description'); ?></div>
                </div>

            <?php $count++; endwhile; ?>
            </div>
        <?php endif; ?>
    </div>

</div>