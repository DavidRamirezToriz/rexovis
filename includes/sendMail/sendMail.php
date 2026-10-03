<?php

/*

 * 

 * 

 */



function getScript($value = 'basename'){

	$script = $_SERVER['PHP_SELF'];

	$path_info = pathinfo($script);

	switch($value){

		case 'dirname':return $path_info['dirname'];break; 

		case 'basename':return $path_info['basename'];break;

		case 'extension':return $path_info['extension'];break;

	}

}



function incorrectField($name,$msg)

{

	$result["status"]=false;

	$name = str_replace('_',' ',$name);

	$result["msg"]=ucfirst(str_replace('{field}',$name,$msg));

	$result["empty"]=$name;

	return $result;

}



function validaLimite($value,$arraylimit)

{

	$limites = explode(',',$arraylimit);

	return ($value >= $limites[0] && $value <= $limites[1]);

}



function correctCatcha($value){

	return ($value == $_SESSION['security_code']);

}



function validar($variable,$fields,$messages,$redirect)

{

	/*

	 * VALORES EXPRESIONES REGULARES

	 */

	$letras_especiales = "(�|�|�|�|�|�|�|�|�|�|�|�|�|�|�|�|�|�|�|�|�|�|�|�|�|�|�|�|�|�|�|�|�|�|�|�|�|�|�|�|�|�|�|�|�|�|�|�|�|�|�|�)";

	$ER['string'] = "([[:alpha:]]|$letras_especiales)+([[:alpha:]]|[[:space:]]|$letras_especiales)*";

	$ER['email'] = "^[^0-9][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[@][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[.][a-zA-Z]{2,4}$";

	$ER['phone'] = "([[:digit:]]|[[:space:]]|-|\(|\))+";

	$ER['number']	= "^[1-9]+[[:digit:]]*$";

	$ER['tcredito'] = "^[[:digit:]]{16}$";

	$ER['decimal2']	= "^[1-9]+[[:digit:]]*(\.[[:digit:]]{1,2}){0,1}$";

	

	foreach($fields as $field){

		if( $field['required'] && ( !isset($_POST[$variable][$field['name']]) || empty($_POST[$variable][$field['name']]) ) ){

			return incorrectField($field['name'],$messages['empty']);	

		}

		if(!empty($_POST[$variable][$field['name']])){

			$regs = NULL;

			

			switch ($field['type']){

				case 'string':

					@ereg($ER['string'],$_POST[$variable][$field['name']],$regs);

					if(!isset($regs[0]) || empty($regs[0])){

						return incorrectField($field['name'],$messages['incorrect']); 

					}

					break;

				case 'email':

					@ereg($ER['email'],$_POST[$variable][$field['name']],$regs);

					if(!isset($regs[0]) || empty($regs[0])){

						return incorrectField($field['name'],$messages['incorrect']); 

					}

					break;

				case 'phone':

					@ereg($ER['phone'],$_POST[$variable][$field['name']],$regs);

					if(!isset($regs[0]) || empty($regs[0])){

						return incorrectField($field['name'],$messages['incorrect']); 

					}

					break;

				case 'tcredito':

					ereg($ER['tcredito'],$_POST[$variable][$field['name']],$regs);

					if(!isset($regs[0]) || empty($regs[0])){

						return incorrectField($field['name'],$messages['incorrect']); 

					}

					break;

				case 'number':

					@ereg($ER['number'],$_POST[$variable][$field['name']],$regs);

					if(!isset($regs[0]) || empty($regs[0])){

						return incorrectField($field['name'],$messages['incorrect']); 

					}

					//VALIDAR LIMITES

					if(!empty($field['limit']) && !validaLimite($_POST[$variable][$field['name']],$field['limit']))

						return incorrectField($field['name'],$messages['outlimit'], $field['limit']);

					break;

				case 'decimal2':

					ereg($ER['decimal2'],$_POST[$variable][$field['name'][1]],$regs);

					if(!isset($regs[0]) || empty($regs[0])){

						return incorrectField($field['name'],$messages['incorrect']); 

					}

					break;

				case 'captcha':

					session_start();

					include_once $_SERVER['DOCUMENT_ROOT'] . '/sendMail/captcha/securimage/securimage.php';

					$securimage = new Securimage();								

						if($securimage->check($_POST['entity']['captcha_code']) == false){

							return incorrectField($field['name'],$messages['incorrect']); 

	

						}



					break;

			}

		}

	}

	$msg = '

	<script languaje="javascript" type="text/javascript">

		alert("'.$messages['ok'].'");

		document.location.href="'.$redirect.'";

	</script>

	';

	$result["status"]=true;

	$result["msg"]=$msg;

	return $result;

}



