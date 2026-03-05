<?php 
include 'db.php'; 

// 1. Filtros de Data (Padrão: mês atual)
$data_inicio = $_GET['desde'] ?? date('Y-m-01');
$data_fimm   = $_GET['ate']   ?? date('Y-m-d');

// 2. Busca filtrada e agrupada por semana
$sql = "SELECT *, 
        WEEK(data_venda) as semana, 
        (valor_peca_venda - valor_peca_custo + valor_mao_de_obra) as lucro 
        FROM vendas_loja 
        WHERE DATE(data_venda) BETWEEN '$data_inicio' AND '$data_fimm'
        ORDER BY data_venda DESC";

$res = $conn->query($sql);
$vendas_por_semana = [];

while($row = $res->fetch_assoc()) {
    $vendas_por_semana[$row['semana']][] = $row;
}

// 3. Lucro Total Acumulado para o Dashboard
$res_geral = $conn->query("SELECT SUM(valor_peca_venda - valor_peca_custo + valor_mao_de_obra) as lucro_total FROM vendas_loja");
$dados_geral = $res_geral->fetch_assoc();

// 4. Lógica de Motivação (Comissão 4%)
$lucro_total = $dados_geral['lucro_total'] ?? 0;
$comissao_tiago = $lucro_total * 0.04;
$meta_objetivo = 1700.00; // Sua meta de comissão
$progresso = ($comissao_tiago / $meta_objetivo) * 100;
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>BetterSmart - Gestão Completa</title>
    <style>
        body { font-family: 'Segoe UI', sans-serif; background: #172841; padding: 20px; color: #333; }
        .no-print { margin-bottom: 20px; }
        .card { background: white; padding: 20px; border-radius: 8px; box-shadow: 0 2px 4px rgba(0,0,0,0.1); margin-bottom: 20px; }
        .flex-form { display: flex; flex-wrap: wrap; gap: 10px; }
        input, button { padding: 10px; border: 1px solid #016bf5; border-radius: 4px; }
        
        .btn-save { background: #28a745; color: white; border: none; cursor: pointer; }
        .btn-filter { background: #007bff; color: white; border: none; cursor: pointer; }
        .btn-pdf { background: #dc3545; color: white; border: none; cursor: pointer; }
        
        .semana-container { background: white; margin-bottom: 30px; border-radius: 8px; box-shadow: 0 2px 5px rgba(0,0,0,0.1); overflow: hidden; }
        .semana-header { background: #007bff; color: white; padding: 10px 20px; font-weight: bold; }
        
        table { width: 100%; border-collapse: collapse; }
        th, td { padding: 12px; text-align: left; border-bottom: 1px solid #eee; }
        th { background: #f8f9fa; }
        .lucro-pos { color: green; font-weight: bold; }
        
        .badge-tecnico { background: #e9ecef; padding: 4px 8px; border-radius: 4px; font-weight: bold; }
        .acoes a { text-decoration: none; font-size: 14px; margin-right: 10px; }

        .progress-container { background: #e9ecef; border-radius: 10px; height: 20px; width: 100%; margin-top: 10px; overflow: hidden; }
        .progress-bar { background: #00ffdd; height: 100%; transition: width 0.5s; }

        @media print {
            .no-print, .btn-acoes { display: none !important; }
            body { background: white; padding: 0; }
            .semana-container { box-shadow: none; border: 1px solid #ddd; page-break-inside: avoid; }
        }
        
        .textoh1 {
            color: #00ffdd; text-align: center; font-size: 40px; font-family: Arial, sans-serif; text-shadow: 2px 2px 4px rgba(0,0,0,0.5);
        }

        #dica-preco {
            margin-top: 15px; color: #172841; font-weight: bold; background: #00ffdd; padding: 10px; border-radius: 5px; display: none; line-height: 1.5;
        }
    </style>
</head>
<body>

    <h1 class="textoh1">🚀 BetterSmart System</h1>

    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px;">
        <div class="card" style="background: #28a745; color: white; margin-bottom: 0;">
            <strong>Lucro Total (Loja):</strong> <br>
            <span style="font-size: 28px;">R$ <?php echo number_format($lucro_total, 2, ',', '.'); ?></span>
        </div>

        <div class="card" style="background: #007bff; color: white; margin-bottom: 0;">
            <strong>Minha Comissão (4%):</strong> <br>
            <span style="font-size: 28px;">R$ <?php echo number_format($comissao_tiago, 2, ',', '.'); ?></span>
            <div class="progress-container">
                <div class="progress-bar" style="width: <?php echo min($progresso, 100); ?>%"></div>
            </div>
            <small>Meta de Comissão: R$ 1.700,00</small>
        </div>
    </div>

    <br>

    <div class="card no-print">
        <h3>Cadastrar Novo Serviço / Venda</h3>
        <form action="salvar.php" method="POST" class="flex-form" id="formVenda">
            <input type="text" name="cliente" placeholder="Nome do Cliente" required>
            <input type="text" name="tecnico" value="Tiago" placeholder="Técnico">
            <input type="text" name="servico" placeholder="Descrição do Serviço">
            
            <input type="number" step="0.01" name="custo" id="custo" placeholder="Custo da Peça (R$)" oninput="executarCalculos()">
            <input type="number" step="0.01" name="mao_de_obra" id="mao_de_obra" placeholder="Valor do Serviço (R$)" oninput="executarCalculos()">
            <input type="number" step="0.01" name="venda" id="venda_peca" placeholder="Venda da Peça (R$)" oninput="executarCalculos()">
            
            <input type="number" step="0.01" name="total" id="total_pago" placeholder="TOTAL PAGO (Final)" required>
            
            <button type="submit" class="btn-save">Gravar Venda</button>
        </form>
        <div id="dica-preco"></div>
    </div>

    <div class="card no-print" style="background: #343a40; color: white;">
        <form method="GET" class="flex-form">
            <strong>Relatório de:</strong>
            <input type="date" name="desde" value="<?php echo $data_inicio; ?>">
            <input type="date" name="ate" value="<?php echo $data_fimm; ?>">
            <button type="submit" class="btn-filter">Filtrar</button>
            <button type="button" onclick="window.print();" class="btn-pdf">Gerar PDF</button>
        </form>
    </div>

    <?php foreach ($vendas_por_semana as $semana => $vendas): ?>
        <div class="semana-container">
            <div class="semana-header">Semana nº <?php echo $semana; ?></div>
            <table>
                <thead>
                    <tr>
                        <th>Data</th>
                        <th>Cliente</th>
                        <th>Serviço / Venda</th>
                        <th>Total Pago</th>
                        <th>Lucro</th>
                        <th>%</th> 
                        <th class="no-print">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    $total_semana = 0;
                    foreach ($vendas as $v): 
                        $total_semana += $v['lucro'];
                        $p_lucro = ($v['valor_total_pago'] > 0) ? ($v['lucro'] / $v['valor_total_pago']) * 100 : 0;
                        $cor_p = "#ff8800";
                        if($p_lucro >= 50) $cor_p = "#28a745";
                        elseif($p_lucro >= 20) $cor_p = "#007bff";
                    ?>
                    <tr>
                        <td><?php echo date('d/m/Y', strtotime($v['data_venda'])); ?></td>
                        <td><?php echo $v['cliente']; ?></td>
                        <td><?php echo $v['descricao_servico']; ?></td>
                        <td>R$ <?php echo number_format($v['valor_total_pago'], 2, ',', '.'); ?></td>
                        <td class="lucro-pos">R$ <?php echo number_format($v['lucro'], 2, ',', '.'); ?></td>
                        <td style="color: <?php echo $cor_p; ?>; font-weight: bold;"><?php echo number_format($p_lucro, 1, ',', '.'); ?>%</td>
                        <td class="no-print acoes">
                            <a href="editar.php?id=<?php echo $v['id']; ?>">✏️</a>
                            <a href="salvar.php?excluir=<?php echo $v['id']; ?>" onclick="return confirm('Apagar?')">🗑️</a>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
                <tfoot>
                    <tr style="background: #f8fff8;">
                        <td colspan="4" style="text-align:right; font-weight:bold;">Lucro da Semana:</td>
                        <td class="lucro-pos" colspan="3">R$ <?php echo number_format($total_semana, 2, ',', '.'); ?></td>
                    </tr>
                </tfoot>
            </table>
        </div>
    <?php endforeach; ?>

    <script>
    function executarCalculos() {
        // Pega os valores dos inputs
        const custo = parseFloat(document.getElementById('custo').value) || 0;
        const servico = parseFloat(document.getElementById('mao_de_obra').value) || 0;
        const vendaPeca = parseFloat(document.getElementById('venda_peca').value) || 0;
        const campoTotal = document.getElementById('total_pago');
        const dica = document.getElementById('dica-preco');

        // 1. Soma automática para o Total Pago (Venda + Serviço)
        const totalCalculado = servico + vendaPeca;
        campoTotal.value = totalCalculado.toFixed(2);

        // 2. Cálculo de Margem 60% (Águas Claras)
        if (custo > 0) {
            let precoSugerido = custo / 0.4; // Garante 60% de margem sobre a peça
            let lucroSugerido = precoSugerido - custo;
            let comissaoPrevista = (totalCalculado - custo) * 0.04;

            dica.style.display = "block";
            dica.innerHTML = `💡 <strong>Sugestão Águas Claras (Margem 60% na peça):</strong> R$ ${precoSugerido.toFixed(2)} + R$ ${servico.toFixed(2)} de serviço.<br>` +
                             `💰 <strong>Sua Comissão (4%) se fechar agora:</strong> R$ ${comissaoPrevista.toFixed(2)}`;
        } else if (servico > 0) {
            dica.style.display = "block";
            dica.innerHTML = `🚀 <strong>Serviço Puro:</strong> 100% de lucro! Sua comissão: R$ ${(servico * 0.04).toFixed(2)}`;
        } else {
            dica.style.display = "none";
        }
    }
    </script>
</body>
</html>