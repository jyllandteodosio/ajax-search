<section class="inner-banner" <?php if(has_post_thumbnail()) { ?>style="background-image:url('<?php echo get_the_post_thumbnail_url(); ?>'<?php } ?>);">
    <div class="wrap">
        <h1 class="entry-title" itemprop="headline"><?php echo the_title(); ?></h1>
    </div>
</section>