function getValue($key,$print = true)

{

	if($print)

		echo($_POST['entity'][$key]);

	else

		return $_POST['entity'][$key];

}



/*function getMSG($msg)

{

	if(!empty($msg)){

		echo'<div style="vertical-align:center;color:#AF6700; font-weight:bold; font-family:Arial,Helvetica,sans-serif; font-size:15px;">

				<img src="sendMail/alert.gif"> '.$msg.'

			</div>'; 

	}		

}*/

function getMSG($msg,$class = 'error')

{

	if(!empty($msg)){

		echo'

		<style>

			 .msgerror{

				/*background: #fff6bf url(exclamation.png) center no-repeat;*/

			    background-position: 15px 50%; /* x-pos y-pos */

			    text-align: left;

			    padding: 5px 20px 5px 45px;

			    /*border-top: 2px solid #ffd324;*/

/*			    border-bottom: 2px solid #ffd324;*/

			    font-size:12px;

				font-family:arial;

				/*color:#ff0000;*/
				
				width: 457px;
				
				background-color: #F2DEDE;
				
				border-color: #EED3D7;
				
				color: #B94A48;
				
				border-radius: 4px 4px 4px 4px;
				margin-bottom: 20px;
				padding: 8px 35px 8px 14px;
				text-shadow: 0 1px 0 rgba(255, 255, 255, 0.5);
				
				margin-top:-10px;

			 }

 

			.msgok{

				background: #E0FFBF url(icon-ok.gif) center no-repeat;

			    background-position: 15px 50%; /* x-pos y-pos */

			    text-align: left;

			    padding: 5px 20px 5px 45px;

			    border-top: 2px solid #96FF24;

			    border-bottom: 2px solid #96FF24;

			    font-size:12px;

				font-family:arial;

				color:#2D9F09;

			 }

		</style>

		<div class="msg'.$class.'"><img width="16" src="sendMail/alert.gif"> ' .$msg.'</div>'; 

	}		

}





function genericHTMLFieldsTable($campos,$colorth = "#000;", $colortd = "#000;"){

	if(count($campos)>0){

		$html .= '<table width="100%" >';

		foreach($campos as $campo => $value){

			$campo = str_replace('_',' ',$campo);

			$html .= '<tr>

						<th width="170" align="right" style="color:'.$colorth.';font-weight:bold;">

							<b>'.ucfirst($campo).':</b>

						</th>

						<td align="left"  style="color:'.$colortd.'">'.nl2br($value).'</td></tr>'; 

		}

		$html .= '</table>';

		return $html;

	}

	return false;

}



function genericHTMLMail($img,$backimg = "#FFFFFF",$comentario = NULL,$fieldsTable = NULL){

	$html = '

	<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

	<html xmlns="http://www.w3.org/1999/xhtml">

		<head>

			<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />

			<title>Untitled Document</title>

			<style type="text/css">

			<!--

				body {

					font-family:Arial,Helvetica,sans-serif;

					font-size:12px;

				}

			-->

			</style>

		</head>



		<body>

			<div style="margin:0 auto;">

				<table width="700">

					<tr>

						<td colspan="2" style="border-bottom: solid 2px #B2B2B2;background-color:'.$backimg.';">

							<img src="'.$img.'">

						</td>

					</tr>

	';

	

	if(!empty($comentario)){

		$html .= '

			<tr>

				<td colspan="2" align="justify">'.$comentario.'</td>

			</tr>

		';

	}

	

	if(!empty($fieldsTable)){

		$html .= '<tr><td align="left" colspan="2">'.$fieldsTable.'</td></tr>'; 

	}

	

	$html .= '

	</table>

				    </td>

				</tr>

			</table>

		</body>

	</html>

	';

	

	return $html;

}



