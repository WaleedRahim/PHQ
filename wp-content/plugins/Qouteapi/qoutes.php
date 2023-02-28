<?php

/**
 * Plugin name: Qoutes APIs
 * Description: Get Qoutes from external APIs 
 * Author: Waleed Khan
 * version: 0.1.0
 * text-domain: task-apis
 */





defined( 'ABSPATH' ) or die( 'Unauthorized Access' );
add_shortcode('api_data', 'qoute_get_data');
function qoute_get_data() {

    $url = 'https://api.kanye.rest';
    
  $arguments = array(
        'method' => 'GET'
     );

 $response = wp_remote_get( $url, $arguments );

	if ( is_wp_error( $response ) ) {
	 	$error_message = $response->get_error_message();
	 	return "Something went wrong: $error_message";
	} 

	$results = json_decode( wp_remote_retrieve_body( $response ) );






$html = '';
$html .= '<table>';
$html .= '<tr>';
$html .= '<td><h3>Qoutes</h3></td>'; 
$html .= '</tr>';



foreach ($results as $value){


for ($x = 0; $x <= 4; $x++){
$html .= '<tr>';
$html .= '<td>'. $value.'</td>'; 
$html .= '</tr>';
}
}
$html .= '</table>';
return $html;
}	



// Register a custom menu page to view the information queried.

function wpdocs_register_my_custom_menu_page(){
    add_menu_page( 
        __( 'Qoute Api', 'QoutesAPIs' ),
        'Qoute Api',
        'manage_options',
        'custompage',
        'my_custom_menu_page',
        'dashicons-welcome-widgets-menus', 90
        
    ); 
}
add_action( 'admin_menu', 'wpdocs_register_my_custom_menu_page' );

function my_custom_menu_page(){
    esc_html_e( 'Admin Page Test', 'QoutesAPIs' );  

    ?>

    <h1> Please Select</h1><?php  
}
?>