<?php
/**
 * Template name: Test
 *
 *
 * @package understrap
 */

get_header();

$home_id = get_option( 'page_on_front' );

?>

<main class="main" id="main">
    <section class="section-cars">
        <div class="container">
            <div class="title">
                <span class="title__sub">
                    <?php the_field('homepage_cars_title', $home_id); ?>
                </span>

                <span class="title__main">
                    <?php the_field('homepage_cars_subtitle', $home_id); ?>
                </span>
            </div>
        </div>
        <div class="container section-cars__container">

            <div class="js-car-slider-homepage left-align-slick">
                <?php 
                    $args = array(
                        'post_type' => 'car',
                        'meta_key' => 'car_show_on_homepage',
                        'meta_value' => true
                    ); 
                ?>
                <?php $loop = new WP_Query($args); ?>

                <?php if ( $loop->have_posts() ) : while ( $loop->have_posts() ) : $loop->the_post(); ?>

                    <?php get_template_part( 'loop-templates/content', 'car' ); ?>

                <?php endwhile; ?>

                <?php else: ?>
                    <span class="message">
                        <?php _e('Geen wagens beschikbaar','safelease-theme'); ?>
                    </span>
                <?php endif; ?>
                <?php wp_reset_postdata(); ?>
            </div>


        </div>
        
        <div class="container">
            <div class="button-wrapper text--center">
                <a href="<?php the_field('homepage_cars_cta_link', $home_id); ?>" class="button button--primary"><?php the_field('homepage_cars_cta_text', $home_id); ?></a>
            </div>
        </div>
    </section>
    


    <section class="section-advantages">
        <div class="container section-advantages__container">
            <div class="row">
                <div class="col-sm-12 col-md-5">
                    <div class="section-advantages__left">
                        <div class="section-advantages__content">
                            <?php the_field('homepage_advantages_text', $home_id); ?>

                            <?php if(get_field('homepage_advantages_cta_link', $home_id)) { ?>
                                <a href="<?php the_field('homepage_advantages_cta_link', $home_id); ?>" class="button button--primary"><?php the_field('homepage_advantages_cta_text', $home_id); ?></a>
                            <?php } ?>
                        </div>
                    </div>
                </div>

                <div class="col-sm-12 col-md-7">
                    <div class="section-advantages__right">
                        <?php 
                            $image = get_field('homepage_advantages_photo', $home_id);
                            $url = $image['url'];
                            $alt = $image['alt'];

                            $size = 'large';
                            $image = $image['sizes'][$size];
                        ?>

                        
                        <img class="section-advantages__image" alt="<?php echo $alt; ?>" src="<?php echo $image; ?>" />
                          
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="section-how">
        <div class="container">
            <div class="title">
                <span class="title__sub text--center">
                    <?php the_field('homepage_how_it_works_title', $home_id); ?>
                </span>
                <span class="title__main text--center">
                    <?php the_field('homepage_how_it_works_subtitle', $home_id); ?>
                </span>
            </div>
        </div>

        <div class="container section-how__container no-padding">
            <div class="row">
                <div class="col-md-4">
                    <div class="section-how__item">
                        <span class="section-how__item__number">01</span>

                        <div class="section-how__item__content">
                            <?php the_field('homepage_how_it_works_block_1_text', $home_id); ?>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="section-how__item">
                        <span class="section-how__item__number">02</span>

                        <div class="section-how__item__content">
                            <?php the_field('homepage_how_it_works_block_2_text', $home_id); ?>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="section-how__item">
                        <span class="section-how__item__number">03</span>

                        <div class="section-how__item__content">
                            <?php the_field('homepage_how_it_works_block_3_text', $home_id); ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <?php include 'global-templates/bottom-cta.php'; ?>

    <?php include 'global-templates/testimonials.php'; ?>

</main>

<?php get_footer(); ?>