function sendMail($html,$from,$to,$subject,$email_noreply,$SMTP=false,$files=array())

{	

	// ENVIO DEL CORREO //

	$message = $html;

	$header  = "Content-type: text/html; charset=iso-8859-1\r\n";

	$header .= "From: $from. <$email_noreply>\r\n";



	if($SMTP){

		mailSMTP($to,$subject,$message,$email_noreply,$from,$files);

	}else{

		mail($to,$subject,$message,$header,$email_noreply);

	}

}





function mailSMTP($to,$subject,$message,$email_noreply,$from,$files)

{

	require_once('PHPMailer/class.phpmailer.php');

	$mail             = new PHPMailer();

	$body = $message;

	$body             = eregi_replace("[\]",'',$body);

	

	$mail->IsSMTP(); // telling the class to use SMTP

	$mail->Host       = "rexovis.com"; // SMTP server

	//$mail->SMTPDebug  = 2;                     // enables SMTP debug information (for testing)

	                                           // 1 = errors and messages

	                                           // 2 = messages only

	$mail->SMTPAuth   = true;                  // enable SMTP authentication

	$mail->Host       = "rexovis.com"; // sets the SMTP server

	$mail->Port       = 26;                    // set the SMTP port for the GMAIL server

	$mail->Username   = "demo@rexovis.com"; // SMTP account username

	$mail->Password   = "";        // SMTP account password

	

	$mail->SetFrom($email_noreply, $from);

	//$mail->AddReplyTo("ejemplo@rexovis.com");

	$mail->Subject    = $subject;

	$mail->AltBody    = $subject; // optional, comment out and test

	$mail->MsgHTML($body);

	

	$arrayTo = explode(",",$to);

	foreach($arrayTo as $email){

		$mail->AddAddress($email);

	}

	foreach($files as $file)

			$mail->AddAttachment($file['path'], $file['name']);		

		

	$send = $mail->Send();

}



function genericOptions($options,$selected)

{

	foreach($options as $key => $value){

		echo '<option value="'.$key.'" '.(($key==$selected)?'selected="selected"':'').'>'.$value.'</option>';

	}

}



function genericPassword($nCharts = 7){

	$charts = array("A","B","C","D","E","F","G","H","I","J","K","L","M","N","�","O",

					"P","Q","R","S","T","U","V","W","X","Y","Z","0","1","2","3","4",

					"5","6","7","8","9","_","-","*","+","=","#","$","%","/",":",".",

					"@","(",")",",",";");

	$tam 	= count($charts);

	$max 	= $tam - 1;

	for($i=0;$i<$nCharts;$i++){

		$p 		= rand(0,$max);

		$psw .= $charts[$p];

	}

	return $psw;

}



//VARABLES UTILES

