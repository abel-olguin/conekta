<?php
session_start();
if(isset($_SESSION['id_user']) && $_SESSION['id_user'] && !isset($_COOKIE['id_user']))
{
    setcookie('id_user',$_SESSION['id_user'],time() + 4800);
}
//setcookie('id_user',' ',time() + -4800);
?>
<html lang="es">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="shortcut icon" href="images/favicon.ico">
	<title>tienda conekta</title>
	<!-- Bootsatrap -->
	<link href="css/bootstrap.min.css" rel="stylesheet">
	<!-- Custom styles for this template -->
	<link href="css/style.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" media="print" href="css/impresion.css">
	<script src="js/jquery11.js"></script>
	<!-- Bootstrap core JavaScript-->
	<!-- Placed at the end of the document so the pages load faster -->
	<script src="js/bootstrap.min.js"></script>
	<script src="js/validacion.js"></script>
	<script src="js/validar.js"></script>
	<script src="js/validateAddMethods.js"></script>
    <script src="js/scripts-ajax.js"></script>
	<!-- conekta -->
	<script src="https://conektaapi.s3.amazonaws.com/v0.3.0/js/conekta.js"></script>
	<script src="js/scripts-conekta.js"></script>
	<!-- end conekta -->


</head>

<!-- Valida solo  letras Metodo Adicional-->
<script>
	jQuery.validator.addMethod("lettersonly", function(value, element) 
{
return this.optional(element) || /^[A-Za-záéíóúÁÉÍÓÚ'," "]+$/i.test(value);
}, "Letters and spaces only please");

$.validator.addMethod("valueNotEquals", function(value, element, arg){
  return arg != value;
 }, "Value must not equal arg.");

</script>

<body class="col-md-12">


	<header>
		<div class="col-md-12 banner">
			<img class="img-responsive" src="images/header.png">
		</div>
	</header>
    <div class="clear"></div>
	<article class="pp_container">

