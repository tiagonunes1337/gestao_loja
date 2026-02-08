create database bettersmart;
use bettersmart;


CREATE TABLE vendas_loja (
    id INT AUTO_INCREMENT PRIMARY KEY,
    data_venda DATETIME DEFAULT CURRENT_TIMESTAMP,
    cliente VARCHAR(100),
    descricao_servico VARCHAR(255),
    
    -- Campos opcionais (Aceitam NULL e padrão é 0)
    valor_peca_custo DECIMAL(10,2) DEFAULT 0.00,
    valor_peca_venda DECIMAL(10,2) DEFAULT 0.00,
    valor_frete DECIMAL(10,2) DEFAULT 0.00,
    
    valor_mao_de_obra DECIMAL(10,2) DEFAULT 0.00,
    
    valor_total_pago DECIMAL(10,2) NOT NULL
);

select * from vendas_loja;


INSERT INTO vendas_loja (cliente, descricao_servico, valor_peca_custo, valor_peca_venda, valor_mao_de_obra, valor_total_pago)
VALUES ('Gabriel', 'Montagem + Fonte', 42.00 , 25.00, 200.00, 320.00);
