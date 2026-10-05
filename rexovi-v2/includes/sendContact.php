<?php
error_reporting(0);

date_default_timezone_set("America/Mexico_City");

if(!isset($_POST) || empty($_POST)){
	header('Location: /');
	die;
}//end if



$recaptchaSecret = '6Lc2oUsqAAAAALaUjx6DeyRwgg7xMI9OLE9ig6vS';
$recaptchaResponse = $_POST['g-recaptcha-response_contact'];

// Verificar el token con Google
$url = 'https://www.google.com/recaptcha/api/siteverify';
$data = [
    'secret' => $recaptchaSecret,
    'response' => $recaptchaResponse
];

$options = [
    'http' => [
        'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
        'method'  => 'POST',
        'content' => http_build_query($data),
    ],
];
$context  = stream_context_create($options);
$result = file_get_contents($url, false, $context);
$response = json_decode($result);

// Verifica el resultado
if ($response->success && $response->score >= 0.5) {
	$TEST            = false;
	$ENVIAR_POR_SMTP = false;
	$subject_title   = "Formulario de contacto";
	$asunto_title    = "Formulario de contacto";
	$domain          = "rexovis.com";
	$EMAIL_TEST      = "";
	$correo          = "contacto@rexovis.com";
	$to              = $TEST ? $EMAIL_TEST : $correo;
	$from            = "rexovis.com";
	$img             = "https://rexovis.com/demo/assets/images/brand-rexovi.png";
	$colorth         = '#000';
	$colortd         = '#000';
	$backimg         = '#FFF';

	$subject         = "$subject_title - $domain";
	//$email_noreply = "noreply@$domain";
	$email_noreply   = "noreply@rexovis.com";
	$asunto          = "$asunto_title - $domain";
	$comentarios     = ('Una persona ha completado el formulario de contacto con la siguiente informaci&oacute;n : <br />');

	$campos = array(
		'nombre'   => utf8_decode($_POST['nombre']),
		'email'    => $_POST['email'],
		'telefono' => utf8_decode($_POST['telefono']),
		'mensaje'  => utf8_decode($_POST['mensaje']),
	);

	$array_clean = array_filter($campos);
	//$FieldsTable = genericHTMLFieldsTable($array_clean,$colorth,$colortd);
	//$HTML        = genericHTMLMail($img,$backimg,$comentarios,$FieldsTable); 


	$array_clean["ip"]    = $_SERVER['REMOTE_ADDR'];
	$array_clean["fecha"] = date("Y-m-d");
	$array_clean["hora"]  = date("H:i:s");

	$table = "contacto";
	$sql = "INSERT INTO $table SET ";
	foreach($array_clean as $campo => $valor)$sql .= "`$campo` = '$valor',";
	$sql = substr($sql,0,-1);

	$host     = 'localhost';
	$username = 'uguy22p3jjqi';
	$password = 'M0r4Matcha*';
	$db_name  = 'db_rexovis';

	// Crear conexión
	$mysqli = new mysqli($host, $username, $password, $db_name);

	// Comprobar conexión
	if ($mysqli->connect_error) {
	    die("Conexión fallida: " . $mysqli->connect_error);
	}//end if

	// Preparar la consulta de inserción
	$stmt = $mysqli->prepare($sql);


	// Ejecutar la consulta
	if ($stmt->execute()) {
	    $data['estatus'] = true;
	    // include_once('sendMail/PhpMailer/class.PHPMailer.php');
		// $phpmailer             = new PHPMailer();
		// $phpmailer->IsSMTP();
		// $phpmailer->SMTPAuth   = true;// enable SMTP authentication
		// $phpmailer->SMTPSecure = "ssl";
		// $phpmailer->Host       = "rexovis.com"; // sets the SMTP server
		// $phpmailer->Port       = 465;// set the SMTP port for the GMAIL server
		// $phpmailer->Username   = "noreply@rexovis.com"; // SMTP account username
		// $phpmailer->Password   = 'KvGb(D#M]$Re';// SMTP account password
		// $phpmailer->SMTPDebug  = 0;
		// $phpmailer->From       = "noreply@rexovis.com";
		// $phpmailer->FromName   = "rexovis.com";
		// $phpmailer->isHTML(true);
		// $phpmailer->Subject    = $subject_title;

		// // Reply to 
		// $phpmailer->AddReplyTo($_POST['email']);

		// //Add Addres mailbox
		// $phpmailer->AddAddress($to);

		// // $arr_to = explode(",",$to);
		// // foreach ($arr_to as $to_) {
		// // 	$phpmailer->AddAddress($to);
		// // }//end foreach

		// $phpmailer->MsgHTML($HTML);
		// $send                  = $phpmailer->Send();
	} else {
		$data['estatus'] = false;
	    //echo "Error al insertar el registro: " . $stmt->error;
	}//end if

	// Cerrar la declaración y la conexión
	$stmt->close();
	$mysqli->close();
} else {
    // El token no es válido o el usuario no es humano
   $data['estatus'] = false;
}

//include_once ('sendMail/sendMail.php');



$json = json_encode($data);
header('Content-disposition: inline');
header('Content-Type: application/json; charset: UTF-8');

echo $json;
die();

// $FieldsTable = genericHTMLFieldsTable($array_clean,$colorth,$colortd);
// $HTML        = genericHTMLMail($img,$backimg,$comentarios,$FieldsTable); 
// $HTML        = ($HTML);

// include_once('sendMail/PhpMailer/class.PHPMailer.php');
// $phpmailer             = new PHPMailer();
// $phpmailer->IsSMTP();
// $phpmailer->SMTPAuth   = true;// enable SMTP authentication
// $phpmailer->SMTPSecure = "ssl";
// $phpmailer->Host       = "smtp.gmail.com"; // sets the SMTP server
// $phpmailer->Port       = 465;// set the SMTP port for the GMAIL server
// $phpmailer->Username   = "noreplyrexovis@gmail.com"; // SMTP account username
// $phpmailer->Password   = "123456Abc$.-";// SMTP account password
// $phpmailer->SMTPDebug  = 2;
// $phpmailer->From       = "noreplyrexovis@gmail.com";
// $phpmailer->FromName   = utf8_decode("rexovis.com");
// $phpmailer->Subject    = utf8_decode($subject_title);

// // Reply to 
// $phpmailer->AddReplyTo($_POST['email']);

// //Add Addres mailbox
// $arr_to = explode(",",$to);
// foreach ($arr_to as $to_) {
// 	$phpmailer->AddAddress($to_);
// }//end foreach

// $phpmailer->MsgHTML(($HTML));
// $send                  = $phpmailer->Send();

// if($send == true){
// 	$data['estatus'] = true;
// }else{
// 	$data['estatus'] = false;
// }//end if
// $json = json_encode($data);

// header('Content-disposition: inline');
// header('Content-Type: application/json; charset: UTF-8');

// echo $json;
?>