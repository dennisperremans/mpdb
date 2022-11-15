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

<a href="<?php the_permalink(); ?>" class="gig gig--full <?php if($isAttending) { echo "gig--attended"; }?> <?php if(get_field('hasRecording')) { echo "gig--recorded"; }?>">
    <span class="gig__date">
        <span class="day"><?php echo get_the_date( 'd' ); ?></span>
        <span class="month"><?php echo get_the_date( 'M' ); ?></span>
        <span class="year"><?php echo get_the_date( 'Y' ); ?></span>    
    </span>

    <div class="gig__content">
        <?php if(get_field('hasRecording') || get_field('gig_video_list')) { ?>
            <div class="gig__content__extra">
                <?php if(get_field('hasRecording')) { ?>
                    <span>
                        <i title="Recording available" class="fa fa-microphone"></i>
                    </span>
                <?php } ?>

                <?php if(get_field('gig_video_list')) { ?>
                    <span class="video">
                        <i title="Video(s) avaible" class="fas fa-video"></i>
                    </span>
                <?php } ?>

                <?php if(get_field('gig_picture_list')) { ?>
                    <span class="picture">
                        <i title="Picture(s) avaible" class="fas fa-camera-retro"></i>
                    </span>
                <?php } ?>

                <?php if($isAttending) { ?>
                    <span class="attending">
                        <i title="I've attened this gig" class="fas fa-hand-rock"></i>
                    </span>
                <?php } ?>
            </div>
        <?php } ?>
        <div class="gig__content__venue">
            <span class="venue"><?php the_field('venue_name'); ?></span> - <span class="city"><?php the_field('city'); ?>,</span> <span class="country"><?php the_field('country'); ?></span>
        </div>
        
        <div class="gig__content__songs">
            <?php
            $posts = get_field('songs', $postId);
            //$count = 0;

            if( $posts ): ?>
                <?php foreach( $posts as $post): // variable must be called $post (IMPORTANT) ?>
                    <?php setup_postdata($post); ?>
                    <?php //$count = $count +1; ?>

                    <span class="song-item"><?php the_title(); ?></span>
                    

    
                <?php endforeach; ?>
                <?php wp_reset_postdata(); // IMPORTANT - reset the $post object so the rest of the page works correctly ?>
                
            <?php else: ?>

                No setlist available
            
            <?php endif; ?>
        </div>
    </div>
</a>