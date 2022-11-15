<?php
/**
 * The template for displaying all single songs
 *
 * @package understrap
 */

get_header();
$container   = get_theme_mod( 'understrap_container_type' );
?>
<script>
    

    jQuery(function(){
        //get all the gig id of your attended gigs
        var gigs = [];

        jQuery('.gig--attended').each(function(i, obj) {
            gigs.push(jQuery(this).data('id'));
        });

        //copy attended 
        jQuery('.js-attended-gig').each(function(i, obj) {
            //gigs.push(jQuery(this).data('id'));
            jQuery(this).clone().appendTo("#js-my-gigs-songs");  
        });
        //
    });

    
</script>


<header class="primary-header">
    <div class="container">
        <div class="row d-flex">
            <div class="col-md-10 col-sm-12">
                <div class="primary-header__title">
                    <h1 class="about-song__title"><?php the_title(); ?></h1>
                </div>

                <div class="primary-header__facts">
                    <ul class="labellist">
                        <?php if(get_field('album')) { ?>
                        <li>
                            <span class="labellist__label">Album:</span>
                            <span class="labellist__value"><?php echo get_the_title(get_field('album')); ?></span>
                        </li>
                        <?php } ?>

                        <?php if(get_field('alternative_title')) { ?>
                        <li>
                            <span class="labellist__label">Alternative title(s):</span>
                            <span class="labellist__value">
                                <?php
                                    $posts = get_field('alternative_title');

                                    if( $posts ): 
                                            foreach( $posts as $post):
                                                setup_postdata($post);
                                                
                                                echo "<span class='song--text'>" . get_the_title($post->ID) . "</span>";
                                            endforeach;
                                            
                                        wp_reset_postdata();
                                    endif;
                                ?>
                            </span>
                        </li>
                        <?php } ?>
                        
                        <?php if(get_field('traditional_song')) { ?>
                        <li>
                            <span class="labellist__label">Type:</span>
                            <span class="labellist__value">Traditional</span>
                        </li>
                        <?php } ?>

                        <?php if(get_field('other_band_name')) { ?>
                        <li>
                            <span class="labellist__label">Cover from:</span>
                            <span class="labellist__value"><?php the_field('other_band_name'); ?></span>
                        </li>
                        <?php } ?>

                        <li>
                            <span class="labellist__label">First time played:</span>
                            <span class="labellist__value">
                                <?php
                                    $gigs_first = get_posts(array(
                                        'post_type' => 'gig',
                                        'orderby' => 'publish_date', 
                                        'order' => 'ASC',
                                        'posts_per_page' => 1,
                                        'meta_query' => array(
                                            array(
                                                'key' => 'songs',
                                                'value' => '"' . get_the_ID() . '"',
                                                'compare' => 'LIKE'
                                            )
                                        )
                                    ));
                                ?>
                                <?php if( $gigs_first ): ?>
                                    <?php foreach( $gigs_first as $gig_first ): ?>
                                        <a href="<?php echo get_permalink( $gig_first->ID ); ?>">
                                            <?php echo get_the_date( 'd/m/Y',$gig_first->ID ); ?> - <?php the_field('venue_name',$gig_first->ID); ?>, <?php the_field('city',$gig_first->ID); ?>, <?php the_field('country',$gig_first->ID); ?>
                                        </a>
                                    <?php endforeach; ?>
                                <?php endif; ?>

                            </span>
                        </li>
                        <li>
                            <span class="labellist__label">Last time played:</span>
                            <span class="labellist__value">
                                <?php
                                    $gigs_first = get_posts(array(
                                        'post_type' => 'gig',
                                        'orderby' => 'publish_date', 
                                        'order' => 'DESC',
                                        'posts_per_page' => 1,
                                        'meta_query' => array(
                                            array(
                                                'key' => 'songs',
                                                'value' => '"' . get_the_ID() . '"',
                                                'compare' => 'LIKE'
                                            )
                                        )
                                    ));
                                ?>
                                <?php if( $gigs_first ): ?>
                                    <?php foreach( $gigs_first as $gig_first ): ?>
                                        <a href="<?php echo get_permalink( $gig_first->ID ); ?>">
                                            <?php echo get_the_date( 'd/m/Y',$gig_first->ID ); ?> - <?php the_field('venue_name',$gig_first->ID); ?>, <?php the_field('city',$gig_first->ID); ?>, <?php the_field('country',$gig_first->ID); ?>
                                        </a>
                                    <?php endforeach; ?>
                                <?php endif; ?>

                            </span>
                        </li>
                        <li>
                            <span class="labellist__label">Number of times played:</span>
                            <span class="labellist__value">
                                <?php 
                                    $gigs = get_posts(array(
                                        'post_type' => 'gig',
                                        'posts_per_page' => -1,
                                        'orderby' => array(
                                            'date' => 'ASC',
                                        ),
                                        'meta_query' => array(
                                            array(
                                                'key' => 'songs', // name of custom field
                                                'value' => '"' . get_the_ID() . '"', // matches exactly "123", not just 123. This prevents a match for "1234"
                                                'compare' => 'LIKE'
                                            )
                                        )
                                    ));

                                    echo count($gigs);
                                ?>
                            </span>
                        </li>
                    </ul>
                </div>
            </div>

            <div class="col-md-2 col-sm-12">
                <?php $albumId = get_field('album'); ?>
                <img alt="<?php get_the_title($albumId); ?>" src="<?php echo get_the_post_thumbnail_url($albumId); ?>" />
            </div>
        </div> <!-- row -->

        <div class="row">
            <div class="col-md-12">
                <div class="primary-header__links">
                    <?php if(get_field('video')) { ?>
                        <a class="label label--icon" href="<?php the_field('video'); ?>" data-lity><i class="fa fa-play-circle"></i> Play video</a>
                    <?php } ?>

                    <?php if(get_field('tab')) { ?>
                        <a class="label label--icon" href="<?php the_field('tab'); ?>" target="_blank"><i class="fas fa-guitar"></i> Guitar tab</a>
                    <?php } ?>
                </div> <!-- /primary-header__links -->
            </div>
        </div>
    </div>
