<!DOCTYPE html>
<html>
<head>
    <title>Lendo a API de Stocks</title>
</head>
<body>
    <?php
    $apiUrl = 'http://localhost:5000/api/AAPL';  // Substitua pela URL da sua API, caso não tenha e queira testar o repositório está disponível no meu github elvisbrazil

    // Fazendo a solicitação à API usando cURL
    $ch = curl_init($apiUrl);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $response = curl_exec($ch);
    curl_close($ch);

    // Decodificando a resposta JSON
    $data = json_decode($response, true);

    if ($data === null) {
        echo "Erro ao decodificar JSON.";
    } else {
        echo "<h1>Dados da Ação</h1>";
        echo "<p>Símbolo: " . $data['symbol'] . "</p>";
        echo "<p>Nome: " . $data['name'] . "</p>";
        echo "<p>Setor: " . $data['sector'] . "</p>";
        echo "<p>País: " . $data['country'] . "</p>";
        echo "<p>Preço Atual: " . $data['last_price'] . "</p>";
        echo "<p>Fechamento Anterior: " . $data['previous_close'] . "</p>";
        echo "<h2>Perfil da Ação</h2>";
        echo "<p>" . $data['profile'] . "</p>";

        if (isset($data['quotes'])) {
            echo "<h2>Cotações</h2>";
            echo "<table>";
            echo "<tr><th>Timestamp</th><th>Abertura</th><th>Máxima</th><th>Mínima</th><th>Fechamento</th><th>Volume</th></tr>";
            foreach ($data['quotes'] as $quote) {
                echo "<tr>";
                echo "<td>" . $quote['timestamp'] . "</td>";
                echo "<td>" . $quote['open'] . "</td>";
                echo "<td>" . $quote['high'] . "</td>";
                echo "<td>" . $quote['low'] . "</td>";
                echo "<td>" . $quote['close'] . "</td>";
                echo "<td>" . $quote['volume'] . "</td>";
                echo "</tr>";
            }
            echo "</table>";
        }
    }
    ?>
</body>
</html>
