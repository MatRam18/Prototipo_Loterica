<?php
session_start();

// Verificar se o formulário foi enviado 
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Verificar se o nome, valor da aposta e números foram inseridos
    if (!isset($_POST['name']) || !isset($_POST['amount']) || !isset($_POST['numbers'])) {
        echo '<p style="color: red;">Por favor, preencha todos os campos corretamente.</p>';
    } else {
        $_SESSION['name'] = $_POST['name'];
        $_SESSION['amount'] = $_POST['amount'];
        $_SESSION['selected_numbers'] = isset($_POST['numbers']) ? $_POST['numbers'] : [];

        // manda para a pag de resultado
        header('Location: result.php');
        exit();
    }
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LotoGru</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h1>LotoGru</h1>
        <form action="index.php" method="post" id="game-form">
            <label for="name">Seu Nome:</label>
            <input type="text" id="name" name="name" required>
            
            <label for="amount">Valor da Aposta (R$):</label>
            <input type="number" id="amount" name="amount" min="1" required>
            <p><small>(É obrigatório selecionar exatamente 25 números para a aposta.)</small></p>

            <div id="numbers-container">
                <?php for ($i = 1; $i <= 50; $i++): ?>
                    <button type="button" class="number" data-number="<?php echo $i; ?>"><?php echo $i; ?></button>
                <?php endfor; ?>
            </div>
            
            <input type="hidden" name="numbers[]" id="selected-numbers">
            <button type="submit">Confirmar Aposta</button>
        </form>
    </div>

    <script src="main.js"></script>
</body>
</html>
