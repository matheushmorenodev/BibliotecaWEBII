<?php
include 'config.php';
$result = $conn->query("SELECT * FROM Usuario");
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Usuários</title>
    <style>
        body { font-family: 'Segoe UI', Arial, sans-serif; background: #f6f8fa; margin: 0; }
        .container { max-width: 700px; margin: 50px auto; background: #fff; border-radius: 12px; box-shadow: 0 2px 12px #0001; padding: 32px 40px; }
        h2 { color: #2c3e50; text-align: center; margin-bottom: 28px; }
        table { width: 100%; border-collapse: collapse; margin-bottom: 24px; }
        th, td { border: none; padding: 12px 10px; text-align: left; }
        th { background: #2980b9; color: #fff; font-weight: 600; }
        tr:nth-child(even) { background: #f2f6fa; }
        tr:hover { background: #eaf3fb; }
        td { color: #333; }
        .back-btn { display: inline-block; background: #2980b9; color: #fff; padding: 10px 22px; border-radius: 8px; text-decoration: none; font-weight: 500; transition: background 0.2s; }
        .back-btn:hover { background: #1a5e8a; }
    </style>
</head>
<body>
    <div class="container">
        <h2>Usuários</h2>
        <table>
            <tr><th>ID</th><th>Nome</th><th>Email</th><th>Tipo</th></tr>
            <?php while($row = $result->fetch_assoc()): ?>
            <tr>
                <td><?= $row['id'] ?></td>
                <td><?= htmlspecialchars($row['nome']) ?></td>
                <td><?= htmlspecialchars($row['email']) ?></td>
                <td><?= htmlspecialchars($row['tipo']) ?></td>
            </tr>
            <?php endwhile; ?>
        </table>
        <a class="back-btn" href="index.php">Voltar ao menu</a>
    </div>
</body>
</html>
<?php $conn->close(); ?> 