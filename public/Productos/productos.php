<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/css/normalize.css">
    <link rel="stylesheet" href="/css/global.css">
    <link rel="stylesheet" href="/css/tabla.css">
    <title>Inicio</title>
</head>

<body>
    <nav>
        <ul>
            <li><a href="/index.html">Inicio</a></li>
            <li><a href="/public/Empleados/empleados.php">Empleados</a></li>
            <li><a href="/public/Productos/productos.php">Productos</a></li>
            <li><a href="/public/Categorias/categorias.php">Categorías</a></li>
        </ul>
    </nav>
    
    <h1>Productos</h1>

    <?php
    include '../../config/conexionDB.php';
    $pdo = getPDO();

    try {
        // Consulta SQL
        $stmt = $pdo->query('SELECT `b_productos`.`id_producto`,
                                    `b_productos`.`nombre`,
                                    `b_productos`.`descripcion`,
                                    `b_productos`.`precio`,
                                    `b_productos`.`imagen`,
                                    `b_productos`.`categoria`,
                                    `b_productos`.`fecha_registro`,
                                    `b_productos`.`hora_registro`,
                                    `b_productos`.`ip`,
                                    `b_productos`.`activo`
                                FROM `dbprogramacionweb`.`b_productos`;
                            ');

        // Obtener nombres de columnas
        $columnNames = array_keys($stmt->fetch(PDO::FETCH_ASSOC));

        // Volver a ejecutar la consulta para obtener los datos
        $stmt = $pdo->query('SELECT `b_productos`.`id_producto`,
                                    `b_productos`.`nombre`,
                                    `b_productos`.`descripcion`,
                                    `b_productos`.`precio`,
                                    `b_productos`.`imagen`, 
                                    `b_productos`.`categoria`,
                                    `b_productos`.`fecha_registro`,
                                    `b_productos`.`hora_registro`,
                                    `b_productos`.`ip`,
                                    `b_productos`.`activo`
                                FROM `dbprogramacionweb`.`b_productos`;
                            ');

        // Generar la tabla HTML con clases y encabezados automáticos
        echo '<div class="table-wrapper">';
        echo '<table class="fl-table">';
        echo '<thead>';
        echo '<tr>';
        foreach ($columnNames as $columnName) {
            echo '<th>' . htmlspecialchars($columnName) . '</th>';
        }
        echo '</tr>';
        echo '</thead>';
        echo '<tbody>';

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            echo '<tr>';
            foreach ($columnNames as $columnName) {
                echo '<td>' . htmlspecialchars($row[$columnName]) . '</td>';
            }
            echo '</tr>';
        }

        echo '</tbody>';
        echo '</table>';
        echo '</div>';
    } catch (PDOException $e) {
        // Manejo de errores
        echo 'Error: ' . $e->getMessage();
    }
    ?>

    <form action="">
        <label for="nombre">Nombre:</label>
        <input type="text" name="nombre" id="nombre">
        <label for="descripcion">Descripción:</label>
        <input type="text" name="descripcion" id="descripcion">
        <label for="precio">Precio:</label>
        <input type="text" name="precio" id="precio">
        <label for="imagen">Imagen:</label>
        <input type="text" name="imagen" id="imagen">
        <label for="categoria">Categoría:</label>
        <input type="text" name="categoria" id="categoria">
    <!--<label for="fecha_registro">Fecha de registro:</label>
        <input type="text" name="fecha_registro" id="fecha_registro">
        <label for="hora_registro">Hora de registro:</label>
        <input type="text" name="hora_registro" id="hora_registro">
        <label for="ip">IP:</label>
        <input type="text" name="ip" id="ip"> -->
        <label for="activo">Activo:</label>
        <input type="text" name="activo" id="activo">
        <input type="submit" value="Agregar">
    </form>

</body>

</html>