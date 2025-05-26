<?php include 'db.php'; ?>
<!DOCTYPE html>
<html>
<head>
    <title>Editar</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <?php
    $tabla = $_GET['tabla'];
    $id = $_GET['id'];
    $pk = $conn->query("SHOW KEYS FROM $tabla WHERE Key_name = 'PRIMARY'")->fetch_assoc()['Column_name'];

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $sets = [];
        foreach ($_POST as $campo => $valor) {
            $sets[] = "$campo='" . $conn->real_escape_string($valor) . "'";
        }
        $setStr = implode(",", $sets);
        $conn->query("UPDATE $tabla SET $setStr WHERE $pk=$id");
        header("Location: index.php");
    }

    $data = $conn->query("SELECT * FROM $tabla WHERE $pk=$id")->fetch_assoc();
    ?>
    <h2>Editar <?php echo $tabla; ?></h2>
    <form method="POST">
        <?php
        foreach ($data as $campo => $valor) {
            if ($campo != $pk)
                echo "<label>$campo:</label><input type='text' name='$campo' value='$valor'><br>";
        }
        ?>
        <button type="submit">Actualizar</button>
    </form>
</body>
</html>
