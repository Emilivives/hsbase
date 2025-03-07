<?php
include("../../config.php");

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $id_trabajador = $_POST['id_trabajador'];

    // Consulta principal de trabajador
    $sql = "SELECT tr.id_trabajador as id_trabajador,
            tr.codigo_tr as codigo_tr,
            tr.dni_tr as dni_tr,
            tr.nombre_tr as nombre_tr,
            tr.fechanac_tr as fechanac_tr,
            tr.sexo_tr as sexo_tr,
            cat.nombre_cat as nombre_cat,
            tr.inicio_tr as inicio_tr,
            tr.activo_tr as activo_tr,
            tr.formacionpdt_tr as formacionpdt_tr,
            tr.informacion_tr as informacion_tr,
            cen.nombre_cen as nombre_cen,
            emp.id_empresa as id_empresa,
            emp.nombre_emp as nombre_emp,
            emp.logo_emp as logo_emp,
            emp.razonsocial_emp as razonsocial_emp,
            emp.direccion_emp as direccion_emp,
            tr.anotaciones_tr as anotaciones_tr
        FROM trabajadores as tr
        INNER JOIN categorias as cat ON tr.categoria_tr=cat.id_categoria
        INNER JOIN centros as cen ON tr.centro_tr=cen.id_centro
        INNER JOIN empresa as emp ON cen.empresa_cen=emp.id_empresa
        WHERE tr.id_trabajador = :id_trabajador";

    $query = $pdo->prepare($sql);
    $query->execute(['id_trabajador' => $id_trabajador]);
    $trabajador = $query->fetch(PDO::FETCH_ASSOC);

    // Consultas de formaciones
    $formaciones_sql = "SELECT tf.nombre_tf as nombre_tf, fr.fecha_fr as fecha_fr, fr.fechacad_fr as fechacad_fr
                        FROM formacion as fr
                        INNER JOIN tipoformacion as tf ON fr.tipo_fr = tf.id_tipoformacion
                        INNER JOIN form_asistencia as fas ON fas.nroformacion = fr.nroformacion
                        WHERE fas.idtrabajador_fas = :id_trabajador
                        ORDER BY fr.fecha_fr DESC";

    $formaciones_query = $pdo->prepare($formaciones_sql);
    $formaciones_query->execute(['id_trabajador' => $id_trabajador]);
    $formaciones = $formaciones_query->fetchAll(PDO::FETCH_ASSOC);

    // Consultas de formaciones
    $informaciones_sql = "SELECT tf.nombre_tf as nombre_tf, fr.fecha_fr as fecha_fr, fr.fechacad_fr as fechacad_fr
      FROM formacion as fr
      INNER JOIN tipoformacion as tf ON fr.tipo_fr = tf.id_tipoformacion
      INNER JOIN form_asistencia as fas ON fas.nroformacion = fr.nroformacion
      WHERE fas.idtrabajador_fas = :id_trabajador
      ORDER BY fr.fecha_fr DESC";

    $informaciones_query = $pdo->prepare($informaciones_sql);
    $informaciones_query->execute(['id_trabajador' => $id_trabajador]);
    $informaciones = $formaciones_query->fetchAll(PDO::FETCH_ASSOC);

    // Consultas de reconocimientos
    $reconocimientos_sql = "SELECT rm.id_reconocimiento as id_reconocimiento, rm.fecha_rm as fecha_rm, rm.caducidad_rm as caducidad_rm
                            FROM reconocimientos as rm
                            WHERE trabajador_rm = :id_trabajador";

    $reconocimientos_query = $pdo->prepare($reconocimientos_sql);
    $reconocimientos_query->execute(['id_trabajador' => $id_trabajador]);
    $reconocimientos = $reconocimientos_query->fetchAll(PDO::FETCH_ASSOC);

    // Consultas de accidentes
    $accidentes_sql = "SELECT ta.tipoaccidente_ta as tipoaccidente_ta, ace.fecha_ace as fecha_ace, ace.fechabaja_ace as fechabaja_ace, cen.nombre_cen as nombre_cen
                       FROM accidentes as ace
                       INNER JOIN ace_tipoaccidente as ta ON ace.tipoaccidente_ace = ta.id_tipoaccidente
                       INNER JOIN centros as cen ON ace.centro_ace = cen.id_centro
                       WHERE ace.trabajador_ace = :id_trabajador
                       ORDER BY ace.fecha_ace DESC";

    $accidentes_query = $pdo->prepare($accidentes_sql);
    $accidentes_query->execute(['id_trabajador' => $id_trabajador]);
    $accidentes = $accidentes_query->fetchAll(PDO::FETCH_ASSOC);

    // Preparar la respuesta
    $response = [
        'trabajador' => $trabajador,
        'formaciones' => $formaciones,
        'reconocimientos' => $reconocimientos,
        'accidentes' => $accidentes
    ];

    echo json_encode($response);
}
