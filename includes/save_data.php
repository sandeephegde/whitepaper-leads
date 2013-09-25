<?php

	global $wpdb;
	
	$expire = time() + 60 * 60 * 24 * 30;
	setcookie("visited_flag", "1", $expire);
	
	$name = $_GET['name'];
	$email = $_GET['email'];
	$company = $_GET['company'];
	$hear = $_GET['hear'];
	
	$table = $wpdb->prefix . "details";
	$structure = "INSERT INTO $table VALUES (null,'$name', '$email', '$company', '$hear');";
	$wpdb->query($structure);
	
	
	/************ php mailer imformation and SMTP information ******************/
	require_once('./lib/phpmailer/class.phpmailer.php');

	$mail = new PHPMailer();
	$mail->IsSMTP();                                 
	$mail->SMTPSecure = 'ssl'; // secure transfer enabled REQUIRED for Gmail
	$mail->Host = 'smtp.gmail.com';
	$mail->From = 'apps@dotcord.com';
	$mail->SMTPAuth = true;
	$mail->Username = 'apps@dotcord.com';
	$mail->Password =  'dotcord123';
	$mail->Port = 465; 
	/***************************************************************************/
?>
	
<?php
	/*$mail->FromName  =  "apps@dotcord.com";
	$mail->AddAddress('siddharth@dotcord.com');
		
	$mail->Subject = 'Dummy Subject';
	$mail->WordWrap = 50;
	
	$mail->IsHTML(true);
	$mail->Body = "Following user downloaded the Whitepaper <br> 
					Name : $name <br>
					email-id : $email <br>
					Company : $company <br>
					The person heard us from : $hear <br>";
					
	if(!$mail->Send())
	{
	   $error_sending_mail =  'Message was not sent.' . "</br>";
	   $error_sending_mail =  'Mailer error: ' . $mail->ErrorInfo;
	}
	
/*	$server_name = "localhost";
	$user_name = "dcdemo_vayavya12" ;
	$pass = "4o{LB7uA_,bK";
*/
	$server_name = "localhost";
	$user_name = "root" ;
	$pass = "";
	
	mysql_connect($server_name,$user_name,$pass) or die("cannot connect the server!!");
	
//	$database = "vavavya_labs";
	$database = "white_paper_downloader";
	
	mysql_select_db($database) or die("cannot connect the database!!");

	$sql = "insert into details values('','$name','$email', '$company', '$hear');";
	$res = mysql_query($sql);
	
	if($res)
		echo "Thank you. Your file will be downloaded in a moment";
	else
		echo "Error in downloading the file..";
?>