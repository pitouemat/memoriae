<?php
class photo_class{

    private $pdo;
    public function __construct($dbname, $host, $usuario, $senha)
    {
        try{
            $this->pdo = new PDO("mysql:dbname=".$dbname.";host=".$host, $usuario, $senha);
        }catch (PDOException $e){
            echo 'Erro com o Banco de Dados' .$e->getMessage();
        }catch (Exception $e){
            echo 'Ocorreu algum erro' .$e->getMessage();
        }
    }

    public function enviarPhoto($nome, $descricao, $photos = array())
    {
        //inserindo autor
        $cmd = $this->pdo->prepare('INSERT INTO autor(nome_autor, descricao) values (:n, :d) ');
        $cmd-> bindValue(':n', $nome);
        $cmd-> bindValue(':d', $descricao);
        $cmd-> execute();
        $idAutor =  $this->pdo->lastInsertId();
        //insirindo imagens

        if(count($photos) > 0)
        {
            for ($i=0; $i < count($photos); $i++){
                $nome_photo = $photos[$i];
            }
        $cmd = $this->pdo->prepare('INSERT INTO imagem(nome_imagem, fk_id_autor) values(:n, :fk)' );
        $cmd-> bindValue(':n', $nome_photo);
        $cmd-> bindValue(':fk', $idAutor);
        $cmd-> execute();
        }

       
    }

    public function verPhoto()
    {
        $cmd = $this->pdo->query("SELECT *,(SELECT nome_imagem from imagem where fk_id_autor = autor.id_autor LIMIT 1) as foto_capa  FROM autor ");
    
        if($cmd->rowCount() > 0)
        {
            $dados = $cmd->fetchAll(PDO::FETCH_ASSOC);
        }
        else{
            $dados = array();
        }
        return $dados;
    }

    public function buscarPhoto($id){

    }
}

?>