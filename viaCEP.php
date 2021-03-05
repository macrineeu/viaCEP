<?php

    //definindo minha constantes do BD//
    $servername = "localhost";
    $user =  "root";
    $password = "";
    $database = "salvaCEP";

    //Faço conexão com o Banco de dados//
    $conexao = new  mysqli($servername, $user, $password, $database);

    //VERIFICO SE HOUVE ALGUM PROBLEMA COM A CONEXAO//
    if($conexao->connect_error){
        die("Conexão com o Site falhou, tente Novamente mais tarde" . $conexao->connect_error);
    };

    //CEP informado pelo usuário//
    $cep = $_POST['cep'];


    //vamos consulta primeiro a nossa base em busca do cep informado
	$query = "SELECT * FROM tb_cep WHERE cep = '{$cep}'";
 
    $resultado = mysqli_query($conexao, $query);

    //ATRIBUINDO VALORES AOS MEU ARRAY//
    if(mysqli_num_rows($resultado) > 0){
        while($linha = mysqli_fetch_array($resultado)){
           $endereco = $linha['logradouro'];
           $bairro = $linha['bairro'];
           $localidade = $linha['localidade'];
           $UF = $linha['uf'];
        }
    }
    else{
        //Pesquisando via WEB, endereço completo a partir do CEP//
        $url = "https://viacep.com.br/ws/".$cep."/xml/";

            //Transforma String em Objeto///
            $xml = simplexml_load_file($url);

        //Dados a serem inseridos//
        $endereco = $xml->logradouro;
        $bairro = $xml->bairro;
        $localidade = $xml->localidade;
        $UF = $xml->uf;

        
        //INSERIR NO BANCO DE DADOS//
        $query = "insert into tb_cep (cep, logradouro, bairro, localidade, uf) values ('{$cep}', '{$endereco}', '{$bairro}', '{$localidade}', '{$UF}')";

        $conexao = mysqli_connect('localhost', 'root', '', 'salvaCEP');
        mysqli_query($conexao, $query);
        mysqli_close($conexao);
        }
?>

<!DOCTYPE html>
<html lang="en">
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
        <div class="container" id="Resposta">
            <h1 class="text-center">Dados do CEP inserido:</h1>
            <br>
            <div id="results" class="text-center">
                <div class="col-md-12">
                    <label class="negrito">CEP: </label>
                    <?php echo $cep ?>
                </div>
                <div class="col-md-12">
                    <label class="negrito">Endereço:</label>
                    <?php echo $endereco ?>
                </div>
                <div class="col-md-12">
                    <label class="negrito">Bairro: </label>
                    <?php echo $bairro ?>
                </div>
                <div class="col-md-12">
                    <label class="negrito">Localidade: </label>
                    <?php echo $localidade ?>
                </div>
                <div class="col-md-12">
                    <label class="negrito">UF: </label>
                    <?php echo $UF ?>
                </div>

                    <div class="col-md-12" >
                            <br>
                            <a href="index.php">
                                <button class="btn btn-success btn-lg">
                                    Fazer nova pesquisa <i class="fa fa-search"></i>
                                </button>
                            </a>
                    </div>
                
                <p>Obs: Caso os campos não sejam preenchidos, verifique o CEP e tente novamnte.</p>
            </div>
        </div>
    </body>

</html>