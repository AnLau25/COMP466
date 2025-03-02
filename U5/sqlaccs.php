<?php
$database = mysqli_connect("localhost:33", "root", "", "products");
if (!$database) {
    die("Error en la conexión: " . mysqli_connect_error());
}

// Validar entrada
if (!isset($_POST["select"]) || empty(trim($_POST["select"]))) {
    die("Error: Selección inválida.");
}

// Lista de columnas permitidas
$allowed_columns = ["ID", "Title", "Category", "ISBN", "*"];
$select = $_POST["select"];

if (!in_array($select, $allowed_columns)) {
    die("Selección no válida.");
}

// Construcción de la consulta
$query = ($select === "*") ? "SELECT * FROM books" : "SELECT $select FROM books";
$result = mysqli_query($database, $query);

if (!$result) {
    die("Error en la consulta.");
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Resultados SQL</title>
    <style>
        table {
            border-collapse: collapse;
            margin: 20px auto;
        }

        th,
        td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }
    </style>
</head>

<body>
    <table>
        <caption>Resultados del query</caption>
        <thead>
            <tr>
                <?php while ($field = mysqli_fetch_field($result)) {
                    echo "<th>{$field->name}</th>";
                } ?>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = mysqli_fetch_assoc($result)) {
                echo "<tr>";
                foreach ($row as $value) {
                    echo "<td>$value</td>";
                }
                echo "</tr>";
            } ?>
        </tbody>
    </table>
    <p>Se encontraron: <?php echo mysqli_num_rows($result); ?> resultados</p>
</body>

</html>