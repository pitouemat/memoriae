<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Photo</title>
    <link rel="stylesheet" href="css/photo.css">
</head>
<body>
    <section>
        <?php
        require 'classes/photo_class.php';
        $p = new photo_class('crud_img', 'localhost', 'root', '');
        $dadosPhoto = $p->verPhoto();

        if(empty($dadosPhoto))
        {
            echo 'Ainda não há imagens';
        }
        else{

            foreach($dadosPhoto as $value){
            ?>
         <a href="exibirPhoto.php">
            <div>
                <img src="imagens/<?php echo$value['foto_capa']?>" alt="">
                <h2><?php echo $value['nome_autor']?></h2>
                <p><?php echo $value['descricao']  ?></p>
            </div>
        </a>
            <?php
            }
        }
        ?>
       
    </section>
</body>
</html>