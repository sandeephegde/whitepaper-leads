<?php		

	$message = "Following user downloaded the Whitepaper
				Name : $name
				email-id : $email
				Company : $company
				The person heard us from : $heard";
	$to = "sandeep@dotcord.com";
	$subject = "Whitepaper Downloaded";
	
	add_filter('wp_mail_content_type',create_function('', 'return "text/html";'));
	if(wp_mail($to, $subject, $message))
		echo "Mail sent";
	else
		echo "Mail Not sent";
	
?>