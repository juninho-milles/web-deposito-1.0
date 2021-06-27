<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>
        <?php
        if(isset($pagina)):
            echo 'WEB DEPÓSITO | '.$pagina;
        endif;
        ?>
        </title>
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <link rel="shortcut icon" href="<?=base_url()?>/assets/dist/img/favicon-min.png" type="image/x-icon" />

        <link rel="stylesheet" href="<?=base_url()?>/assets/bower_components/bootstrap/dist/css/bootstrap.min.css">
        <link rel="stylesheet" href="<?=base_url()?>/assets/bower_components/font-awesome/css/font-awesome.min.css">
        <link rel="stylesheet" href="<?=base_url()?>/assets/bower_components/Ionicons/css/ionicons.min.css">
        
        <?php
        if(isset($css)):
            echo view('telas/'.$css);
        endif;
        ?>
        
        <link rel="stylesheet" href="<?=base_url()?>/assets/dist/css/AdminLTE.min.css">
        <link rel="stylesheet" href="<?=base_url()?>/assets/dist/css/skins/_all-skins.min.css">

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->

        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
        <style>
        body{
            padding-right:0 !important;
        }
        </style>
    </head>
    <body class="hold-transition skin-green sidebar-mini fixed">

        <div class="wrapper">

            <header class="main-header">
                <a href="<?=base_url()?>" class="logo">
                    <span class="logo-mini"><b>WD</b></span>
                    <span class="logo-lg"><b>WEB</b> DEPÓSITO</span>
                </a>
                <nav class="navbar navbar-static-top">

                    <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </a>

                    <div class="navbar-custom-menu">
                        <ul class="nav navbar-nav">
                            <li class="dropdown user user-menu">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                    <img src="<?=base_url()?>/assets/dist/img/user.jpg" class="user-image" alt="User Image">
                                    <span class="hidden-xs">Irani Junior</span>
                                </a>
                                <ul class="dropdown-menu">
                                    <li class="user-header">
                                        <img src="<?=base_url()?>/assets/dist/img/user.jpg" class="img-circle" alt="User Image">

                                        <p>
                                        Irani Junior - Web Developer
                                        <small>Member since Nov. 2012</small>
                                        </p>
                                    </li>

                                    <li class="user-footer">
                                        <div class="text-center">
                                            <a href="<?=base_url()?>" class="btn btn-default btn-flat text-red"><i class="fa fa-power-off"></i> SAIR</a>
                                        </div>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </div>

                </nav>
            </header>

            <aside class="main-sidebar">
                <section class="sidebar">
                    <ul class="sidebar-menu" data-widget="tree">
                        <li class="header text-center">MENU DE NAVEGAÇÃO</li>

                        <!-- LINK HOME -->
                        <?php
                        if(isset($pagina) && $pagina == 'HOME'):
                        ?>
                        <li class="active">
                            <a href="<?=base_url()?>"><i class="fa fa-home"></i> <span>HOME</span></a>
                        </li>
                        <?php
                        else:
                        ?>
                        <li>
                            <a href="<?=base_url()?>"><i class="fa fa-home"></i> <span>HOME</span></a>
                        </li>
                        <?php
                        endif;
                        ?>

                        <!-- LINK CONFERENTES -->
                        <?php
                        if(isset($pagina) && $pagina == 'CONFERENTES'):
                        ?>
                        <li class="active">
                            <a href="<?=base_url('conferentes')?>"><i class="fa fa-users"></i> <span>CONFERENTES</span></a>
                        </li>
                        <?php
                        else:
                        ?>
                        <li>
                            <a href="<?=base_url('conferentes')?>"><i class="fa fa-users"></i> <span>CONFERENTES</span></a>
                        </li>
                        <?php
                        endif;
                        ?>
                        
                        <!-- LINK FORNECEDORES -->
                        <?php
                        if(isset($pagina) && $pagina == 'FORNECEDORES'):
                        ?>
                        <li class="active">
                            <a href="<?=base_url('fornecedores')?>"><i class="fa fa-truck"></i> <span>FORNECEDORES</span></a>
                        </li>
                        <?php
                        else:
                        ?>
                        <li>
                            <a href="<?=base_url('fornecedores')?>"><i class="fa fa-truck"></i> <span>FORNECEDORES</span></a>
                        </li>
                        <?php
                        endif;
                        ?>

                        <!-- LINK SETORES -->
                        <?php
                        if(isset($pagina) && $pagina == 'SETORES'):
                        ?>
                        <li class="active">
                            <a href="<?=base_url('setores')?>"><i class="fa fa-bank"></i> <span>SETORES</span></a>
                        </li>
                        <?php
                        else:
                        ?>
                        <li>
                            <a href="<?=base_url('setores')?>"><i class="fa fa-bank"></i> <span>SETORES</span></a>
                        </li>
                        <?php
                        endif;
                        ?>
                        
                        <!-- LINK LANÇAMENTOS -->
                        <?php
                        if(isset($pagina) && $pagina == 'LANÇAMENTOS'):
                        ?>
                        <li class="active">
                            <a href="<?=base_url('lancamentos')?>"><i class="fa fa-file-text"></i> <span>LANÇAMENTOS</span></a>
                        </li>
                        <?php
                        else:
                        ?>
                        <li>
                            <a href="<?=base_url('lancamentos')?>"><i class="fa fa-file-text"></i> <span>LANÇAMENTOS</span></a>
                        </li>
                        <?php
                        endif;
                        ?>
                        
                        <!-- LINK RELATÓRIOS -->
                        <?php
                        if(isset($pagina) && $pagina == 'RELATÓRIOS'):
                        ?>
                        <li class="active">
                            <a href="<?=base_url('relatorios')?>"><i class="fa fa-bar-chart"></i> <span>RELATÓRIOS</span></a>
                        </li>
                        <?php
                        else:
                        ?>
                        <li>
                            <a href="<?=base_url('relatorios')?>"><i class="fa fa-bar-chart"></i> <span>RELATÓRIOS</span></a>
                        </li>
                        <?php
                        endif;
                        ?>

                        <!-- LINK OUTROS -->
                        <?php
                        if(isset($pagina) && $pagina == 'OUTROS'):
                        ?>
                        <li class="active">
                            <a href="<?=base_url('outros')?>"><i class="fa fa-book"></i> <span>OUTROS</span></a>
                        </li>
                        <?php
                        else:
                        ?>
                        <li>
                            <a href="<?=base_url('outros')?>"><i class="fa fa-book"></i> <span>OUTROS</span></a>
                        </li>
                        <?php
                        endif;
                        ?>
                        
                        <li class="header text-center">ACESSO RÁPIDO</li>
                        <li><a href="<?=base_url('fornecedores/deposito')?>"><i class="fa fa-circle-o"></i> <span>FORNECEDORES DEPÓSITO</span></a></li>
                        <li><a href="<?=base_url('fornecedores/hortifruti')?>"><i class="fa fa-circle-o"></i> <span>FORNECEDORES HORTIFRUTI</span></a></li>
                    </ul>
                </section>
            </aside>

            <div class="content-wrapper">
            <?php
            if(isset($tela)):
                echo view('telas/'.$tela);
            endif;
            ?>
            </div>

            <footer class="main-footer">
                <div class="pull-right hidden-xs">
                    <b>Versão</b> 1.0.0
                </div>
                <strong>Copyright &copy; 2021 </strong>- Irani Junior
            </footer>

        </div>

        <script src="<?=base_url()?>/assets/bower_components/jquery/dist/jquery.min.js"></script>
        <script src="<?=base_url()?>/assets/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
        <script src="<?=base_url()?>/assets/bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
        <script src="<?=base_url()?>/assets/bower_components/fastclick/lib/fastclick.js"></script>
        <script src="<?=base_url()?>/assets/dist/js/adminlte.min.js"></script>
        <script src="<?=base_url()?>/assets/dist/js/demo.js"></script>
        
        <?php
        if(isset($js)):
            echo view('telas/'.$js);
        endif;
        ?>

    </body>
</html>
