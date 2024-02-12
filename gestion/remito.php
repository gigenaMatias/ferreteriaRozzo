<?php
require("../fpdf/fpdf.php");
require("conexion.php");

/*$datosTabla = $_POST['jsonData'];
$jsonDecoded = json_decode($datosTabla); 
print_r($jsonDecoded); //objeto json a string*/


class PDF extends FPDF
{
// Cabecera de página
function Header()
{
    // Logo
    //$this->Image('logo.png',10,8,33);
    // Arial bold 15
    $this->SetFont('Arial','B',15);
    // Movernos a la derecha
    $this->Cell(80);
    // Título
    $this->Cell(40,10,'Lista productos',0,0,'C');
    // Salto de línea
    $this->Ln(20);

    $this->Cell(30,10,"Numero",1,0,"C",0);
    $this->Cell(30,10,"Nombre",1,0,"C",0);
    $this->Cell(30,10,"Cantidad",1,0,"C",0);
    $this->Cell(30,10,"Divisible",1,0,"C",0);
    $this->Cell(35,10,"Valor Unidad",1,0,"C",0);
    $this->Cell(30,10,"Total",1,1,"C",0);
}

// Pie de página
function Footer()
{
    // Posición: a 1,5 cm del final
    $this->SetY(-15);
    // Arial italic 8
    $this->SetFont('Arial','I',8);
    // Número de página
    $this->Cell(0,10,utf8_decode('Página').$this->PageNo().'/{nb}',0,0,'C');
}
}

$ids = $_POST['idPro'];
$arrayIds = explode(',',$ids);
$cantidades = $_POST['cantPro'];
$arrayCant = explode(',',$cantidades);
$i = 1;

// Creación del objeto de la clase heredada

$pdf = new PDF();
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetFont('Times','',12);
foreach($arrayIds as $id) {
    $consulta = "SELECT * from productos WHERE id='".$id."'";
    $resultado = mysqli_query($conexion,$consulta);
    while($fila = $resultado->fetch_assoc()){
        $pdf->Cell(30,10,$i,1,0,'C',0);
        $pdf->Cell(30,10,$fila['nombre'],1,0,'C',0);
        $pdf->Cell(30,10,$arrayCant[$i-1],1,0,'C',0);
        $pdf->Cell(30,10,$fila['divisible'],1,0,'C',0);
        $pdf->Cell(35,10,$fila['valor'],1,0,'C',0);
        $pdf->Cell(30,10,intval($arrayCant[$i-1])*$fila['valor'],1,1,'C',0);
        //
        $i++;
    }
}
$pdf->Output();

?>