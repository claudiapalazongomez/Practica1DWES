<?php
session_start();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio</title> 
</head>
<body>
    <div class="container">
    <form action="carrito.php" method="post">
        <label for="articulo">Artículo:</label>
        <select name="articulo">
            <option value="">Elige un perfume...</option>
            <option value="Zara Rose Gourmand 80 ML">Zara Rose Gourmand 80 ML</option> 
            <option value="Elegantly Tokyo 75 ML">Elegantly Tokyo 75 ML</option> 
            <option value="Violet Blossom 90 ML">Violet Blossom 90 ML</option> 
            <option value="Red Vanilla 30 ML">Red Vanilla 30 ML</option> 
        </select>

        <div class="form-group">
            <label for="cantidad">Cantidad:</label>
            <input type="number" name="cantidad" min="1" step="1">
        </div>

        <button type="submit">Añadir al Carrito</button>
    </form>
    </div>
</body>
</html>
