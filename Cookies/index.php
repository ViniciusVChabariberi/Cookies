<?php
// Contador de visitas
if(isset($_COOKIE['visit_count'])) {
    $visit_count = $_COOKIE['visit_count'] + 1;
} else {
    $visit_count = 1;
}

// Mudar cor
if(isset($_COOKIE['background_color'])) {
    $background_color = $_COOKIE['background_color'];
} else {
    $background_color = '#ffffff'; // Cor padrão (branco)
}
if(isset($_POST['color'])) {
    $background_color = $_POST['color'];
    setcookie('background_color', $background_color, time() + 200); // expira em 2 minutos
}

// Mudar idioma
if(isset($_COOKIE['language'])) {
    $language = $_COOKIE['language'];
} else {
    $language = 'en'; // Idioma padrão: inglês
}
 
if(isset($_GET['lang'])) {
    $language = $_GET['lang'];
    setcookie('language', $language, time() + 30); // expira em 30 segundos
}
 
// Conjunto de traduções
$translations = [
    'en' => [
        'title' => 'Change Language',
        'current_language' => 'Current Language: English',
        'select_language' => 'Select a Language:',
        'update_language' => 'Update Language',
    ],
    'pt' => [
        'title' => 'Mudar Idioma',
        'current_language' => 'Idioma Atual: Português',
        'select_language' => 'Selecione um Idioma:',
        'update_language' => 'Atualizar Idioma',
    ],
];
 
$translation = $translations[$language];

setcookie('visit_count', $visit_count, time() + 30); // expira em 30 segundos
?>
 
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../Cookies/assets/style.css">
    <title>Cookies</title>
    <style>
        body {
            background-color: <?php echo $background_color; ?>;
        }
    </style>
</head>
<body>
    <h1 class="title">Explorando o Mundo dos Cookies na Programação Web: Uma Abordagem Prática</h1>

    <h2>Contador de Visitas</h2>
    <p>Você visitou esta página <?php echo $visit_count; ?> vezes.</p>
    <br>
    <h2>Mudar Cor da Tela</h2>
    <p>Cor atual da tela: <?php echo $background_color; ?></p>

    <form method="post" action="">
        <label for="color">Escolha uma nova cor:</label>
        <input type="color" id="color" name="color">
        <input type="submit" value="Atualizar Cor">
    </form>
    <br>
    <h2><?php echo $translation['title']; ?></h2>
    <p><?php echo $translation['current_language']; ?></p>
 
    <form method="get" action="">
        <label for="lang"><?php echo $translation['select_language']; ?></label>
        <select id="lang" name="lang">
            <option value="en" <?php echo ($language === 'en') ? 'selected' : ''; ?>>English</option>
            <option value="pt" <?php echo ($language === 'pt') ? 'selected' : ''; ?>>Português</option>
        </select>
        <input type="submit" value="<?php echo $translation['update_language']; ?>">
    </form>

    <footer>
    <p class="texto"> Este trabalho mergulha no fascinante universo da programação com cookies, 
    destacando sua utilidade na persistência de dados em aplicações web. 
    Descubra como esses pequenos arquivos de texto desempenham um papel crucial na personalização da experiência do usuário. 
    Para garantir uma compreensão abrangente das práticas de segurança e proteção de dados, 
    consulte nossas <a class="link" href="politica.php">políticas de segurança</a> para obter informações detalhadas sobre a privacidade e a integridade dos dados.</p>
    </footer>
</body>
</html>
