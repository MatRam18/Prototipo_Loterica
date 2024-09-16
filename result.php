<?php
session_start();

// Verificar se as variáveis de sessão estão definidas
if (!isset($_SESSION['name']) || !isset($_SESSION['amount']) || !isset($_SESSION['selected_numbers'])) {
    header('Location: index.php');
    exit();
}

// Lógica do joguinho da hora
$selectedNumbers = array_map('intval', $_SESSION['selected_numbers']);
$winningNumbers = array_rand(range(1, 50), 25);
$winningNumbers = array_map(function ($num) { return $num + 1; }, $winningNumbers);

$correct = array_intersect($selectedNumbers, $winningNumbers);
$prize = 0;

if (count($correct) === 25 || count($correct) === 0) {
    $prize = $_SESSION['amount'] * 50;
}

// Preparar dados para a exibissao do balacubaco
$name = isset($_SESSION['name']) ? htmlspecialchars($_SESSION['name']) : 'Usuário';
$winningNumbersDisplay = implode(', ', $winningNumbers);

// limpa tudo
unset($_SESSION['name']);
unset($_SESSION['amount']);
unset($_SESSION['selected_numbers']);
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Resultado do Jogo</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h1>Resultado do Jogo</h1>
        <p>Olá, <strong><?php echo $name; ?></strong>!</p>
        <p><strong>Números sorteados:</strong> <?php echo $winningNumbersDisplay; ?></p>
        <?php if ($prize > 0): ?>
            <div class="result success">
                <p>Parabéns! Você ganhou <strong>R$<?php echo $prize; ?></strong>!</p>
            </div>
        <?php else: ?>
            <div class="result failure">
                <p>Infelizmente, você não ganhou. Tente novamente!</p>
            </div>
        <?php endif; ?>
        <div id="retry">
            <p>Deseja jogar novamente?</p>
            <button id="play-again">Sim</button>
            <button id="quit">Não</button>
        </div>
    </div>

    <script>
        document.getElementById('play-again').addEventListener('click', () => {
            window.location.href = 'index.php';
        });
        document.getElementById('quit').addEventListener('click', () => {
            window.location.href = 'index.php';
        });

        setTimeout(() => {
            window.location.href = 'index.php';
        }, 10000); // Redireciona após 10 segundinhos
    </script>
</body>
</html>
