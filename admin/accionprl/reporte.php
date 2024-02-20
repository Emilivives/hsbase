<?php
require('../../fpdf/fpdf.php');
include('../../app/config.php');
include('../../admin/layout/parte1.php');
$id_accion = $_GET['id_accion'];
include('../../app/controllers/actividad/datos_accionprl.php');
include('../../app/controllers/trabajadores/listado_trabajadores.php');
include('../../app/controllers/maestros/responsables/listado_responsables.php');
include('../../app/controllers/maestros/centros/listado_centros.php');

class PDF extends FPDF
{
// Cabecera de página
function Header()
{
    // Logo
    $this->SetFont('Times','',12); //definimos tipo de letra
    $this->Image('../../public/img/LOGO1.jpg',10,8,33); //imagen comocabecera (imagen, posicion x, y, pixel grande)
    $this->Cell(100,8,'hola mundo',1,1,'C,0);'); //INSERTAR CELDA
    $this->Ln(20); // espacio de cabecera con lineas
}

// Pie de página
function Footer()
{
    // Posición: a 1,5 cm del final
 $this->SetY(-15);
    // Arial italic 8
  $this->SetFont('Arial','I',8);
    // Número de página
 $this->Cell(0,10,'Page '.$this->PageNo().'/{nb}',0,0,'C');
}
}

// Creación del objeto de la clase heredada
$pdf = new PDF(); //hacemos una instancia de la clase
$pdf->AliasNbPages();
$pdf->AddPage();//añadimos una pagina / en blanco
$pdf->SetMargins(10,10,10);
$pdf->SetAutoPageBreak(20);//salto de pagina
$pdf->SetFont('Times','',12); //definimos tipo de letra
$pdf->Image('../../public/img/LOGO1.jpg',10,8,33); //imagen comocabecera (imagen, posicion x, y, pixel grande)
$pdf->Cell(100,8,'hola mundo',1,1,'C,0);'); //INSERTAR CELDA
$pdf->Ln(20); // espacio de cabecera con lineas


for($i=1;$i<=40;$i++)
$pdf->setX(30,60); //posicionamos celdas
    $pdf->Cell(0,10,utf8_decode('Imprimiendo linea numero'),0,1);
// celdas (ancho, largo, contenido, borde, salto de linea)
$pdf->Output();
?>