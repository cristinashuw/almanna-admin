<?php
require('../../fpdf17/fpdf.php');

//db connection
include '../../koneksi.php';


//get invoices data
$query = mysqli_query($connect, "SELECT actual.*, customers.*, quotation.* FROM actual JOIN customers ON actual.customer_ID = customers.customer_ID JOIN quotation ON actual.quotation_ID = quotation.quotation_ID WHERE actual.no_actual = '".$_GET['no_actual']."'" );
$invoice = mysqli_fetch_array($query);


class PDF extends FPDF
{
// Page header
function Header()
{
    // Logo
    $this->Image('../../fpdf17/logoAlmanna.jpg',107,5,100);
    // Arial bold 15
    $this->SetFont('Arial','B',15);
    // // Move to the right
    // $this->Cell(80);
    // Line break
    $this->Ln(30);
}

// Page footer
function Footer()
{
    // Position at 1.5 cm from bottom
    $this->SetY(-15);
    // Arial italic 8
    $this->SetFont('Arial','I',8);
    // Page number
    $this->Cell(0,10,'Page '.$this->PageNo().'/{nb}',0,0,'C');
}
}

//A4 width : 219mm
//default margin : 10mm each side
//writable horizontal : 219-(10*2)=189mm

$pdf = new PDF('P','mm','A4');
$pdf->AliasNbPages();
$pdf->AddPage();

//set font to arial, bold, 14pt
$pdf->SetFont('Arial','B',14);

//Cell(width , height , text , border , end line , [align] )

$pdf->Cell(125	,5,'ALMANNA',0,0);
$pdf->Cell(59	,5,'INVOICE',0,1);//end of line

//set font to arial, regular, 12pt
$pdf->SetFont('Arial','',12);

$pdf->Cell(125	,5,'Almanna Street B-27',0,0);
$pdf->Cell(59	,5,'',0,1);//end of line

$pdf->Cell(125	,5,'Batam, Indonesia, 29433',0,0);
$pdf->Cell(25	,5,'Date',0,0);
$pdf->Cell(34	,5,$invoice['actualDate'],0,1);//end of line

$pdf->Cell(125	,5,'Phone [+12345678]',0,0);
$pdf->Cell(25	,5,'Invoice #',0,0);
$pdf->Cell(34	,5,$invoice['no_actual'],0,1);//end of line

$pdf->Cell(125	,5,'Fax [+12345678]',0,0);
$pdf->Cell(25	,5,'ID Customer ',0,0);
$pdf->Cell(34	,5,$invoice['customer_ID'],0,1);//end of line

//make a dummy empty cell as a vertical spacer
$pdf->Cell(189	,10,'',0,1);//end of line

//billing address
$pdf->Cell(100	,5,'Bill to :',0,1);//end of line

//add dummy cell at beginning of each line for indentation
$pdf->Cell(10	,5,'',0,0);
$pdf->Cell(90	,5,$invoice['customer_name'],0,1);

// $pdf->Cell(10	,5,'',0,0);
// $pdf->Cell(90	,5,$invoice['company'],0,1);

$pdf->Cell(10	,5,'',0,0);
$pdf->Cell(90	,5,$invoice['address'],0,1);

$pdf->Cell(10	,5,'',0,0);
$pdf->Cell(90	,5,$invoice['phone'],0,1);


//make a dummy empty cell as a vertical spacer
$pdf->Cell(190	,20,'',0,1);

$pdf->Cell(190	,15,'Here are the final cost of your treatment :',0,1);
//end of line


//MEDICAL FEE//
$pdf->Cell(190	,0,'',0,1);
//invoice contents
$pdf->SetFont('Arial','B',12);
$pdf->Cell(0	,10,'First stage treatment',0,1,'C');

$pdf->SetFont('Arial','',12);
$pdf->Cell(10	,10,'No',1,0,'C');
$pdf->Cell(145	,10,'Medical action',1,0,'C');
$pdf->Cell(35	,10,'Price',1,1,'C');//end of line

$pdf->SetFont('Arial','',12);

//Numbers are right-aligned so we give 'R' after new line parameter

