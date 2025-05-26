<?php include 'db.php'; ?>
<!DOCTYPE html>
<html>
<head>
    <title>Gestión Hospitalaria</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>Sistema Hospitalario</h1>
    <div class="nav">
        <a href="insert.php?tabla=Hospital">Agregar Hospital</a>
        <a href="insert.php?tabla=Paciente">Agregar Paciente</a>
        <a href="insert.php?tabla=Ingreso">Agregar Ingreso</a>
        <a href="insert.php?tabla=Medico">Agregar Médico</a>
        <a href="insert.php?tabla=Tratamiento">Agregar Tratamiento</a>
    </div>
    
    <?php
    $tablas = ["Hospital", "Paciente", "Ingreso", "Medico", "Tratamiento"];
    foreach ($tablas as $tabla) {
        echo "<h2>$tabla</h2>";
        $res = $conn->query("SELECT * FROM $tabla");
        if ($res->num_rows > 0) {
            echo "<table><tr>";
            while ($col = $res->fetch_field()) echo "<th>{$col->name}</th>";
            echo "<th>Acciones</th></tr>";
            while ($row = $res->fetch_assoc()) {
                echo "<tr>";
                foreach ($row as $val) echo "<td>$val</td>";
                echo "<td>
                    <a href='update.php?tabla=$tabla&id=" . array_values($row)[0] . "'>Editar</a>
                    <a href='delete.php?tabla=$tabla&id=" . array_values($row)[0] . "' onclick='return confirm(\"¿Eliminar?\")'>Eliminar</a>
                </td>";
                echo "</tr>";
            }
            echo "</table>";
        } else {
            echo "<p>No hay registros.</p>";
        }
    }
    ?>
</body>
</html>
