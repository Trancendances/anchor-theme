<?php
// :-)

require_once "Mail.php";
require_once("Mail/mime.php");

$mois = 0;
$i = 0;

switch(date("n")) {
	case 1:
		$mois = "janvier";
		break;
	case 2:
		$mois = "février";
		break;
	case 3:
		$mois = "mars";
		break;
	case 4:
		$mois = "avril";
		break;
	case 5:
		$mois = "mai";
		break;
	case 6:
		$mois = "juin";
		break;
	case 7:
		$mois = "juillet";
		break;
	case 8:
		$mois = "août";
		break;
	case 9:
		$mois = "septembre";
		break;
	case 10:
		$mois = "octobre";
		break;
	case 11:
		$mois = "novembre";
		break;
	case 12:
		$mois = "décembre";
		break;
}

$from = "Trancendances <nepasrepondre@trancendances.fr>";
$reply_to = "Trancendances <contact@trancendances.fr>";
$subject = "Trancendances : Lettre d'information de ".$mois." ".date('Y');
//$body_html = "<strong>Test</strong>";
$body_html = file_get_contents("/var/www/trancendances-anchor/themes/Trancendances/template.htm");
$body_text = file_get_contents("/var/www/trancendances-anchor/themes/Trancendances/template.txt");

$mime_params = array(
		'text_encoding' => '7bit',
		'text_charset'  => 'UTF-8',
		'html_charset'  => 'UTF-8',
		'head_charset'  => 'UTF-8'
		);

$mime = new Mail_mime();

$mime->setTXTBody($body_text);
$mime->setHTMLBody($body_html);

$body = $mime->get($mime_params);

$dbh = new PDO('mysql:host=localhost;dbname=trancendances2', 'trancendances2', 'MJSH8ctxGAEdK3JX');

foreach($dbh->query("SELECT * FROM  newsletter_emails_test") as $email) {

	$host = "mail.ceypasbien.com";
	$username = "nepasrepondre@trancendances.fr";
	$password = "qyyYScWNTm";

	$to = $email['email'];

	$headers = array ('From' => $from,
			'To' => $to,
			'Subject' => $subject,
			'Reply-To' => $reply_to,
			'MIME-Version' => '1.0',
			//  'Content-Type' => 'multipart/alternative; boundary='.$boundary,
			'Date' => date('D, j M Y G:i:s O')
			);

	$headers = $mime->headers($headers);

	$smtp = Mail::factory('smtp',
			array ('host' => $host,
				'auth' => true,
				'username' => $username,
				'password' => $password));

	$mail = $smtp->send($to, $headers, $body);

	if (PEAR::isError($mail)) {
		echo("<p>" . $mail->getMessage() . "</p>
			<p>E-mail address: $to</p>");
		return 1;
	} else {
		$i++;
	}
}

echo("<p>$i message(s) successfully sent.</p>");
?>
