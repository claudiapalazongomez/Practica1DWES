<?php
session_start();

$numero_pedidos = 0;
$fecha_ultimo_pedido = "N/A";

if (isset($_COOKIE['numero_pedidos'])) {
    $numero_pedidos = $_COOKIE['numero_pedidos'];
}
if (isset($_COOKIE['fecha_ultimo_pedido'])) {
    $fecha_ultimo_pedido = $_COOKIE['fecha_ultimo_pedido'];
}

if (isset($_POST['btnProcesar'])) {
    if (!empty($_SESSION['carrito'])) {
        $numero_pedidos++;
        $fecha_ultimo_pedido = date('d/m/y H:i:s');
        setcookie('numero_pedidos', $numero_pedidos, time() + 3600, '/');
        setcookie('fecha_ultimo_pedido', $fecha_ultimo_pedido, time() + 3600, '/');
        
        session_unset();
    }
}

if (isset($_POST['btnEliminarPedido'])) {
    if ($numero_pedidos > 0) {
        $numero_pedidos--;
    }
    setcookie('fecha_ultimo_pedido', $fecha_ultimo_pedido, time() + 3600, '/');
}

if (isset($_POST['btnEliminarHistorial'])) {
    $numero_pedidos = 0;
    setcookie('numero_pedidos', $numero_pedidos, time() + 3600, '/');
    $fecha_ultimo_pedido = "N/A";
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Historial de Pedidos</title>
</head>
<body>
    <h1>Historial de Pedidos</h1>
    <?php if ($numero_pedidos > 0): ?>
        <p>Número de pedidos: <?php echo $numero_pedidos; ?></p>
        <p>Fecha del último pedido: <?php echo $fecha_ultimo_pedido; ?></p>
    <?php else: ?>
        <p>No existen pedidos realizados</p>
    <?php endif; ?>

    
    <form action="pedidos.php" method="post">
        <input type="submit" value="Eliminar pedido" name="btnEliminarPedido" />
        <input type="submit" value="Eliminar historial" name="btnEliminarHistorial" />
    </form>
    <a href="inicio.php"><button>Volver a Inicio</button></a>
</body>
</html>


