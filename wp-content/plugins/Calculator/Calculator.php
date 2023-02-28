<?php
//  Plugin name: 8-Minute Rule Calculator
//  Author: Waleed Khan
//  Description: 8 Minute Rule table to help you determine the total number of minutes service was provided and the total number of units you can bill for.
//  version: 0.1.0
//  text-domain: custom-cal?>
<?php

if (!defined( 'ABSPATH' )){
	define('ABSPATH',dirname(__FILE__).'/');
}

if ( !defined ('CAL_PLUGIN_VERSION') ){

    define('CAL_PLUGIN_VERSION', '0.1.0');
    
}

if (!defined ('CAL_PLUGIN_DIR')){

define('CAL_PLUGIN_DIR', plugin_dir_url( __FILE__ ) );

}


 function cal_plugin_scripts() {

 	
    wp_enqueue_style( 'style-css',CAL_PLUGIN_DIR.'/assets/css/index.css');
	wp_enqueue_style( 'bootstrap-min-css',CAL_PLUGIN_DIR.'/assets/css/bootstrap.min.css'); 
	
	//  Scripts
	wp_enqueue_script( 'jquery-js',CAL_PLUGIN_DIR.'/assets/js/jquery.js');
    wp_enqueue_script( 'jquery-validate',CAL_PLUGIN_DIR.'/assets/js/jquery.validate.js');
	// wp_enqueue_script( 'bootstrap-min-js',CAL_PLUGIN_DIR.'/assets/js/proper.min.js');
	wp_enqueue_script( 'main-js',CAL_PLUGIN_DIR.'/assets/js/main.js','jQuery'); 
	wp_enqueue_script( 'index-js',CAL_PLUGIN_DIR.'/assets/js/index.js','jQuery');
    wp_enqueue_script( 'jspdf', 'https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.5.3/jspdf.min.js', array(), '1.5.3', true );
	 
	// wp_enqueue_script( 'bootstrap-min-js',CAL_PLUGIN_DIR.'/assets/js/bootstrap.min.js'); 
	wp_localize_script( 'index-js', 'index_ajax_url',
    array( 
        'ajax_url' => admin_url( 'admin-ajax.php' )
    ));
 }
add_action( 'wp_enqueue_scripts', 'cal_plugin_scripts');


function enqueuing_admin_scripts() {
wp_enqueue_style( 'Admin-css',CAL_PLUGIN_DIR. 'assets/css/admin.css');   
}
add_action( 'admin_enqueue_scripts', 'enqueuing_admin_scripts' );


add_shortcode('rule_cal','custom_rule_calculator');


function custom_rule_calculator(){?>
 <section>
<div class="container-fluid">
    <div class="row justify-content-center text-center">
        <div class="col-md-8 mt-5 mb-1">
            <h3 class="head">The Ultimate Guide to 8 Minute Rule Therapy PT Calculator</h3>
        </div>
        <div class="col-md-8 button ">
            <div class="row align-items-center">
                <div class="input-group mb-3">
                    <input type="text" id="pixel" name="pixel" class="form-control" style="border: 1px solid #ccc;" placeholder="Enter Your pixel Unit" aria-describedby="basic-addon2" >
                    <div class="input-group-append">
                      <span class="input-group-text button1 " id="basic-addon2">
                        <a href="javascript:void(0);" type="button" class="btn button1 btn-sm">Click to get vw unit</a>
                      </span>
                    </div>
                  </div>
            </div>
        </div> 
        <div class="col-md-8 output  mt-3 pt-3 ">
            <label></label>
        </div>
        <div class="col-md-8 output1 mt-3 pt-3">
            <label></label>
        </div>
        <div class="col-md-8 downloadbtn">
            <button id="show" class="btn button1 btn-sm mt-3">Subscribe To Download Broucher</button>
            
            
           
            
        </div>
      
    </div>
</div>
</section>
<div class="container hideform center  p-5" style="display: none;">
        <div class="row justify-content-center">
            <div class="col-md-8 text-center bg-light p-5">
                <button class="btn btn-secondary position-absolute mt-2 mr-2" id="close" style="float: right; top: 0;right: 0%;">X</button>
                <h3 class="subscribe">Please Subscribe To Download The Broucher</h3>
                <form method="POST" class="myform" id="form1" >
                    <input class="form-control mt-4" type="email" id="email" name="email" placeholder="Enter Your Email" required><br>
                    <a  id="linkID" href="#"  >
                    <button class="btn btn-primary mt-3" id="btnsubmit" name="submit" type="submit">Subscribe</button>   
                    </a>
                    <!-- <button class="btn btn-primary mt-3" id="download1" name="submit" type="submit">Download Broucher</button> -->
                </form>
            </div>
        </div>
 </div> 
<?php
}