//items
$query = mysqli_query($connect, "SELECT actual.*, customers.*, quotation.* FROM actual JOIN customers ON actual.customer_ID = customers.customer_ID JOIN quotation ON actual.quotation_ID = quotation.quotation_ID WHERE actual.no_actual = '".$_GET['no_actual']."'" );
$medicalFee = 0; //total medical fee
$travelFee = 0; //total travel fee
$downPayment = 0;

//display the items
while($invoice = mysqli_fetch_array($query)){
	$pdf->Cell(10	,10,'1',1,0,'C');
	//add thousand separator using number_format function
	$pdf->Cell(145	,10,'Consultation and registration',1,0);
	$pdf->Cell(35	,10,' ','LTR',1,'R');//end of line

	$pdf->Cell(10	,10,'2',1,0,'C');
	//add thousand separator using number_format function
	$pdf->Cell(145	,10,'Laboratorium checks',1,0);
	$pdf->Cell(35	,10,' ','LR',1,'R');//end of line

	$pdf->Cell(10	,10,'3',1,0,'C');
	//add thousand separator using number_format function
	$pdf->Cell(145	,10,'Growth factor activation',1,0);
	$pdf->Cell(35	,10,'','LR',1,'R');//end of line

	$pdf->Cell(10	,10,'4',1,0,'C');
	//add thousand separator using number_format function
	$pdf->Cell(145	,10,'Wharton Jelly 4cc',1,0);
	$pdf->Cell(35	,10,"Rp" . number_format($invoice['medicalFee']),'LR',1,'C');//end of line

	$pdf->Cell(10	,10,'5',1,0,'C');
	//add thousand separator using number_format function
	$pdf->Cell(145	,10,"Doctor's fee and medical items",1,0);
	$pdf->Cell(35	,10,' ','LR',1,'R');//end of line

	$pdf->Cell(155	,15,'',1,0);
	$pdf->Cell(35	,15,'','LBR',1,1);//end of line
	//accumulate medicalFee
	$medicalFee += $invoice['medicalFee'];
}
//summary
$pdf->SetFont('Arial','I',0,1);
$pdf->Cell(155	,10,'(1 KD = Rp 40.000)',1,0,'C');

$pdf->SetFont('Arial','',12);
$pdf->Cell(35	,10,"KD" . number_format($medicalFee/40000),1,1,'C');//end of line


//TRAVEL FEE//
$pdf->Cell(190	,50,'',0,1);
$pdf->SetFont('Arial','B',12);
$pdf->Cell(0	,5,'Travel in Jakarta',0,1,'C');

$pdf->SetFont('Arial','',12);
$pdf->Cell(0	,10,'(International flight ticket not included)',0,1,'C');
$pdf->Cell(10	,10,'No',1,0,'C');
$pdf->Cell(145	,10,'Travel Items',1,0,'C');
$pdf->Cell(35	,10,'Price',1,1,'C');//end of line

$pdf->SetFont('Arial','',12);

//Numbers are right-aligned so we give 'R' after new line parameter

//items
$query = mysqli_query($connect, "SELECT actual.*, customers.*, quotation.* FROM actual JOIN customers ON actual.customer_ID = customers.customer_ID JOIN quotation ON actual.quotation_ID = quotation.quotation_ID WHERE actual.no_actual = '".$_GET['no_actual']."'" );
$travelFee = 0; //total travelFee
$downPayment = 0;

//display the items
while($treatments = mysqli_fetch_array($query)){
	$pdf->Cell(10	,10,'1',1,0,'C');
	//add thousand separator using number_format function
	$pdf->Cell(145	,10,'Travel Package in Jakarta',1,0);
	$pdf->Cell(35	,10,' ','LTR',1,'R');//end of line

	$pdf->Cell(10	,10,'',1,0,'C');
	//add thousand separator using number_format function
	$pdf->Cell(145	,10,'5 star hotel - 2 deluxe room',1,0);
	$pdf->Cell(35	,10,' ','LR',1,'R');//end of line

	$pdf->Cell(10	,10,'',1,0,'C');
	//add thousand separator using number_format function
	$pdf->Cell(145	,10,'Private car',1,0);
	$pdf->Cell(35	,10,'','LR',1,'R');//end of line

	$pdf->Cell(10	,10,'',1,0,'C');
	//add thousand separator using number_format function
	$pdf->Cell(145	,10,'Meal package',1,0);
	$pdf->Cell(35	,10,"Rp" . number_format($invoice['travelFee']),'LR',1,'C');//end of line

	$pdf->Cell(10	,10,'',1,0,'C');
	//add thousand separator using number_format function
	$pdf->Cell(145	,10,"Private assistant & optional caregiver",1,0);
	$pdf->Cell(35	,10,' ','LR',1,'R');//end of line

	$pdf->Cell(155	,15,'',1,0);
	$pdf->Cell(35	,15,'','LBR',1,1);//end of line

//accumulate travelFee
	$travelFee += $invoice['travelFee'];	
	$downPayment += $invoice['downPayment'];
}
//summary
$pdf->SetFont('Arial','I','12');
$pdf->Cell(155	,10,'(1 KD = Rp 40.000)',1,0,'C');

