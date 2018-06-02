<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <!-- <link rel="stylesheet" href="./public/css/master.css"> -->
    <!-- JQuery -->
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>

    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css">

    <!-- Popper JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js"></script>

    <!-- Latest compiled JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js"></script>

    <!-- Alertfy.js -->
    <!-- JavaScript -->
    <script src="//cdn.jsdelivr.net/npm/alertifyjs@1.11.1/build/alertify.min.js"></script>

    <!-- CSS -->
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.11.1/build/css/alertify.min.css"/>

    <!--PointToPoint-->
    <script src="/public/plugins/jquery.pointpoint/jquery.pointpoint.js"></script>
    <script src="/public/plugins/jquery.pointpoint/transform.js"></script>

    <link rel="stylesheet" href="/public/plugins/jquery.pointpoint/jquery.pointpoint.css">

     <script src="/public/js/script.js"></script>
</head>
<body>

    <div class="container-fluid">
	<div class="row">
		<div class="col-md-12">
			<div class="page-header">
				<h1>
					Crud <br>
                    <small>Fazendo um pequeno crud com PHP, JQuery e Ajax</small>
				</h1>
			</div>
			<form>
				<div class="form-group">
					 
					<label for="inputNome">
						Nome de usuário
					</label>
					<input type="text" class="form-control" id="inputNome" required/>
				</div>
				<div class="form-group">
					 
					<label for="inputEmail">
						E-mail
					</label>
					<input type="email" class="form-control" id="inputEmail" required/>
				</div>
				
				<button type="submit" class="btn btn-primary">
					Enviar
				</button>
			</form>
			
		</div>
	</div>
    <div class="row">
        <div class="col-md-2 col-sm-0"></div>
        <div class="col-md-8 col-sm-12">
            <table class="table table-hover table-striped">
				
            </table>
        </div>
        <div class="col-md-2 col-sm-0"></div>
    </div>
</div>
</body>
</html>