CREATE TABLE Usuarios (
	cd_usuario INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    nm_usuario VARCHAR(100) NOT NULL,
	ds_email VARCHAR(100) NOT NULL UNIQUE,
    ds_senha VARCHAR(255) NOT NULL,
    dt_nascimento DATE,
    fg_sexo CHAR(1) CHECK (fg_sexo IN ('M', 'F')),
    fg_status CHAR(1) DEFAULT 'A' CHECK (fg_status IN ('A', 'I'))
);

CREATE TABLE Categorias (
	cd_categoria INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    ds_categoria VARCHAR(100) NOT NULL,
    fg_status CHAR(1) DEFAULT 'A' CHECK (fg_status IN ('A', 'I'))
);

CREATE TABLE Subcategorias (
	cd_subcategoria INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    ds_subcategoria VARCHAR(100),
    fg_status CHAR(1) DEFAULT 'A' CHECK (fg_status IN ('A', 'I')),
    cd_categoria INT NOT NULL,
    FOREIGN KEY (cd_categoria)
    REFERENCES categorias(cd_categoria)
);

CREATE TABLE Produtos (
	cd_produto INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    nm_produto VARCHAR(100) NOT NULL,
    vl_produto FLOAT,
    vl_promocao FLOAT,
    dt_validade_promocao DATE,
    ds_produto TEXT,
    ds_ficha_tecnica TEXT,
    fg_status CHAR(1) DEFAULT 'A' CHECK (fg_status IN ('A', 'I')),
    cd_subcategoria INT NOT NULL,
    FOREIGN KEY (cd_subcategoria) REFERENCES subcategorias(cd_subcategoria)
);

CREATE TABLE Produto_imagens (
	cd_imagem INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    nm_imagem VARCHAR(100) NOT NULL,
    fg_destaque CHAR(1) CHECK (fg_destaque IN ('S', 'N')),
    fg_status CHAR(1) DEFAULT 'A' CHECK (fg_status IN ('A', 'I')),
	cd_produto INT NOT NULL,
    FOREIGN KEY (cd_produto) REFERENCES produtos(cd_produto)
);

CREATE TABLE Banners (
	cd_banner INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    nm_banner VARCHAR(100) NOT NULL,
    ds_legenda TEXT,
    dt_validade_banner DATE,
    fg_status CHAR(1) DEFAULT 'A' CHECK (fg_status IN ('A', 'I')),
	cd_produto INT NOT NULL,
    FOREIGN KEY (cd_produto) REFERENCES produtos(cd_produto),
    cd_categoria INT NOT NULL,
    FOREIGN KEY (cd_categoria) REFERENCES categorias(cd_categoria)
);

INSERT INTO Usuarios (
    nm_usuario, 
    ds_email, 
    ds_senha, 
    dt_nascimento, 
    fg_sexo, 
    fg_status
) VALUES (
    'Teste Usuario', 
    'teste.usuario@email.com', 
    '123', 
    '1995-08-20', 
    'M', 
    'A'
);

INSERT INTO Categorias (
    ds_categoria,
    fg_status
) VALUES (
    '',
    'A'
);

INSERT INTO Subcategorias (ds_subcategoria, cd_categoria) VALUES ('Utensílio de limpeza', 1);

INSERT INTO Subcategorias (ds_subcategoria, fg_status, cd_categoria) VALUES
('Produtos Químicos', 'A', 1),
('Ciclismo e Mobilidade', 'A', 2),
('Ferramentas Manuais', 'A', 3),
('Panelas', 'A', 4),
('Notebooks', 'A', 5),
('Periféricos', 'A', 5),
('Computadores', 'A', 5),
('Peças de Carro', 'A', 6);

SELECT ds_categoria, fg_status FROM categorias;

-- Atenção
-- Em casa atualizar Categorias, Subcategorias, Usuarios
ALTER TABLE Categorias 
MODIFY COLUMN fg_status CHAR(1) NOT NULL DEFAULT 'A';


INSERT INTO Produtos (
    nm_produto,
    vl_produto,
    vl_promocao,
    dt_validade_promocao,
    ds_produto,
    ds_ficha_tecnica,
    fg_status,
    cd_subcategoria
) VALUES 
(
    'Teclado Mecânico RGB',
    350.00,
    289.90,
    '2026-10-31',
    'Teclado mecânico com switches azuis e retroiluminação RGB personalizável.',
    'Switch: Outemu Blue; Conexão: USB 2.0; Comprimento do cabo: 1.8m; PBT Double Shot.',
    'A',
    7
),
(
    'Mouse Gamer Sem Fio',
    199.90,
    NULL,
    NULL,
    'Mouse ergonômico sem fio com sensor de alta precisão de até 16000 DPI.',
    'DPI: 100-16000; Bateria: até 70h; Peso: 85g; Conexão: 2.4GHz / Bluetooth.',
    'A',
    7
),
(
    'Monitor 24" IPS 144Hz',
    899.00,
    799.00,
    '2026-11-15',
    'Monitor gamer Full HD com taxa de atualização de 144Hz e tempo de resposta de 1ms.',
    'Resolução: 1920x1080; Painel: IPS; Taxa de Atualização: 144Hz; Conexões: HDMI, DisplayPort.',
    'A',
    14
);