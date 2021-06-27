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

    <body class="hold-transition skin-green layout-top-nav fixed">
        <div class="wrapper">

            <header class="main-header">
                <nav class="navbar navbar-static-top">
                    <div class="container">
                        <div class="navbar-header">
                            <a href="<?=base_url()?>" class="navbar-brand"><b>WEB</b> DEPÓSITO</a>
                            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse">
                                <i class="fa fa-bars"></i>
                            </button>
                        </div>

                        <div class="collapse navbar-collapse pull-left" id="navbar-collapse">
                            <ul class="nav navbar-nav">
                                <!-- LINK HOME -->
                                <?php
                                if(isset($pagina) && $pagina == 'HOME'):
                                ?>
                                <li class="active">
                                    <a href="<?=base_url()?>"><i class="fa fa-home"></i> HOME</a>
                                </li>
                                <?php
                                else:
                                ?>
                                <li>
                                    <a href="<?=base_url()?>"><i class="fa fa-home"></i> HOME</a>
                                </li>
                                <?php
                                endif;
                                ?>

                                <!-- LINK LANÇAMENTOS -->
                                <?php
                                if(isset($pagina) && $pagina == 'LANÇAMENTOS'):
                                ?>
                                <li class="active">
                                    <a href="<?=base_url('lancamentos')?>"><i class="fa fa-file-text"></i> LANÇAMENTOS</a>
                                </li>
                                <?php
                                else:
                                ?>
                                <li>
                                    <a href="<?=base_url('lancamentos')?>"><i class="fa fa-file-text"></i> LANÇAMENTOS</a>
                                </li>
                                <?php
                                endif;
                                ?>

                                <!-- LINK RELATÓRIOS -->
                                <?php
                                if(isset($pagina) && $pagina == 'RELATÓRIOS'):
                                ?>
                                <li class="active">
                                    <a href="<?=base_url('relatorios')?>"><i class="fa fa-bar-chart"></i> RELATÓRIOS</a>
                                </li>
                                <?php
                                else:
                                ?>
                                <li>
                                    <a href="<?=base_url('relatorios')?>"><i class="fa fa-bar-chart"></i> RELATÓRIOS</a>
                                </li>
                                <?php
                                endif;
                                ?>

                                <!-- LINK OUTROS -->
                                <?php
                                if(isset($pagina) && $pagina == 'OUTROS'):
                                ?>
                                <li class="active">
                                    <a href="<?=base_url('outros')?>"><i class="fa fa-book"></i> OUTROS</a>
                                </li>
                                <?php
                                else:
                                ?>
                                <li>
                                    <a href="<?=base_url('outros')?>"><i class="fa fa-book"></i> OUTROS</a>
                                </li>
                                <?php
                                endif;
                                ?>

                            </ul>
                        </div>
                        <div class="navbar-custom-menu">
                            <ul class="nav navbar-nav">
                                <li class="dropdown user user-menu">
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                        <?php
                                        if(session()->nivel_acesso === 'adm'):
                                        ?>
                                            <img src="<?=base_url()?>/assets/dist/img/user.jpg" class="user-image" alt="User Image">
                                        <?php
                                        else:
                                        ?>
                                            <img src="<?=base_url()?>/assets/dist/img/user_adm.jpg" class="user-image" alt="User Image">
                                        <?php
                                        endif;
                                        ?>
                                        <span class="hidden-xs"><?=strtoupper(session()->usuario)?></span>
                                    </a>
                                    <ul class="dropdown-menu">
                                        <li class="user-header">
                                            <?php
                                            if(session()->nivel_acesso == 'adm'):
                                            ?>
                                                <img src="<?=base_url()?>/assets/dist/img/user.jpg" class="img-circle" alt="User Image">
                                            <?php
                                            else:
                                            ?>
                                                <img src="<?=base_url()?>/assets/dist/img/user_adm.jpg" class="img-circle" alt="User Image">
                                            <?php
                                            endif;
                                            ?>
                                            

                                            <p>
                                            <?=strtoupper(session()->usuario)?>
                                            <small></small>
                                            </p>
                                        </li>

                                        <li class="user-footer">
                                            <div class="text-center">
                                                <a href="<?=base_url('login/logout')?>" class="btn btn-default btn-flat text-red"><i class="fa fa-power-off"></i> SAIR</a>
                                            </div>
                                        </li>
                                    </ul>
                                </li>
                            </ul>
                        </div>
                    </div>
                </nav>
            </header>

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
        <!-- ./wrapper -->

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
