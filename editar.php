<?php 
include 'db.php'; 
$id = $_GET['id'];
$res = $conn->query("SELECT * FROM vendas_loja WHERE id = $id");
$venda = $res->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>BetterSmart - Editar Venda</title>
    <style>
        body { font-family: sans-serif; padding: 40px; background: #f4f4f4; }
        .box { background: white; padding: 20px; border-radius: 8px; max-width: 500px; margin: auto; }
        input { display: block; width: 95%; margin-bottom: 10px; padding: 8px; }
        button { background: #28a745; color: white; border: none; padding: 10px; cursor: pointer; width: 100%; }
    </style>
</head>
<body>
    <div class="box">
        <h2>Editar Registro #<?php echo $id; ?></h2>
        <form action="salvar.php" method="POST">
            <input type="hidden" name="id" value="<?php echo $venda['id']; ?>">
            <input type="text" name="cliente" value="<?php echo $venda['cliente']; ?>" required>
            <input type="text" name="tecnico" value="<?php echo $venda['tecnico']; ?>">
            <input type="text" name="servico" value="<?php echo $venda['descricao_servico']; ?>">
            <input type="number" step="0.01" name="custo" value="<?php echo $venda['valor_peca_custo']; ?>">
            <input type="number" step="0.01" name="venda" value="<?php echo $venda['valor_peca_venda']; ?>">
            <input type="number" step="0.01" name="mao_de_obra" value="<?php echo $venda['valor_mao_de_obra']; ?>">
            <input type="number" step="0.01" name="total" value="<?php echo $venda['valor_total_pago']; ?>" required>
            <button type="submit" name="editar">Salvar Alterações</button>
            <br><br>
            <a href="index.php">Voltar sem salvar</a>
        </form>
    </div>
</body>
</html>