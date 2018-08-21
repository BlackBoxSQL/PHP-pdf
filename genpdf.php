<?php  

require "fpdf.php";
$db = new PDO('mysql:host=localhost;dbname=info','root','');
	
	class mypdf extends FPDF{
		function header(){
			$this->Image('logo.png',10,6);
			$this->SetFont('Arial','B',14);
			$this->Cell(276,5,'Information of Student',0,0,'C');
			$this->Ln();
			$this->SetFont('Times','',12);
			$this->Cell(276,10,'Imaginary School of Maddness',0,0,'C');
			$this->Ln(20);

		}
		function footer(){
			$this->SetY(-15);
			$this->SetFont('Arial','',8);
			$this->Cell(0,10,'Page'.$this->PageNo().'/{nb}',0,0,'C');
		}
		function table(){
			$this->SetFont('Times','B',14);
			$this->Cell(50,10,'ID',1,0,'C');
			$this->Cell(60,10,'Name',1,0,'C');
			$this->Cell(20,10,'Class',1,0,'C');
			$this->Cell(20,10,'Section',1,0,'C');
			$this->Cell(20,10,'Roll',1,0,'C');
			$this->Cell(50,10,'Contact',1,0,'C');
			$this->Cell(20,10,'Result',1,0,'C');
			$this->Ln();
		}
		function tableData($db){
			$this->SetFont('Times','',12);
			$stmt = $db->query('select * from information');
			while($data = $stmt->fetch(PDO::FETCH_OBJ)){
				$this->Cell(50,10,$data->student_id,1,0,'L');
				$this->Cell(60,10,$data->student_name,1,0,'L');
				$this->Cell(20,10,$data->class,1,0,'C');
				$this->Cell(20,10,$data->section,1,0,'C');
				$this->Cell(20,10,$data->roll,1,0,'C');
				$this->Cell(50,10,$data->mobile,1,0,'L');
				$this->Cell(20,10,$data->result,1,0,'C');
				$this->Ln();
			}
			
		

		}
	}
	$pdf = new myPDF();
	$pdf -> AliasNbPages();
	$pdf -> AddPage('L','A4',0);
	$pdf -> table();
	$pdf -> tableData($db);
	$pdf -> Output();

?>