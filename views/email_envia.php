<?php
//pego os dados enviados pelo formulario
$nome = "loja";
$email = $_POST["email"];
$mensagem = "xml";
$assunto = "xml";
$email_from = "weltonvcardoso@gmail.com";
//formato o campo da mensagem
$mensagem = wordwrap( $mensagem, 50, "
", 1);
//valido os emails
if (!ereg("^([0-9,a-z,A-Z]+)([.,_]([0-9,a-z,A-Z]+))*[@]([0-9,a-z,A-Z]+)([.,_,-]([0-9,a-z,A-Z]+))*[.]([0-9,a-z,A-Z]){2}([0-9,a-z,A-Z])?$", $email)){
echo"<center>Digite um email valido</center>";
echo "<center><a href=\"java script:history.go(-1)\">Voltar</center></a>";
exit;
}
if (!ereg("^([0-9,a-z,A-Z]+)([.,_]([0-9,a-z,A-Z]+))*[@]([0-9,a-z,A-Z]+)([.,_,-]([0-9,a-z,A-Z]+))*[.]([0-9,a-z,A-Z]){2}([0-9,a-z,A-Z])?$", $email_from)){
echo "<center>Digite um email valido</center>";
echo "<center><a href=\"java script:history.go(-1)\"><center>Voltar</center></a>";
exit;
}
$arquivo = isset($_FILES["arquivo"]) ? $_FILES["arquivo"] : FALSE;
if(file_exists($arquivo["tmp_name"]) and !empty($arquivo)){
$fp = fopen($_FILES["arquivo"]["tmp_name"],"rb");
$anexo = fread($fp,filesize($_FILES["arquivo"]["tmp_name"]));
$anexo = base64_encode($anexo);
fclose($fp);
$anexo = chunk_split($anexo);
$boundary = "XYZ-" . date("dmYis") . "-ZYX";
$mens = "--$boundary\n";
$mens .= "Content-Transfer-Encoding: 8bits\n";
$mens .= "Content-Type: text/html; charset=\"ISO-8859-1\"\n\n"; //plain
$mens .= "$mensagem\n";
$mens .= "--$boundary\n";
$mens .= "Content-Type: ".$arquivo["type"]."\n";
$mens .= "Content-Disposition: attachment; filename=\"".$arquivo["name"]."\"\n";
$mens .= "Content-Transfer-Encoding: base64\n\n";
$mens .= "$anexo\n";
$mens .= "--$boundary--\r\n";
$headers = "MIME-Version: 1.0\n";
$headers .= "From: \"$nome\" <$email_from>\r\n";
$headers .= "Content-type: multipart/mixed; boundary=\"$boundary\"\r\n";
$headers .= "$boundary\n";
//envio o email com o anexo
mail($email,$assunto,$mens,$headers);


if (isset($_POST['email'])  &&  !empty($_POST['email'])) {

        echo ("<SCRIPT LANGUAGE='JavaScript'>
        window.alert('E-mail Enviado com Sucesso!')
        </SCRIPT>");


        

}else{

        echo ("<SCRIPT LANGUAGE='JavaScript'>
        window.alert('Ocorreu um erro Tente Novamente!')
        </SCRIPT>");


        }

}
//se não tiver anexo
else{
$headers = "MIME-Version: 1.0\r\n";
$headers .= "Content-type: text/html; charset=iso-8859-1\r\n";
$headers .= "From: \"$nome\" <$email_from>\r\n";
//envia o email sem anexo
mail($email,$assunto,$mensagem, $headers);



if (isset($_POST['arquivo'])  &&  !empty($_POST['arquivo'])) {

        echo ("<SCRIPT LANGUAGE='JavaScript'>
        window.alert('E-mail Enviado com Sucesso!')
        </SCRIPT>");
}else{

        echo ("<SCRIPT LANGUAGE='JavaScript'>
        window.alert('E-mail Enviado SEM ANEXO!')
        </SCRIPT>");

        }

}
?>
