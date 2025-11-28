CREATE DATABASE IF NOT EXISTS onepiece CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE onepiece;

CREATE TABLE IF NOT EXISTS racas (
  id   INT AUTO_INCREMENT PRIMARY KEY,
  nome VARCHAR(100) NOT NULL,
  UNIQUE KEY (nome)
);

CREATE TABLE IF NOT EXISTS afiliacoes (
  id   INT AUTO_INCREMENT PRIMARY KEY,
  nome VARCHAR(100) NOT NULL,
  UNIQUE KEY (nome)
);

CREATE TABLE IF NOT EXISTS personagens (
  id             INT AUTO_INCREMENT PRIMARY KEY,
  nome           VARCHAR(120) NOT NULL,
  idade          INT NOT NULL,
  akuma_no_mi    VARCHAR(120) NULL,
  raca_id        INT NOT NULL,
  afiliacao_id   INT NOT NULL,
  recompensa     DECIMAL(12,2) NOT NULL DEFAULT 0.00,
  descricao      TEXT NULL,
  image_url      VARCHAR(255) NULL,
  criado_em      TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  atualizado_em  TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  CONSTRAINT fk_personagem_raca FOREIGN KEY (raca_id) REFERENCES racas(id) ON DELETE RESTRICT ON UPDATE CASCADE,
  CONSTRAINT fk_personagem_afiliacao FOREIGN KEY (afiliacao_id) REFERENCES afiliacoes(id) ON DELETE RESTRICT ON UPDATE CASCADE
);

INSERT INTO racas (nome) VALUES
  ('Humano'),
  ('Skypian'),
  ('Lunarian'),
  ('Mink'),
  ('Fishman'),
  ('Giant'),
  ('Tontatta'),
  ('Animal'),
  ('Outros')
ON DUPLICATE KEY UPDATE nome = VALUES(nome);


INSERT INTO afiliacoes (nome) VALUES
  ('Marinha'), ('Pirata'), ('Revolucionário'), ('Jornalista'), ('Nenhuma'), ('Shichibukai (extinto)'), ('Yonkou')
ON DUPLICATE KEY UPDATE nome = VALUES(nome);
