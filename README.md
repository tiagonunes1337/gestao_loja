# 📊 Dashboard de Vendas e BI - Assistência Técnica Better Smart

Este projeto integra um banco de dados **MySQL** com o **Power BI** para automatizar o controle financeiro e a análise de lucratividade da assistência técnica. A solução substitui controles manuais, permitindo o monitoramento de faturamento bruto, custos de peças, despesas de frete e o lucro líquido real de cada serviço prestado.

## 🛠️ Tecnologias Utilizadas
* **Banco de Dados:** MySQL 8.0
* **Business Intelligence:** Power BI Desktop
* **Linguagem de Consulta:** SQL

## 🗄️ Estrutura do Banco de Dados
O esquema foi projetado para suportar registros flexíveis, permitindo serviços que envolvam apenas mão de obra ou venda de produtos com custos logísticos associados.

```sql
CREATE DATABASE bettersmart;
USE bettersmart;

CREATE TABLE vendas_loja (
    id INT AUTO_INCREMENT PRIMARY KEY,
    data_venda DATETIME DEFAULT CURRENT_TIMESTAMP,
    cliente VARCHAR(100),
    descricao_servico VARCHAR(255),
    valor_peca_custo DECIMAL(10,2) DEFAULT 0.00,  -- Custo de aquisição (Fornecedor)
    valor_peca_venda DECIMAL(10,2) DEFAULT 0.00,  -- Preço de venda ao cliente
    valor_frete DECIMAL(10,2) DEFAULT 0.00,       -- Custo de logística/entrega
    valor_mao_de_obra DECIMAL(10,2) DEFAULT 0.00, -- Valor do serviço técnico
    valor_total_pago DECIMAL(10,2) NOT NULL       -- Total bruto recebido (Dinheiro no caixa)
);

-- Exemplo de inserção de dados (Venda com peça + serviço + frete)
INSERT INTO vendas_loja (cliente, descricao_servico, valor_peca_custo, valor_peca_venda, valor_mao_de_obra, valor_total_pago)
VALUES ('Gabriel', 'Montagem + Fonte', 42.00, 120.00, 200.00, 320.00);

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

Desenvolvido por Tiago de Aquino Nunes Técnico em Informática | Estudante de Engenharia de Software (UCB)
