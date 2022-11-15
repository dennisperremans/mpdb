<a href="<?php echo get_post_permalink($key); ?>" class="song">
    <div class="song__content">
        <div class="song__title">
            <?php echo get_the_title($key); ?>
        </div>
        <div class="song__album">
            <?php echo get_field('text_field', $key); ?>
        </div>
    </div>
    <div class="song__ntp">
        <i class="fa fa-guitar"></i>
        <?php echo $value; ?>
    </div>
</a>