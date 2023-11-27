<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['accept_cookies'])) {
        $nome = "cookie";
        $valor = "Vinicius";
        $tempo = time() + 300; // 5 minutos
        setcookie($nome, $valor, $tempo);
    }

    if (isset($_POST['reject_cookies'])) {
        echo "Cookie rejeitado";
    }
}

// Move o código PHP para o início
if (isset($_COOKIE["cookie"])) {
    $nome_usuario = $_COOKIE["cookie"];
    echo "Bem-vindo, $nome_usuario!";
} else {
    echo "Cookie não encontrado.";
}

if (isset($_COOKIE['cookie_consent'])) {
    $cookieStatus = $_COOKIE['cookie_consent'];
} else {
    $cookieStatus = 'undefined';
}

// Emite variáveis JavaScript
echo '<script>';
echo 'var preferredLanguage = "' . getPreferredLanguage() . '";';
echo 'var preferredColor = "' . getPreferredColor() . '";';
echo '</script>';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <title>Cookies</title>
</head>

<body>
    <?php
    if ($cookieStatus === 'undefined') {
    ?>
        <div class="container text-center">
            <div class="row">
                <div class="col">
                    --
                </div>
                <div class="col-6">
                    Trabalhando com Cookies!
                </div>
                <div class="col">
                    --
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <form method="post">
                        <button type="submit" name="accept_cookies">Aceitar Cookies</button>
                    </form>
                </div>
                <div class="col-5">
                    <a class="link" href="politica.php">É importante que o site tenha políticas de acordo com o Regulamento Geral de Proteção de Dados (GDPR).</a>
                </div>
                <div class="col">
                    <form method="post">
                        <button type="submit" name="reject_cookies">Rejeitar Cookies</button>
                    </form>
                </div>
            </div>
            <script>
                // Remove a chamada para location.reload()

                // Aplica a preferência de idioma ao carregar a página
                setLanguagePreference(preferredLanguage);

                // Aplica a preferência de cor ao carregar a página
                applyColorPreference(preferredColor);
            </script>
        </div>
    <?php
    } else {
    ?>
        <div class="row">
            <div class="col">
                funções:
            </div>
            <div class="col-6">
                Trocar a linguagem

                <label for="languageSelect">Escolha o Idioma:</label>
                <select id="languageSelect" onchange="changeLanguage()">
                    <option value="en">Inglês</option>
                    <option value="pt">Português</option>
                    <!-- Adicione mais opções conforme necessário -->
                </select>

                <script>
                    function changeLanguage() {
                        var selectedLanguage = document.getElementById("languageSelect").value;
                        setLanguagePreference(preferredLanguage);
                        location.reload(); // Recarrega a página para aplicar a mudança imediatamente
                    }

                    function setLanguagePreference(language) {
                        document.cookie = "language=" + language + "; path=/";
                    }
                    <?php
                    function getPreferredLanguage()
                    {
                        if (isset($_COOKIE['language'])) {
                            return $_COOKIE['language'];
                        } else {
                            return 'en';
                        }
                    }

                    $preferredLanguage = getPreferredLanguage();
                    echo "Idioma Preferido: $preferredLanguage";
                    ?>
                </script>
            </div>

            <div class="col">
                <label for="colorSelect">Trocar a Cor:</label>
                <select id="colorSelect" onchange="changeColor()">
                    <option value="default">Padrão</option>
                    <option value="blue">Azul</option>
                    <option value="green">Verde</option>
                    <option value="red">Vermelho</option>
                    <!-- Adicione mais opções conforme necessário -->
                </select>

                <script>
                    function changeColor() {
                        var selectedColor = document.getElementById("colorSelect").value;
                        setColorPreference(selectedColor);
                        applyColorPreference(preferredColor);
                    }

                    function setColorPreference(color) {
                        document.cookie = "site_color=" + color + "; path=/";
                    }

                    function applyColorPreference(color) {
                        var colorStyles = document.getElementById("colorStyles");
                        colorStyles.innerHTML = `
                        body {
                            background-color: ${color === 'default' ? 'white' : color};
                        } `;
                    }

                    // Aplica a preferência de cor ao carregar a página
                    var savedColorPreference = getCookie("site_color");
                    if (savedColorPreference) {
                        applyColorPreference(savedColorPreference);
                    }

                    // Função para obter o valor de um cookie
                    function getCookie(name) {
                        var match = document.cookie.match(new RegExp(name + '=([^;]+)'));
                        return match ? match[1] : null;
                    }

                    <?php
                    function getPreferredColor()
                    {
                        if (isset($_COOKIE['site_color'])) {
                            return $_COOKIE['site_color'];
                        } else {
                            return 'default';
                        }
                    }

                    $preferredColor = getPreferredColor();
                    echo "Cor Preferida: $preferredColor"; ?>
                </script>
            </div>
        </div>
    <?php
    }
    ?>
</body>

</html>