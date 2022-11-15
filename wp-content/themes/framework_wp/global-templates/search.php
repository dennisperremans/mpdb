<section class="section-search">
    <div class="section-search__container d-flex">
        <div class="searchbox">
            <h1 class="searchbox__title">Search for gigs, songs, location,...</h1>
            <?php echo do_shortcode('[wpdreams_ajaxsearchlite]'); ?>
        </div>
    </div>

    <div class="my-gigs__header__bottom">
        <div class="container">
            <div class="row">
                <div class="col-4">
                    <div class="overview">
                        <div class="overview__label">
                            <strong>Songs on MPDB</strong>
                        </div>

                        <div class="overview__value">
                            <?php 
                                $count_songs = wp_count_posts('song')->publish;
                                echo $count_songs . " added"
                            ?>
                        </div>
                    </div>
                </div>
                <div class="col-4">
                    <div class="overview">
                        <div class="overview__label">
                            <strong>Gigs on MPDB</strong> 
                        </div>
                        
                        <div class="overview__value">
                            <?php 
                                $count_gigs = wp_count_posts('gig')->publish;
                                echo $count_gigs . " added"
                            ?>
                        </div>
                    </div>
                </div>
                <div class="col-4">
                    <div class="overview">
                        <div class="overview__label">
                            <strong>Songs played live</strong>
                        </div>
                        
                        <div class="overview__value">
                            <?php
                                echo getNumberSongsPlayed();
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>