register_activation_hook( __FILE__ , "DB_create" );

function DB_create(){
global $wpdb;
$charset_collate = $wpdb->get_charset_collate();
$table_name = $wpdb->prefix . "calcu";
$sql = "CREATE TABLE IF NOT EXISTS $table_name (
  id mediumint(9) NOT NULL AUTO_INCREMENT,
  Email text, 
  
  PRIMARY KEY  (id)
) $charset_collate;";

require_once( ABSPATH . "wp-admin/includes/upgrade.php");
dbDelta( $sql );


} 

register_deactivation_hook(__FILE__, 'drop_db_table');


function drop_db_table()
{
    global $wpdb;
    $table_name = $wpdb->prefix . "calcu";
    $wpdb->query( "DROP TABLE IF EXISTS" . $table_name);
    
}



function ajax_contact_us(){

    $arr=[];

    wp_parse_str( $_POST['contact_us'],$arr );
    global $wpdb;
    require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
    $table_name = $wpdb->prefix . "calcu";
   
    $result = $wpdb->insert($table_name,[
        "Email" => $arr['email'],
     
      ]);
    
    
    wp_send_json_success( $result );
    
}
    
    add_action( 'wp_ajax_contact_us', 'ajax_contact_us');
    add_action( 'wp_ajax_nopriv_contact_us', 'ajax_contact_us' );
   

    function send_form_pdf_email() {
        //generate the pdf
        //save pdf
        $to = "wrahimkhan071@gmail.com";
        $subject = "Form PDF Attachment";
        $pdf_path = "form.pdf";
    
        $headers = array();
        $headers[] = 'From: sender@example.com';
        $headers[] = 'Cc: sender@example.com';
        $headers[] = 'Content-Type: application/pdf';
        $headers[] = 'Content-Disposition: attachment; filename="' . basename($pdf_path) . '"';
    
        foreach($headers as $header){
            echo '<script>alert("Welcome to Geeks for Geeks")</script>';
        }

        $attachments = array($pdf_path);
    
        $is_sent = wp_mail($to, $subject, '', $headers, $attachments);
        if ( $is_sent ) {
            // Email sent successfully
            $message = 'Email sent successfully';
        } else {
            // Email not sent
            $message = 'Email not sent';
        }
        echo $message;
    }
    
    add_action( 'wp_ajax_nopriv_submit_form', 'send_form_pdf_email' );
    add_action( 'wp_ajax_submit_form', 'send_form_pdf_email' );



// Menus


add_action( 'admin_menu', 'register_calculator_menu_page' );
function register_calculator_menu_page(){
add_menu_page( 'Calculator', 'Custom Calculator', 'manage_options', 'rule-chart', 'cal_custom_menu_page', 'dashicons-calculator', 90 );
add_submenu_page( 'rule-chart', 'Subscribers List', 'Subscribers List', 'manage_options', 'subscribers','cal_custom_sub_menu_page');

}
function cal_custom_menu_page(){ ?>
 <div class="box">
<h3 class="heading">Welcome to 8-Minute Rule Calculator </h3>
<p class="para">Please copy and add the shortcode in page or blog post: <b>[rule_cal]</p>
<div> 


<?php }
function cal_custom_sub_menu_page() {?>
<table border="1">
<tr>
 <th>Email</th>
</tr>

</div>
<?php
    
    global $wpdb;
    $table_name = $wpdb->prefix . "calcu";
    $result = $wpdb->get_results ( "SELECT * FROM $table_name" );
   

        
    foreach ( $result as $print )   {
        ?>
        <tr>
        <td><?php echo $print->Email;?></td>
        </tr>
        
            <?php }
    
    }?>