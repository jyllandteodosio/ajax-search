<div class="section-booking">

    <?php echo do_shortcode('[booking]'); ?>

</div>

<div id="waiverModal" class="modal fade waiver-modal widget-area">
    <div class="waiver-wrap">
        <div class="close" data-dismiss="modal" aria-hidden="true">
            <i class="fas fa-times"></i>
        </div>
        <div class="waiver-content">
            <?php echo get_field('waiver'); ?>
        </div>
    </div>
</div>