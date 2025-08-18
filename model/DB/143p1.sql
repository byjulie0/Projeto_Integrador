USE 143p1;

-- Tabela: endereco
CREATE TABLE endereco (
    id_endereco INT AUTO_INCREMENT PRIMARY KEY,
    pais VARCHAR(100),
    bairro VARCHAR(100),
    rua VARCHAR(100),
    numero INT,
    cep CHAR(8)
);

-- Tabela: tipo-user
CREATE TABLE tipo_user (
    idtipo_user INT AUTO_INCREMENT PRIMARY KEY,
    cpf CHAR(11),
    cnpj CHAR(14)
);

-- Tabela: cliente
CREATE TABLE cliente (
    id_cliente INT AUTO_INCREMENT PRIMARY KEY,
    cliente_nome VARCHAR(100),
    email VARCHAR(150),
    data_nasc DATE,
    telefone CHAR(9),
    senha VARCHAR(100),
    endereco_idendereco INT,
    tipo_user_idtipo_user INT,
    FOREIGN KEY (endereco_idendereco) REFERENCES endereco(id_endereco),
    FOREIGN KEY (tipo_user_idtipo_user) REFERENCES tipo_user(idtipo_user)
);

-- Tabela: adm
CREATE TABLE adm (
    id_adm INT AUTO_INCREMENT PRIMARY KEY,
    adm_nome VARCHAR(100),
    email VARCHAR(150),
    data_nasc DATE,
    telefone CHAR(9),
    senha VARCHAR(100),
    endereco_idendereco INT,
    tipo_user_idtipo_user INT,
    FOREIGN KEY (endereco_idendereco) REFERENCES endereco(id_endereco),
    FOREIGN KEY (tipo_user_idtipo_user) REFERENCES tipo_user(idtipo_user)
);

-- Tabela: user
CREATE TABLE user (
    id_user INT AUTO_INCREMENT PRIMARY KEY,
    user_nome VARCHAR(150),
    email VARCHAR(150),
    senha VARCHAR(100)
);

-- Tabela: categoria
CREATE TABLE categoria (
    id_categorias INT AUTO_INCREMENT PRIMARY KEY,
    cat_nome VARCHAR(100)
);

-- Tabela: subcategoria
CREATE TABLE subcategoria (
    id_subcategorias INT AUTO_INCREMENT PRIMARY KEY,
    subcat_nome VARCHAR(100)
);

-- Tabela: produto
CREATE TABLE produto (
    id_produto INT AUTO_INCREMENT PRIMARY KEY,
    prod_nome VARCHAR(100),
    valor FLOAT(10,2),
    quant_estoque INT,
    descricao TINYTEXT,
    sexo ENUM('F', 'M'),
    peso DECIMAL(10,2),
    id_categorias INT,
    id_subcategorias INT,
    campeao TINYINT,
    FOREIGN KEY (id_categorias) REFERENCES categoria(id_categorias),
    FOREIGN KEY (id_subcategorias) REFERENCES subcategoria(id_subcategorias)
);

-- Tabela: favorito
CREATE TABLE favorito (
    cliente_id_cliente INT,
    produto_id_produto INT,
    PRIMARY KEY (cliente_id_cliente, produto_id_produto),
    FOREIGN KEY (cliente_id_cliente) REFERENCES cliente(id_cliente),
    FOREIGN KEY (produto_id_produto) REFERENCES produto(id_produto)
);



-- Tabela: pedido
CREATE TABLE pedido (
    id_pedido INT AUTO_INCREMENT PRIMARY KEY,
    data_pedido DATE,
    status ENUM('Pendente', 'Aprovado', 'Enviado', 'Concluído', 'Cancelado'),
    qte INT,
    pagamento ENUM('Cartão', 'Boleto', 'Pix'),
    cliente_id_cliente INT,
    FOREIGN KEY (cliente_id_cliente) REFERENCES cliente(id_cliente)
);

-- Tabela: item
CREATE TABLE item (
    pedido_id_pedido INT,
    produto_id_produto INT,
    preco FLOAT(10,2),
    qtd_total INT,
    PRIMARY KEY (pedido_id_pedido, produto_id_produto),
    FOREIGN KEY (pedido_id_pedido) REFERENCES pedido(id_pedido),
    FOREIGN KEY (produto_id_produto) REFERENCES produto(id_produto)
);

-- Tabela: carrinho
CREATE TABLE carrinho (
    id_item INT AUTO_INCREMENT PRIMARY KEY,
    id_produto INT NOT NULL,
    quantidade INT NOT NULL DEFAULT 1,
    selecionado TINYINT(1) DEFAULT 0,
    id_cliente INT NOT NULL,
    FOREIGN KEY (id_produto) REFERENCES produto(id_produto),
    FOREIGN KEY (id_cliente) REFERENCES cliente(id_cliente)
);

show tables;
