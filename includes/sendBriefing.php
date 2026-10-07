<?php
header('Content-Type: application/json; charset=UTF-8');

function respond($status, $success, $message)
{
	http_response_code($status);
	echo json_encode(array('success' => $success, 'message' => $message));
	exit;
}

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
	header('Allow: POST');
	respond(405, false, 'Método no permitido.');
}

$email = isset($_POST['email']) && is_string($_POST['email']) ? trim($_POST['email']) : '';
$phone = isset($_POST['phone']) && is_string($_POST['phone']) ? trim($_POST['phone']) : '';
$message = isset($_POST['message']) && is_string($_POST['message']) ? trim($_POST['message']) : '';
$messageLength = preg_match_all('/./us', $message, $messageCharacters);

if (
	$email === '' || strlen($email) > 254 || !filter_var($email, FILTER_VALIDATE_EMAIL) ||
	!preg_match('/^[0-9]{10}$/', $phone) ||
	$message === '' || $messageLength === false || $messageLength > 200
) {
	respond(400, false, 'Completa los campos con información válida e intenta de nuevo.');
}

$recipient = 'deif.bogul.2@gmail.com';
$subject = 'Nueva solicitud desde REXOVIS';
$body = "Email: {$email}\nTeléfono: {$phone}\n\nTexto:\n{$message}";
$headers = array(
	'From: REXOVIS <no-reply@rexovis.com>',
	'Reply-To: ' . $email,
	'Content-Type: text/plain; charset=UTF-8',
);

if (!mail($recipient, $subject, $body, implode("\r\n", $headers))) {
	error_log('No se pudo enviar el formulario de briefing de REXOVIS.');
	respond(500, false, 'El servidor no pudo enviar el correo. Intenta de nuevo más tarde.');
}

respond(200, true, 'Tu solicitud se envió correctamente.');
