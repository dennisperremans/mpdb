<?php
/**
 * Template Name: My gigs
 *
 * @package understrap
 */

get_header();

$container   = get_theme_mod( 'understrap_container_type' );

?>

<main class="main">
    <div class="my-gigs">
        <section class="section-search my-gigs__header">
            <div class="section-search__container d-flex">
                
                <div class="searchbox">
                    <h1 class="searchbox__title">Search for gigs, songs, location,...</h1>
                    <?php echo do_shortcode('[wpdreams_ajaxsearchlite]'); ?>
                </div>

            </div>

            <div class="section-search__bottom">
                <div class="container">
                    <div class="row">
                        <div class="col-md-4 col-sm-12">
                            <div class="overview">
                                <div class="overview__label">
                                    <strong># unique songs</strong>
                                </div>

                                <div class="overview__value">
                                    <?php echo count(getSongsOfPosts()); ?>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 col-sm-12">
                            <div class="overview">
                                <div class="overview__label">
                                    <strong>Total # songs</strong>
                                </div>

                                <div class="overview__value" id="totalSongs">
                                   0
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 col-sm-12 text--center">
                            <div class="overview">
                                <div class="overview__label">
                                    <strong># gigs</strong> 
                                </div>
                                
                                <div class="overview__value">
                                    <?php echo getNumberOfGigs(); ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <div class="my-gigs__content">
            <div class="my-gigs__content__gigs">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <h2>Attended the following gigs</h2>
                        </div>
                    </div>
                    <div class="row">
                        <?php
                            global $wpdb;
                            
                            $currentUserId = currentUserId();
                            
                            $results = $wpdb->get_results($wpdb->prepare('SELECT * FROM ' . $wpdb->prefix . 'gigs_attending WHERE user_id = %s', $currentUserId));
                            $gigIdList = [];

                            //push all the gig id's to an array
                            foreach ($results as $r) {
                                $gig_id = $r->post_id;
                                $gig_name = get_the_title($gig_id);
                                array_push($gigIdList, $gig_id);
                            }

                        ?>

                        <?php if(!empty($gigIdList)) { ?>
                            <?php
                                $args = array(
                                    'post_type' => array( 'gig' ),
                                    'order' => 'DESC',
                                    'orderby' => 'date',
                                    'post__in' => $gigIdList
                                );

                                $loop = new WP_Query( $args );
                            ?>
                                <?php if ( $loop->have_posts() ) : while ( $loop->have_posts() ) : $loop->the_post(); ?>
                                    <div class="col-md-4 col-sm-12">
                                        <?php get_template_part('loop-templates/content-gig'); ?>
                                    </div>
                                <?php endwhile; ?>

                                <?php else: ?>
                                    <div class="col-md-4 col-sm-12">
                                        <h2>No gigs attended yet.</h2>
                                    </div>
                                <?php endif; ?>
                                
                                <?php wp_reset_postdata(); ?>
                        <?php } else { ?>
                            <div class="col-md-8 col-sm-12">
                                <p>No gigs attended yet. To attend a gig, go to the gig detail page and click on the "I was there" button.</p>
                            </div>
                        <?php } ?>
                    </div>
                </div>
            </div>
            

            <?php 
                $attended = false;

                //get user id
                $current_user = wp_get_current_user();
                $current_user_id = $current_user->ID;

                $attended = $wpdb->get_var(
                    $wpdb->prepare(
                        "SELECT attending_id FROM " . $wpdb->prefix . "gigs_attending
                        WHERE user_id = %d LIMIT 1",
                        $current_user_id
                    )
                );

                if ( $attended > 0 ) {
                    $attended = true;
                } else {
                    $attended = false;
                }
            ?>

            <?php if($attended == true) { ?>
            <!-- heard these songs -->
            <div class="my-gigs__content__songs">
                <div class="container">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="d-flex justify-content-between">
                                
                                <h2 class="title">
                                    I've heard the following songs
                                </h2>
                                <div class="sort">
                                    <select class="js-sort">
                                        <option value="">Sort by</option>
                                        <option value="az">Title (A-Z)</option>
                                        <option value="za">Title (Z-A)</option>
                                        <option value="1-10">Played (1-10)</option>
                                        <option value="10-1">Played (10-1)</option>
                                    </select>

                                    <div style="display: none;">
                                    <span class="sort__item" id="js-az">A-Z</span>
                                    <span class="sort__item" id="js-za">Z-A</span>
                                    <span class="sort__item" id="js-1-10">1-10</span>
                                    <span class="sort__item" id="js-10-1">10-1</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row js-songs-sortable" id="all-song-list">
                        <?php
                            $args = array(
                                'post_type' => array( 'song' ),
                                'order' => 'ASC',
                                'orderby' => 'title',
                                'post__in' => getSongsOfPosts()
                            );

                            $loop = new WP_Query( $args );
                        ?>

                        <?php if ( $loop->have_posts() ) : while ( $loop->have_posts() ) : $loop->the_post(); ?>

                            <div class="col-md-4 col-sm-12" data-count="" data-name="<?php the_title(); ?>">
                                <a class="song" href="<?php the_permalink(); ?>" data-name="<?php the_title(); ?>" data-id="<?php echo get_the_ID(); ?>" data-count="">
                                    <?php the_title(); ?>
                                    <span class="song__count">#</span>
                                </a>
                            </div>

                        <?php endwhile; ?>

                        <?php else: ?>

                        <?php endif; ?>
                        <?php wp_reset_postdata(); ?>
                    </div>
                </div>
            </div>
            <!-- /heard thse songs -->
            <?php } ?>


        </div>
    </div>
</main>

<?php get_footer(); ?>

<script>
    jQuery(function(){

        //get the number of songs per heard song.
        var songIds = <?php echo json_encode(getNumberOfSongsOfPosts()); ?>;
        var totalSongs = 0;

        jQuery.each(songIds, function(postid, count) {
            jQuery('.song[data-id='+ postid +'] .song__count ').html('# ' + count);
            jQuery('.song[data-id='+ postid +']').attr('data-count', count);
            jQuery('.song[data-id='+ postid +']').parent().attr('data-count', count);

            totalSongs += count;
            jQuery('#totalSongs').html(totalSongs);
        });
    });
</script>