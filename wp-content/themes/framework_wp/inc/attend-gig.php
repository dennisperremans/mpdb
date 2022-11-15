<?php
    //get the user id
    $current_user = wp_get_current_user();
    $current_user_id = $current_user->ID;

    //get the post id
    $current_post_id = get_the_ID();

    //check if already attended
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


    //actions
    if($isAttending == false) {
        //if not attended yet, insert the user_id and post_id in the table
        $success = $wpdb->insert("wp_gigs_attending", array(
            "user_id" => $current_user_id,
            "post_id" => $current_post_id,
        ));

    } else {
        //if attended yet, delete the row in the table
        $succes = $wpdb->get_var(
            $wpdb->prepare(
                "DELETE FROM " . $wpdb->prefix . "gigs_attending
                WHERE user_id = %d AND post_id = %d LIMIT 1",
                $current_user_id, $current_post_id
            )
        );
    }