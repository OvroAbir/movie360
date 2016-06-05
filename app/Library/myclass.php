<?php namespace App\Library 
{
	use Fpdf;

    class myclass
    {
        function Header()
		{
		    // Logo
		    Fpdf::Image('C:\xampp\htdocs\project\public\images\logo.gif',10,6,190);
		    Fpdf::SetY(70);
		    // Arial bold 15
		    Fpdf::SetFont('Arial','B',15);
		    // Move to the right
		    Fpdf::Cell(80);
		    // Title
		    Fpdf::Cell(30,10,'Movies360',1,0,'C');
		    // Line break
		    Fpdf::Ln(20);
		}

		// Page footer
		function Footer()
		{
		    // Position at 1.5 cm from bottom
		    Fpdf::SetY(-15);
		    // Arial italic 8
		    Fpdf::SetFont('Arial','I',8);
		    // Page number
		    Fpdf::Cell(0,10,'Page '.Fpdf::PageNo().'/{nb}',0,0,'C');
		}

		function BasicTable($header, $data)
		{
		    // Header
		    foreach($header as $col)
		        Fpdf::Cell(40,7,$col,1);
		    Fpdf::Ln();
		    // Data
		    foreach($data as $row)
		    {
		        foreach($row as $col)
		            Fpdf::Cell(40,6,$col,1);
		        Fpdf::Ln();
		    }
		}

		// Better table
		function ImprovedTable($header, $data)
		{
		    // Column widths
		    $w = array(40, 35, 40, 45);
		    // Header
		    for($i=0;$i<count($header);$i++)
		        Fpdf::Cell($w[$i],7,$header[$i],1,0,'C');
		    Fpdf::Ln();
		    // Data
		    foreach($data as $row)
		    {
		        Fpdf::Cell($w[0],6,$row[0],'LR');
		        Fpdf::Cell($w[1],6,$row[1],'LR');
		        Fpdf::Cell($w[2],6,number_format($row[2]),'LR',0,'R');
		        Fpdf::Cell($w[3],6,number_format($row[3]),'LR',0,'R');
		        Fpdf::Ln();
		    }
		    // Closing line
		    Fpdf::Cell(array_sum($w),0,'','T');
		}

		// Colored table
		function FancyTable($data)
		{
		    // Colors, line width and bold font
		    Fpdf::SetFillColor(255,0,0);
		    Fpdf::SetTextColor(255);
		    Fpdf::SetDrawColor(128,0,0);
		    Fpdf::SetLineWidth(.3);
		    Fpdf::SetFont('','B');
		    // Header
		    $w = array(40, 35, 40, 45);
		    //for($i=0;$i<count($header);$i++)
		    //    Fpdf::Cell($w[$i],7,$header[$i],1,0,'C',true);
		    Fpdf::Ln();
		    // Color and font restoration
		    Fpdf::SetFillColor(224,235,255);
		    Fpdf::SetTextColor(0);
		    Fpdf::SetFont('');
		    // Data
		    $fill = false;
		    foreach($data as $row)
		    {
		        Fpdf::Cell($w[0],6,$row[0],'LR',0,'L',$fill);
		        Fpdf::Cell($w[1],6,$row[1],'LR',0,'L',$fill);
		        //Fpdf::Cell($w[2],6,number_format($row[2]),'LR',0,'R',$fill);
		       // Fpdf::Cell($w[3],6,number_format($row[3]),'LR',0,'R',$fill);
		        Fpdf::Ln();
		        $fill = !$fill;
		    }
		    // Closing line
		    Fpdf::Cell(array_sum($w),0,'','T');
		}
	}
}
?>