$ARRAY_PAISES = array(

	"AF" => "Afghanistan",

	"AL" => "Albania",

	"DZ" => "Algeria",

	"AD" => "Andorra",

	"AO" => "Angola",

	"AI" => "Anguilla",

	"AG" => "Antigua and Barbuda",

	"AR" => "Argentina",

	"AM" => "Armenia",

	"AW" => "Aruba",

	"AU" => "Australia",

	"AT" => "Austria",

	"BS" => "Bahamas",

	"BH" => "Bahrain",

	"BB" => "Barbados",

	"BD" => "BBangladesh",

	"BE" => "Belgium",

	"BZ" => "Belize",

	"BM" => "Bermuda",

	"BT" => "Bhutan",

	"BO" => "Bolivia",

	"BW" => "Botswana",

	"BR" => "Brazil",

	"BN" => "Brunei",

	"BG" => "Bulgaria",

	"BI" => "Burundi",

	"KH" => "Cambodia",

	"CA" => "Canada",

	"CV" => "Cape Verde",

	"KY" => "Cayman Islands",

	"CF" => "Central African Republic",

	"CL" => "Chile",

	"CN" => "China",

	"CO" => "Colombia",

	"KM" => "Comoros",

	"CR" => "Costa Rica",

	"HR" => "Croatia",

	"CU" => "Cuba",

	"CY" => "Cyprus",

	"CZ" => "Czech Republic",

	"DK" => "Denmark",

	"DJ" => "Djibouti",

	"DO" => "Dominican Republic",

	"EC" => "Ecuador",

	"EG" => "Egypt",

	"SV" => "El Salvador",

	"EE" => "Estonia",

	"ET" => "Ethiopia",

	"FK" => "Falkland Islands",

	"FJ" => "Fiji",

	"FI" => "Finland",

	"FR" => "France",

	"GM" => "Gambia",

	"DE" => "Germany",

	"GH" => "Ghana",

	"GI" => "Gibraltar",

	"GR" => "Greece",

	"GT" => "Guatemala",

	"GN" => "Guinea",

	"GY" => "Guyana",

	"HT" => "Haiti",

	"HN" => "Honduras",

	"HK" => "Hong Kong",

	"HU" => "Hungary",

	"IS" => "Iceland",

	"IN" => "India",

	"ID" => "Indonesia",

	"IR" => "Iran",

	"IQ" => "Iraq",

	"IE" => "Ireland",

	"IL" => "Israel",

	"IT" => "Italy",

	"JM" => "Jamaica",

	"JP" => "Japan",

	"JO" => "Jordan",

	"KZ" => "Kazakhstan",

	"KE" => "Kenya",

	"KW" => "Kuwait",

	"LA" => "Laos",

	"LV" => "Latvia",

	"LB" => "Lebanon",

	"LS" => "Lesotho",

	"LR" => "Liberia",

	"LY" => "Libya",

	"LT" => "Lithuania",

	"LU" => "Luxembourg",

	"MO" => "Macao",

	"MG" => "Madagascar",

	"MW" => "Malawi",

	"MY" => "Malaysia",

	"MV" => "Maldives",

	"MT" => "Malta",

	"MR" => "Mauritania",

	"MU" => "Mauritius",

	"MX" => "Mexico",

	"MN" => "Mongolia",

	"MA" => "Morocco",

	"MZ" => "Mozambique",

	"MM" => "Myanmar",

	"NA" => "Namibia",

	"NP" => "Nepal",

	"AN" => "Netherlands Antilles",

	"NL" => "Netherlands",

	"NZ" => "New Zealand",

	"NI" => "Nicaragua",

	"NG" => "Nigeria",

	"KP" => "North Korea",

	"NO" => "Norway",

	"OM" => "Oman",

	"PK" => "Pakistan",

	"PA" => "Panama",

	"PG" => "Papua New Guinea",

	"PY" => "Paraguay",

	"PE" => "Peru",

	"PH" => "Philippines",

	"PL" => "Poland",

	"PT" => "Portugal",

	"QA" => "Qatar",

	"RO" => "Romania",

	"RU" => "Russia",

	"SH" => "Saint Helena",

	"WS" => "Samoa",

	"ST" => "Sao Tome/Principe",

	"SA" => "Saudi Arabia",

	"SC" => "Seychelles",

	"SL" => "Sierra Leone",

	"SG" => "Singapore",

	"SK" => "Slovakia",

	"SI" => "Slovenia",

	"SB" => "Solomon Islands",

	"SO" => "Somalia",

	"ZA" => "South Africa",

	"KR" => "South Korea",

	"ES" => "Spain",

	"LK" => "Sri Lanka",

	"SD" => "Sudan",

	"SR" => "Suriname",

	"SZ" => "Swaziland",

	"SE" => "Sweden",

	"CH" => "Switzerland",

	"SY" => "Syria",

	"TW" => "Taiwan",

	"TZ" => "Tanzania",

	"TH" => "Thailand",

	"TO" => "Tonga",

	"TT" => "Trinidad/Tobago",

	"TN" => "Tunisia",

	"TR" => "Turkey",

	"UG" => "Uganda",

	"UA" => "Ukraine",

	"AE" => "United Arab Emirates",

	"GB" => "United Kingdom",

	"US" => " United States",

	"UY" => "Uruguay",

	"VU" => "Vanuatu",

	"VE" => "Venezuela",

	"VN" => "Viet Nam",

	"ZM" => "Zambia",

	"ZW" => "Zimbabwe");



