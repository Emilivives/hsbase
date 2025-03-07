<?php
include('../../../app/config.php');

session_start(); // Iniciar sesión para los mensajes
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    try {
        // Recibir datos del formulario
        $id_epi = $_POST['id_epi'];
        $id_responsable = $_POST['id_responsable'];
        $fecha = !empty($_POST['fecha']) ? $_POST['fecha'] : die("Error: La fecha no fue enviada correctamente.");
        $observaciones = $_POST['observaciones'];
        $prioridad = $_POST['prioridad'];
        $valoracion = $_POST['valoracion_epi'];

        // Listas de campos para inspección
        $cintas = ["hoyos", "desalichadas", "desgastadas", "talladuras", "torsion", "suciedad", "quemada", "pintura", "degradacion", "quimicos", "cortes", "otros"];
        $costuras = ["abiertas", "hebras", "reventadas", "otros"];
        $metales = ["desgaste", "corrosion", "deformacion", "fisuras", "aristas", "otros"];

        // Construcción de la consulta SQL con placeholders
        $sql = "INSERT INTO inv_revision_arnes (id_epi_arnes, fecha, id_responsable, 
                " . implode(", ", array_map(fn($c) => "cintas_$c", $cintas)) . ",
                " . implode(", ", array_map(fn($c) => "costuras_$c", $costuras)) . ",
                " . implode(", ", array_map(fn($c) => "metales_$c", $metales)) . ",
                observaciones, prioridad, valoracion_epi) 
                VALUES (?,?,?," . str_repeat("?,", count($cintas) + count($costuras) + count($metales)) . "?,?,?)";

        // Preparar la consulta
        $stmt = $pdo->prepare($sql);

        // Crear array de valores a insertar
        $params = [$id_epi, $fecha, $id_responsable];

        // Añadir valores de las inspecciones (por defecto "INCORRECTO" si no se envían)
        foreach ($cintas as $cinta) {
            $params[] = $_POST["cintas_$cinta"] ?? 'INCORRECTO';
        }
        foreach ($costuras as $costura) {
            $params[] = $_POST["costuras_$costura"] ?? 'INCORRECTO';
        }
        foreach ($metales as $metal) {
            $params[] = $_POST["metales_$metal"] ?? 'INCORRECTO';
        }

        // Añadir los últimos campos
        array_push($params, $observaciones, $prioridad, $valoracion);

        // Ejecutar la consulta y manejar el resultado
        if ($stmt->execute($params)) {
            $_SESSION['mensaje'] = "Actividad registrada correctamente";
            $_SESSION['icono'] = "success";
        } else {
            $_SESSION['mensaje'] = "Inspección NO registrada";
            $_SESSION['icono'] = "warning";
        }

        header("Location: " . $URL . "/admin/inventario/controlepis.php");
        exit(); // Asegura que el script se detenga después de la redirección

    } catch (PDOException $e) {
        $_SESSION['mensaje'] = "Error en la base de datos: " . $e->getMessage();
        $_SESSION['icono'] = "error";
        header("Location: " . $URL . "/admin/inventario/controlepis.php");
        exit();
    }
} else {
    $_SESSION['mensaje'] = "Acceso denegado.";
    $_SESSION['icono'] = "error";
    header("Location: " . $URL . "/index.php");
    exit();
}
?>