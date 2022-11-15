jQuery(function(){

    /**
     * 
     * Description: Toggle filters
     * Template: page-gigs.php
     */
    jQuery('.filter__item__label').click(function(){
        jQuery(this).next('.filter__item__choice').toggle();
        jQuery(this).toggleClass('active');
    });


});