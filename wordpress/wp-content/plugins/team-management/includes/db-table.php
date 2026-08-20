<?php
  global $wpdb;
    $table_name = $wpdb->prefix . 'team_members';
    $charset_collate = $wpdb->get_charset_collate();
    $sql = "
    CREATE TABLE $table_name (
    id MEDIUMINT(9) NOT NULL AUTO_INCREMENT,
    name VARCHAR(255) NOT NULL,
    designation VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL,
    image VARCHAR(255) DEFAULT NULL,
    PRIMARY KEY (id)
    ) $charset_collate;";

    require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
    dbDelta($sql);


  register_activation_hook(__FILE__, 'team_management_db');
?>