<?php
require('../../fpdf17/fpdf.php');

//db connection
include '../../koneksi.php';


//get invoices data
$query = mysqli_query($connect, "SELECT proforma.*, customers.*, quotation.* FROM proforma JOIN customers ON proforma.customer_ID = customers.customer_ID JOIN quotation ON proforma.quotation_ID = quotation.quotation_ID WHERE proforma.no_proforma = '".$_GET['no_proforma']."'" );
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
$pdf->Cell(59	,5,'PROFORMA INVOICE',0,1);//end of line

//set font to arial, regular, 12pt
$pdf->SetFont('Arial','',12);

$pdf->Cell(125	,5,'Almanna Street B-27',0,0);
$pdf->Cell(59	,5,'',0,1);//end of line

$pdf->Cell(125	,5,'Batam, Indonesia, 29433',0,0);
$pdf->Cell(25	,5,'Date',0,0);
$pdf->Cell(34	,5,$invoice['proformaDate'],0,1);//end of line

$pdf->Cell(125	,5,'Phone [+12345678]',0,0);
$pdf->Cell(25	,5,'Invoice #',0,0);
$pdf->Cell(34	,5,$invoice['no_proforma'],0,1);//end of line

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

$pdf->Cell(100	,5,'Here are the procedure and estimated pricing of your medical treatment in Indonesia :',0,1);
$pdf->Cell(100	,5,'1. Patient will be thoroughly check with standard lab checks',0,1);
$pdf->Cell(100	,5,'2. Growth factor will be activated by using the patients blood',0,1);
$pdf->Cell(100	,5,'3. Patient will then be injected by combination of Wharton jelly and growth factor',0,1);
$pdf->Cell(100	,5,'4. The therapy will be duplicated 4 times within 4 months timeframe',0,1);
//end of line


//MEDICAL FEE//
$pdf->Cell(190	,15,'',0,1);
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
$query = mysqli_query($connect, "SELECT proforma.*, customers.*, quotation.* FROM proforma JOIN customers ON proforma.customer_ID = customers.customer_ID JOIN quotation ON proforma.quotation_ID = quotation.quotation_ID WHERE proforma.no_proforma = '".$_GET['no_proforma']."'" );
$medicalFee = 0; //total medical fee
$travelFee = 0; //total travel fee

//display the items
while($treatments= mysqli_fetch_array($query)){
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
$pdf->Cell(190	,25,'',0,1);
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
$query = mysqli_query($connect, "SELECT proforma.*, customers.*, quotation.* FROM proforma JOIN customers ON proforma.customer_ID = customers.customer_ID JOIN quotation ON proforma.quotation_ID = quotation.quotation_ID WHERE proforma.no_proforma = '".$_GET['no_proforma']."'" );
$travelFee = 0; //total travelFee

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

//accumulate medicalFee
	$travelFee += $invoice['travelFee'];	
}
//summary
$pdf->SetFont('Arial','I','12');
$pdf->Cell(155	,10,'(1 KD = Rp 40.000)',1,0,'C');

$pdf->SetFont('Arial','','12');
$pdf->Cell(35	,10,"KD" . number_format($travelFee/40000),1,1,'C');//end of line



//total MEDICAL FEE dan TRAVEL FEE//


$pdf->SetFont('Arial','B','12');
$pdf->Cell(190	,10,'',0,1);

$pdf->Cell(95	,10,'Total Treatment & Travel',1,0,'C');
$pdf->Cell(95	,10,"Rp" . number_format($medicalFee + $travelFee),1,1,'C');

$pdf->SetFont('Arial','I','12');
$pdf->Cell(95	,10,'(1 KD = Rp 40.000)',1,0,'C');
$pdf->Cell(95	,10,"KD" . number_format(($medicalFee + $travelFee)/40000),1,1,'C');



//OPTIONAL FEE//
$pdf->Cell(190	,15,'',0,1);
$pdf->SetFont('Arial','I',12);
$pdf->Cell(0	,5,'Optional Travel to Bali 4 Days 3 Nights',0,1,'C');

$pdf->SetFont('Arial','',12);
$pdf->Cell(10	,10,'No',1,0,'C');
$pdf->Cell(145	,10,'Travel Items',1,0,'C');
$pdf->Cell(35	,10,'Price',1,1,'C');//end of line

//Numbers are right-aligned so we give 'R' after new line parameter

