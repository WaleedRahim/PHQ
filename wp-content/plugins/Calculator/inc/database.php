<?php

function DB_tb_create(){
global $wpdb;

$charset_collate = $wpdb->get_charset_collate();
$table_name = $wpdb->prefix . "calcu";

$sql = "CREATE TABLE $table_name (
  id mediumint(9) NOT NULL AUTO_INCREMENT,
  Email text, 
  
  PRIMARY KEY  (id)
) $charset_collate;";

require_once( ABSPATH . "wp-admin/includes/upgrade.php");
dbDelta( $sql );
}
?>