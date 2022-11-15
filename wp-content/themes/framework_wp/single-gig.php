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
                    <?php
                        function removeAccents($str) {
                            $a = array('À', 'Á', 'Â', 'Ã', 'Ä', 'Å', 'Æ', 'Ç', 'È', 'É', 'Ê', 'Ë', 'Ì', 'Í', 'Î', 'Ï', 'Ð', 'Ñ', 'Ò', 'Ó', 'Ô', 'Õ', 'Ö', 'Ø', 'Ù', 'Ú', 'Û', 'Ü', 'Ý', 'ß', 'à', 'á', 'â', 'ã', 'ä', 'å', 'æ', 'ç', 'è', 'é', 'ê', 'ë', 'ì', 'í', 'î', 'ï', 'ñ', 'ò', 'ó', 'ô', 'õ', 'ö', 'ø', 'ù', 'ú', 'û', 'ü', 'ý', 'ÿ', 'Ā', 'ā', 'Ă', 'ă', 'Ą', 'ą', 'Ć', 'ć', 'Ĉ', 'ĉ', 'Ċ', 'ċ', 'Č', 'č', 'Ď', 'ď', 'Đ', 'đ', 'Ē', 'ē', 'Ĕ', 'ĕ', 'Ė', 'ė', 'Ę', 'ę', 'Ě', 'ě', 'Ĝ', 'ĝ', 'Ğ', 'ğ', 'Ġ', 'ġ', 'Ģ', 'ģ', 'Ĥ', 'ĥ', 'Ħ', 'ħ', 'Ĩ', 'ĩ', 'Ī', 'ī', 'Ĭ', 'ĭ', 'Į', 'į', 'İ', 'ı', 'Ĳ', 'ĳ', 'Ĵ', 'ĵ', 'Ķ', 'ķ', 'Ĺ', 'ĺ', 'Ļ', 'ļ', 'Ľ', 'ľ', 'Ŀ', 'ŀ', 'Ł', 'ł', 'Ń', 'ń', 'Ņ', 'ņ', 'Ň', 'ň', 'ŉ', 'Ō', 'ō', 'Ŏ', 'ŏ', 'Ő', 'ő', 'Œ', 'œ', 'Ŕ', 'ŕ', 'Ŗ', 'ŗ', 'Ř', 'ř', 'Ś', 'ś', 'Ŝ', 'ŝ', 'Ş', 'ş', 'Š', 'š', 'Ţ', 'ţ', 'Ť', 'ť', 'Ŧ', 'ŧ', 'Ũ', 'ũ', 'Ū', 'ū', 'Ŭ', 'ŭ', 'Ů', 'ů', 'Ű', 'ű', 'Ų', 'ų', 'Ŵ', 'ŵ', 'Ŷ', 'ŷ', 'Ÿ', 'Ź', 'ź', 'Ż', 'ż', 'Ž', 'ž', 'ſ', 'ƒ', 'Ơ', 'ơ', 'Ư', 'ư', 'Ǎ', 'ǎ', 'Ǐ', 'ǐ', 'Ǒ', 'ǒ', 'Ǔ', 'ǔ', 'Ǖ', 'ǖ', 'Ǘ', 'ǘ', 'Ǚ', 'ǚ', 'Ǜ', 'ǜ', 'Ǻ', 'ǻ', 'Ǽ', 'ǽ', 'Ǿ', 'ǿ', 'Ά', 'ά', 'Έ', 'έ', 'Ό', 'ό', 'Ώ', 'ώ', 'Ί', 'ί', 'ϊ', 'ΐ', 'Ύ', 'ύ', 'ϋ', 'ΰ', 'Ή', 'ή');
                            $b = array('A', 'A', 'A', 'A', 'A', 'A', 'AE', 'C', 'E', 'E', 'E', 'E', 'I', 'I', 'I', 'I', 'D', 'N', 'O', 'O', 'O', 'O', 'O', 'O', 'U', 'U', 'U', 'U', 'Y', 's', 'a', 'a', 'a', 'a', 'a', 'a', 'ae', 'c', 'e', 'e', 'e', 'e', 'i', 'i', 'i', 'i', 'n', 'o', 'o', 'o', 'o', 'o', 'o', 'u', 'u', 'u', 'u', 'y', 'y', 'A', 'a', 'A', 'a', 'A', 'a', 'C', 'c', 'C', 'c', 'C', 'c', 'C', 'c', 'D', 'd', 'D', 'd', 'E', 'e', 'E', 'e', 'E', 'e', 'E', 'e', 'E', 'e', 'G', 'g', 'G', 'g', 'G', 'g', 'G', 'g', 'H', 'h', 'H', 'h', 'I', 'i', 'I', 'i', 'I', 'i', 'I', 'i', 'I', 'i', 'IJ', 'ij', 'J', 'j', 'K', 'k', 'L', 'l', 'L', 'l', 'L', 'l', 'L', 'l', 'l', 'l', 'N', 'n', 'N', 'n', 'N', 'n', 'n', 'O', 'o', 'O', 'o', 'O', 'o', 'OE', 'oe', 'R', 'r', 'R', 'r', 'R', 'r', 'S', 's', 'S', 's', 'S', 's', 'S', 's', 'T', 't', 'T', 't', 'T', 't', 'U', 'u', 'U', 'u', 'U', 'u', 'U', 'u', 'U', 'u', 'U', 'u', 'W', 'w', 'Y', 'y', 'Y', 'Z', 'z', 'Z', 'z', 'Z', 'z', 's', 'f', 'O', 'o', 'U', 'u', 'A', 'a', 'I', 'i', 'O', 'o', 'U', 'u', 'U', 'u', 'U', 'u', 'U', 'u', 'U', 'u', 'A', 'a', 'AE', 'ae', 'O', 'o', 'Α', 'α', 'Ε', 'ε', 'Ο', 'ο', 'Ω', 'ω', 'Ι', 'ι', 'ι', 'ι', 'Υ', 'υ', 'υ', 'υ', 'Η', 'η');
                            return str_replace($a, $b, $str);
                        }
                        $country = str_replace(' ','-', strtolower(removeAccents(get_field('country'))));
                        $venue = str_replace(' ','-', strtolower(removeAccents(get_field('venue_name'))));
                    ?>
                    At <a href="<?php echo get_site_url(); ?>?fwp_country=<?php echo $country; ?>&fwp_venue=<?php echo $venue; ?>"><?php echo get_field('venue_name'); ?></a>, <?php echo get_field('city'); ?>, <span class="country"><?php echo get_field('country'); ?></span> <br />

                    <i class="fas fa-chart-bar"></i> <a href="<?php echo get_site_url(); ?>/stats/tour/?tour=<?php echo get_the_date( 'Y' ); ?>" class="about-gig__link">Tour stats</a>
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
                        
                        
                        <ul class="nav nav-tabs">
                            <li class="active"><a class="active show" data-toggle="tab" href="#videos">Videos</a></li>
                            <li><a data-toggle="tab" href="#pictures">Pictures</a></li>
                        </ul>

                        <div class="tab-content">
                        
                            <div id="videos" class="tab-pane fade in active show">
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

                                                endif;
                                            ?>
                                        </div>
                                    </div>
                                <?php } else { ?>
                                    <strong>No videos available</strong>
                                <?php } ?>
                            </div><!-- videos -->

                            <div id="pictures" class="tab-pane fade">
                                <?php if(get_field('gig_picture_list')) { ?>
                                    <div class="pictures">
                                        <div class="pictures__wrapper">
                                            <?php
                                                // check if the repeater field has rows of data
                                                if( have_rows('gig_picture_list') ):

                                                    // loop through the rows of data
                                                    while ( have_rows('gig_picture_list') ) : the_row();
                                                ?>
                                                    <?php 
                                                        $image = get_sub_field('picture');
                                                        $url = $image['url'];

                                                        $size = 'thumbnail';
                                                        $thumb = $image['sizes'][ $size ];
                                                    ?>
                                                    <a href="<?php echo esc_url($url); ?>" class="pictures__item" data-lity>
                                                        <?php
                                                        if( !empty( $image ) ): ?>
                                                            <img src="<?php echo esc_url($thumb); ?>" alt="<?php echo esc_attr($image['alt']); ?>" />
                                                        <?php endif; ?>
                                                    </a>
                                                <?php
                                                    endwhile;

                                                else :

                                                endif;
                                            ?>
                                        </div>
                                    </div>
                                <?php } else { ?>
                                    <strong>No pictures available</strong>
                                <?php } ?>
                            </div> <!-- pictures -->
                        </div>
                        
                    </div> <!-- / col -->
                </div>

                <div class="col-md-4 col-sm-12">
                    <div class="sidebar">

                        <!-- extra info block -->
                        <?php if ( !empty( get_the_content() ) ) { ?>
                            <div class="block">
                                <div class="block__header">
                                    <h2 class="block__header__title">Extra info</h2>
                                </div>
                                <div class="block__content block__content--small">
                                    <?php the_content(); ?>
                                </div>
                            </div>
                        <?php } ?>
                        <!-- /extra info block -->

                        <?php if(get_field('played_with_other_artist')){ ?>
                            <div class="block">
                                <div class="block__header">
                                    <h2 class="block__header__title">Played with:</h2>
                                </div>

                                <div class="block__content block__content--small">
                                    <?php the_field('played_with_other_artist'); ?>
                                </div>
                            </div>
                        <?php } ?>

                        <!-- MP releases block -->
                        <div class="block">
                            <div class="block__header">
                                <h2 class="block__header__title">Songs on MP releases</h2>
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
                        <!-- /MP releases block -->

                        <!-- Other dates on this venue block -->
                        <div class="block">
                            <div class="block__header">
                                <h2 class="block__header__title">Played on this venue</h2>
                            </div>
                            <div class="block__content">
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
                                
                                <a class="gig--date" href="<?php the_permalink(); ?>">
                                    <span class="month"><?php echo get_the_date( 'F' ); ?></span>
                                    <span class="day"><?php echo get_the_date( 'j' ); ?></span>, 
                                    <span class="year"><?php echo get_the_date( 'Y' ); ?></span>
                                </a>

                                <?php endwhile; ?>

                                <?php else: ?>
                                    <span>There are no other gigs on this location</span>
                                <?php endif; ?>
                                <?php wp_reset_postdata(); ?>
                            </div>
                        </div>
                        <!-- /Other dates on this venue block -->
                        
                    </div>
                </div>
            </div> <!-- row -->
            
            <?php if(get_field('feedUrl')) { ?>
                <div class="row">
                    <div class="col-md-12">
                        <div class="feed">
                            <?php
                            $url = get_field('feedUrl');
                            $invalidurl = false;
                            if(@simplexml_load_file($url)){
                                $feeds = simplexml_load_file($url);
                            }else{
                                $invalidurl = true;
                                echo "<h2>Invalid RSS feed URL.</h2>";
                            }
                        
                            if(!empty($feeds)){
                        
                                $site = $feeds->channel->title;
                                $sitelink = $feeds->channel->link;
                                $articles = [];
                            
                                echo "<h1>".$site."</h1>";
                                foreach ($feeds->channel->item as $item) {

                                    array_push($articles, $item);
                        
                                }
								echo "<pre>";
								//var_dump($articles);
								echo "</pre>";
                            }

                            $articles = array_reverse($articles, true);

                            foreach($articles as $item) {

                                $title = $item->title;
                                $link = $item->link;
                                $description = $item->description;
                                $postDate = $item->pubDate;
                                $pubDate = date('D, d M Y',strtotime($postDate));
								
							
                            ?>

                            <div class="feed__post">
                                <div class="feed__post__head">
                                    <span><?php echo $pubDate; ?></span>
                                </div>
                                <div class="feed__post__content">
                                    <?php echo html_entity_decode($description); ?>
                                </div>
                                <div class="feed__post__more">
                                    <a href="<?php echo $link; ?>" target="_blank">Read more</a>
                                </div>
                            </div>

                            <?php
                            }
                            ?>
                        </div>
                    </div>
                </div>
                <!-- /row -->
            <?php } ?>
        </div> <!-- container -->
    </div>
</main>

<?php get_footer(); ?>
