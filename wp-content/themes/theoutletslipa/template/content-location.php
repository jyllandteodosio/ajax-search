<div class="two-thirds first">
    <div class="content-tabs content-sidebar-content">
        <div class="tab-wrapper">
            <ul class="tabs">
                    <li class="tab-link active" data-tab="1"><?php echo get_field('tab_title_1'); ?></li>
                    <li class="tab-link" data-tab="2"><?php echo get_field('tab_title_2'); ?></li>
            </ul>
        </div>
        <div class="content-wrapper">

            <div id="tab-1" class="tab-content active">

                <?php if( have_rows('details') ): ?>
                    <div class="accordion">
                    <?php $count = 0; while( have_rows('details') ): the_row(); ?>

                        <div class="accordion-wrap">
                        <div class="title"><a href=""><?php echo get_sub_field('title'); ?><i class="fa fa-angle-down"></i></a></div>
                        <div class="content <?php if($count === 0){echo 'active';}; ?>"><?php echo get_sub_field('content'); ?></div>
                        </div>

                    <?php $count++; endwhile; ?>
                    </div>
                <?php endif; ?>

            </div>

            <div id="tab-2" class="tab-content">

                <?php if( have_rows('details_2') ): ?>
                    <div class="accordion">
                    <?php $count = 0; while( have_rows('details_2') ): the_row(); ?>

                        <div class="accordion-wrap">
                        <div class="title"><a href=""><?php echo get_sub_field('title'); ?><i class="fa fa-angle-down"></i></a></div>
                        <div class="content <?php if($count === 0){echo 'active';}; ?>"><?php echo get_sub_field('content'); ?></div>
                            </div>

                    <?php $count++; endwhile; ?>
                    </div>
                <?php endif; ?>

            </div>


        </div>
    </div>
</div>