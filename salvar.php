<?php
include 'db.php';

// --- LOGICA PARA EXCLUIR ---
if (isset($_GET['excluir'])) {
    $id = $_GET['excluir'];
    $conn->query("DELETE FROM vendas_loja WHERE id = $id");
    header("Location: index.php");
}

// --- LOGICA PARA INSERIR OU EDITAR ---
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $cliente = $_POST['cliente'];
    $tecnico = $_POST['tecnico'];
    $servico = $_POST['servico'];
    $custo   = $_POST['custo'] ?: 0;
    $venda   = $_POST['venda'] ?: 0;
    $m_obra  = $_POST['mao_de_obra'] ?: 0;
    $total   = $_POST['total'];

    if (isset($_POST['id'])) {
        // UPDATE (Editar)
        $id = $_POST['id'];
        $sql = "UPDATE vendas_loja SET 
                cliente='$cliente', tecnico='$tecnico', descricao_servico='$servico', 
                valor_peca_custo='$custo', valor_peca_venda='$venda', 
                valor_mao_de_obra='$m_obra', valor_total_pago='$total' 
                WHERE id=$id";
    } else {
        // INSERT (Novo)
        $sql = "INSERT INTO vendas_loja (cliente, tecnico, descricao_servico, valor_peca_custo, valor_peca_venda, valor_mao_de_obra, valor_total_pago) 
                VALUES ('$cliente', '$tecnico', '$servico', '$custo', '$venda', '$m_obra', '$total')";
    }

    if ($conn->query($sql) === TRUE) {
        header("Location: index.php");
    } else {
        echo "Erro: " . $conn->error;
    }
}
?>