<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <!--BOOTSTRAP 4-->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
        <!--JavaScript-->
        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>
        <!--FontAwesome-->
        <script src="https://kit.fontawesome.com/47443fc21b.js" crossorigin="anonymous"></script>
        <!--CSS-->
        <link rel="stylesheet" href="css/style.css">
        <title>API - VIACEP</title>
    </head>

    <body>
        
    <div class="container">
            <h1 class="text-center">BUSCA DE ENDEREÇO VIA CEP</h1>
            <p class="information text-center">** Utilize somente Números **</p>
        </div>

        <br>
        <br>
        <form action="viaCEP.php" method="POST" name="formulario">

            <div class="container">
                <div class="form-row">
                    <div class="col-md-3">
                    </div>

                    <div class="col-md-4">
                        <label>CEP: <i class="fas fa-map-marked-alt"></i></label>
                        <input type="text" class="form-control" name="cep" id="cep" maxlength="9" minlength="9" required autofocus><br>
                    </div>
                    
                    <div class="col-md-4 text-initial" id="button" >
                            <br>
                            <button class="btn btn-success btn-lg" onclick="validar()">
                                Consultar <i class="fa fa-search"></i>
                            </button>
                    </div>  
                </div>
            </div>
        </form>
    </body>

    <script type="text/javascript">
		var campoCEP = document.getElementById('cep');

		campoCEP.oninput = function () {
			
			var cep = campoCEP.value;

			if (cep.length == 5){
				campoCEP.value += "-";
			}			
		}
	</script>
</html>