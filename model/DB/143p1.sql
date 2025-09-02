use 143p1;

CREATE TABLE pais(
    id_pais INT AUTO_INCREMENT PRIMARY KEY,
    pais VARCHAR(100)
);

CREATE TABLE estado (
    id_estado INT AUTO_INCREMENT PRIMARY KEY,
    estado VARCHAR(100)
);

CREATE TABLE cliente (
    id_cliente INT AUTO_INCREMENT PRIMARY KEY,
    cliente_nome VARCHAR(100) NOT NULL,
    user_nome VARCHAR(150) NOT NULL UNIQUE,
    email VARCHAR(150) NOT NULL,
    senha VARCHAR(255) NOT NULL,
    cpf_cnpj varchar(20) NOT NULL UNIQUE,
    data_nasc DATE NOT NULL,
    user_ativo INT NOT NULL DEFAULT 1,
    telefone VARCHAR(9),
    cep VARCHAR(8) NOT NULL,
    cidade VARCHAR(100),
    estado_id_estado INT,
    pais_id_pais INT,
    FOREIGN KEY (estado_id_estado) REFERENCES estado(id_estado),
    FOREIGN KEY (pais_id_pais) REFERENCES pais(id_pais)
);
/* criando clientes na tab clientes */
INSERT INTO cliente (
    cliente_nome,
    email,
    data_nasc,
    telefone,
    senha,
    endereco_idendereco,
    tipo_user_idtipo_user
) VALUES
('ana.silva', 'ana@example.com', '1995-04-12', '999999991', 'ana123', 1, 1),
('bruno.souza', 'bruno@example.com', '1990-08-25', '988888882', 'bruno456', 2, 1),
('carla.moura', 'carla@example.com', '1988-11-30', '977777773', 'carla789', 3, 1),
('daniel.pereira', 'daniel@example.com', '1992-03-15', '966666664', 'daniel000', 4, 1),
('elisa.almeida', 'elisa@example.com', '1998-07-07', '955555555', 'elisa999', 5, 1);

CREATE TABLE adm (
    id_adm INT AUTO_INCREMENT PRIMARY KEY,
    adm_nome VARCHAR(100),
    email VARCHAR(150),
    telefone VARCHAR(9),
    senha VARCHAR(100),
    cnpj VARCHAR(14)
);

CREATE TABLE categoria (
    id_categoria INT AUTO_INCREMENT PRIMARY KEY,
    cat_nome VARCHAR(100)
);

CREATE TABLE subcategoria (
    id_subcategoria INT AUTO_INCREMENT PRIMARY KEY,
    subcat_nome VARCHAR(100),
    id_categoria INT NOT NULL,
    FOREIGN KEY (id_categoria) REFERENCES categoria(id_categoria)
);

CREATE TABLE produto (
    id_produto INT AUTO_INCREMENT PRIMARY KEY,
    prod_nome VARCHAR(100)NOT NULL,
    valor FLOAT(10,2) NOT NULL,
    quant_estoque INT, -- valido para produtos
    path_img VARCHAR(255) NOT NULL,
    descricao TINYTEXT NOT NULL,
    sexo ENUM('F', 'M', 'Não se aplica') NOT NULL,
    peso DECIMAL(10,2) NOT NULL DEFAULT 0.0,
    campeao TINYINT NOT NULL DEFAULT 0,
    id_categoria INT,
    id_subcategoria INT,
    produto_ativo TINYINT NOT NULL DEFAULT 1,
    FOREIGN KEY (id_categoria) REFERENCES categoria(id_categoria),
    FOREIGN KEY (id_subcategoria) REFERENCES subcategoria(id_subcategoria)
);

CREATE TABLE favorito (
    cliente_id_cliente INT PRIMARY KEY,
    produto_id_produto INT,
    FOREIGN KEY (cliente_id_cliente) REFERENCES cliente(id_cliente),
    FOREIGN KEY (produto_id_produto) REFERENCES produto(id_produto)
);

CREATE TABLE pedido (
    id_pedido INT AUTO_INCREMENT PRIMARY KEY,
    cliente_id_cliente INT,
    data_pedido DATE,
    status_pedido ENUM('Pendente','Concluído', 'Cancelado') DEFAULT "Pendente",
    FOREIGN KEY (cliente_id_cliente) REFERENCES cliente(id_cliente)
);

CREATE TABLE item (
    id_item INT PRIMARY KEY,
    pedido_id_pedido INT,
    produto_id_produto INT,
    qtd_produto INT,
    FOREIGN KEY (pedido_id_pedido) REFERENCES pedido(id_pedido),
    FOREIGN KEY (produto_id_produto) REFERENCES produto(id_produto)
);

CREATE TABLE carrinho (
    id_carrinho INT AUTO_INCREMENT PRIMARY KEY,
    produto_id_produto INT NOT NULL,
    qtd_selecionada INT NOT NULL DEFAULT 1,
    selecionado TINYINT(1) DEFAULT 0,
    cliente_id_cliente INT NOT NULL,
    FOREIGN KEY (produto_id_produto) REFERENCES produto(id_produto),
    FOREIGN KEY (cliente_id_cliente) REFERENCES cliente(id_cliente)
);

CREATE TABLE notificacoes(
    id_notificacao INT AUTO_INCREMENT PRIMARY KEY,
    id_cliente INT NOT NULL,
    tipo VARCHAR(100) NOT NULL,
    mensagemtexto TINYTEXT NOT NULL,
    data_recebida DATE NOT NULL,
    lida TINYINT DEFAULT 0,
    FOREIGN KEY (id_cliente) REFERENCES cliente(id_cliente)
);

show tables;
describe adm;
describe carrinho;
describe categoria;
describe cliente;
describe subcategoria;
describe favorito;
describe notificacoes;
describe item;
describe pedido;
describe produto;