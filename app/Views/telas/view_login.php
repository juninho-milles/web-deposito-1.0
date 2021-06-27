<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<title>WEB DEPÓSITO | LOGIN</title>
		<!-- Tell the browser to be responsive to screen width -->
		<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
		<link rel="shortcut icon" href="<?=base_url()?>/assets/dist/img/favicon-min.png" type="image/x-icon" />

		<link rel="stylesheet" href="<?=base_url()?>/assets/bower_components/bootstrap/dist/css/bootstrap.min.css">
		<!-- Font Awesome -->
		<link rel="stylesheet" href="<?=base_url()?>/assets/bower_components/font-awesome/css/font-awesome.min.css">
		<!-- Ionicons -->
		<link rel="stylesheet" href="<?=base_url()?>/assets/bower_components/Ionicons/css/ionicons.min.css">
		<!-- Theme style -->
		<link rel="stylesheet" href="<?=base_url()?>/assets/dist/css/AdminLTE.min.css">

		<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
		<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
		<!--[if lt IE 9]>
		<script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
		<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
		<![endif]-->

		<!-- Google Font -->
		<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
        
        
    </head>
	<body class="hold-transition login-page" style="background-image: linear-gradient(#00a65a, #25431d); height: 0">
		
		<br>
		<div class="login-box" id="tela_login" style="display:none;">


			<div class="login-box-body">
				
				<div class="login-logo">
					<img src="<?=base_url()?>/assets/dist/img/Logomarca-Oficial.png" width="207" height="80" class="user-image" alt="logo">
					<h4><b>WEB</b> DEPÓSITO</h4>
				</div>

				<hr>
				
                <div id="divLogin">
                    <div class="form-group has-feedback">
                        <input type="text" class="form-control" name="inputUsuario" id="inputUsuario" placeholder="Usuário">
                        <span class="glyphicon glyphicon-user form-control-feedback"></span>
                        <p id="mensagemInputUsuario"></p>
                    </div>
                    <div class="form-group has-feedback">
                        <input type="password" class="form-control" name="inputSenha" id="inputSenha" placeholder="Senha">
                        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                        <p id="mensagemInputSenha"></p>
                    </div>

                                            
                    <hr>

                    <div class="row text-center">

                        <button type="button" class="btn btn-default btn-flat text-green" onclick="logar()"><i class="fa fa-unlock-alt"></i> ENTRAR</button>
                            
                    </div>
                </div>
			</div>

		</div>


		<!-- jQuery 3 -->
		<script src="<?=base_url()?>/assets/bower_components/jquery/dist/jquery.min.js"></script>
		<!-- Bootstrap 3.3.7 -->
		<script src="<?=base_url()?>/assets/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>

        <script src="<?=base_url()?>/assets/dist/includes/login/js/view_login.js"></script>
        
    </body>
</html>
