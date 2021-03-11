-- -----------------------------------------------------
CREATE TABLE CATEGORIA (
  cat_codigo INT NOT NULL AUTO_INCREMENT,
  cat_descricao VARCHAR(50) NOT NULL,
  cat_ativa CHAR(1) NOT NULL,
  PRIMARY KEY (cat_codigo))

-- -----------------------------------------------------
CREATE TABLE TEMA (
  tem_codigo INT NOT NULL AUTO_INCREMENT,
  cat_codigo INT NOT NULL,
  tem_descricao VARCHAR(300) NOT NULL,
  tem_criacao DATETIME NOT NULL,
  usu_cpf CHAR(11) NOT NULL,
  tem_ativo CHAR(1) NOT NULL,
  PRIMARY KEY (tem_codigo),
  INDEX fk_cat_codigo_idx (cat_codigo ASC),
  CONSTRAINT fk_cat_codigo
    FOREIGN KEY (cat_codigo)
    REFERENCES CATEGORIA (cat_codigo)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)

-- -----------------------------------------------------
CREATE TABLE USUARIO (
  usu_cpf CHAR(11) NOT NULL,
  usu_email VARCHAR(80) NOT NULL,
  usu_senha VARCHAR(20) NOT NULL,
  usu_administrador CHAR(1) NOT NULL,
  usu_ativo CHAR(1) NOT NULL,
  PRIMARY KEY (usu_cpf),
  UNIQUE INDEX usu_email_UNIQUE (usu_email ASC))

-- -----------------------------------------------------
CREATE TABLE COMENTARIO (
  tem_codigo INT NOT NULL,
  com_codigo INT NOT NULL AUTO_INCREMENT,
  com_datahora DATETIME NOT NULL,
  com_comentario VARCHAR(2000) NOT NULL,
  usu_cpf CHAR(11) NOT NULL,
  com_ativo CHAR(1) NOT NULL,
  INDEX fk_tem_codigo_idx (tem_codigo ASC),
  INDEX fk_usu_cpf_idx (usu_cpf ASC),
  PRIMARY KEY (com_codigo, tem_codigo),
  CONSTRAINT fk_tem_codigo
    FOREIGN KEY (tem_codigo)
    REFERENCES TEMA (tem_codigo)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT fk_usu_cpf
    FOREIGN KEY (usu_cpf)
    REFERENCES USUARIO (usu_cpf)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)

-- -----------------------------------------------------
