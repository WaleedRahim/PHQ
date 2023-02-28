<?php
// Scripts To included
function phq_enqueue_scripts() {
    wp_enqueue_style( 'main-css',MY_PLUGIN_URL . 'assets/css/main.css' );

    wp_enqueue_style( 'my-plugin-style', 'https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0/css/bootstrap.min.css');


    wp_enqueue_script( 'my-plugin-script', MY_PLUGIN_URL . 'assets/js/main.js', array( 'jquery' ), '1.0.0', true );
    wp_enqueue_script( 'jquery-min', MY_PLUGIN_URL . 'assets/jquery/jquery.min.js', array( 'jquery' ), '1.0.0', true );
    wp_enqueue_script( 'jquery-chart',MY_PLUGIN_URL. 'assets/js/chart.js', array( 'jquery' ), '1.0.0',  );
    
  }
  add_action( 'wp_enqueue_scripts', 'phq_enqueue_scripts' );
  



  
?>