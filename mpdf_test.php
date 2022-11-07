include("mpdf/mpdf.php");

if ( isset( $_POST['submit'] ) ) {      

$mpdf=new mPDF('c','Letter','','','10','10','10','10','','');
$mpdf->allow_charset_conversion=true;
$mpdf->charset_in='ISO-8859-2';
$mpdf->SetDisplayMode('fullpage');
$mpdf->WriteHTML(utf8_encode($html));
$emailAttachment = $mpdf->Output('serviceagreement.pdf', 'S');
//$emailAttachment = chunk_split(base64_encode($emailAttachment));  

require("php_mailer/class.phpmailer.php");

$mail = new PHPMailer(true);

try {

$mail = new PHPMailer;           

$mail->AddAddress('send email');
$mail->SetFrom('support@myorganization.com');
$mail->AddReplyTo($_POST['email1']);
$mail->Subject = 'Evaluation';
$mail->AltBody = 'To view the message, please use an HTML compatible email viewer!'; // optional - MsgHTML will create an alternate automatically
$mail->MsgHTML("*** Form attached! Please see the attached form (.pdf).");
$mail->AddStringAttachment($emailAttachment, $filename = 'serviceagreement.pdf',
      $encoding = 'base64',
      $type = 'application/pdf');      // attachment
if (isset($_FILES['attached']) &&
    $_FILES['attached']['error'] == UPLOAD_ERR_OK) {
    $mail->AddAttachment($_FILES['attached']['tmp_name'],
                         $_FILES['attached']['name']);
}
$mail->Send();
echo "<div style='margin-left:4%;'>Message Sent OK</div>\n";
} catch (phpmailerException $e) {
echo $e->errorMessage(); //Pretty error messages from PHPMailer
} catch (Exception $e) {
echo $e->getMessage(); //Boring error messages from anything else!
}}

?>'