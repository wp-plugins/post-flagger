<?php
/*
Plugin Name: Post Flagger
Plugin URI: http://owak.co/post-flagger/
Description: Manage flags to posts, to be used by logged in users. Autmatically creates "Favorites" flag.
Author: Cesaros
Version: 0.9
Author URI: http://be.net/nosoycesaros
License: GPLv2 or later
*/

include (plugin_dir_path( __FILE__ ) . '/options.php');


/**
 * Load plugin scripts and styles
 *
 */
function post_flagger_scripts() {
    //Enqueque post-flagger.js
    wp_enqueue_script( 'post_flagger_script', plugin_dir_url( __FILE__ ) . 'post-flagger.js', array('jquery'), '1.0.0', true );
    //Add ajax_url var to the JS
    wp_localize_script( 'post_flagger_script', 'the_ajax_script', array( 'ajaxurl' => admin_url( 'admin-ajax.php' ) ) );

}
add_action( 'wp_enqueue_scripts', 'post_flagger_scripts' );

/**
 * Add flag button to content
 *
 * @param $content
 * @return string
 */

function post_flagger_add_content_flag( $content ) {
//    if ( is_user_logged_in() ) {
//        $favorites = do_shortcode( '[flag slug="favorites"]' );
//
//        return $content . $favorites;
//    }

    return $content;
}
//FILTER TO ADD FLAG BUTTON
add_filter( 'the_content', 'post_flagger_add_content_flag');


/**
 * Shortcode function handler
 * Show flag button
 *
 * @param $atts
 * @return string
 */
function post_flagger_flag_button($atts) {
    global $post;

    $a = shortcode_atts( array(
        'slug' => null
    ), $atts );

    if (!is_null($a['slug'])) {
        $flagData = post_flagger_get_flag_html_codes($a['slug']);

        if (pf_flagged($a['slug'])) {
            //The post is faved
            $flagButton = '<a class="flagged" post-id="' . $post->ID . '" flag="' . $a['slug'] . '" href="#">' . $flagData->flagged_code . '</a>';
        } else {
            //The post is not faved
            $flagButton = '<a class="flag-this" post-id="' . $post->ID . '" flag="' . $a['slug'] . '" href="#">' . $flagData->unflagged_code . '</a>';
        }

        return $flagButton;
    }
}
/** CREATE FLAG SHORTCODE */
add_shortcode( 'flag', 'post_flagger_flag_button');


/**
 * Returns flagged posts of a given $metaKey
 *
 * @param $metaKey
 * @return mixed
 */
function post_flagger_get_user_meta($metaKey) {
    $user_ID = get_current_user_id();
    $meta = get_user_meta($user_ID, $metaKey, true);

    return $meta;
}

/**
 * Update user meta data with a given $value and $metaKey
 *
 * @param $metaKey
 * @param $value
 * @return mixed
 */
function post_flagger_update_user_meta($metaKey, $value) {
    return update_user_meta(get_current_user_id(), $metaKey, $value);
}

/**
 * Returns true when a post is flagged with a meta key
 * Loads the meta key by a given slug in the $metaKeys array()
 *
 * @param $metaSlug
 * @return bool
 */
function pf_flagged($metaSlug) {
    global $post;

    $metaKey = post_flagger_get_flag_meta_key($metaSlug);

    $meta = post_flagger_get_user_meta($metaKey);

    if (!empty($meta)){
        if (in_array($post->ID, $meta)) {
            return true;
        }
    }

    return false;
}

/**
 * AJAX Callback Function
 * Flag a post given in $_POST['post_id']
 * With the meta key given by slug in $_POST['flag_slug']
 * all parameters are passed by $_POST
 *
 * @param post_id
 * @param flag_slug
 *
 */
function post_flagger_flag_post() {
    $post_id = intval($_POST['post_id']);
    $metaSlug = $_POST['flag_slug'];

    $metaKey = post_flagger_get_flag_meta_key($metaSlug);
    $flaggedCode = post_flagger_get_flagged_code($metaSlug);

    $views = post_flagger_get_user_meta($metaKey);
    $views[] = $post_id;

    post_flagger_update_user_meta($metaKey, $views);

    echo $flaggedCode;
    die();
}

/** RECEIVE FLAG AJAX */
add_action( 'wp_ajax_flag', 'post_flagger_flag_post' );



