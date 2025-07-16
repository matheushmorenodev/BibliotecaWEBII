-- Projeto Banco de Dados: Biblioteca
-- Integrantes: Pedro Galhardi, Matheus Moreno
-- Banco: MySQL

-- Criação das tabelas
CREATE TABLE Categoria (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100) NOT NULL
);

CREATE TABLE Usuario (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    tipo VARCHAR(20) NOT NULL -- aluno, funcionario, etc
);

CREATE TABLE Autor (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100) NOT NULL
);

CREATE TABLE Livro (
    id INT AUTO_INCREMENT PRIMARY KEY,
    titulo VARCHAR(200) NOT NULL,
    ano INT NOT NULL,
    id_categoria INT,
    FOREIGN KEY (id_categoria) REFERENCES Categoria(id)
);

CREATE TABLE Livro_Autor (
    id_livro INT,
    id_autor INT,
    PRIMARY KEY (id_livro, id_autor),
    FOREIGN KEY (id_livro) REFERENCES Livro(id),
    FOREIGN KEY (id_autor) REFERENCES Autor(id)
);

CREATE TABLE Emprestimo (
    id INT AUTO_INCREMENT PRIMARY KEY,
    id_usuario INT,
    data_emprestimo DATE NOT NULL,
    data_devolucao DATE,
    FOREIGN KEY (id_usuario) REFERENCES Usuario(id)
);

CREATE TABLE Emprestimo_Livro (
    id_emprestimo INT,
    id_livro INT,
    PRIMARY KEY (id_emprestimo, id_livro),
    FOREIGN KEY (id_emprestimo) REFERENCES Emprestimo(id),
    FOREIGN KEY (id_livro) REFERENCES Livro(id)
);

-- Inserção de dados (mínimo 3 tuplas por tabela)
INSERT INTO Categoria (nome) VALUES ('Romance'), ('Tecnologia'), ('História');

INSERT INTO Usuario (nome, email, tipo) VALUES
('Ana Souza', 'ana@email.com', 'aluno'),
('Carlos Lima', 'carlos@email.com', 'funcionario'),
('Beatriz Silva', 'beatriz@email.com', 'aluno');

INSERT INTO Autor (nome) VALUES ('Machado de Assis'), ('J.K. Rowling'), ('George Orwell');

INSERT INTO Livro (titulo, ano, id_categoria) VALUES
('Dom Casmurro', 1899, 1),
('1984', 1949, 3),
('Harry Potter e a Pedra Filosofal', 1997, 1);

INSERT INTO Livro_Autor (id_livro, id_autor) VALUES
(1, 1), -- Dom Casmurro - Machado de Assis
(2, 3), -- 1984 - George Orwell
(3, 2); -- Harry Potter - J.K. Rowling

INSERT INTO Emprestimo (id_usuario, data_emprestimo, data_devolucao) VALUES
(1, '2024-05-01', '2024-05-10'),
(2, '2024-05-03', NULL),
(3, '2024-05-05', NULL);

INSERT INTO Emprestimo_Livro (id_emprestimo, id_livro) VALUES
(1, 1),
(2, 2),
(3, 3);

-- Consultas
-- 1. Consulta com JOIN: Listar todos os empréstimos com nome do usuário e título do livro
SELECT e.id AS emprestimo_id, u.nome AS usuario, l.titulo AS livro, e.data_emprestimo, e.data_devolucao
FROM Emprestimo e
JOIN Usuario u ON e.id_usuario = u.id
JOIN Emprestimo_Livro el ON e.id = el.id_emprestimo
JOIN Livro l ON el.id_livro = l.id;

-- 2. Consulta usando 3 tabelas: Listar livros, seus autores e a categoria
SELECT l.titulo, a.nome AS autor, c.nome AS categoria
FROM Livro l
JOIN Livro_Autor la ON l.id = la.id_livro
JOIN Autor a ON la.id_autor = a.id
JOIN Categoria c ON l.id_categoria = c.id;

-- 3. Listar todos os usuários que não devolveram livros ainda
SELECT u.nome, l.titulo, e.data_emprestimo
FROM Usuario u
JOIN Emprestimo e ON u.id = e.id_usuario
JOIN Emprestimo_Livro el ON e.id = el.id_emprestimo
JOIN Livro l ON el.id_livro = l.id
WHERE e.data_devolucao IS NULL;

-- 4. Contar quantos livros cada usuário já pegou emprestado
SELECT u.nome, COUNT(el.id_livro) AS total_livros
FROM Usuario u
JOIN Emprestimo e ON u.id = e.id_usuario
JOIN Emprestimo_Livro el ON e.id = el.id_emprestimo
GROUP BY u.nome;

-- Exemplo de VIEW: Visualizar empréstimos em aberto
CREATE VIEW Emprestimos_Abertos AS
SELECT e.id AS emprestimo_id, u.nome AS usuario, l.titulo, e.data_emprestimo
FROM Emprestimo e
JOIN Usuario u ON e.id_usuario = u.id
JOIN Emprestimo_Livro el ON e.id = el.id_emprestimo
JOIN Livro l ON el.id_livro = l.id
WHERE e.data_devolucao IS NULL; 