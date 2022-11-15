<?php
    global $wpdb;  

    $current_user_id = get_current_user_id();
    $postId = get_the_ID();

    $attending = $wpdb->get_var(
        $wpdb->prepare(
            "SELECT attending_id FROM " . $wpdb->prefix . "gigs_attending
            WHERE user_id = %d AND post_id = %d LIMIT 1",
            $current_user_id, $postId
        )
    );

    if ( $attending > 0 ) {
        $isAttending = true;
    } else {
        $isAttending = false;
    }
?>

<a href="<?php the_permalink(); ?>" class="gig <?php if($isAttending) { echo "gig--attended"; }?>">
    <span class="gig__date">
        <span class="day"><?php echo get_the_date( 'd' ); ?></span>
        <span class="month"><?php echo get_the_date( 'M' ); ?></span>
        <span class="year"><?php echo get_the_date( 'Y' ); ?></span>    
    </span>

    <div class="gig__content">
        <div class="gig__content__venue"><?php the_field('venue_name'); ?></div>
        <div class="gig__content__location">
            <span class="gig__content__city"><?php the_field('city'); ?></span>,&nbsp;
            <span class="gig__content__country"><?php the_field('country'); ?></span>
        </div>
    </div>
</a>