$pdf->SetFont('Arial','','12');
$pdf->Cell(35	,10,"KD" . number_format($travelFee/40000),1,1,'C');//end of line


//total MEDICAL FEE dan TRAVEL FEE//
$pdf->SetFont('Arial','','12');
$pdf->Cell(190	,10,'',0,1);

$pdf->Cell(95	,5,'Total Treatment & Travel costs',0,0,'L');
$pdf->Cell(95	,5,"Rp" . number_format($medicalFee + $travelFee),0,1,'R');

$pdf->Cell(95	,5,'Down Payment',0,0,'L');
$pdf->Cell(95	,5,"Rp"	. number_format($invoice['downPayment']),0,1,'R');//end of line


$pdf->SetFont('Arial','B','12');

$pdf->Cell(95	,8,'Total to be paid',0,0,'L');
$pdf->Cell(95	,8,'Rp' . number_format(($medicalFee + $travelFee)-$downPayment),0,1,'R');//end of line


$pdf->Cell(55	,5,'Total to be in paid in KD',0,0,'L');
$pdf->SetFont('Arial','I','12');
$pdf->Cell(65	,5, '(1 KD = Rp 40.000)',0,0);
$pdf->SetFont('Arial','B','12');
$pdf->Cell(70	,5,"KD" . number_format((($medicalFee + $travelFee)-$downPayment)/40000),0,1,'R');



//payment terms//
$pdf->SetFont('Arial','','12');
$pdf->Cell(190,15,'',0,1);
$pdf->Cell(190	,8,'Payment terms are as follows :',0,1);//end of line

//add dummy cell at beginning of each line for indentation
$pdf->Cell(10	,8,'',0,0);
$pdf->Cell(90	,8,'1.	Payments must be completed 5 days after all treatment and travel are completed',0,1);

// $pdf->Cell(10	,5,'',0,0);
// $pdf->Cell(90	,5,$invoice['company'],0,1);

$pdf->Cell(10	,8,'',0,0);
$pdf->Cell(90	,8,'2.	All payments must be transferred to :',0,1);

$pdf->SetFont('Arial','B','11');

$pdf->Cell(25	,5,'',0,0);
$pdf->Cell(80	,5,'Bank Mandiri',0,1);

$pdf->Cell(25	,5,'',0,0);
$pdf->Cell(80	,5,'Palm Spring, Batam',0,1);

$pdf->Cell(25	,5,'',0,0);
$pdf->Cell(80	,5,'Account Name : PT Multi Kreasi Sinergia',0,1);

$pdf->Cell(25	,5,'',0,0);
$pdf->Cell(80	,5,'Account Number : 1090015905706',0,1);

$pdf->Cell(25	,5,'',0,0);
$pdf->Cell(80	,5,'SWIFT code : BMRIIDJA',0,1);




$pdf->Cell(0	,5,'',0,1);
$pdf->SetFont('Arial','','12');
$pdf->Cell(190	,5,'For more information please contact our administration staff :',0,1);
$pdf->Cell(190	,5,'Astri',0,1);
$pdf->Cell(190	,5,'+62 811 9118 008',0,1);
$pdf->Cell(190	,5,'astri@almanna.co',0,1);

$pdf->Cell(190	,5,'',0,1);
$pdf->SetFont('Arial','B','12');
$pdf->Cell(190	,8,'Almanna Team',0,1);



$pdf->Output();
?>