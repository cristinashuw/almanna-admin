<?php
require('../../fpdf17/fpdf.php');

//db connection
include '../../koneksi.php';


//get receipts data
$query = mysqli_query($connect, "SELECT kwitansi.*, customers.*, quotation.* FROM kwitansi JOIN customers ON kwitansi.customer_ID = customers.customer_ID JOIN quotation ON kwitansi.quotation_ID = quotation.quotation_ID WHERE kwitansi.no_kwitansi = '".$_GET['no_kwitansi']."'" );
$kwitansi = mysqli_fetch_array($query);

class PDF extends FPDF
{
// Page header
	

function Header()
{
    // Logo
    $this->Image('../../fpdf17/logoAlmanna.jpg',70,5,60);
    // Arial bold 15
    $this->SetFont('Arial','B',15);
    // // Move to the right
    // $this->Cell(80);
    // Line break
    $this->Ln(0);
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

$pdf->Line(30, 70, 100, 70);
$pdf->Line(135, 70, 190, 70);
$pdf->Line(50, 78, 160, 78);

//Cell(width , height , text , border , end line , [align] )
$pdf->Cell(142	,5,'RECEIPT',0,0);
$pdf->Cell(0	,5,'ALMANNA',0,1);//end of line

//set font to arial, regular, 12pt
$pdf->SetFont('Arial','',12);

$pdf->Cell(10	,5,'No. :',0,0);
$pdf->Cell(132	,5,$kwitansi['no_kwitansi'],0,0);
$pdf->Cell(0	,5,'Almanna Street B-27',0,1);//end of line


$pdf->Cell(142	,5,$kwitansi['paymentDate'],0,0);
$pdf->Cell(0	,5,'Batam, Indonesia, 29433',0,1);//end of line

$pdf->Cell(142	,5,'',0,0);
$pdf->Cell(0	,5,'Phone [+12345678]',0,1);

$pdf->Cell(142	,5,'',0,0);
$pdf->Cell(0	,5,'Fax [+12345678]',0,1);


$pdf->Cell(0	,10,'',0,1);
$pdf->SetFont('Arial','B','12');

$pdf->Cell(25	,8,'AMOUNT ',0,0);
$pdf->SetFont('Arial','','12');
$pdf->Cell(40	,8,'Rp ' . number_format($kwitansi['downPayment']),1,1,'R');

$pdf->Cell(0	,10, '',0,1);

$pdf->Cell(15	,8,'Received ',0,0);
$pdf->Cell(80	,8, $kwitansi['keterangan'],0,0,'C');
$pdf->Cell(15	,8, 'Rupiah',0,0);
$pdf->Cell(20	,8,' from ',0,0);
$pdf->Cell(30	,8,	$kwitansi['customer_name'],0,1,'C');


$pdf->SetFont('Arial','','12');
$pdf->Cell(50	,8,'For the Payment of',0,0);
$pdf->Cell(100	,8, $kwitansi['order_name'],0,0,'C');

$pdf->Cell(40	,8, '.',0,1);


//manggil query lagi untuk hitung total dan KD nya//
$query = mysqli_query($connect, "SELECT kwitansi.*, customers.*, quotation.* FROM kwitansi JOIN customers ON kwitansi.customer_ID = customers.customer_ID JOIN quotation ON kwitansi.quotation_ID = quotation.quotation_ID WHERE kwitansi.no_kwitansi = '".$_GET['no_kwitansi']."'" );

$downPayment = 0;
$medicalFee = 0;
$travelFee = 0;
$optionalFee = 0;

while($kwitansi = mysqli_fetch_array($query)){
	$downPayment += $kwitansi['downPayment'];
	$medicalFee += $kwitansi['medicalFee'];
	$travelFee += $kwitansi['travelFee'];
	$optionalFee += $kwitansi['optionalFee'];
	$customer_name = $kwitansi['customer_name'];
}
// end //

$pdf->Cell(0	,15,'',0,1);  //spasi//

$pdf->Cell(32	,8,'',0,0);
$pdf->Cell(10	,8,'KD',1,0,'C');
$pdf->Cell(20	,8, number_format(($medicalFee + $travelFee + $optionalFee)/40000),1,0,'R');
$pdf->SetFont('Arial','B','12');
$pdf->Cell(50	,8,'Total Payment',1,0,'C');
$pdf->SetFont('Arial','','12');
$pdf->Cell(10	,8,"Rp",1,0,'C');
$pdf->Cell(35	,8, number_format($medicalFee + $travelFee + $optionalFee),1,1,'R');


$pdf->Cell(32	,8,'',0,0);
$pdf->Cell(10	,8,'KD',1,0,'C');
$pdf->Cell(20	,8, number_format($downPayment/40000),1,0,'R');
$pdf->SetFont('Arial','B','12');
$pdf->Cell(50	,8,'Down Payment (50%)',1,0,'C');
$pdf->SetFont('Arial','','12');
$pdf->Cell(10	,8,"Rp",1,0,'C');
$pdf->Cell(35	,8, number_format($downPayment),1,1,'R');

$pdf->SetTextColor(255,0,0);
$pdf->Cell(32	,8,'',0,0);
$pdf->Cell(10	,8,'KD',1,0,'C');
$pdf->Cell(20	,8, number_format((($medicalFee + $travelFee + $optionalFee) - $downPayment)/40000),1,0,'R');
$pdf->SetFont('Arial','B','12');
$pdf->Cell(50	,8,'Total to be Paid',1,0,'C');
$pdf->SetFont('Arial','','12');
$pdf->Cell(10	,8,"Rp",1,0,'C');
$pdf->Cell(35	,8, number_format(($medicalFee + $travelFee + $optionalFee) - $downPayment),1,1,'R');


$pdf->SetTextColor(0,0,0);
$pdf->Cell(190	,15,'',0,1);
$pdf->SetFont('Arial','I','12');
$pdf->Cell(10	,5,'Receiver,  ',0,0,'L');
$pdf->Cell(0	,5,'Received by,  ',0,1,'R');

$pdf->Cell(0	,15,'',0,1);
$pdf->SetFont('Arial','B','12');
$pdf->Cell(0	,5,$customer_name,0,0,'L');
$pdf->Cell(0	,5,'Almanna Team',0,1,'R');

$pdf->Output();
?>