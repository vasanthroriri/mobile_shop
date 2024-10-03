<?php
    include "../class.php";

//    echo  $id = $_GET['payment_id'];
   $id = $_GET['tran_id'];
    // $id = 1;

    // Validate and sanitize the input
    if (!is_numeric($id)) {
        die("Invalid payment ID");
    }     

    $select_sql = "SELECT 
    `tran_id`
    , `tran_date`
    , `tran_amount`
    , `tran_method`
    , `tran_transaction_id`
    , `tran_reason` 
    FROM `jeno_transaction`
    WHERE tran_category ='Income'
    AND tran_status ='Active' 
    AND tran_id =$id;";


    $result = $conn->query($select_sql);

    if ($result->num_rows > 0) {
        
    // Output data of each row
    $row = $result->fetch_assoc();
    $pay_date =$row['tran_date'];

        $tran_id = $row['tran_id'];
        $tran_date = date('d-m-Y', strtotime($pay_date));
        $tran_amount = $row['tran_amount'];
        $tran_method = $row['tran_method'];
        $tran_transaction_id = $row['tran_transaction_id'];
        $tran_reason = $row['tran_reason'];
        

    
    } else {
    echo "0 results";
    }







    $conn->close();

    function numberToWords($number) {
        $words = array(
            0 => '',
            1 => 'one',
            2 => 'two',
            3 => 'three',
            4 => 'four',
            5 => 'five',
            6 => 'six',
            7 => 'seven',
            8 => 'eight',
            9 => 'nine',
            10 => 'ten',
            11 => 'eleven',
            12 => 'twelve',
            13 => 'thirteen',
            14 => 'fourteen',
            15 => 'fifteen',
            16 => 'sixteen',
            17 => 'seventeen',
            18 => 'eighteen',
            19 => 'nineteen',
            20 => 'twenty',
            30 => 'thirty',
            40 => 'forty',
            50 => 'fifty',
            60 => 'sixty',
            70 => 'seventy',
            80 => 'eighty',
            90 => 'ninety',
            100 => 'hundred',
            1000 => 'thousand',
            1000000 => 'million',
            1000000000 => 'billion',
        );
    
        if ($number == 0) {
            return 'zero';
        }
    
        if ($number < 21) {
            return $words[$number];
        }
    
        if ($number < 100) {
            return $words[10 * floor($number / 10)] . ' ' . $words[$number % 10];
        }
    
        if ($number < 1000) {
            return $words[floor($number / 100)] . ' hundred ' . numberToWords($number % 100);
        }
    
        if ($number < 1000000) {
            return numberToWords(floor($number / 1000)) . ' thousand ' . numberToWords($number % 1000);
        }
    
        if ($number < 1000000000) {
            return numberToWords(floor($number / 1000000)) . ' million ' . numberToWords($number % 1000000);
        }
    
        return numberToWords(floor($number / 1000000000)) . ' billion ' . numberToWords($number % 1000000000);
    }
    

    // Include the FPDF library
    require('../fpdf186/fpdf.php');

    // Create a class extending FPDF
    class PDF extends FPDF
    {
    // Header
    function Header()
    {
        // Set font to Arial bold 15
        $this->SetFont('Arial', 'B', 16);

        // Title
        $this->Cell(0, 8, 'Bill Receipt', 0, 1, 'C');
        $this->Ln(1);

        // Move to the right
        $this->Cell(70);

        // Left logo
        $this->Image('../image/jenoLogopng.png', 10, 4, 40); // Adjust the path and size as needed

        
        // Company name
        $this->SetFont('Arial', 'B', 12);
        $this->Cell(0, 8, 'JENO STUDY CENTER ', 0, 1, 'R');
        

        // Address
        $this->SetFont('Arial', '', 8);
        $this->Cell(0, 10, 'Westen Tower Complex, II and Floor , Opp ,Cathedral Church, Murugankurichi Palayamkottai,Tirunelveli - 2 Ph - 04622912601', 0, 1, 'R');
        // Line break
        $this->Ln(2);
    }

    // Footer
        function Footer()
        {
            $this->SetY(-35);
            $this->SetFont('Arial', 'B', 12);
            $this->SetFont('Arial', 'B', 12);
            $this->Cell(0,10,"Checked By",0,1,"C");
            $this->SetY(-35);
            $this->Cell(0,10,"For JEO",0,1,"R");
            
            
            
            
            
            $this->Ln(1);
            $this->SetY(-25);
            $this->Cell(0,10,"",'B',1);
            $this->Ln(10); // Adjust the line height as needed
            $this->SetY(-25);
            $this->SetFont('Arial', '', 10);
            $this->Cell(0,10,"Mobile : 9894653254  || email : contact@jeno.com   ",0,1,"c");
            $this->SetY(-23);
            $this->Cell(0,6,"Thankyou from Jeno Study Center MS University.",0,1,"R");
            
            // Position at 1.5 cm from bottom
            $this->SetY(-15);
           
        }
    }

    // Create a new PDF instance
    $pdf = new PDF('L', 'mm', array(148, 210));
    $pdf->AliasNbPages();
    $pdf->AddPage();

    // Set font for the document
    $pdf->SetFont('Arial', '', 12);

    // Add invoice content
    $pdf->Cell(0, 8, 'Receipt Number: BRT-00'.$tran_id, 'T', 0,'L');
    $pdf->Cell(0, 8, 'Date: ' . $tran_date, 'T', 1,'R');
    if($tran_method =='Online'){
        $pdf->Cell(0, 8, 'Transaction Id  :'.$tran_transaction_id, 0, 1,'R');
    }else {
        $pdf->Cell(0, 8, '', 0, 1,'R');
    }
    
    $pdf->Ln(2); // Move to the next line

    // Add item details to the table
    
    $pdf->SetFont('Arial', 'B', 10);
    $pdf->Cell(40, 10, 'S.No', 1, 0, 'C'); 
    $pdf->Cell(50, 10, 'Payment Method', 1, 0, 'C');// Changed alignment to center
    $pdf->Cell(50, 10, 'Biil Reason', 1, 0, 'C'); // Adjusted width and changed alignment to center 
    $pdf->Cell(50, 10, 'Total Amount', 1, 1, 'C'); // Adjusted width and changed alignment to center
    $pdf->SetFont('Arial', '', 10);

    
    $pdf->Cell(40, 10, 1, 1);
    $pdf->Cell(50, 10, $tran_method, 1);  
    $pdf->Cell(50, 10, $tran_reason, 1,0,'R');  
    $pdf->Cell(50, 10, $tran_amount, 1, 0,'R'); // Border on the left and right sides

    $pdf->Ln();
 
   
    // Format the total amount to two decimal places
    $formattedTotalAmt = number_format($tran_amount, 2, '.', ',');

    // Convert total amount to words
    $totalAmtInWords = numberToWords($tran_amount);
    $totalAmtInWords = preg_replace('/\bzero\b/', '', $totalAmtInWords); // Remove 'zero' if present
    $pdf->SetFont('Arial', 'B', 12);
    $pdf->Cell(100, 10, ucfirst($totalAmtInWords), 1, 0, 'C'); // No border, aligned left, and move to next line
    // Add the cell with the "Total:" label
    $pdf->Cell(40, 10, 'Total:', 1, 0, 'R'); // Adjusted alignment to left for the label
    // Add the cell with the formatted total amount, aligned to the right
    $pdf->Cell(50, 10, $formattedTotalAmt, 1, 1, 'R'); // Adjusted alignment to right for the total amount

    // Add the cell with the total amount in words


    

    $filename = "_JenoBill.pdf";
    // No need to specify the file path
    $pdf->Output("$filename", 'D'); // Force download the PDF
    //echo "PDF invoice created successfully.";
?>
