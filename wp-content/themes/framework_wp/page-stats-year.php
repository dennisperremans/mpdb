<?php
/**
 * Template Name: Year/Tour statistics
 *
 * @package understrap
 */

get_header();

$container   = get_theme_mod( 'understrap_container_type' );
$currentYear = $_GET['tour'];
?>

<main class="main">
    <?php 
        get_template_part('global-templates/search');
    ?>
    <div class="page-statistics">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <?php 
                        $terms_year = array(
                            'post_type' => array('gig'),
                        );
                        
                        $years = array();
                        $query_year = new WP_Query( $terms_year );
                        
                        if ( $query_year->have_posts() ) :
                            while ( $query_year->have_posts() ) : $query_year->the_post();
                                $year = get_the_date('Y');
                                if(!in_array($year, $years)){
                                    $years[] = $year;
                                }
                            endwhile;
                            wp_reset_postdata();
                        endif;
                        
                        $previousYear = $currentYear - 1; 
                        $nextYear = $currentYear + 1; 

                        $lastYear = reset($years);
                        $firstYear = end($years);
                    ?>

                    

                    <ul class="nav nav-tabs">
                        <li class="active"><a class="active" data-toggle="tab" href="#songs">Songs</a></li>
                        <li><a data-toggle="tab" href="#releases">Releases</a></li>
                        <!--
                        <li><a data-toggle="tab" href="#covers">Covers</a></li>
                        -->
                        <li><a data-toggle="tab" href="#avgsetlist">Avg. setlist</a></li>
                        <li style="margin-left: auto;"></li>
                        <?php if($currentYear > $firstYear) { ?>
                            <li class="nav__prev"><a href="<?php echo get_site_url(); ?>/stats/tour/?tour=<?php echo $previousYear; ?>">Previous year</a></li>
                        <?php } ?>

                        <?php if($currentYear < $lastYear) { ?>
                            <li class="nav__next"><a href="<?php echo get_site_url(); ?>/stats/tour/?tour=<?php echo $nextYear; ?>">Next year</a></li>
                        <?php } ?>
                    </ul>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="tab-content">
                        <div id="songs" class="tab-pane fade in active show">
                            <h3>Songs played on tour <?php echo $currentYear; ?></h3>        
                            <?php 
                                $args = array(
                                    'post_type' => 'gig',
                                    'date_query' => array(
                                        array(
                                            'year'  => $currentYear
                                        ),
                                    ),
                                );
                                $songsByYear = [];
                                $countSongsByYear = 0;
                            ?>
                            
                            <?php $loop = new WP_Query($args); ?>

                            <?php if ( $loop->have_posts() ) : while ( $loop->have_posts() ) : $loop->the_post(); ?>

                                <?php
                                    $posts = get_field('songs');

                                    if( $posts ): 
                                            foreach( $posts as $post):
                                                setup_postdata($post); 
                                                $countSongsByYear ++;
                                                
                                                array_push($songsByYear, $post->ID);
                                            endforeach;
                                        wp_reset_postdata();
                                    endif;
                                ?>

                            <?php endwhile; ?>

                            <?php else: ?>
                                No gigs during this year
                            <?php endif; ?>                                    
                            
                            <ol class="stats-list">
                            <?php 
                                $songsByYear = array_count_values($songsByYear);
                                arsort($songsByYear);

                                $firstKey = array_key_first($songsByYear);

                                $firstValue = $songsByYear[$firstKey]; // this is the highest value so this is 100%

                                foreach ($songsByYear as $key => $value) {
                                    $percentage = ($value / $firstValue) * 100;

                                    echo "<li class='stats-list__item'>";
                                        echo "<div class='stats-list__item__inner'>";
                                            echo "<a class='key' href='". get_the_permalink($key) ."'>" . get_the_title($key) . "</a>";
                                            echo "<a href='".get_site_url()."?fwp_date_as_year=".$currentYear."&fwp_songs=".$key."' class='count'><span class='count__graph' style='width:".$percentage."%'><span class='count__graph__inner'>" . $value ."</span></span></a>";
                                        echo "</div>";
                                    echo "</li>";
                                }
                            ?>
                            </ol>
                        </div>
                        <div id="releases" class="tab-pane fade">
                            <h3>Songs from releases played on tour <?php echo $currentYear; ?></h3>
                            
                            <?php 
                                $args = array(
                                    'post_type' => 'gig',
                                    'date_query' => array(
                                        array(
                                            'year'  => $currentYear
                                        ),
                                    ),
                                );
                                $albumsByYear = [];
                                $countAlbumsByYear = 0;
                            ?>
                            
                            <?php $loop = new WP_Query($args); ?>

                            <?php if ( $loop->have_posts() ) : while ( $loop->have_posts() ) : $loop->the_post(); ?>

                                <?php
                                    $posts = get_field('songs');

                                    if( $posts ): 
                                            foreach( $posts as $post):
                                                setup_postdata($post); 
                                                $countAlbumsByYear ++;
                                                
                                                if((get_field('album',$post->ID) == '')) {
                                                    array_push($albumsByYear, 'Other');
                                                } else {
                                                    array_push($albumsByYear, get_field('album',$post->ID));
                                                }
                                                
                                            endforeach;
                                        wp_reset_postdata();
                                    endif;
                                ?>

                            <?php endwhile; ?>

                            <?php else: ?>

                                No gigs during this year

                            <?php endif; ?>    
                            
                            <ol class="stats-list">
                            <?php 
                                
                                $albumsByYear = array_replace($albumsByYear,array_fill_keys(array_keys($albumsByYear, null),''));
                                $albumsByYear = array_count_values($albumsByYear);
                                arsort($albumsByYear);

                                $firstKey = array_key_first($albumsByYear);

                                $firstValue = $albumsByYear[$firstKey]; // this is the highest value so this is 100%

                                foreach ($albumsByYear as $key => $value) {
                                    $percentage = ($value / $firstValue) * 100;

                                    echo "<li class='stats-list__item'>";
                                        echo "<div class='stats-list__item__inner'>";
                                            if($key == "Other") {
                                                echo "<span class='key'>Other</span>";
                                            } else {
                                                echo "<span class='key'>" . get_the_title($key) . "</span>";
                                            }
                                            echo "<div class='count'><span class='count__graph' style='width:".$percentage."%'><span class='count__graph__inner'>" . $value ."</span></span></div>";
                                        echo "</div>";
                                    echo "</li>";
                                }
                                
                            ?>
                            </ol>
                        </div>

                        <div id="covers" class="tab-pane fade">
                            <h3>Cover played on tour <?php echo $currentYear; ?></h3>
                        </div>
                        
                        <div id="avgsetlist" class="tab-pane fade">
                            <h3>Average setlist of <?php echo $currentYear; ?></h3>

                            <p>
                                This setlist is generated from the most played songs of year <?php echo $currentYear; ?>.
                            </p>

                            <?php
                            //get the gigs of the current year
                            $args = array(
                                'post_type' => 'gig',
                                'date_query' => array(
                                    array(
                                        'year'  => $currentYear
                                    ),
                                ),
                            );
                            
                            $allSongs = [];
                            $countSongs = 0;
                            $countGigs = 0;
                            $average = 0;

                            //count how many songs in total
                            $loop = new WP_Query($args);

                            if ( $loop->have_posts() ) : while ( $loop->have_posts() ) : $loop->the_post();

                                    $posts = get_field('songs');

                                    if( $posts ): 
                                            foreach( $posts as $post):
                                                setup_postdata($post); 
                                                $countSongs ++;
                                                
                                                array_push($allSongs, $post->ID);
                                            endforeach;
                                        wp_reset_postdata();
                                    endif;

                                    $countGigs ++;
                    
                                endwhile;

                            endif;

                            //get average number: songs/gigs (round up)
                            if($countGigs > 0) {
                                $average = ceil($countSongs / $countGigs);
                            }

                            //get all the songs sorted by numbers of played
                            $allSongs = array_count_values($allSongs);
                            arsort($allSongs); //print_r($allSongs);
                            ?>

                            <div class="setlist">
                                <div class="setlist__header">
                                    <h2 class="setlist__header__title">Setlist</h2>
                                </div>

                                <div class="setlist__content">
                                    
                                    <?php 
                                    $posts = get_field('songs');
                                    $counter = 0;
                                    ?>


                                    <ol class="setlist__content__list">
                                        <?php foreach( $allSongs as $key => $value): ?>
                                            <?php 
                                                if ($counter < $average) {
                                                    $counter ++;
                                            ?>
                                            
                                            <li class="setlist__content__list__item">
                                                <a class="setlist__content__list__item__link" href="<?php get_the_permalink($key)?>"><?php echo get_the_title($key); ?><?php if(get_field('other_band_name',$key)){ ?> <span class="cover">Cover: <?php the_field('other_band_name',$key); ?></span>  <?php } ?></a>
                                            </li>

                                            <?php } ?>
                                        <?php endforeach; ?>
                                    </ol>
                                </div>
                            </div> <!-- setlist -->


                            <?php
                            //get the first x number of songs = average number.
                        
                            ?>
                        </div>
                    </div>
                </div> <!-- col-md-12 -->
            </div> <!-- row -->
        </div>
    </div>
</main>

<?php get_footer(); ?>
