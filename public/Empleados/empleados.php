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
    
    <h1>Empleados</h1>

    <?php
    include_once(__DIR__ . '/../../config/conexionDB.php');
    $pdo = getPDO();

    try {
        // Consulta SQL
        $stmt = $pdo->query('SELECT `b_empleados`.`id_empleado`,
                                    `b_empleados`.`nombre`,
                                    `b_empleados`.`apellido_paterno`,
                                    `b_empleados`.`apellido_materno`,
                                    `b_empleados`.`fecha_registro`,
                                    `b_empleados`.`hora_registro`,
                                    `b_empleados`.`ip`,
                                    `b_empleados`.`activo`
                                FROM `db_sistemas`.`b_empleados`;');

        // Obtener nombres de columnas
        $columnNames = array_keys($stmt->fetch(PDO::FETCH_ASSOC));

        // Volver a ejecutar la consulta para obtener los datos
        $stmt = $pdo->query('SELECT `b_empleados`.`id_empleado`,
                                    `b_empleados`.`nombre`,
                                    `b_empleados`.`apellido_paterno`,
                                    `b_empleados`.`apellido_materno`,
                                    `b_empleados`.`fecha_registro`,
                                    `b_empleados`.`hora_registro`,
                                    `b_empleados`.`ip`,
                                    `b_empleados`.`activo`
                                FROM `db_sistemas`.`b_empleados`;');

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

</body>

</html>