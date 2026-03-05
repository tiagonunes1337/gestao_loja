create database bettersmart;
use bettersmart;


CREATE TABLE `vendas_loja` (
  `id` int(11) NOT NULL AUTO_INCREMENT, -- Adicionado AUTO_INCREMENT para os IDs funcionarem sozinhos
  `data_venda` datetime DEFAULT CURRENT_TIMESTAMP,
  `cliente` varchar(100) DEFAULT NULL,
  `descricao_servico` varchar(255) DEFAULT NULL,
  `valor_peca_custo` decimal(10,2) DEFAULT 0.00,
  `valor_peca_venda` decimal(10,2) DEFAULT 0.00,
  `valor_frete` decimal(10,2) DEFAULT 0.00,
  `valor_mao_de_obra` decimal(10,2) DEFAULT 0.00,
  `valor_total_pago` decimal(10,2) NOT NULL,
  `tecnico` varchar(100) DEFAULT 'Tiago',
  PRIMARY KEY (`id`) -- Definindo o ID como chave primária
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

select * from vendas_loja;


INSERT INTO `vendas_loja` (`id`, `data_venda`, `cliente`, `descricao_servico`, `valor_peca_custo`, `valor_peca_venda`, `valor_frete`, `valor_mao_de_obra`, `valor_total_pago`, `tecnico`) VALUES
(4, '2026-02-09 14:42:01', 'Carlos', 'Teclado', 18.50, 35.00, 0.00, 0.00, 35.00, 'Tiago'),
(5, '2026-02-09 17:57:26', 'Gustavo', 'Fone', 0.00, 80.00, 0.00, 0.00, 80.00, 'Tiago'),
(6, '2026-02-10 18:20:42', '.', 'Fone', 0.00, 20.00, 0.00, 0.00, 20.00, 'Tiago'),
(7, '2026-02-11 14:52:21', 'Maria', 'FONTE DE CARREGADOR - ALL IN ONE', 0.00, 100.00, 0.00, 0.00, 240.00, 'Tiago'),
(8, '2026-02-13 10:57:26', 'Marcelo', 'Tela Notebook Dell', 284.89, 350.00, 0.00, 260.00, 560.00, 'Tiago'),
(11, '2026-02-19 17:33:32', '.', 'Fone', 0.00, 20.00, 0.00, 0.00, 20.00, 'Tiago'),
(12, '2026-02-19 17:35:41', 'Gutemberg', 'COMPUTADOR COMPLETO + MONITOR + MOUSEPAD(CABO DE FORÇA - BRINDE)', 1192.00, 1535.00, 0.00, 0.00, 1535.00, 'Tiago'),
(13, '2026-02-19 17:37:32', 'Gutemberg', 'Adaptador de Wi-Fi', 11.90, 35.00, 0.00, 0.00, 35.00, 'Tiago'),
(14, '2026-02-20 10:20:27', 'Thiago', 'Carregador Tipo C', 0.00, 49.90, 0.00, 0.00, 49.90, 'Tiago'),
(15, '2026-02-20 14:54:48', 'Eduardo', 'SSD + LINUX + BACKUP', 0.00, 0.00, 0.00, 230.00, 230.00, 'Tiago'),
(20, '2026-02-24 17:09:37', 'Jackson', 'LOAD BIOS', 0.00, 18.09, 0.00, 0.00, 50.00, 'Tiago'),
(21, '2026-02-26 15:25:13', 'Gabriel', 'LIMPEZA + ATUALIZAÇÃO BIOS + FORMATAÇÃO + TROCA PASTA TERMICA', 0.00, 0.00, 0.00, 280.00, 630.00, 'Tiago'),
(22, '2026-02-26 15:30:30', '.', 'CARREGADOR', 0.00, 50.00, 0.00, 0.00, 50.00, 'Tiago'),
(23, '2026-02-26 15:31:57', 'Carlos - Predator', 'Troca pasta termica', 0.00, 0.00, 0.00, 200.00, 200.00, 'Tiago'),
(24, '2026-02-02 15:34:50', 'Daniel', 'FORMATAÇÃO + BACKUP + INSTALAÇÃO DE PROGRAMAS', 0.00, 0.00, 0.00, 300.00, 300.00, 'Tiago'),
(25, '2026-02-03 15:35:39', 'Gabriel ', 'MONTAGEM COM PASTA TERMICA + COOLER INTEL + FONTE', 0.00, 0.00, 0.00, 256.00, 320.00, 'Tiago'),
(26, '2026-02-03 15:36:25', 'GABRIEL', 'CABO HDMI + CABO DE FORÇA + CABO RJ45', 0.00, 73.00, 0.00, 0.00, 73.00, 'Tiago'),
(27, '2026-02-05 15:36:54', '.', 'MONTAGEM COM PASTA TERMICA', 0.00, 0.00, 0.00, 180.00, 180.00, 'Tiago'),
(28, '2026-02-04 15:37:15', 'Mariana', 'FORMATAÇÃO + BACKUP', 0.00, 0.00, 0.00, 250.00, 250.00, 'Tiago');
