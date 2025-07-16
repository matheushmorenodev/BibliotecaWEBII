<?php
include 'config.php';

// 1. Consulta com JOIN: Listar todos os empréstimos com nome do usuário e título do livro
$q1 = $conn->query("SELECT e.id AS emprestimo_id, u.nome AS usuario, l.titulo AS livro, e.data_emprestimo, e.data_devolucao FROM Emprestimo e JOIN Usuario u ON e.id_usuario = u.id JOIN Emprestimo_Livro el ON e.id = el.id_emprestimo JOIN Livro l ON el.id_livro = l.id");
// 2. Consulta usando 3 tabelas: Listar livros, seus autores e a categoria
$q2 = $conn->query("SELECT l.titulo, a.nome AS autor, c.nome AS categoria FROM Livro l JOIN Livro_Autor la ON l.id = la.id_livro JOIN Autor a ON la.id_autor = a.id JOIN Categoria c ON l.id_categoria = c.id");
// 3. Listar todos os usuários que não devolveram livros ainda
$q3 = $conn->query("SELECT u.nome, l.titulo, e.data_emprestimo FROM Usuario u JOIN Emprestimo e ON u.id = e.id_usuario JOIN Emprestimo_Livro el ON e.id = el.id_emprestimo JOIN Livro l ON el.id_livro = l.id WHERE e.data_devolucao IS NULL");
// 4. Contar quantos livros cada usuário já pegou emprestado
$q4 = $conn->query("SELECT u.nome, COUNT(el.id_livro) AS total_livros FROM Usuario u JOIN Emprestimo e ON u.id = e.id_usuario JOIN Emprestimo_Livro el ON e.id = el.id_emprestimo GROUP BY u.nome");
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Consultas Especiais</title>
    <style>
        body { font-family: 'Segoe UI', Arial, sans-serif; background: #f6f8fa; margin: 0; }
        .container { max-width: 900px; margin: 50px auto; background: #fff; border-radius: 12px; box-shadow: 0 2px 12px #0001; padding: 32px 40px; }
        h1 { color: #2c3e50; text-align: center; margin-bottom: 32px; }
        h2 { color: #2980b9; margin-top: 36px; margin-bottom: 12px; }
        table { width: 100%; border-collapse: collapse; margin-bottom: 24px; }
        th, td { border: none; padding: 12px 10px; text-align: left; }
        th { background: #2980b9; color: #fff; font-weight: 600; }
        tr:nth-child(even) { background: #f2f6fa; }
        tr:hover { background: #eaf3fb; }
        td { color: #333; }
        .back-btn { display: inline-block; background: #2980b9; color: #fff; padding: 10px 22px; border-radius: 8px; text-decoration: none; font-weight: 500; transition: background 0.2s; margin-top: 18px; }
        .back-btn:hover { background: #1a5e8a; }
    </style>
</head>
<body>
    <div class="container">
        <h1>Consultas Especiais</h1>
        <h2>1. Empréstimos com nome do usuário e título do livro</h2>
        <table>
            <tr><th>ID</th><th>Usuário</th><th>Livro</th><th>Data Empréstimo</th><th>Data Devolução</th></tr>
            <?php while($row = $q1->fetch_assoc()): ?>
            <tr>
                <td><?= $row['emprestimo_id'] ?></td>
                <td><?= htmlspecialchars($row['usuario']) ?></td>
                <td><?= htmlspecialchars($row['livro']) ?></td>
                <td><?= $row['data_emprestimo'] ?></td>
                <td><?= $row['data_devolucao'] ?></td>
            </tr>
            <?php endwhile; ?>
        </table>
        <h2>2. Livros, seus autores e a categoria</h2>
        <table>
            <tr><th>Título</th><th>Autor</th><th>Categoria</th></tr>
            <?php while($row = $q2->fetch_assoc()): ?>
            <tr>
                <td><?= htmlspecialchars($row['titulo']) ?></td>
                <td><?= htmlspecialchars($row['autor']) ?></td>
                <td><?= htmlspecialchars($row['categoria']) ?></td>
            </tr>
            <?php endwhile; ?>
        </table>
        <h2>3. Usuários que não devolveram livros ainda</h2>
        <table>
            <tr><th>Usuário</th><th>Livro</th><th>Data Empréstimo</th></tr>
            <?php while($row = $q3->fetch_assoc()): ?>
            <tr>
                <td><?= htmlspecialchars($row['nome']) ?></td>
                <td><?= htmlspecialchars($row['titulo']) ?></td>
                <td><?= $row['data_emprestimo'] ?></td>
            </tr>
            <?php endwhile; ?>
        </table>
        <h2>4. Quantidade de livros emprestados por usuário</h2>
        <table>
            <tr><th>Usuário</th><th>Total de Livros</th></tr>
            <?php while($row = $q4->fetch_assoc()): ?>
            <tr>
                <td><?= htmlspecialchars($row['nome']) ?></td>
                <td><?= $row['total_livros'] ?></td>
            </tr>
            <?php endwhile; ?>
        </table>
        <a class="back-btn" href="index.php">Voltar ao menu</a>
    </div>
</body>
</html>
<?php $conn->close(); ?> 