<?php
/**
 * Template Name: Default
 *
 * @package understrap
 */

get_header();

$container   = get_theme_mod( 'understrap_container_type' );

?>

<main class="main">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="page-wrapper">
                    <?php get_template_part( 'loop-templates/content', 'page' ); ?>
                </div>
            </div>
        </div>
    </div>
</main>

<?php get_footer(); ?>