</header>
<main class="main">
    <div class="single-song-page">
        <div class="container">
            <?php if(get_the_content()){ ?>
            <div class="row">
                <div class="col-md-12">
                    <div class="extra-info">
                        <div class="extra-info__header">
                            <h2 class="extra-info__header__title">Extra info</h2>
                        </div>
                        <div class="extra-info__header">
                            <?php the_content(); ?>
                        </div>
                    </div>
                </div>
            </div> <!--/row-->
            <?php } ?>
        </div> <!-- /container -->

        <!-- stats for current song -->
        <section class="count-per-year">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <h2>Number of times played over all the years</h2>
                    </div>
                    <div class="col-md-12">
                        <?php 
                        /*
                        *  Query posts for a relationship value.
                        *  This method uses the meta_query LIKE to match the string "123" to the database value a:1:{i:0;s:3:"123";} (serialized array)
                        */
                        $gigs = get_posts(array(
                            'post_type' => 'gig',
                            'posts_per_page' => -1,
                            'orderby' => array(
                                'date' => 'ASC',
                            ),
                            'meta_query' => array(
                                array(
                                    'key' => 'songs', // name of custom field
                                    'value' => '"' . get_the_ID() . '"', // matches exactly "123", not just 123. This prevents a match for "1234"
                                    'compare' => 'LIKE'
                                )
                            )
                        ));
                        ?>

                        <?php if( $gigs ): ?>
                        <?php
                            $countYears = [];
                            $total = 0;
                        ?>
                            <?php foreach( $gigs as $gig ): ?>
                                <?php array_push($countYears, get_the_date( 'Y',$gig->ID )); ?>
                            <?php endforeach; ?>

                            <?php 
                                $total = count($countYears);
                                $countYears = array_count_values($countYears);
                            ?>
                            <div class="graph">
                                <?php
                                    $percentage = 0;
                                    foreach ($countYears as $year => $number) {
                                        $percentage = ceil(($number / $total) * 100);
                                        $percentage = $percentage * 5;
                                        //https://mpdb.space/?fwp_date_as_year=1991&fwp_songs=371
                                        echo "<a href='https://mpdb.space/?fwp_date_as_year=".$year."&fwp_songs=".get_the_ID()."' class='graph__block'>";
                                            echo "<span style='height:". $percentage . "px;' data-number='". $percentage ."' class='js-graph-number graph__number'><span class='graph__number__inner'>" . $number . "</span></span>";
                                            echo "<span class='graph__year'>" . $year . "</span>";
                                        echo "</a>";
                                    }
                                ?>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </section>

        <!-- /stats for current song -->
        
        <?php if ( is_user_logged_in() ) {  ?>
            <section class="section-other-gigs">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <h2>You've heard "<?php the_title(); ?>" at the following gigs</h2>

                            <div class="gigs-played" id="js-my-gigs-songs">
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        <?php } ?>

        <section class="section-other-gigs">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                    <h2>"<?php the_title(); ?>" was played at these gigs:</h2>
                        <?php 

                        /*
                        *  Query posts for a relationship value.
                        *  This method uses the meta_query LIKE to match the string "123" to the database value a:1:{i:0;s:3:"123";} (serialized array)
                        */
                        $gigs = get_posts(array(
                            'post_type' => 'gig',
                            'posts_per_page' => -1,
                            'orderby' => array(
                                'date' => 'DESC',
                            ),
                            'meta_query' => array(
                                array(
                                    'key' => 'songs', // name of custom field
                                    'value' => '"' . get_the_ID() . '"', // matches exactly "123", not just 123. This prevents a match for "1234"
                                    'compare' => 'LIKE'
                                )
                            )
                        ));

                        ?>
                        <?php if( $gigs ): ?>
                            <div class="gigs-played">
                                
                                <?php foreach( $gigs as $gig ): ?>
                                    <?php
                                        global $wpdb;  

                                        $current_user_id = get_current_user_id();
                                        $postId = $gig->ID;

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
                                    <div class="gigs-played__item <?php if($isAttending) { echo "js-attended-gig"; }?>"">
                                        <a data-id="<?php echo $gig->ID; ?>" href="<?php echo get_permalink( $gig->ID ); ?>" class="gig <?php if($isAttending) { echo "gig--attended"; }?>">
                                            <span class="gig__date">
                                                <span class="day"><?php echo get_the_date( 'd',$gig->ID ); ?></span>
                                                <span class="month"><?php echo get_the_date( 'M',$gig->ID ); ?></span>
                                                <span class="year"><?php echo get_the_date( 'Y',$gig->ID ); ?></span>    
                                            </span>

                                            <div class="gig__content">
                                                <div class="gig__content__venue"><?php the_field('venue_name',$gig->ID); ?></div>
                                                <div class="gig__content__location">
                                                    <span class="gig__content__city"><?php the_field('city',$gig->ID); ?></span>,&nbsp;
                                                    <span class="gig__content__country"><?php the_field('country',$gig->ID); ?></span>
                                                </div>
                                                <?php if(get_field('hasRecording',$gig->ID)) { ?>
                                                    <div class="gig__content__extra">
                                                        <?php if(get_field('hasRecording',$gig->ID)) { ?>
                                                            <span>
                                                                <i title="Recording available" class="fa fa-microphone"></i>
                                                            </span>
                                                        <?php } ?>
                                                    </div>
                                                <?php } ?>
                                            </div>
                                        </a>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div> <!-- container -->
        </section>
    </div>
</main>

<?php get_footer(); ?>


