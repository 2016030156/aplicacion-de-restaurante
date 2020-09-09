<?php
require('fpdf/fpdf.php');

class Pdf extends FPDF {

	function tablaPlatillos ($header, $data) {
	    $this->SetFillColor(200,200,200);
	    $this->SetTextColor(0);
	    $this->SetDrawColor(0,0,0);
	    $this->SetLineWidth(.3);
	    $this->SetFont('','B');
	    $w = array(10, 40, 35, 45, 40);
	    for ($i = 0; $i < count($header); $i++)
	        $this->Cell($w[$i], 7, $header[$i], 1, 0, 'C', true);
	    $this->Ln();
	    $this->SetFillColor(230, 230, 230);
	    $this->SetTextColor(0);
	    $this->SetFont('');
	    $fill = false;
	    foreach ($data as $index => $row) {
	        $this->Cell($w[0], 6, $index + 1, 'LR', 0, 'L', $fill);
	        $this->Cell($w[1], 6, $row['nombre'], 'LR', 0, 'L', $fill);
	        $this->Cell($w[2], 6, $row['cantidad'], 'LR', 0, 'R', $fill);
	        $this->Cell($w[3], 6, $row['precio'] , 'LR', 0, 'R', $fill);
	        $this->Cell($w[4], 6, $row['cantidad'] * $row['precio'], 'LR', 0, 'R', $fill);
	        $this->Ln();
	        $fill = !$fill;
	    }
	    $this->Cell(array_sum($w), 0, '', 'T');
	    $this->Ln();
	}

	function tablaComandas ($header, $data) {
	    $this->SetFillColor(200,200,200);
	    $this->SetTextColor(0);
	    $this->SetDrawColor(0,0,0);
	    $this->SetLineWidth(.3);
	    $this->SetFont('','B');
	    $w = array(10, 25, 30, 30, 30, 30);
	    // echo array_sum($w);
	   	// $this->Cell(10, 10, 6, array_sum($w), 0, 1);
	    for ($i = 0; $i < count($header); $i++)
	        $this->Cell($w[$i], 7, $header[$i], 1, 0, 'C', true);
	    $this->Ln();
	    $this->SetFillColor(230, 230, 230);
	    $this->SetTextColor(0);
	    $this->SetFont('');
	    $fill = false;
	    foreach ($data as $index => $row) {
	    	$fecha = new datetime($row['fecha']);
	    	if ($row['status'] == 3)
	    		$status = "Pagado";
	    	else
	    		$status = "Rechazado";
	        $this->Cell($w[0], 6, $index + 1, 'LR', 0, 'L', $fill);
	        $this->Cell($w[1], 6, $row['mesa'], 'LR', 0, 'L', $fill);
	        $this->Cell($w[2], 6, $row['total'], 'LR', 0, 'R', $fill);
	        $this->Cell($w[3], 6, $fecha->format("d/m/Y"), 'LR', 0, 'R', $fill);
	        $this->Cell($w[4], 6, $row['hora'], 'LR', 0, 'R', $fill);
	        $this->Cell($w[5], 6, $status, 'LR', 0, 'R', $fill);
	        $this->Ln();
	        $fill = !$fill;
	    }
	    $this->Cell(array_sum($w), 0, '', 'T');
	    $this->Ln();
	}
}