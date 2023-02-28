<?php
// Function File



// Include Files
require_once MY_PLUGIN_DIR . 'includes/phq-main.php';
require_once MY_PLUGIN_DIR . 'includes/scripts.php';
require_once MY_PLUGIN_DIR . 'tcpdf/tcpdf.php';

// Plugin functions menu
add_action('admin_menu', 'phq_admin_menu');

// Admin menu Function
function phq_admin_menu()
{
  add_menu_page(
    'PHQ',
    'PHQ',
    'manage_options',
    'phq-form',
    'phq_admin_page',
    'dashicons-admin-generic',
    100
  );
}
function phq_admin_page()
{
?>
  <h1>PHQ-9 (Patient Health Questionnaire-9)</h1>
  <h2 style="color: green;">Please Use This Shortcode To PHQ Form In Page Or Post</h2>
  <h2 style="color: brown;">Short Code: &nbsp; [phq-form]</h2>
<?php
}
// // Register plugin activation and deactivation hooks
register_activation_hook(__FILE__, 'phq_activate');
function phq_activate()
{

  global $wpdb;

  $charset_collate = $wpdb->get_charset_collate();
  $table_name = $wpdb->prefix . "formdata";

  $sql = "CREATE TABLE IF NOT EXISTS $table_name (
  id mediumint(9) NOT NULL AUTO_INCREMENT,
  -- time datetime DEFAULT '0000-00-00 00:00:00' NOT NULL,
  littleintest int ,
  FDDRH int ,
  TFRS int ,
  FTRHLE int ,
  PARO  int,
  FBAYS int,
  TCOT int,
  MRSSS int,
  TTYWBBOD int,
  TotalScore text,
  Points int,
  Fname text,
  Email text, 
  
  PRIMARY KEY  (id)
) $charset_collate;";

  require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
  dbDelta($sql);
}
register_deactivation_hook(__FILE__, 'phq_deactivate');
function phq_deactivate()
{
  global $wpdb;
  $table_name = $wpdb->prefix . "formdata";
  $wpdb->query("DROP TABLE IF EXISTS" . $table_name);
}
add_action('wp_ajax_contact_us', 'ajax_contact_us');
add_action('wp_ajax_nopriv_contact_us', 'ajax_contact_us');
function ajax_contact_us()
{

  $arr = [];
  wp_parse_str($_POST['contact_us'], $arr);
  global $wpdb;
  require_once(ABSPATH . 'wp-admin/includes/upgrade.php');

  $table_name = $wpdb->prefix . "formdata";
  $result = $wpdb->insert($table_name, [
    "littleintest" => $arr['littleintest'],
    "FDDRH" => $arr['FDDRH'],
    "TFRS" => $arr['TFRS'],
    "FTRHLE" => $arr['FTRHLE'],
    "PARO" => $arr['PARO'],
    "FBAYS" => $arr['FBAYS'],
    "TCOT" => $arr['TCOT'],
    "MRSSS" => $arr['MRSSS'],
    "TTYWBBOD" => $arr['TTYWBBOD'],
    "TotalScore" => $arr['Score'],
    "Points" => $arr['points'],
    "Fname" => $arr['name'],
    "Email" => $arr['email'],
  ]);
  $data = $arr;
  $pdf = new TCPDF('P', 'mm', 'A4', true, 'UTF-8', false);
  $pdf->SetCreator('TCPDF');
  $pdf->SetAuthor('Waleed');
  $pdf->SetTitle('PHQ FORM');
  $pdf->AddPage();

  // Format data to be written to PDF

  $content = "PHQ FORM" . "\n" . "\n";
  $content = "Name: " . $data['name'] . "\n";
  $content .= "Email: " . $data['email'] . "\n" . "\n";
  $content .= "Little interest or pleasure in doing things?: " . "\n" . "\n" . $data['littleintest'] . "\n"  . "\n";
  $content .= "Feeling down, depressed, or hopeless?: " . "\n" . "\n" . $data['FDDRH'] . "\n"  . "\n";
  $content .= "Trouble falling or staying asleep, or sleeping too much?: " . "\n" . "\n" . $data['TFRS'] . "\n"  . "\n";
  $content .= "Feeling tired or having little energy?: " . "\n" . "\n" . $data['FTRHLE'] . "\n"  . "\n";
  $content .= "Poor appetite or overeating?: " . "\n" . "\n" . $data['PARO'] . "\n"  . "\n";
  $content .= "Feeling bad about yourself — or that you are a failure or have let yourself or your family down?: " . "\n" . "\n" . $data['FBAYS'] . "\n"  . "\n";
  $content .= "Trouble concentrating on things, such as reading the newspaper or watching television?: " . "\n" . "\n" . $data['TCOT'] . "\n"  . "\n";
  $content .= "Moving or speaking so slowly that other people could have noticed? Or so fidgety or restless that you have been moving a lot more than usual?: " . "\n" . "\n" . $data['MRSSS'] . "\n"  . "\n";
  $content .= "Thoughts that you would be better off dead, or thoughts of hurting yourself in some way?: " . "\n" . "\n" . $data['TTYWBBOD'] . "\n"  . "\n";
  $content .= "Total Score: " . "\n" . ($data['Score']) . "\n"  . "\n";
  $content .= "Points: " . "\n" . $data['points'] . "\n";
  // echo '<pre>';
  // print_r($content);
  // echo '</pre>';
  $current_date = date("Y-m-d") . "\n" . "\n";
  $pdf->Write(0, 'PHQ-9 (Patient Health Questionnaire-9)' . "\n" . " ", '', 0, 'L', true, 0, false, false, 0) . "\n" . "\n";
  $pdf->Write(0, 'Date:' . " " . $current_date, '', 0, 'L', true, 0, false, false, 0) . "\n" . "\n";
  $pdf->Write(0, $content, '', 0, 'L', true, 0, false, false, 0);

  $filePath = WP_CONTENT_DIR . '/plugins/phq/forms/phq-form.pdf';
  $pdf->Output($filePath, 'F');
  $pdfContent = $pdf->Output();
  file_put_contents($filePath, $pdfContent);
  if (!$filePath) {
    echo ('File canot created');
  } else {
    echo ('File created');
  }

  add_action('wp', 'send_custom_email');
  function send_custom_email()
  {

    if (isset($_POST['contact_us'])) {
      
      $to = 'wrahimkhan071@gmail.com';
      $subject = 'Form Submission';
      $message = 'This is a custom email message';
      // $message = 'Name: ' . $_POST['name'] . '<br>Email: ' . $_POST['email'];
      $headers = array('Content-Type: text/html; charset=UTF-8');

      $attachments = array(WP_CONTENT_DIR . '/plugins/phq/forms/phq-form.pdf');
      $smtp_params = array(
        'host' => 'smtp.example.com',
        'port' => 587,
        'encryption' => 'tls',
        'username' => 'your-smtp-username',
        'password' => 'your-smtp-password',
      );

      add_filter('wp_mail_content_type', 'set_custom_email_content_type');

      wp_mail($to, $subject, $message, $headers, $attachments, $smtp_params);

      remove_filter('wp_mail_content_type', 'set_custom_email_content_type');
    }
    function set_custom_email_content_type()
    {
      return 'text/html';
    }
    // $sent =  wp_mail($to, $subject, $message, $headers, $attachments) ;
    // if($sent)  {

    //   printf( 'Message has been sent');
    //   } else {
    //     printf( 'Message could not be sent');

    //   }
    //   echo '<pre>';
    //   printf
    //   ($sent);
    //   echo '</pre>';
  }
  wp_send_json_success($result);
}


?>