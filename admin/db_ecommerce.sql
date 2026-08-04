CREATE TABLE Usuarios (
	cd_usuario INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    nm_usuario VARCHAR(100) NOT NULL,
	ds_email VARCHAR(100) NOT NULL UNIQUE,
    ds_senha VARCHAR(255) NOT NULL,
    dt_nascimento DATE,
    fg_sexo CHAR(1) CHECK (fg_sexo IN ('M', 'F')),
    fg_status CHAR(1) CHECK (fg_status IN ('A', 'I'))
);


CREATE TABLE Categorias (
	cd_categoria INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    ds_categoria VARCHAR(100) NOT NULL,
    fg_status CHAR(1) CHECK (fg_status IN ('A', 'I'))
);

CREATE TABLE Subcategorias (
	cd_subcategoria INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    ds_subcategoria VARCHAR(100),
    fg_status CHAR(1) CHECK (fg_status IN ('A', 'I')),
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
    '123', -- Exemplo de hash de senha
    '1995-08-20', 
    'M', 
    'A'
);