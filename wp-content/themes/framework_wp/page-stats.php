<?php
/**
 * Template Name: Statistics
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
    <div class="page-statistics">
        <div class="container">
            <div class="row">
                <div class="col-md-6 col-sm-12">
                    <div class="gig-list">
                        <h2>Latest gigs added</h2>
                        <?php 
                            $args = array(
                                'post_type' => 'gig',
                                'orderby' => 'publish_date', 
                                'order' => 'DESC',
                                'posts_per_page' => '10'
                            ); 
                        ?>
                        
                        <?php $loop = new WP_Query($args); ?>

                        <?php if ( $loop->have_posts() ) : while ( $loop->have_posts() ) : $loop->the_post(); ?>

                            <?php get_template_part('loop-templates/content-gig'); ?>

                        <?php endwhile; ?>

                        <?php else: ?>
                            <!-- No gigs available -->
                        <?php endif; ?>
                        <?php wp_reset_postdata(); ?>
                    </div>
                </div>

                <div class="col-md-3 col-sm-12">
                    <h2>Played in countries</h2>
                    <ul class="list list--countries">
                    <?php foreach (getNumberCountries() as $country => $count) { ?>
                        <li class="list__item">
                            <span class="number"><?php echo $count; ?></span> <a href="https://mpdb.space/?fwp_country=<?php echo str_replace(' ','-',strtolower($country)); ?>"><?php echo $country; ?></a>
                        </li>
                    <?php } ?>
                    </ul>
                </div>

                <div class="col-md-3 col-sm-12">
                    <h2>Played in cities</h2>
                    <ul class="list list--cities">
                    <?php foreach (getNumberCities() as $city => $count) { ?>
                        <li class="list__item">
                            <span class="number"><?php echo $count; ?></span> <a href="https://mpdb.space/?fwp_city=<?php echo str_replace(' ','-',strtolower($city)); ?>"><?php echo $city; ?></a>
                        </li>
                    <?php } ?>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</main>

<?php get_footer(); ?>
