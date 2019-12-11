<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <title>Painel - <?php echo $viewData['company_name']; ?></title>
        <link href="<?php echo BASE_URL; ?>/assets/css/template.css" rel="stylesheet" />

        <link  href="<?php echo BASE_URL; ?>/assets/css/bootstrap.min.css" rel="stylesheet" />
       <script type="text/javascript" src="<?php echo BASE_URL; ?>/assets/js/jquery.min.js"></script>
        <script type="text/javascript" src="<?php echo BASE_URL; ?>/assets/js/bootstrap.min.js"></script>
        <script type="text/javascript">var BASE_URL = '<?php echo BASE_URL; ?>' ;</script>
        <script type="text/javascript" src="<?php echo BASE_URL; ?>/assets/js/script.js"></script>
                <link href="<?php echo BASE_URL; ?>/assets/css/nav.css" rel="stylesheet" />
       <script type="text/javascript" src="<?php echo BASE_URL; ?>/assets/js/script_nav.js"></script>

           

    </head>
    <body style="   background-color: #cccccc;">

      <header role="banner" class="navbar navbar-fixed-top navbar-inverse">
      <div class="container">
        <div class="navbar-header">

          <button data-toggle="collapse-side" data-target=".side-collapse" data-target-2=".side-collapse-container" type="button" class="navbar-toggle pull-left"><span class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span></button>
              <a class="navbar-brand" href="<?php echo BASE_URL; ?>"><?php echo $viewData['company_name']?></a>

        </div>

        <div class="navbar-inverse side-collapse in">
          <nav role="navigation" class="navbar-collapse">
            <ul class="nav navbar-nav">
           <li><a href="<?php echo BASE_URL; ?>/dasboard"> Dasboard</a></li>
           <li><a href="<?php echo BASE_URL; ?>/permissions"> Permissões</a></li>
        <li class="dropdown">
        <a href="" class="dropdown-toggle" data-toggle="dropdown" >Cadastrar
        <span class="caret"></span></a>
        <ul class="dropdown-menu">

            <li><a href="<?php echo BASE_URL; ?>/inventory"> Produtos</a></li>
            <li><a href="<?php echo BASE_URL; ?>/users"> Usuários</a></li>
            <li><a href="<?php echo BASE_URL; ?>/clients"> Clientes</a></li>
            <li><a href="<?php echo BASE_URL; ?>/salesman"> Funcionários</a></li>
            <li><a href="<?php echo BASE_URL; ?>/services"> Serviços</a></li>
        </ul>
      </li>
      <li class="active"><a href="<?php echo BASE_URL; ?>/sales"> Vendas</a></li>
      

    <li class="dropdown">
        <a href="" class="dropdown-toggle" data-toggle="dropdown" >Relatorios
        <span class="caret"></span></a>
        <ul class="dropdown-menu">
            <li><a href="<?php echo BASE_URL; ?>/report/sales"> Vendas</a></li>
            <li><a href="<?php echo BASE_URL; ?>/report/services"> Serviços</a></li>
            <li><a href="<?php echo BASE_URL; ?>/report/inventory"> Estoque</a></li>
            <li><a href="<?php echo BASE_URL; ?>/report/accounts"> Contas</a></li>
            <li><a href="<?php echo BASE_URL; ?>/report/nfces"> Notas Fiscais</a></li>
            <li><a href="<?php echo BASE_URL; ?>/danfes"> NFCs Mês</a></li>
            <li><a href="<?php echo BASE_URL; ?>/email"> E-mail Contador</a></li>
        </ul>
      </li>

            <li><a href="<?php echo BASE_URL; ?>/accounts"> Contas</a></li>
          </ul>



       <ul class="nav navbar-nav navbar-right">
      <li title="<?php echo $viewData['user_email']; ?>"><a href="#"><span class="glyphicon glyphicon-user" ></span>Usuário</a></li>
      <li title="Sair"><a href="<?php echo BASE_URL.'/login/logout'; ?>"><span class="glyphicon glyphicon-log-in"></span> Sair</a></li>
    </ul>

          </nav>
        </div>
      </div>
    </header>


    <div class="container side-collapse-container">

      <div class="area">
      
        <?php $this->loadViewInTemplate($viewName, $viewData); ?>
      </div>  
     </div>
     </div>

    </body>
</html>
