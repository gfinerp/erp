
<html>
	<head>
		<script language="javascript" type="text/javascript">
	function checa_formulario(email){

	if (email.email.value == ""){
	alert("não deixe o destinatario em branco!!!");
	email.email.focus();
	return (false);
	}

}
		</script>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">

	</head>
	<body>

	<form onSubmit="return checa_formulario(this)" method="post" action="<?php echo BASE_URL;?>/email/envia"  enctype="multipart/form-data" name="email">
			<h1 align="left" class="style1">Enviar E-mail para Contador</h1>	</br></br>
	
	<div style="text-align: left; color: orange">
		<div>Destinatario:
	<input name="email" type="text" class="email"></div></br></br>
		<div >Anexo:
	<input name="arquivo" type="file"></div></br></br>

	<div style="size: 500" ><input type="submit" name="Submit" class="button button_small" style="background-color:#32CD32" value="Enviar"></div>
<div>
</form>
	</body>
</html>