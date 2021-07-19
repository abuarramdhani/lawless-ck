<?php

$mail = new PHPMailer;
$mail->IsSMTP();
$mail->SMTPSecure = 'tls';
$mail->Host = $mailhost1; //host masing2 provider email
//$mail->SMTPDebug = 3;
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