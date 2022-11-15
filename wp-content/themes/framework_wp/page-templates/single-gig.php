<?php
/**
 * The template for displaying all single posts.
 *
 * @package understrap
 */

get_header();
$container   = get_theme_mod( 'understrap_container_type' );
?>
<header class="primary-header primary-header--gig">
    <div class="container">
        <div class="primary-header__title">
            <div class="about-gig">
                <div class="about-gig__date">
                    <span class="day"><?php echo get_the_date( 'd' ); ?></span>
                    <span class="month"><?php echo get_the_date( 'M' ); ?></span>
                    <span class="year"><?php echo get_the_date( 'Y' ); ?></span>
                </div>
                <div class="about-gig__location">
                    At <?php echo get_field('venue_name'); ?>, <?php echo get_field('city'); ?>, <span class="country"><?php echo get_field('country'); ?></span>
                </div>
            </div>
        </div>
    </div>
</header>
<main class="main">
    <div class="single-gig-page">
        <div class="container">
            <div class="row">
                <div class="col-md-8 col-sm-12">
                <?php if( is_singular('gig') ) { ?>
                    <div class="gig-pager">
                        <?php previous_post_link( '%link', 'Previous gig' ) ?>
                        <?php next_post_link( '%link', 'Next gig' ) ?>
                    </div>
                <?php } ?>
                </div>
            </div>
            <div class="row">
                <div class="col-md-8 col-sm-12">
                    <div class="content-gig">

                        <div class="setlist">
                            <div class="setlist__header">
                                <h2 class="setlist__header__title">Setlist</h2>
                                
                                <?php if ( is_user_logged_in() ) {  ?>
                                <div class="setlist__header__attending">
                                    <?php 
                                        
                                        $isAttending = false;

                                        //get user id
                                        $current_user = wp_get_current_user();
                                        $current_user_id = $current_user->ID;

                                        //get post id
                                        $current_post_id = get_the_ID();

                                        $attending = $wpdb->get_var(
                                            $wpdb->prepare(
                                                "SELECT attending_id FROM " . $wpdb->prefix . "gigs_attending
                                                WHERE user_id = %d AND post_id = %d LIMIT 1",
                                                $current_user_id, $current_post_id
                                            )
                                        );

                                        if ( $attending > 0 ) {
                                            $isAttending = true;
                                        } else {
                                            $isAttending = false;
                                        }

                                        
                                    ?>
                                    <?php if($isAttending == false) { ?>
                                        <div class="attended">
                                            <form method="post" id="attending" class="attended__form">
                                                <button class="attended__button attenden__button--not" id="btnAttend" name="submit" type="submit">
                                                    I wasn't there
                                                    <i class="far fa-hand-rock"></i>
                                                </button>
                                            </form>


                                            <?php 
                                                if(isset($_POST['submit'])) {
                                                    $success = $wpdb->insert("wp_gigs_attending", array(
                                                        "user_id" => $current_user_id,
                                                        "post_id" => $current_post_id,
                                                    ));
                                                    echo "<meta http-equiv='refresh' content='0'>";    
                                                }
                                            ?>
                                        </div>
                                    <?php } else { ?>
                                        <div class="attended">
                                            <form method="post" id="attending" class="attended__form">
                                                <button class="attended__button" id="btnAttend" name="submit" type="submit">
                                                    I was there
                                                    <i class="fas fa-hand-rock"></i>
                                                </button>
                                            </form>

                                            <?php 
                                                if(isset($_POST['submit'])) {   

                                                    $succes = $wpdb->get_var(
                                                        $wpdb->prepare(
                                                            "DELETE FROM " . $wpdb->prefix . "gigs_attending
                                                            WHERE user_id = %d AND post_id = %d LIMIT 1",
                                                            $current_user_id, $current_post_id
                                                        )
                                                    );

                                                    echo "<meta http-equiv='refresh' content='0'>";
                                                }
                                            ?>
                                        </div>
                                    <?php } ?>
                                </div>
                                <?php } ?>
                            </div>

                            <div class="setlist__content">
                                

                                <?php 
                                $posts = get_field('songs');

                                if( $posts ): ?>
                                    <?php if(get_field('hasRecording')) { ?>
                                        <div class="setlist__content__recording">
                                            Recording available
                                        </div>
                                    <?php } ?>

                                    <ol class="setlist__content__list">
                                        <?php foreach( $posts as $post): // variable must be called $post (IMPORTANT) ?>
                                            <?php setup_postdata($post); ?>
                                            
                                            <li class="setlist__content__list__item">
                                                <a class="setlist__content__list__item__link" href="<?php the_permalink($post)?>"><?php the_title(); ?><?php if(get_field('other_band_name',$post)){ ?> <span class="cover">Cover: <?php the_field('other_band_name'); ?></span>  <?php } ?></a>
                                            </li>
                                        <?php endforeach; ?>
                                    </ol>
                                    <?php wp_reset_postdata(); // IMPORTANT - reset the $post object so the rest of the page works correctly ?>
                                <?php else: ?>

                                    <div class="setlist__content__nosetlist">
                                        <span class="label label--icon"><i class="fas fa-exclamation-circle"></i>&nbsp;No setlist available</span>
                                    </div>
                                <?php endif; ?>
                                
                                <?php if(get_field('isIncomplete')) { ?>
                                    <div class="setlist__content__incomplete">
                                        <span class="label label--icon"><i class="fas fa-exclamation-circle"></i>The setlist is incomplete</span>
                                    </div>
                                <?php } ?>
                            </div>
                        </div> <!-- setlist -->

                        <?php if ( !empty( get_the_content() ) ) { ?>
                            <div class="block">
                                <div class="block__header">
                                    <h2 class="block__header__title">Extra info</h2>
                                </div>
                                <div class="block__content">
                                    <?php the_content(); ?>
                                </div>
                            </div>
                        <?php } ?>

                        <div class="block">
                            <div class="block__header">
                                <h2 class="block__header__title">Songs on albums</h2>
                            </div>
                            <div class="block__content">
                                <?php 
                                    $posts = get_field('songs');
                                    $abumIds = [];

                                    if( $posts ):
                                        foreach( $posts as $post):
                                            setup_postdata($post);

                                            if(get_field('album', $post->ID)) {
                                                $albumId = get_field('album', $post->ID);

                                                array_push($abumIds, $albumId);
                                            }
                                        endforeach;
                                        wp_reset_postdata();
                                    else:

                                    endif;

                                    $abumIds = array_count_values($abumIds);
                                    //print_r($abumIds);
                                ?>

                                <ul class="list list--countries">
                                    <?php foreach ($abumIds as $albumId => $count) { ?>
                                        <li class="list__item">
                                            <span class="number"><?php echo $count; ?></span><?php echo get_the_title($albumId); ?>
                                        </li>
                                    <?php } ?>
                                </ul>
                            </div>
                        </div>

                        <?php if(get_field('gig_video_list')) { ?>
                            <div class="videos">
                                <div class="videos__wrapper">
                                    <?php
                                        // check if the repeater field has rows of data
                                        if( have_rows('gig_video_list') ):

                                            // loop through the rows of data
                                            while ( have_rows('gig_video_list') ) : the_row();
                                        ?>
                                            <div class="videos__item">
                                                <a class="videos__item__link" href="" data-lity></a>
                                                <?php the_sub_field('video'); ?>
                                            </div>
                                        <?php
                                            endwhile;

                                        else :

                                            // no videos found

                                        endif;
                                    ?>
                                </div>
                            </div>
                        <?php } ?>
                    </div>
                </div>

                <div class="col-md-4 col-sm-12">
                    <div class="sidebar">

                        <div class="other-gigs">
                            <h2>Other gigs played on this location:</h2>

                            <?php 
                                $args = array(
                                    'post_type' => 'gig',
                                    'post__not_in' => array( $post->ID ),
                                    //'meta_key' => 'venue_name',
                                    //'meta_value' => get_field('venue_name'),
                                    'meta_query'        => array(
                                        'relation'      => 'AND',
                                        array(
                                            'key'       => 'venue_name',
                                            'value'     => get_field('venue_name'),
                                            'compare'   => '=',
                                        ),
                                        array(
                                            'key'       => 'city',
                                            'value'     => get_field('city'),
                                            'compare'   => '=',
                                        )
                                    )
                                ); 
                            ?>
                            
                            <?php $loop = new WP_Query($args); ?>

                            <?php if ( $loop->have_posts() ) : while ( $loop->have_posts() ) : $loop->the_post(); ?>
                            
                                <?php get_template_part('loop-templates/content-gig'); ?>

                            <?php endwhile; ?>

                            <?php else: ?>
                                <span>There are no other gigs on this location</span>
                            <?php endif; ?>
                            <?php wp_reset_postdata(); ?>
                        </div>
                    </div>
                </div>
            </div> <!-- row -->
        </div> <!-- container -->
    </div>
</main>

<?php get_footer(); ?>
