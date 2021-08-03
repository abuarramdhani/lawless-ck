<?php
require 'include/fungsi.php';

echo $kodeoutlet = "OUT001";
$kodemailer = query("SELECT * FROM mailer WHERE kodeoutlet = '$kodeoutlet' ")[0];
$mailhost1 = $kodemailer['mailhost1'];
echo $username1 = $kodemailer['username1'];
$password1 = $kodemailer['password1'];
$setfrom1 = $kodemailer['setfrom1'];

$cEmail = "ammarwaliyuddin@gmail.com";
$SubjectMsg = "Tes Email Lawless";
$bodyMsg = "Tes Email Lawless";

include "classes/class.phpmailer.php";
$mail = new PHPMailer;
$mail->IsSMTP();
$mail->SMTPSecure = 'tls';
$mail->Host = $mailhost1; //host masing2 provider email
$mail->SMTPDebug = 3;
$mail->Debugoutput = 'html';
$mail->Port = 587;
$mail->SMTPAuth = true;
$mail->Username = $username1; //user email
$mail->Password = $password1; //password email 
$mail->SetFrom($username1, $setfrom1); //set email pengirim
$mail->Subject = $SubjectMsg; //subyek email
$mail->AddAddress($cEmail);  //tujuan email
$mail->AddBCC($username1, "Notif Lawless");
$mail->MsgHTML($bodyMsg);

if ($mail->Send()) {

    echo '
            <script>
            alert("berhasil");
                              
            </script>
            ';
} else {
    echo "Mail Error - >" . $mail->ErrorInfo;
}
