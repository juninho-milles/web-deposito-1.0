<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
        <title>IMPRIMIR RECIBO</title>

        <!-- Bootstrap -->
        <link href="<?=base_url()?>/assets/bower_components/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">

        <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
    </head>
    <body>
        <div class="container">

            <div class="row text-center">
                <img src="<?php echo base_url()?>/assets/dist/img/Logomarca-Oficial.png" width="207" height="80">
            </div>

            <br>

            <div class="row">
				<h4 class="text-center"><b>RECIBO</b></h4>

				<br>	

				<p><?=$dadosRecibo['texto']?></p>
			</div>

            <br>
			<br>
			<br>
			<br>
			<br>
			<br>

            <div class="row text-center">
				<table class="table">
					<tbody>
						<tr>
							<th><p>DATA: ______/______/____________</p></th>
							<th class="text-right"><p>ASSINATURA: _________________________________________</p></th>
						</tr>
					</tbody>
				</table>
		    
		<p>ASSINATURA: _________________________________________</p>
	   </div>
        </div>

        <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
        <!-- Include all compiled plugins (below), or include individual files as needed -->
        <script src="<?=base_url()?>/assets/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
    </body>
</html>
