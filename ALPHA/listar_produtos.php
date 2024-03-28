<?php
session_start();

require_once('conexao.php');
if(!isset($_SESSION['admin_logado'])){
    header("Location:login.php");
    exit();
}

try{
    $stmt = $pdo->prepare("SELECT * FROM PRODUTOS");
    $stmt->execute();
    $produtos = $stmt->fetchAll(PDO::FETCH_ASSOC);
}catch(PDOException $e){
    echo "Erro: " . $e->getMessage();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        table{
            width: 100%;
            border-collapse: collapse;
        }
        th,td{
            padding:8px;
            text-align:left;
            border-bottom: 1px solid #ddd;
        }
        th{
            background-color:#f2f2f2;
        }
        tr:hover{
            background-color:#f5f5f5;
        }
    </style>
</head>
<body>
    <h2>Lista de Produtos</h2>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Nome</th>
                <th>Descrição</th>
                <th>Preço</th>
                <th>Imagem</th>
                <th>Ações</th>
            </tr>
        </thead>
        <?php foreach($produtos as $produto): ?>
            <tr>
                <td><?php echo $produto['ID'];?></td>
                <td><?php echo $produto['Nome'];?></td>
                <td><?php echo $produto['Descricao'];?></td>
                <td><?php echo $produto['Preco'];?></td>
                <td><img src="<?php echo $produto['url_imagem'];?>" alt="Imagem do Produto" width="50"></td>
                <td>
                    <a href="editar_produto.php?id=<?php echo $produto['ID'];?>">Editar</a>
                    <a href="excluir_produto.php?id=<?php echo $produto['ID'];?>">Excluir</a>
                </td>
            </tr>
            <?php endforeach;?>
    </table>

    <a href="painel_admin.php">Voltar ao Painel do Administrador</a>
</body>
</html>

</html>