<?php
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *'); // Habilitar CORS
header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE');
header('Access-Control-Allow-Headers: Content-Type');

require 'db.php'; // Conexión a la base de datos

$method = $_SERVER['REQUEST_METHOD']; // Detectar el método HTTP

switch ($method) {
    case 'GET':
        obtenerProductos();
        break;
    case 'POST':
        crearProducto();
        break;
    case 'PUT':
        actualizarProducto();
        break;
    case 'DELETE':
        eliminarProducto();
        break;
    default:
        echo json_encode(['error' => 'Método no permitido']);
}

function obtenerProductos() {
    $db = conectarDB();
    $stmt = $db->query("SELECT * FROM productos");
    $productos = $stmt->fetchAll(PDO::FETCH_ASSOC);
    echo json_encode($productos);
}

function crearProducto() {
    $db = conectarDB();
    $data = json_decode(file_get_contents('php://input'), true);
    $stmt = $db->prepare("INSERT INTO productos (nombre, precio) VALUES (:nombre, :precio)");
    $stmt->execute(['nombre' => $data['nombre'], 'precio' => $data['precio']]);
    echo json_encode(['mensaje' => 'Producto creado']);
}

function actualizarProducto() {
    $db = conectarDB();
    $data = json_decode(file_get_contents('php://input'), true);
    $stmt = $db->prepare("UPDATE productos SET nombre = :nombre, precio = :precio WHERE id = :id");
    $stmt->execute(['nombre' => $data['nombre'], 'precio' => $data['precio'], 'id' => $data['id']]);
    echo json_encode(['mensaje' => 'Producto actualizado']);
}

function eliminarProducto() {
    $db = conectarDB();
    parse_str(file_get_contents('php://input'), $data);
    $stmt = $db->prepare("DELETE FROM productos WHERE id = :id");
    $stmt->execute(['id' => $data['id']]);
    echo json_encode(['mensaje' => 'Producto eliminado']);
}
?>
