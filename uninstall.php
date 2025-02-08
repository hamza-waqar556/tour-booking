<?php

/**
 * Trigger this file on Plugin uninstall
 *
 * @package TourBooking
 */

defined('WP_UNINSTALL_PLUGIN') or die;

$cptDelete = [ '' ];

function clear_post_type_data($post_types = [  ])
{
    if (empty($post_types)) {
        return;
    }

    global $wpdb;

    // Sanitize and prepare the post type names for SQL query
    $post_types_placeholders = implode(',', array_fill(0, count($post_types), '%s'));

    // Delete posts of the given post types
    $wpdb->query(
        $wpdb->prepare(
            "DELETE FROM wp_posts WHERE post_type IN ($post_types_placeholders)",
            $post_types
        )
    );

    // Delete orphaned post meta
    $wpdb->query("DELETE FROM wp_postmeta WHERE post_id NOT IN (SELECT id FROM wp_posts)");

    // Delete orphaned term relationships
    $wpdb->query("DELETE FROM wp_term_relationships WHERE object_id NOT IN (SELECT id FROM wp_posts)");
}
clear_post_type_data($cptDelete);
