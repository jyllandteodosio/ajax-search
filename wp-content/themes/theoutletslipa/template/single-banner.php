<?php $banner = get_the_post_thumbnail_url(get_the_ID(),'banner-image'); ?>

<section class="inner-banner" <?php if(has_post_thumbnail()) { ?>style="background-image:url('<?php echo  esc_url($banner); ?>'<?php } ?>);">
    <div class="wrap">
        <h1 class="entry-title" itemprop="headline"><?php echo the_title(); ?></h1>
    </div>
</section>