$ARRAY_ED_USA = array(

"Alaska" 				=> "Alaska",

"Arizona" 				=> "Arizona",

"Arkansas" 				=> "Arkansas",

"California" 			=> "California",

"Colorado" 				=> "Colorado",

"Connecticut" 			=> "Connecticut",

"Delaware" 				=> "Delaware",

"District of Columbia" 	=> "District of Columbia",

"Florida" 				=> "Florida",

"Georgia" 				=> "Georgia",

"Hawaii"				=> "Hawaii",

"Idaho" 				=> "Idaho",

"Illinios" 				=> "Illinios",

"Indiana" 				=> "Indiana",

"Iowa" 					=> "Iowa",

"Kansas" 				=> "Kansas",

"Kentucky" 				=> "Kentucky",

"Louisiana" 			=> "Louisiana",

"Maine" 				=> "Maine",

"Maryland" 				=> "Maryland",

"Massachusetts" 		=> "Massachusetts",

"Michigan" 				=> "Michigan",

"Minnesota" 			=> "Minnesota",

"Mississippi" 			=> "Mississippi",

"Missouri" 				=> "Missouri",

"Montana" 				=> "Montana",

"Nebraska" 				=> "Nebraska",

"Nevada" 				=> "Nevada",

"New Hampshire" 		=> "New Hampshire",

"New Jersey" 			=> "New Jersey",

"New Mexico" 			=> "New Mexico",

"New York" 				=> "New York",

"North Carolina" 		=> "North Carolina",

"North Dakota" 			=> "North Dakota",

"Ohio" 					=> "Ohio",

"Oklahoma" 				=> "Oklahoma",

"Oregon" 				=> "Oregon",

"Pennsylvania" 			=> "Pennsylvania",

"Puerto Rico" 			=> "Puerto Rico",

"Rhode Island" 			=> "Rhode Island",

"South Carolina"		=> "South Carolina",

"South Dakota" 			=> "South Dakota",

"Tennessee" 			=> "Tennessee",

"Texas" 				=> "Texas",

"Utah" 					=> "Utah",

"Vermont" 				=> "Vermont",

"Virginia" 				=> "Virginia",

"Washington" 			=> "Washington",

"West Virginia" 		=> "West Virginia",

"Wisconsin" 			=> "Wisconsin",

"Wyoming" 				=> "Wyoming");



$ARRAY_ED_MEX = array(

"Aguascalientes" 		=> "Aguascalientes",

"Baja California" 		=> "Baja California",

"Baja California Sur" 	=> "Baja California Sur",

"Campeche" 				=> "Campeche",

"Chihuahua" 			=> "Chihuahua",

"Coahuila" 				=> "Coahuila",

"Colima" 				=> "Colima",

"Distrito Federal" 		=> "Distrito Federal",

"Durango" 				=> "Durango",

"Estado de Mexico" 		=> "Estado de Mexico",

"Guerrero" 				=> "Guerrero",

"Guanajuato" 			=> "Guanajuato",

"Hidalgo" 				=> "Hidalgo",

"Jalisco" 				=> "Jalisco",

"Michoacan" 			=> "Michoacan",

"Morelos" 				=> "Morelos",

"Nayarit" 				=> "Nayarit",

"Nuevo Leon" 			=> "Nuevo Leon",

"Oaxaca" 				=> "Oaxaca",

"Puebla" 				=> "Puebla",

"Queretaro" 			=> "Queretaro",

"Quintana Roo" 			=> "Quintana Roo",

"San Luis Potosi" 		=> "San Luis Potosi",

"Sinaloa" 				=> "Sinaloa",

"Sonora" 				=> "Sonora",

"Tabasco" 				=> "Tabasco",

"Tamaulipas" 			=> "Tamaulipas",

"Tlaxcala" 				=> "Tlaxcala",

"Veracruz" 				=> "Veracruz",

"Yucatan" 				=> "Yucatan",

"Zacatecas" 			=> "Zacatecas");

?>