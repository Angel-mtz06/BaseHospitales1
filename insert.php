<?php include 'db.php'; ?>
<!DOCTYPE html>
<html>
<head>
    <title>Insertar</title>
    <link rel="stylesheet" href="style.css">
    <script src="script.js"></script>
</head>
<body>
    <?php
    $tabla = $_GET['tabla'];
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $values = array_map(function($v) use ($conn) { return "'" . $conn->real_escape_string($v) . "'"; }, $_POST);
        $campos = implode(",", array_keys($_POST));
        $datos = implode(",", array_values($values));
        $conn->query("INSERT INTO $tabla ($campos) VALUES ($datos)");
        header("Location: index.php");
    }
    ?>
    <h2>Agregar a <?php echo $tabla; ?></h2>
    <form method="POST" onsubmit="return validarFormulario('<?php echo $tabla; ?>')">
        <?php
        $res = $conn->query("DESCRIBE $tabla");
        while ($col = $res->fetch_assoc()) {
            if ($col['Extra'] != "auto_increment") {
                echo "<label>{$col['Field']}:</label>";
                echo "<input type='text' name='{$col['Field']}'><br>";
            }
        }
        ?>
        <button type="submit">Guardar</button>
    </form>
</body>
</html>
