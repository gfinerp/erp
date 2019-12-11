<html>
    <head>
        <meta charset="UTF-8">
        <link rel="shortcut icon" href="<?php echo BASE_URL; ?>/logo.ico" type="image/x-icon" />
        <title>LOGIN - GESFIN</title>
        <link rel="stylesheet" type="text/css" href="<?php echo BASE_URL; ?>/assets/css/login.css">
    </head>
    <body>
      <div class="loginarea">
      <img src="<?php echo BASE_URL; ?>/assets/images/bannerlogin.png" width="250" height="50" border="0" />
        <form method="POST">
          <input type="email" name="email" placeholder="Digite seu E-mail" />
          <input type="password" name="password" placeholder="Digite sua Senha" />
          <input type="submit" value="Entrar" />

          <?php if (isset($error) && !empty($error)):?>
          <div class="warning"> <?php echo $error; ?></div>
        <?php endif;?>
        </form>
      <p>Gerenciamento Empresarial </p>
      </div>
<div style="clear: both;"></div>
            <div class="creditos">
                © Copyright 2018 weltonvcardoso@gmail.com - All Rights Reserved
              </div>
    </body>
</html>
