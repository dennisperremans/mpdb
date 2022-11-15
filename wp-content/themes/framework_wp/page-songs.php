<?php
/**
 * Template Name: Songs
 *
 * @package understrap
 */

get_header();

$container   = get_theme_mod( 'understrap_container_type' );

?>

<main class="main">
    <?php 
        get_template_part('global-templates/search');
    ?>
    <div class="songs-page">            

        <div class="songs-page__full">
            <div class="container">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="d-flex justify-content-between">
                            
                            <h2 class="title">
                                All the songs played
                            </h2>
                            <div class="sort">
                                <select class="js-sort">
                                    <option value="10-1">Played (10-1)</option>
                                    <option value="1-10">Played (1-10)</option>
                                    <option value="az">Title (A-Z)</option>
                                    <option value="za">Title (Z-A)</option>
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
                            'post_type' => 'gig'
                        ); 

                        $countArray = [];
                    ?>
                    
                    <?php $loop = new WP_Query($args); ?>

                    <?php if ( $loop->have_posts() ) : while ( $loop->have_posts() ) : $loop->the_post(); ?>

                        <?php
                            $posts = get_field('songs');

                            if( $posts ): 
                                    foreach( $posts as $post):
                                        setup_postdata($post);
                                        
                                        if (array_key_exists($post->ID, $countArray)){
                                            $countArray[$post->ID]++;
                                        }
                                        else {
                                            $countArray[$post->ID] = 1;    
                                        } 
                                    endforeach;
                                    
                                wp_reset_postdata();
                            endif;
                        ?>

                    <?php endwhile; ?>

                    <?php
                        arsort($countArray);

                        foreach ($countArray as $key => $value) {
                        ?>

                            <div class="col-md-4 col-sm-12" data-count="<?php echo $value; ?>" data-name="<?php echo get_the_title($key); ?>">
                                <a href="<?php echo get_post_permalink($key); ?>" class="song song--small">
                                    
                                    <div class="song__content">
                                        <div class="song__title">
                                            <?php echo get_the_title($key); ?>
                                        </div>
                                        <!--
                                        <?php if(get_field('album', $key)) { ?>
                                            <div class="song__album">
                                                Album: 
                                                <?php echo get_field('album', $key); ?>
                                            </div>
                                        <?php } ?>
                                        -->
                                    </div>
                                    <div class="song__played">
                                        <i class="fa fa-microphone"></i>
                                        # <?php echo $value; ?>
                                    </div>
                                </a>
                            </div>
                            
                        <?php  
                        }
                    ?>

                    <?php else: ?>
                        <!-- No gigs available -->
                    <?php endif; ?>
                    <?php wp_reset_postdata(); ?>
                </div>
            </div>
        </div>
        
    </div>
</main>

<?php get_footer(); ?>

<script>
/**
*
* Show the most played gigs first.
*
 */
    jQuery('#js-10-1').trigger('click');
</script>
