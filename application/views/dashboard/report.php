<?php 
    $event_name = $Events->event_name;
    $GLOBALS['event_name'] = $event_name;
    class MYPDF extends TCPDF {

    //Page header


    
    public function Header() {
        $myHeading = '';

        $myHeading .= '<table style="width:100%">';
        $myHeading .= '<thead>';

        $myHeading .= '<tr style="font-size:11px;">';
            $myHeading .= '<th colspan="15" style="text-align:center;"><b>DEPARTMENT OF SCIENCE AND TECHNOLOGY</b></th>';
        $myHeading .= '</tr>';
        $myHeading .= '<tr style="font-size:11px;">';
            $myHeading .= '<th colspan="15" style="text-align:center;">Caraga Regional Office</th>';
        $myHeading .= '</tr>';
        $myHeading .= '<tr style="font-size:11px;">';
            $myHeading .= '<th colspan="15" style="text-align:center;"><br><br><b>ATTENDANCE SHEET</b></th>';
        $myHeading .= '</tr>';

        $myHeading .= '<tr style="font-size:11px;">';
            $myHeading .= '<th colspan="2">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Title of Activity:</th>';
            $myHeading .= '<th style="border-bottom: 0.1pt thin black;" colspan="12">'.$GLOBALS['event_name'].'</th>';
            $myHeading .= '<th></th>';
        $myHeading .= '</tr>';

         $myHeading .= '<tr style="font-size:11px;">';
            $myHeading .= '<th colspan="2">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Venue:</th>';
            $myHeading .= '<th style="border-bottom: 0.1pt thin black;" colspan="12"></th>';
            $myHeading .= '<th></th>';
        $myHeading .= '</tr>';

         $myHeading .= '<tr style="font-size:11px;">';
            $myHeading .= '<th colspan="2">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Date:</th>';
            $myHeading .= '<th style="border-bottom: 0.1pt thin black;" colspan="12"></th>';
            $myHeading .= '<th></th>';
        $myHeading .= '</tr>';

        $myHeading .= '<tr style="font-size:11px;">';
            $myHeading .= '<th colspan="2">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Duration:</th>';
            $myHeading .= '<th style="border-bottom: 0.1pt thin black;" colspan="12"></th>';
            $myHeading .= '<th></th>';
        $myHeading .= '</tr>';

        $myHeading .= '<tr style="font-size:11px;">';
            $myHeading .= '<th></th>';
            $myHeading .= '<th></th>';
        $myHeading .= '</tr>';

        $myHeading .= '<tr style="font-size:11px;text-align:center;vertical-align: middle;">';
            $myHeading .= '<td style="width:3%; border: 0.1pt thin black;" rowspan="2" >No.</td>';
            $myHeading .= '<td style="width:18%; border: 0.1pt thin black;" rowspan="2" >Name <br>(Surname, Given Name, MI)</td>';
            $myHeading .= '<td style="width:4%; border: 0.1pt thin black;" colspan="2" >Sex</td>';
            $myHeading .= '<td style="width:14%; border: 0.1pt thin black;" colspan="4" >Age</td>';
            $myHeading .= '<td style="width:11%; border: 0.1pt thin black;" rowspan="2">Position/<br> Designation</td>';
            $myHeading .= '<td style="width:10%; border: 0.1pt thin black;" rowspan="2">Name of Firm/Institution</td>';
            $myHeading .= '<td style="width:11%; border: 0.1pt thin black;" rowspan="2">Address</td>';
            $myHeading .= '<td style="width:10%; border: 0.1pt thin black;" rowspan="2">Contact Number<br> Landline/Cellphone (Required)</td>';
            $myHeading .= '<td style="width:11%; border: 0.1pt thin black;" rowspan="2">Email Address <br>(Optional)</td>';
            $myHeading .= '<td style="width:8%; border: 0.1pt thin black;" rowspan="2" colspan="2" >Signature</td>';
        $myHeading .= '</tr>';
        
        $myHeading .= '<tr style="font-size:9px;text-align:center;vertical-align: middle;">';
            $myHeading .= '<td style="border: 0.1pt thin black;"  >M</td>';
            $myHeading .= '<td style="border: 0.1pt thin black;"  >F</td>';
            $myHeading .= '<td style="border: 0.1pt thin black;" >15-<br>30</td>';
            $myHeading .= '<td style="border: 0.1pt thin black;" >31-<br>45 </td>';
            $myHeading .= '<td style="border: 0.1pt thin black;" >46-<br>59</td>';
            $myHeading .= '<td style="border: 0.1pt thin black;" >60 &<br> Above</td>';
        $myHeading .= '</tr>';
        
        
        $myHeading .= '</thead>';
        $myHeading .= '</table>';


          $this->SetY(5);
          // $this->SetY($margin['top']);
        // Logo
        $image_file = K_PATH_IMAGES.'logo_example.jpg';
        $this->Image($image_file, 10, 10, 15, '', 'JPG', '', 'T', false, 300, '', false, false, 0, false, false, false);
        // Set font
        $this->SetFont('helvetica', '', 10);
        // Title
        // $this->Cell(0, 15, 'Department of Science and Technology aw', 0, false, 'C', 0, '', 0, false, 'M', 'M');

        // if ($this->page == 1) {
            // $html = '<p style="text-align:center">DEPARTMENT OF SCIENCE AND TECHNOLOGY<br>
            //        Regional Office No. 8 <br>
            //        Govt. Center, Candahug, Palo, Leyte <br>
            //        Tel. No. (053) 323-7066, Telefax (053) 323-7110 </p>';
            $html = $myHeading;
            $this->writeHTMLCell($w = 0, $h = 0, $x = '', $y = '', $html, $border = 0, $ln = 1, $fill = 0, $reseth = true, $align = 'top', $autopadding = true);

        // }
    }

    // Page footer
    public function Footer() {
        // Position at 15 mm from bottom
        $this->SetY(-15);
        // Set font
        $this->SetFont('helvetica', 'I', 8);
        $html = '';
        $html .= '';

        $html .= '<table width="100%">';
            $html .= '<tr>';
                $html .= '<th style="text-align:center;">Page '.$this->getAliasNumPage().' of '.$this->getAliasNbPages().' Page(s)</th>';
            $html .= '</tr>';

             $html .= '<tr>';
                $html .= '<td width="50%">';
                $html .= '<span style="font-size:8px;width:50%;text-align:justify;"><b>DATA PRIVACY CONSENT:</b> ';
                $html .= 'By filling-out this form, you agree with the Data Privacy Policy of the Department of Science & Technology Regional Office VIII (DOST VIII)';
                $html .= '(DOST VIII) and the National Privacy Commission (NPC). Both personal and non-personal information may be collected from you';
                $html .= 'for using this form. Rest assured that these data shall be kept safe and secured, and will not be shared with anyone except to';
                $html .= 'designated personnel who will process the needed information only for facilitating smooth participation and distribution of';
                $html .= 'materials for such event. The collective information derived from this event will be useful for the improvement of implementing';
                $html .= 'similar activities in the future.<br></span>';
                $html .= '</td>';
                $html .= '<td width="50%" style="text-align:right;"><br><br>PM-TO-TCS-08-03-F1<br>Revision No.6<br>19 November 2021</td>';
                // $html .= '<th width="50%;text-align:right;">PM-TO-TCS-08-03-F1<br>Revision No.6<br>19 November 2021</th>';
            $html .= '</tr>';
        $html .= '</table>';



        // Page number
        // $this->Cell(0, 10, 'Page '.$this->getAliasNumPage().'/'.$this->getAliasNbPages(), 0, false, 'C', 0, '', 0, false, 'T', 'M');
        // $html = '<div>';
        // $html .= '<span style="font-size:8px;width:50%;"><b>DATA PRIVACY CONSENT:</b>';
        // $html .= 'By filling-out this form, you agree with the Data Privacy Policy of the Department of Science & Technology Regional Office VIII (DOST VIII)';
        // $html .= '(DOST VIII) and the National Privacy Commission (NPC). Both personal and non-personal information may be collected from you';
        // $html .= 'for using this form. Rest assured that these data shall be kept safe and secured, and will not be shared with anyone except to';
        // $html .= 'designated personnel who will process the needed information only for facilitating smooth participation and distribution of';
        // $html .= 'materials for such event. The collective information derived from this event will be useful for the improvement of implementing';
        // $html .= 'similar activities in the future.<br></span>';


        // $html .= '<span style="text-align:right">PM-TO-TCS-08-03-F1<br>Revision No.6<br>19 November 2021</span></div>';
        // $html .= 'Page '.$this->getAliasNumPage().'/'.$this->getAliasNbPages();
        // $this->writeHTMLCell($w = 0, $h = 0, $x = '', $y = '', $html, $border = 0, $ln = 1, $fill = 0, $reseth = true, $align = 'top', $autopadding = true);
        $this->writeHTMLCell($w = 0, $h = 0, $x = '', $y = 186, $html, $border = 0, $ln = 1, $fill = 0, $reseth = true, $align = 'top', $autopadding = true);
        // $this->Cell(0, 10, 'Page '.$this->getAliasNumPage().' of '.$this->getAliasNbPages(), 0, false, 'C', 0, '', 0, false, 'T', 'M');
        // $this->Cell(0, 10, 'Page '.$this->getAliasNumPage().' of '.$this->getAliasNbPages(), 0, false, 'C', 0, '', 0, false, 'T', 'M');
    }
}

    // create new PDF document
    $pdf = new MYPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

    // set document information
    // $pdf->SetCreator(PDF_CREATOR);
    // $pdf->SetAuthor('Nicola Asuni');
    // $pdf->SetTitle('TCPDF Example 003');
    // $pdf->SetSubject('TCPDF Tutorial');
    // $pdf->SetKeywords('TCPDF, PDF, example, test, guide');

    // set default header data
    $pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE, PDF_HEADER_STRING);

    // set header and footer fonts
    $pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
    $pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

    // set default monospaced font
    $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

    // set margins
    // $pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
    // $pdf->SetMargins(5, PDF_MARGIN_TOP, 5);
    $pdf->SetMargins(10, 51.8, 10, true);
    $pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
    $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

    // set auto page breaks
    $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

    // set image scale factor
    $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

    // set some language-dependent strings (optional)
    if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
        require_once(dirname(__FILE__).'/lang/eng.php');
        $pdf->setLanguageArray($l);
    }

    // ---------------------------------------------------------

    // set font
    // $pdf->SetFont('', '', 11);

    // add a page
     // $this->SetY(5);
    $pdf->AddPage('L', 'A4');

    // set some text to print
    $txt = '';
    // $txt .='<p style="xter;font-size:11px; "><b>PURCHASE REQUEST</b><p>';
    // $txt .='<p style="text-align:center; "><b>PURCHASE REQUEST</b><p>';
    $txt .='<table cellpadding="2" style="width:100%">';
    $img = '<img style="height: 10px;" src="'.base_url("assets/dist/img/check.jpg").'" alt="" />';
    foreach ($data as $key => $var) {
        $key++;

        // $male = false;
        // $female = false;

        // if ($var['usr_gender'] == 'Male') {
        //     $male = true;
        //     $female = false;
        // }else{
        //     $male = false;
        //     $female = true;
        // }
        $images='<img src="'.base_url("assets/dist/img/check.jpg").'" width="150" />';
        $txt .= '<tr style="font-size:10px;text-align:center;vertical-align: middle;">';
            $txt .= '<td style="height:25px;width:3%; border: 0.1pt thin black;" >'.$key.'</td>';
            // $txt .= '<td style="width:18%; border: 0.1pt thin black;text-align:left !important;"  >'.$var['usr_fname'].' '.substr($var['usr_mname'],0,1).'. '.$var['usr_lname'].'</td>';
            $txt .= '<td style="width:18%; border: 0.1pt thin black;text-align:left !important;"  >'.$var['usr_lname'].', '.$var['usr_fname'].' '.substr($var['usr_mname'],0,1).'</td>';
            $txt .= '<td style="width:2%; border: 0.1pt thin black;">';
            
            if ($var['usr_gender'] == 'Male') {
                $txt .='/';
            }
            $txt .='</td>';
            $txt .= '<td style="width:2%; border: 0.1pt thin black;">';
            if ($var['usr_gender'] == 'Female') {
                $txt .='/';
            }
            $txt .='</td>';

            $dateOfBirth = $var['birth_date'];
            $today = date("Y-m-d");
            $diff = date_diff(date_create($dateOfBirth), date_create($today));
            $age = $diff->format('%y');

            $txt .= '<td style="width:3.5%; border: 0.1pt thin black;">';
                if ($age <= 30) {
                    $txt .= '/';
                }
            $txt .='</td>';
            $txt .= '<td style="width:3.5%; border: 0.1pt thin black;">';
                if ($age >= 31 && $age <=45) {
                    $txt .= '/';
                }
            $txt .='</td>';
            $txt .= '<td style="width:3.5%; border: 0.1pt thin black;">';
                if ($age >= 46 && $age <=59) {
                    $txt .= '/';
                }
            $txt .='</td>';
            $txt .= '<td style="width:3.5%; border: 0.1pt thin black;">';
                if ($age >= 60) {
                    $txt .= '/';
                }
            $txt .='</td>';

            $txt .= '<td style="width:11%; border: 0.1pt thin black;" >'.$var['usr_occupation'].'</td>';
            $txt .= '<td style="width:10%; border: 0.1pt thin black;" >'.$var['usr_institution'].'</td>';
            $txt .= '<td style="width:11%; border: 0.1pt thin black;" >'.$var['usr_municipality'].'</td>';
            $txt .= '<td style="width:10%; border: 0.1pt thin black;" >'.$var['usr_contact'].'</td>';
            $txt .= '<td style="width:11%; border: 0.1pt thin black; font-size:8px !impoerant;" >'.$var['usr_email'].'</td>';
            $txt .= '<td style="width:8%; border: 0.1pt thin black;" colspan="2" ></td>';
            // $txt .= '<td style="width:8%; border: 0.1pt thin black;" colspan="2" ><img style="height: 10px;" src="'.base_url("assets/dist/img/check.jpg").'" alt="" /></td>';
        $txt .= '</tr>';
    }

    $txt .='</table>';

    $pdf->writeHTML($txt, true, false, false, false, '');
    $filename = 'Report.pdf';

    $pdf->Output($filename, 'I');



 ?>