/******************************
 *
 * DATABASE FUNCTIONALITIES
 *
 ******************************/


function post_flagger_get_flags($output_type = 'OBJECT') {
    global $wpdb;

    $flagData = $wpdb->get_results("SELECT * FROM {$wpdb->prefix}post_flagger", $output_type);

    return $flagData;
}

/**
 * Obtain all flag data by id
 *
 * @param $flagId
 * @return mixed
 */
function post_flagger_get_flag_data_by_id($flagId, $output_type = 'OBJECT') {
    global $wpdb;

    $flagData = $wpdb->get_row("SELECT * FROM {$wpdb->prefix}post_flagger WHERE id = '$flagId'", $output_type);

    return $flagData;
}

/**
 * Obtain all flag data by meta slug
 *
 * @param $metaSlug
 * @return mixed
 */
function post_flagger_get_flag_data_by_slug($metaSlug) {
    global $wpdb;

    $flagData = $wpdb->get_row("SELECT * FROM {$wpdb->prefix}post_flagger WHERE slug = '$metaSlug'");

    return $flagData;
}

/**
 * Obtain meta_key by slug
 *
 * @param $metaSlug
 * @return mixed
 */
function post_flagger_get_flag_meta_key($metaSlug) {
    global $wpdb;

    $flagData = $wpdb->get_row("SELECT meta_key FROM {$wpdb->prefix}post_flagger WHERE slug = '$metaSlug'");

    return $flagData->meta_key;
}

function post_flagger_get_flagged_code($metaSlug) {
    global $wpdb;

    $flagData = $wpdb->get_row("SELECT flagged_code FROM {$wpdb->prefix}post_flagger WHERE slug = '$metaSlug'");

    return $flagData->flagged_code;
}

/**
 * Obtain html codes for flagged and unflagged contents by slug
 *
 * @param $metaSlug
 * @return mixed
 */
function post_flagger_get_flag_html_codes($metaSlug) {
    global $wpdb;

    $flagData = $wpdb->get_row("SELECT unflagged_code, flagged_code FROM {$wpdb->prefix}post_flagger WHERE slug = '$metaSlug'");

    return $flagData;
}

function post_flagger_update_flag($fields) {
    global $wpdb;

    $wpdb->update(
        $wpdb->prefix . 'post_flagger',
        $fields,
        array( 'id' => $fields['id'] )
    );
}

/**
 * Creates plugin database to store flag data
 *
 */
function post_flagger_create_database() {
    global $wpdb;

    $table_name = $wpdb->prefix . 'post_flagger';

    $charset_collate = $wpdb->get_charset_collate();

    $sql = "CREATE TABLE $table_name (
		id mediumint(9) NOT NULL AUTO_INCREMENT,
		name varchar(50) NOT NULL,
		slug varchar(50) NOT NULL,
		meta_key varchar(50) NOT NULL,
		unflagged_code longtext NOT NULL,
		flagged_code longtext NOT NULL,
		UNIQUE KEY id (id)
	) $charset_collate;";

    require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
    dbDelta( $sql );
}


/**
 * Add $fields to database
 *
 * @param $fields
 */
function post_flagger_create_flag($fields) {
    global $wpdb;

    $fields['meta_key'] = 'meta_flag_' . $fields['slug'];

    $wpdb->insert(
        $wpdb->prefix . 'post_flagger',
        $fields
    );
}

function post_flagger_delete_flag($flagId) {
    global $wpdb;

    $wpdb->delete( $wpdb->prefix . 'post_flagger', array( 'id' => $flagId ) );
}

function post_flagger_flag_exists($metaSlug) {
    global $wpdb;

    $flagData = $wpdb->get_row("SELECT * FROM {$wpdb->prefix}post_flagger WHERE slug = '$metaSlug'");

    if ($flagData) {
        return true;
    }

    return false;
}

function post_flagger_create_favorites() {

    $favorite = array(
        'name'              => 'Favorites',
        'slug'              => 'favorites',
        'unflagged_code'    => 'Fav This',
        'flagged_code'      => 'Faved'
    );

    post_flagger_create_flag($favorite);
}

register_activation_hook( __FILE__, 'post_flagger_create_database' );
register_activation_hook( __FILE__, 'post_flagger_create_favorites' );