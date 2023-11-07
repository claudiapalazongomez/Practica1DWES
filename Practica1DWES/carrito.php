<?php
session_start();

$carritoVacio = 'Carrito vacío';
$total = 0;

$precios = array(
    "Zara Rose Gourmand 80 ML" => 19.95,
    "Elegantly Tokyo 75 ML" => 22.95,
    "Violet Blossom 90 ML" => 10.95,
    "Red Vanilla 30 ML" => 6.95
);

if(isset($_SESSION['carrito'])){
    $carrito = $_SESSION['carrito'];
} 

if (isset($_POST['articulo']) && isset($_POST['cantidad']) && !empty($_POST['articulo']) && !empty($_POST['cantidad'])) {
    $articulo = $_POST['articulo'];
    $cantidad = $_POST['cantidad'];
    $subtotal = $precios[$articulo] * $cantidad;

    if (!isset($_SESSION['carrito'])) {
        $_SESSION['carrito'] = array();
    }

    $_SESSION['carrito'][] = array(
        'articulo' => $articulo,
        'cantidad' => $cantidad,
        'precio_unitario' => $precios[$articulo],
        'subtotal' => $subtotal
    );

    // Establecer la fecha del último pedido en una cookie
    $fecha = date("d/m/y H:i:s");
    setcookie('fecha_ultimo_pedido', $fecha, time() + 3600);

    header("Location: carrito.php");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Carrito de Compra</title>
</head>
<body>
<div class="container">
        <?php if (!empty($carrito)): ?>
            <h3>Carrito de Compra</h3>
            <table class="tabla">
                <thead>
                    <tr>
                        <th>Artículo</th>
                        <th>Cantidad</th>
                        <th>Precio Unitario</th>
                        <th>Subtotal</th>
                    </tr>
                </thead>
                <tbody>
                <?php foreach ($_SESSION['carrito'] as $item): ?>
                    <tr>
                        <td><?php echo $item['articulo']; ?></td>
                        <td><?php echo $item['cantidad']; ?></td>
                        <td><?php echo $item['precio_unitario']; ?> EUR</td>
                        <td><?php echo $item['subtotal']; ?> EUR</td>
                    </tr>
                    <?php $total += $item['subtotal']; ?>
                <?php endforeach; ?>
                </tbody>
            </table>
            
        <?php endif; ?>

        <?php if (empty($carrito)): ?>
        <h3><?php echo $carritoVacio; ?></h3>
        <?php endif; ?>

        <?php if (!empty($carrito)): ?>
            <h4>El total de su compra equivale a: <?php echo $total; ?> EUR</h4>
        <?php endif; ?>
        
        <a href="inicio.php"><button>Seguir Comprando</button></a>
        <form action="pedidos.php" method="post">
            <button type="submit" name="btnProcesar">Procesar pedido</button>
        </form>
    </div>
</body>
</html>

