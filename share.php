<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/share.css">
    <script src="https://kit.fontawesome.com/669bcf34d7.js" crossorigin="anonymous"></script>
</head>

<body>
    <div class="main">
        <div class="text">
            <h1>Adicione Algumas Informações</h1>
            <p>Só precisamos que você adicione algumas informações sobre sua foto. É rápido, fácil e sem registro. </p>

            <img src="img/photo2.svg" alt="" width="300">
        </div>

        <form action="" method="POST" enctype="multipart/form-data">
            <div class="input-field">
                <div class="input-area">
                    <h3>Autor:</h3>
                    <input type="text" name="nome" id="nome">
                </div>

                <h3>Foto: </h3>
                <input type="file" name="file[]" id="file" multiple>
                <label for="file"> <i class="fas fa-file-upload"></i> Upload Photo</label>

                <div class="input-subtitle">
                    <h3>Descrição:</h3>

                    <textarea name="desc" id="desc" cols="30" rows="10"></textarea>
                </div>

                <input type="submit" value="Enviar!">


            </div>
        </form>

    </div>

</body>

</html>


<?php
    if (isset($_POST['nome']))
    {
        $nome = $_POST['nome'];
        $descricao = $_POST['desc'];
        $photos = array();

        if(isset($_FILES['file']))
        {
            for ($i=0; $i < count($_FILES['file']['name']); $i++)
            {
                //salvando imgs na pasta
                $nome_file = md5($_FILES['file']['name'][$i].rand(1,999)).'.jpg';
                move_uploaded_file($_FILES['file']['tmp_name'][$i], 'imagens/'.$nome_file);

                //salvando nomes para o banco

                array_push($photos, $nome_file);
            }
        }

        //verificar se há campos vazios

        if(!empty($nome) && !empty($descricao) && !empty($photos))
        {
            require 'classes/photo_class.php';
            $p = new photo_class('crud_img', 'localhost', 'root', '');

            $p->enviarPhoto($nome, $descricao, $photos);
            ?>

            <script>
                window.alert("Fotos Enviadas!")
            </script>
            <?php
        }
        else
        {
             ?>
                <script>
                    window.alert("Prencha os Campos!")
                </script>
             <?php
        }
    }

?>