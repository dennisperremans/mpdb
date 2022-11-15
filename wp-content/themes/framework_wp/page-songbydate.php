<?php
/**
 * Template Name: Songs by date
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
                                All the songs played by date
                            </h2>
                            <div class="sort">
                                Filter here
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row js-songs-sortable" id="all-song-list">
                    <?php 
                        $args = array(
                            'post_type' => 'gig',
                            'order' => 'DESC',
                            'orderby' => 'date',
                        );
                    ?>
                    
                    <?php $loop = new WP_Query($args); ?>

                    <?php if ( $loop->have_posts() ) : while ( $loop->have_posts() ) : $loop->the_post(); ?>

                        <?php
                            $gigDate = get_the_date('d/m/Y');
                            $posts = get_field('songs');

                            if( $posts ): 
                                    foreach( $posts as $post):
                                        setup_postdata($post); 
                                    ?>
                                        <div class="col-md-6 col-sm-12" data-date="<?php echo $gigDate; ?>">
                                            <a href="<?php echo get_post_permalink($post->ID); ?>" class="song song--small">
                                                
                                                <div class="song__content">
                                                    <div class="song__title">
                                                        <?php echo get_the_title($post->ID); ?>
                                                    </div>
                                                </div>
                                                <div class="song__played">
                                                    <i class="fa fa-calendar"></i>
                                                    <?php echo $gigDate; ?>
                                                </div>
                                            </a>
                                        </div>
                                    <?php
                                        
                                        /*
                                        if (array_key_exists($post->ID, $countArray)){
                                            $countArray[$post->ID]++;
                                        }
                                        else {
                                            $countArray[$post->ID] = 1;    
                                        } 
                                        */

                                    endforeach;
                                    
                                wp_reset_postdata();
                            endif;
                        ?>

                    <?php endwhile; ?>

                    <?php endif; ?>
                </div>
            </div>
        </div>
        
    </div>
</main>

<?php get_footer(); ?>