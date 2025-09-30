<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="upload.php" method = "post" enctype = "multipart/form-data">
        Selecione uma imagem para envio:
        <input type="file" name="fileToUpload" id="fileToUpload">
        <input type="submit" value="Enviar arquivo Image" name="submit">
        
    </form>
    
</body>
</html>

<!DOCTYPE html>
<html lang="pt-bt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <div vw class="enabled">
        <div vw-access-button class="active"></div>
        <div vw-plugin-wrapper></div>
    </div>
    <script src="https://vlibras.gov.br/app/vlibras-plugin.js"></script>
    <script>
        new window.VLibras.Widget('https://vlibras.gov.br/app');
    </script>

    <h1>Página de Libras</h1>
    <h2>Éderson Costa é o melhor professor do SENAC</h2>
    <h2>Cachorro, Gato e galinha vivem onde?</h2>
    <h2>
        Receita de bolo de chocolate!
    </h2>
    <h2>A Maria Helena e a turma dela vão para SP e irão ganhar Notbooks pelo Vivo Valoriza Dados SA</h2>
    <h2>O Matheus é  o pai da Mateia sua inteligencia Artificial!</h2>
</body>
</html>

<?php
include "connect.php";

$target_dir = 'uploads/';
if (!is_dir($target_dir)) {
    mkdir($target_dir, 0755, true);
}
$target_file = $target_dir . basename($_FILES['fileToUpload']['name']);
// echo $target_file;


//Pega somente a extensão e converte em minúsculo
$imageFileType = strtolower(pathinfo ($target_file,PATHINFO_EXTENSION));

// echo $imageFileType;

$target_file =$target_dir.md5(uniqid()).".".$imageFileType;


// Verifica se a imagem é real
if(isset($_POST["submit"])) {
//A função getimagesize() irá determinar o tamanho de qualquer arquivo de imagem suportado fornecido e retornar as dimensões
    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
    if($check !== false) {
        // echo "Arquivo é uma imagem - " . $check["mime"] . ".";
        $uploadOk = 1; //Variável que vamos validar o envio

    } 
    else {
        echo "Arquivo não é uma imagem.";
        $uploadOk = 0;
    }
}


if (file_exists($target_file)) {
    echo "Desculpe, caminho já existe.";
    $uploadOk = 0;
}

// Verifica o tamanho do arquivo
if ($_FILES["fileToUpload"]["size"] > 5000000) {
    echo "Seu arquivo é muito grande.";
    $uploadOk = 0;
}


if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
&& $imageFileType != "gif" ) {
 echo "Desculpe, apenas arquivos JPG, JPEG, PNG & GIF são permitidos.";
 $uploadOk = 0;
}

// Salvando o arquivo
if ($uploadOk == 0) {
    echo "Desculpe, seu arquivo não pôde ser submetido.";
} 
else {
   //Move o arquivo, porém com o nome alterado função do PHP que move o arquivo temporário enviado para um local definitivo no servidor.

    
//Retorna:

//true se o arquivo foi movido com sucesso,

//false caso contrário.

    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {

//htmlspecialchars (preserva os caracteres não gerando conflito com o HTML)
        echo "O arquivo ". htmlspecialchars( basename( $_FILES["fileToUpload"]["name"])). " foi enviado .";
        
        $query_insert = "insert into path values (null,'./{$target_file}');";
        $result_insert= mysqli_query($con, $query_insert); 
    }

    else {
    echo "Desculpe, ocorreu um erro ao submeter o arquivo.";
    }

}





?>

<?php
$host="127.0.0.1";
$usuario="root";
$senha="";
$bd="files";
$con=mysqli_connect($host,$usuario,$senha,$bd);
// if($con->connect_errno){
//     echo "Falha na Conexão: (".$con->connect_errnno.")" .$con->connect_error;
// }

// echo $con->host_info ."\n";