//items
$query = mysqli_query($connect, "SELECT proforma.*, customers.*, quotation.* FROM proforma JOIN customers ON proforma.customer_ID = customers.customer_ID JOIN quotation ON proforma.quotation_ID = quotation.quotation_ID WHERE proforma.no_proforma = '".$_GET['no_proforma']."'" );
$amount = 0; //total amount

//display the items
while($treatments = mysqli_fetch_array($query)){
	$pdf->Cell(10	,10,'',1,0,'C');
	//add thousand separator using number_format function
	$pdf->Cell(145	,10,'Air Ticket',1,0);
	$pdf->Cell(35	,10,' ','LR',1,'R');//end of line

	$pdf->Cell(10	,10,'',1,0,'C');
	//add thousand separator using number_format function
	$pdf->Cell(145	,10,'Transportation',1,0);
	$pdf->Cell(35	,10,'','LR',1,'R');//end of line

	$pdf->Cell(10	,10,'',1,0,'C');
	//add thousand separator using number_format function
	$pdf->Cell(145	,10,'Meal package',1,0);
	$pdf->Cell(35	,10,"Rp" . number_format($invoice['medicalFee']),'LR',1,'C');//end of line

	$pdf->Cell(10	,10,'',1,0,'C');
	//add thousand separator using number_format function
	$pdf->Cell(145	,10,"Private guide",1,0);
	$pdf->Cell(35	,10,' ','LR',1,'R');//end of line

	$pdf->Cell(10	,10,'',1,0,'C');
	$pdf->Cell(145	,10,'Hotel',1,0);
	$pdf->Cell(35	,10,'','LR',1,'R');

	$pdf->Cell(155	,15,'',1,0);
	$pdf->Cell(35	,15,'','LBR',1,1);//end of line

	//accumulate amount
	$amount += $invoice['medicalFee'];
}
//summary
$pdf->SetFont('Arial','I','12');
$pdf->Cell(155	,10,'(1 KD = Rp 40.000)',1,0,'C');

$pdf->SetFont('Arial','','12');
$pdf->Cell(35	,10,"KD" . number_format($amount/40000),1,1,'C');//end of line




//payment terms//
$pdf->Cell(100	,8,'Payment terms are as follows :',0,1);//end of line

//add dummy cell at beginning of each line for indentation
$pdf->Cell(10	,8,'',0,0);
$pdf->Cell(90	,8,'1.	50% down payment is needed for Treatment & Travel cost',0,1);

// $pdf->Cell(10	,5,'',0,0);
// $pdf->Cell(90	,5,$invoice['company'],0,1);

$pdf->Cell(10	,8,'',0,0);
$pdf->Cell(90	,8,'2.	All payments must be transferred to :',0,1);

$pdf->SetFont('Arial','B','12');

$pdf->Cell(15	,5,'',0,0);
$pdf->Cell(80	,5,'Bank Mandiri',0,1);

$pdf->Cell(15	,5,'',0,0);
$pdf->Cell(80	,5,'Palm Spring, Batam',0,1);

$pdf->Cell(15	,5,'',0,0);
$pdf->Cell(80	,5,'Account Name : PT Multi Kreasi Sinergia',0,1);

$pdf->Cell(15	,5,'',0,0);
$pdf->Cell(80	,5,'Account Number : 1090015905706',0,1);

$pdf->Cell(15	,5,'',0,0);
$pdf->Cell(80	,5,'SWIFT code : BMRIIDJA',0,1);

$pdf->Cell(0	,10,'',0,1);
$pdf->SetFont('Arial','I','12');
$pdf->Cell(190	,5,'Price shown for medical treatment and travel options could change at anytime according to patient',0,1);
$pdf->Cell(190	,5,'condition and needs.',0,1);

$pdf->Cell(0	,8,'',0,1);
$pdf->SetFont('Arial','','12');
$pdf->Cell(190	,5,'For more information please contact our administration staff :',0,1);
$pdf->Cell(190	,5,'Astri',0,1);
$pdf->Cell(190	,5,'+62 811 9118 008',0,1);
$pdf->Cell(190	,5,'astri@almanna.co',0,1);

$pdf->Cell(0	,20,'',0,1);
$pdf->SetFont('Arial','B','12');
$pdf->Cell(190	,5,'Almanna Team',0,1);



$pdf->Output();
?>