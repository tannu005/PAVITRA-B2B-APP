<?php
$content = file_get_contents('src/Views/layouts/main.php');
// Fix sidebar conditions
$content = str_replace(
    "if (\$requestPath !== '/' && \$requestPath !== '/index.php' && !empty(\$requestPath) && \$requestPath !== '/catalog'):",
    "if (\$requestPath !== '/' && \$requestPath !== '/index.php' && !empty(\$requestPath)):",
    $content
);
// Fix filter window.location
$content = str_replace(
    "window.location.href = '/?show_filters=true';",
    "window.location.href = '/catalog?show_filters=true';",
    $content
);
// Fix href="/?"
$content = str_replace(
    'href="/?',
    'href="/catalog?',
    $content
);
file_put_contents('src/Views/layouts/main.php', $content);
echo "Fixed main.php links and sidebar conditions.\n";
?>
