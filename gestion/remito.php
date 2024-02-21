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
    $this->Cell(30,10,'Lista de Productos','B',0,'C');
    // Salto de línea
    $this->Ln(20);

    $this->Cell(20,10,"N",1,0,"C",0);
    $this->Cell(30,10,"Nombre",1,0,"C",0);
    $this->Cell(30,10,"Cantidad",1,0,"C",0);
    $this->Cell(30,10,"Divisible",1,0,"C",0);
    $this->Cell(40,10,"Valor Unidad",1,0,"C",0);
    $this->Cell(40,10,"Subtotal",1,1,"C",0);
}

// Pie de página
function Footer()
{
    // Posición: a 1,5 cm del final
    $this->SetY(-15);
    // Arial italic 8
    $this->SetFont('Arial','I',12);
    // Número de página
    $this->Cell(0,10,utf8_decode('Página').$this->PageNo().'/{nb}',0,0,'C');
}
}

$ids = $_POST['idPro'];
$arrayIds = explode(',',$ids);
$cantidades = $_POST['cantPro'];
$arrayCant = explode(',',$cantidades);
$i = 1;
$total = 0;

// Creación del objeto de la clase heredada

$pdf = new PDF();
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetFillColor(233,229,235);
$pdf->SetFillColor(61,61,61);
$pdf->SetFont('Helvetica','',12);
foreach($arrayIds as $id) {
    $consulta = "SELECT * from productos WHERE id='".$id."'";
    $resultado = mysqli_query($conexion,$consulta);
    while($fila = $resultado->fetch_assoc()){
        $total = $total + intval($arrayCant[$i-1])*$fila['valor'];
        $pdf->Cell(20,10,$i,'B',0,'C',0);
        $pdf->Cell(30,10,$fila['nombre'],'B',0,'C',0);
        $pdf->Cell(30,10,$arrayCant[$i-1],'B',0,'C',0);
        $pdf->Cell(30,10,$fila['divisible'],'B',0,'C',0);
        $pdf->Cell(40,10,$fila['valor'],'B',0,'C',0);
        $pdf->Cell(40,10,intval($arrayCant[$i-1])*$fila['valor'],'B',1,'C',0);
        //
        $i++;
    }
}
$pdf->SetFont('Helvetica','',16);
$pdf->Cell(20,20,'Total: ',0,0,'C');
$pdf->SetFont('Helvetica','B',16);
$pdf->Cell(10,20,'$'.$total,0,1,'C');
$pdf->Output();

?>