# 📊 Dashboard de Vendas e BI - Assistência Técnica Better Smart

Este projeto integra um banco de dados **MySQL** com o **Power BI** para automatizar o controle financeiro e a análise de lucratividade da assistência técnica. A solução substitui controles manuais, permitindo o monitoramento de faturamento bruto, custos de peças, despesas de frete e o lucro líquido real de cada serviço prestado.

## 🛠️ Tecnologias Utilizadas
* **Banco de Dados:** MySQL 8.0
* **Business Intelligence:** Power BI Desktop
* **Site feito em PHP/HTML5/CSS3/JS para visualização de dados**
* **Linguagem de Consulta:** SQL

## 🗄️ Estrutura do Banco de Dados
O esquema foi projetado para suportar registros flexíveis, permitindo serviços que envolvam apenas mão de obra ou venda de produtos com custos logísticos associados.

```sql
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

```

## 📈 Inteligência de Dados & BI
A conexão entre o MySQL e o Power BI possibilita a extração de métricas de desempenho (KPIs) cruciais para a gestão da Better Smart:

Cálculo de Lucro Líquido (DAX): A métrica de lucro é calculada subtraindo-se o custo da peça e o frete do valor total pago.

Fórmula: Lucro = SUM(valor_total_pago) - SUM(valor_peca_custo) - SUM(valor_frete)

Visualização de Serviços: Gráficos que comparam a rentabilidade de diferentes tipos de manutenção (ex: Troca de Tela vs. Montagem de PC).

Atualização em Tempo Real: Integração direta via conector MySQL que reflete novos registros no dashboard instantaneamente.

## 🚀 Como Executar o Projeto
Instalação do Driver: Instale o MySQL Connector/NET (versão 8.0.28 recomendada) para habilitar a comunicação entre as ferramentas.

Setup do Banco: Execute o script SQL fornecido para criar a estrutura e inserir os dados iniciais.

Conexão Power BI: * Vá em Obter Dados > Banco de dados MySQL.

Servidor: 127.0.0.1:3306 | Banco: bettersmart.

Utilize as credenciais de banco de dados (Usuário dev).

Ou instale o site completo e acessa em PHP, tem como você criar um relatorio em PDF semanal das suas vendas e quanto vai ganhar de comissão de 4%.

Desenvolvido por Tiago de Aquino Nunes Técnico em Informática | Estudante de Engenharia de Software (UCB)
