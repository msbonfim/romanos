<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Conversão de Números Romanos</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
    <div class="container">
        <h1>Conversão de Números Romanos</h1>
        <form method="post">
            <div class="form-group">
                <label for="number">Número:</label>
                <input type="text" id="number" name="number" placeholder="Digite um número arábico ou romano" required>
            </div>
            <div class="form-group">
                <label for="type">Tipo:</label>
                <select id="type" name="type" required>
                    <option value="" disabled selected>Selecione o tipo</option>
                    <option value="arabicToRoman">Árabe para Romano</option>
                    <option value="romanToArabic">Romano para Árabe</option>
                </select>
            </div>
            <button type="submit" class="btn">Converter</button>
        </form>
        
        <?php
        // Inclua a classe RomanConverter
        require_once 'RomanConverter.php';
        $converter = new RomanConverter();

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $number = $_POST['number'];
            $type = $_POST['type'];
            $result = '';

            try {
                if ($type == 'arabicToRoman') {
                    $num = (int)$number;
                    $result = $converter->arabicToRoman($num);
                } elseif ($type == 'romanToArabic') {
                    $result = $converter->romanToArabic($number);
                } else {
                    throw new InvalidArgumentException('Tipo de conversão inválido');
                }
            } catch (InvalidArgumentException $e) {
                $result = 'Erro: ' . $e->getMessage();
            }

            // Mostrar o resultado
            if (!empty($result)) {
                $alert_class = strpos($result, 'Erro') === false ? 'alert-info' : 'alert-error';
                echo "<div class='alert $alert_class'>Resultado: $result</div>";
            }
        }
        ?>
    </div>
</body>
</html>

