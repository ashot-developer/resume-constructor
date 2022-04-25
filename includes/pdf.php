<?php
global $wpdb;
if ( !defined('ABSPATH') ) {
    //If wordpress isn't loaded load it up.
    $path = $_SERVER['DOCUMENT_ROOT'];
    include_once $path . '/wp-load.php';
}

require_once CONSTRUCTOR_RESUME_DIR . 'includes/lib/vendor/autoload.php';

use Mpdf\Mpdf;
$mpdf = new Mpdf();

if(isset($_POST['html'])){
ob_start();?>
    <?php 
        echo $_POST['html'];
    ?>
<?php
$html = ob_get_clean();
$pdf_name = 'your_resume';


$stylesheet = file_get_contents(CONSTRUCTOR_RESUME_DIR . 'assets/css/pdf.css');

$mpdf->WriteHTML($stylesheet,\Mpdf\HTMLParserMode::HEADER_CSS);
$mpdf->WriteHTML($html,\Mpdf\HTMLParserMode::HTML_BODY);

$mpdf->Output( CONSTRUCTOR_RESUME_DIR . 'uploads/' . $pdf_name . '.pdf', 'F');

$table = $wpdb->get_blog_prefix() . 'resume';
$data = array('pdf_name' => $pdf_name, 'file_url' => CONSTRUCTOR_RESUME_URL . 'uploads/' . $pdf_name . '.pdf', 'unic_code' => $_POST['unic_key'], 'payment_status' => '0');
$wpdb->insert($table,$data);

print( CONSTRUCTOR_RESUME_URL . 'uploads/' . $pdf_name . '.pdf');die(); 
}