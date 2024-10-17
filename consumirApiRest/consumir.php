<?php
$url = 'http://localhost/apiRest/index.php';
$response = file_get_contents($url);
$productos = json_decode($response, true);

echo "<h1>Lista de Productos</h1>";
echo "<ul>";
foreach ($productos as $producto) {
    echo "<li>{$producto['nombre']} - \${$producto['precio']}</li>";
}
echo "</ul>";
?>
