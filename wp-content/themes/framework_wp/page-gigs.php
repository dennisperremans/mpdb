<?php
/**
 * Template Name: Gigs
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

    <div class="gig-header">
        <div class="container">
            <div class="row">
                <div class="col-md-3">
                    <div class="gig-count">
                        <?php echo do_shortcode('[facetwp counts="true"]'); ?> gigs
                    </div>
                </div>
                <div class="col-md-9">
                    <div class="gig-sort">
                        <?php echo do_shortcode('[facetwp sort="true"]'); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row" style="margin-bottom: 1rem;">
            <div class="col-md-3">

            </div>
            <div class="col-md-9 col-sm-12 text--center">
                <div class="facet-gigs__pager--top">
                    <?php echo facetwp_display( 'pager' ); ?>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-3">
                <div class="filter">
                    <div class="filter__wrapper">
                        <div class="filter__item">
                            <span class="filter__item__label">Country</span>
                            <div class="filter__item__choice">
                                <?php echo facetwp_display('facet', 'country'); ?>
                            </div>
                        </div>
                        <div class="filter__item">
                            <span class="filter__item__label">City</span>
                            <div class="filter__item__choice">
                                <?php echo facetwp_display('facet', 'city'); ?>
                            </div>
                        </div>
                        <div class="filter__item">
                            <span class="filter__item__label">Venue</span>
                            <div class="filter__item__choice">
                                <?php echo facetwp_display('facet', 'venue'); ?>
                            </div>
                        </div>
                        <div class="filter__item">
                            <span class="filter__item__label">Year</span>
                            <div class="filter__item__choice">
                                <?php echo facetwp_display('facet', 'date_as_year'); ?>
                            </div>
                        </div>
                        <div class="filter__item">
                            <span class="filter__item__label">Date range</span>
                            <div class="filter__item__choice">
                                <?php echo facetwp_display('facet', 'date_range'); ?>
                            </div>
                        </div>
                        <div class="filter__item">
                            <span class="filter__item__label">Songs</span>
                            <div class="filter__item__choice">
                                <?php echo facetwp_display('facet', 'songs'); ?>
                            </div>
                        </div>
                        <div class="filter__item">
                            <span class="filter__item__label">Recording available</span>
                            <div class="filter__item__choice">
                                <?php echo facetwp_display('facet', 'recording'); ?>
                            </div>
                        </div>
                        <div class="filter__item">
                            <span class="filter__item__label">Video(s) available</span>
                            <div class="filter__item__choice">
                                <?php echo facetwp_display('facet', 'video'); ?>
                            </div>
                        </div>
                        <div class="filter__item">
                            <span class="filter__item__label">Picture(s) available</span>
                            <div class="filter__item__choice">
                                <?php echo facetwp_display('facet', 'picture'); ?>
                            </div>
                        </div>
                    </div>
                </div>
            
            </div>
            <div class="col-md-9 col-sm-12">
                <div class="facet-gigs">
                    <div class="facet-gigs__list">
                        <?php echo do_shortcode('[facetwp template="gigs_full"]'); ?>
                    </div>
                    <div class="facet-gigs__pager">
                        <?php echo facetwp_display( 'pager' ); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

<?php get_footer(); ?>
