<?php
defined('BASEPATH') OR exit('No direct script access allowed');
header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Methods: GET, OPTIONS");

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Writer\Html;

class Dashboard extends CI_Controller {

	function __construct() {
  		date_default_timezone_set('Asia/Manila');
		parent::__construct();
		$this->load->library('Pdf');
       	$this->load->model('Dashboard_model');
       	$this->load->model('Admin_model');
	 	   // $this->load->model('Hrmis_model', 'hrmis');
    }
	public function index()
	{
		// $data = [
		// 	'usr_table' => $this->Dashboard_model->getTbl('usr_table','usr_lname','asc'),
		// ];
		$this->load->view('dashboard/index');
		// $this->load->view('dashboard/index',$data);
	}
	public function InsertTimeIn(){
		date_default_timezone_set('Asia/Manila');
		$data = $this->input->post('data');
		$post_event_id = $this->input->post('event_id');

		$date = date('Y-m-d');
		$time = date('H:i:s');
	
		$verify = $this->Dashboard_model->getData(['qrcode' =>$data],'usr_table');
		
		// $usr_id = $this->input->post('usr_id');
		// $verify = $this->Dashboard_model->getData(['usr_id' =>$usr_id],'usr_table');
		$event_id_list = explode(',', $verify->event_approved_id);
		$error_message = array();
		
		if ($verify == TRUE) {
         	if (in_array($post_event_id, $event_id_list)) {
				$array = array(
	         		'qrcode' => $data,
					'date' => $date,
					'time' => $time,
					'event_id' => $this->input->post('event_id'),
				);

	        	$this->Dashboard_model->insert('attendance',$array);


				echo json_encode(array(
					'success' => true,
					'date' => $date,
					'time' => $time,
					'firstname' => $verify->usr_fname,
					'middlename' => $verify->usr_mname,
					'surname' => $verify->usr_lname
				));
			}else{
				$approved_events = $this->Admin_model->eventListUser($event_id_list);
				$errorM = '';

				$errorM .= '<b>'.$verify->usr_fname.' '.$verify->usr_lname.'</b> - <span class="highlight">Not Pre Registered</span>';
				$errorM .= '<p>For your guidance, please refer to the sessions with your approved registration below:</p>';	
				foreach ($approved_events as $value) {
					$errorM .= $value->event_name.'<br>';
				}
				// array_push($error_message, $errorM);
				echo json_encode(array(
					'error' => true,
					'error_message' => $errorM,
				));
			}

		}else{
			echo json_encode(array('not_allowed' => true));
		}

	}

	public function InsertTimeInButton(){
		date_default_timezone_set('Asia/Manila');
		$usr_id = $this->input->post('usr_id');

		$date = date('Y-m-d');
		$time = date('H:i:s');

		$verify = $this->Dashboard_model->getData(['usr_id' =>$usr_id],'usr_table');

		if ($verify == TRUE) {
         	$array = array(
         		'qrcode' => $verify->qrcode,
				'date' => $date,
				'time' => $time,
				'event_id' => $this->input->post('event_id'),
			);

        	$this->Dashboard_model->insert('attendance',$array);


			echo json_encode(array(
				'success' => true,
				'date' => $date,
				'time' => $time,
				'firstname' => $verify->usr_fname,
				'middlename' => $verify->usr_mname,
				'surname' => $verify->usr_lname
			));
		}else{
			echo json_encode(array('not_allowed' => true));
		}

	}

	public function EmployeeRecordsAttendance(){
		date_default_timezone_set('Asia/Manila');
		$date = date('Y-m-d');
		$where = [
			'a.date' => $date,
			'a.event_id' => $this->input->post('event_id')
		];
		$data = $this->Dashboard_model->EmployeeRecordsAttendance($where);
		echo json_encode($data);
	}

	public function SearchEmployee(){
		$array = [
			'qrcode' => $this->input->post('qrcode'),
			'date' => $this->input->post('date'),
			'event_id' => $this->input->post('event_id'),
		];
		$data = $this->Dashboard_model->SearchEmployee($array);
		echo json_encode($data);
	}

	public function fetch(){
		$result = $this->hrmis->odbc_select();
		var_dump($result);
	}


	public function DTRSync(){
		$this->load->view('dashboard/DTRSync');
	}

	public function syncData(){

	    $order_by = [
            'a' => 'id',
            'b' => 'asc'
        ];
	    $where = [
            "date" => $this->input->post('dtrDate')
        ];

	    $data = $this->Dashboard_model->select_table_whereOrderByApi($where,$order_by,"dtr");

	    echo json_encode($data);
	}

	public function passData(){
		ini_set('memory_limit', '-1');
		ini_set('max_execution_time', 0);
		set_time_limit(0);
		foreach ( $this->input->post('data') as $val) {
			// echo $val['id'].'-';
		}
	}

	public function AutoSync(){
		$this->load->view('dashboard/AutoSync');
	}

	public function LoadSync(){
		$date = date('Y-m-d');
		$day = date('D');
			
		if($day == 'Mon') { 
			$dateFrom = date('Y-m-d', strtotime('-3 day', strtotime($date)));
		} else {
		   $dateFrom = date('Y-m-d', strtotime('-1 day', strtotime($date)));
		}
	   $order_by = [
         'a' => 'id',
         'b' => 'asc'
      ];
	   $where = [
         "date >=" => $dateFrom,
         "date <=" => $date
      ];

	   $data = $this->Dashboard_model->select_table_whereOrderByApi($where,$order_by,"dtr");

	   echo json_encode($data);

	}
	public function AutoSyncData(){
		// print_r($_POST);
		foreach ($this->input->post('data') as $key => $value) {
			$data = [
	            'usr_fname' => $value['usr_fname'],
	            'usr_mname' => $value['usr_mname'],
	            'usr_lname' => $value['usr_lname'],
	            'birth_date' => $value['birth_date'],
	            'usr_gender' => $value['usr_gender'],
	            'usr_contact' => $value['usr_contact'],
	            'usr_municipality' => $value['usr_municipality'],
	            'usr_occupation' => $value['usr_occupation'],
	            'usr_institution' => $value['usr_institution'],
	            'usr_email' => $value['usr_email'],
	            'usr_sector' => $value['usr_sector'],
	            'usr_sector_other' => $value['usr_sector_other'],
	            'qrcode' => $value['qrcode'] 
	        ];

        $array_verify = array(
            'usr_fname' => $value['usr_fname'],
            'usr_lname' => $value['usr_lname'],
        );

        $verify = $this->Dashboard_model->getData($array_verify,'usr_table');
        
        if ($verify) {
            echo json_encode(array('invalid' => true));
        }else{
            $this->Dashboard_model->insert("usr_table",$data);
        }
		}

	   // echo json_encode($data);
	}


	public function EmployeeRecords(){

        
         $order_by = [
            'a' => 'usr_lname',
            'b' => 'asc'
        ];
	    $where = [
            "status" => 0
        ];

	    $data = $this->Dashboard_model->select_table_whereOrderBy($where,$order_by,"usr_table");
	    echo json_encode($data);
	}

	
	public function EventList(){
		$order_by = [
            'a' => 'event_name',
            'b' => 'asc'
        ];
        $data = $this->Dashboard_model->select_table_OrderBy($order_by,"tbl_events");
        echo json_encode($data);
	}

	public function Addevent(){
		$verify = $this->Dashboard_model->getData(['event_name' => $this->input->post('event_name')],'tbl_events');

		if ($verify) {
			echo json_encode(array('duplicate' => true));
		}else{
			$this->Dashboard_model->insert("tbl_events",
			[
				'event_name' => $this->input->post('event_name'),
				'event_date' => $this->input->post('event_date'),
				'maximum' => $this->input->post('maximum'),
			]);
			echo json_encode(array('success' => true));
		}
	}

	public function getEventData(){
		$data = $this->Dashboard_model->getData(['event_id' => $this->input->post('event_id')],'tbl_events');
		echo json_encode($data);
	}

	public function EditEvent(){
		$array_verify = array(
            'event_name' => $this->input->post('event_name'),
            'event_id !=' => $this->input->post('event_id')
        );
		$data = [
			'event_name' => $this->input->post('event_name'),
			'event_date' => $this->input->post('event_date'),
			'maximum' => $this->input->post('maximum'),
		];
		$verify = $this->Dashboard_model->getData($array_verify,'tbl_events');
		if ($verify) {
			echo json_encode(array('duplicate' => true));
		}else{
			$this->Dashboard_model->update_table(['event_id' => $this->input->post('event_id')], $data,'tbl_events');
			$affected_rows = $this->db->affected_rows();
            if ($affected_rows >= 1) {
                echo json_encode(array('success' => true));
            }else{
                echo json_encode(array('same_value' => true));
            }
		}
	}

	public function Deleteevent(){
		// $verify = $this->Dashboard_model->getData(['charge_to' => $this->input->post('event_id')],'tbl_ppmp');

		// if ($verify) {
		// 	echo json_encode(array('not_allowed' => true));
		// }else{
			$this->Dashboard_model->delete_table_where(["event_id" => $this->input->post('event_id')],"tbl_events");
			echo json_encode(array('success' => true));
		// }
	}

	public function EventAttendance($event_id){
		$tbl_events = $this->Dashboard_model->getData(['event_id' =>$event_id],'tbl_events');

		$data = [
			'tbl_events' => $tbl_events,
			'usr_table' => $this->Dashboard_model->getTbl('usr_table','usr_lname','asc'),
		];
		// $this->load->view('dashboard/index');
		$this->load->view('dashboard/EventAttendance',$data);
	}

	public function GetEmployee(){
		$order_by =[
		    'a' => 'usr_lname',
            'b' => 'asc'
        ];
		$user = $this->Dashboard_model->select_table_whereOrderBy(['approval_status' =>1],$order_by,"usr_table");
		echo json_encode($user);
	}

	public function sample(){
		// echo "string";

		require 'vendor/autoload.php';

		$spreadsheet = new Spreadsheet();
		$sheet = $spreadsheet->getActiveSheet();
		
		$headingStyle = [
		    'alignment' => [
		        'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
		    ],
		];


		$headingStyle2 = [
		    'alignment' => [
		        'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
		    ],
		];

		$borderBottom = [
			'borders' => [
		        'bottom' => [
		            'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
		        ],
		   	]
		];

		$borderBottomDotted = [
			'borders' => [
		        'bottom' => [
		            'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_DOTTED,
		        ],
		   	]
		];

		$borderTopDotted = [
			'borders' => [
		        'top' => [
		            'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_DOTTED,
		        ],
		   	]
		];

		$borderRightDotted = [
			'borders' => [
		        'right' => [
		            'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_DOTTED,
		        ],
		   	]
		];

		$borderTopBottomDotted = [
			'borders' => [
		        'bottom' => [
		            'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_DOTTED,
		        ],
		        'top' => [
		            'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_DOTTED,
		        ],
		   	]
		];

		$borderTopBottom = [
			'borders' => [
		        'bottom' => [
		            'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
		        ],
		        'top' => [
		            'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
		        ],
		   	]
		];

		$borderTop = [
			'borders' => [
		        'top' => [
		            'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
		        ],
		   	]
		];

		$BorderAll = [
			'borders' => [
		  		'allBorders' => [
		            'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
		        ]
		   	],
		];

		$headborder = [
			'borders' => [
		  		'allBorders' => [
		            'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_DOTTED,
		        ]
		   	],
		   	'alignment' => [
				'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
		        'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
		    ]
		];

		$center = [
			'alignment' => [
				'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
		        'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
		    ]
		];

		$centerTop = [
			'alignment' => [
				'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
		        'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_TOP,
		    ]
		];

		$bold = [
		    'font' => [
		        'bold' => true,
		    ],
		];

		$styleArrayItem = [
		    'borders' => [
		  		'right' => [
		            'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_DOTTED,
		        ]
		   	],
		   	'alignment' => [
				'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
		        'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_TOP,
		    ]
		];

		$left = [
			'alignment' => [
				'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_LEFT,
		    ]
		];

		$right = [
			'alignment' => [
				'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_RIGHT,
		    ]
		];

		$font10 = [
		   	'font' => [
		        'size' => 10,
		    ]
		];

		$font9 = [
		   	'font' => [
		        'size' => 9,
		    ]
		];

		$font8 = [
		   	'font' => [
		        'size' => 8,
		    ]
		];


		$spreadsheet->getActiveSheet()->getColumnDimension('A')->setWidth(4);
		$spreadsheet->getActiveSheet()->getColumnDimension('B')->setWidth(24);
		$spreadsheet->getActiveSheet()->getColumnDimension('C')->setWidth(3);
		$spreadsheet->getActiveSheet()->getColumnDimension('D')->setWidth(3);
		$spreadsheet->getActiveSheet()->getColumnDimension('E')->setWidth(4);
		$spreadsheet->getActiveSheet()->getColumnDimension('F')->setWidth(4);
		$spreadsheet->getActiveSheet()->getColumnDimension('G')->setWidth(4);
		$spreadsheet->getActiveSheet()->getColumnDimension('H')->setWidth(6);
		$spreadsheet->getActiveSheet()->getColumnDimension('I')->setWidth(16);
		$spreadsheet->getActiveSheet()->getColumnDimension('J')->setWidth(13);
		$spreadsheet->getActiveSheet()->getColumnDimension('K')->setWidth(19);
		$spreadsheet->getActiveSheet()->getColumnDimension('L')->setWidth(14);
		$spreadsheet->getActiveSheet()->getColumnDimension('M')->setWidth(18);
		$spreadsheet->getActiveSheet()->getColumnDimension('N')->setWidth(9);
		$spreadsheet->getActiveSheet()->getColumnDimension('O')->setWidth(3);



		// $sheet->setCellValue('A1', 'DEPARTMENT OF SCIENCE AND TECHNOLOGY');
		// $sheet->setCellValue('A2', 'Regional Office No. 8');
		// $sheet->setCellValue('A4', 'ATTENDANCE SHEET');
		// $spreadsheet->getActiveSheet()->mergeCells('A1:O1');
		// $spreadsheet->getActiveSheet()->mergeCells('A2:O2');
		// $spreadsheet->getActiveSheet()->mergeCells('A4:O4');
		// $spreadsheet->getActiveSheet()->getStyle('A1')->applyFromArray($bold);
		// $spreadsheet->getActiveSheet()->getStyle('A1:O4')->applyFromArray($center);
		// $spreadsheet->getActiveSheet()->getStyle('A4')->applyFromArray($bold);

		$sheet->setCellValue('A2', ' Title of Activity:');
		$sheet->setCellValue('A3', ' Venue:');
		$sheet->setCellValue('A4', ' Date:');
		$sheet->setCellValue('A5', ' Duration:');
		$spreadsheet->getActiveSheet()->mergeCells('A2:B2');
		$spreadsheet->getActiveSheet()->mergeCells('C2:N2');
		$spreadsheet->getActiveSheet()->mergeCells('C3:N3');
		$spreadsheet->getActiveSheet()->mergeCells('C4:N4');
		$spreadsheet->getActiveSheet()->mergeCells('C5:N5');
		$spreadsheet->getActiveSheet()->getStyle('C2:N2')->applyFromArray($borderBottom);
		$spreadsheet->getActiveSheet()->getStyle('C3:N3')->applyFromArray($borderBottom);
		$spreadsheet->getActiveSheet()->getStyle('C4:N4')->applyFromArray($borderBottom);
		$spreadsheet->getActiveSheet()->getStyle('C5:N5')->applyFromArray($borderBottom);

		$sheet->setCellValue('A7', 'No');
		$sheet->setCellValue("B7", "Name \n(Surname, Given Name, MI)");
		$spreadsheet->getActiveSheet()->mergeCells('A7:A8');
		$spreadsheet->getActiveSheet()->mergeCells('B7:B8');

		$sheet->setCellValue('C7', 'Sex');
		$sheet->setCellValue('E7', 'Age');
		$spreadsheet->getActiveSheet()->mergeCells('C7:D7');
		$spreadsheet->getActiveSheet()->mergeCells('E7:H7');

		$sheet->setCellValue('C8', 'M');
		$sheet->setCellValue('D8', 'F');
		$sheet->setCellValue('E8', '15-30');
		$sheet->setCellValue('F8', '31-45');
		$sheet->setCellValue('G8', '46-59');
		$sheet->setCellValue('H8', '60 & Above');

		// $sheet->setCellValue('D10', 'F');

		$Institution = new PhpOffice\PhpSpreadsheet\Helper\Html();
		$Institution_ = $Institution->toRichTextObject('<font ="10">Name&nbsp;of&nbsp;Firm/<br> Institution</font>');
		
		$sheet->setCellValue('I7', 'Position/ Designation');
		$sheet->setCellValue('J7', $Institution_);
		$sheet->setCellValue('K7', 'Address');
		$sheet->setCellValue('L7', 'Contact Number Landline/Cellphone (Required)');
		$sheet->setCellValue('M7', 'Email Address (Optional)');
		$sheet->setCellValue('N7', 'Signature');

		$spreadsheet->getActiveSheet()->mergeCells('I7:I8');
		$spreadsheet->getActiveSheet()->mergeCells('J7:J8');
		$spreadsheet->getActiveSheet()->mergeCells('K7:K8');
		$spreadsheet->getActiveSheet()->mergeCells('L7:L8');
		$spreadsheet->getActiveSheet()->mergeCells('M7:M8');



		$spreadsheet->getActiveSheet()->mergeCells('N7:O8');

		$spreadsheet->getActiveSheet()->getStyle('A7:B8')->applyFromArray($BorderAll);
		$spreadsheet->getActiveSheet()->getStyle('C7:H7')->applyFromArray($BorderAll);
		$spreadsheet->getActiveSheet()->getStyle('C8:H8')->applyFromArray($BorderAll);
		$spreadsheet->getActiveSheet()->getStyle('I7:O8')->applyFromArray($BorderAll);
		
		$spreadsheet->getActiveSheet()->getStyle('A7:O8')->applyFromArray($center);
		$spreadsheet->getActiveSheet()->getStyle('A7:O7')->applyFromArray($font10);
		$spreadsheet->getActiveSheet()->getStyle('C8:H8')->applyFromArray($font9);
		// $spreadsheet->getActiveSheet()->getStyle('C10:H10')->applyFromArray($font8);
		// $spreadsheet->getActiveSheet()->getStyle('A'.$start.':F'.$start.'')->applyFromArray($font7);
		$start = 13;
		$spreadsheet->getActiveSheet()->getStyle('A7:O'.$start)->getAlignment()->setWrapText(true);


    	$privacy = new PhpOffice\PhpSpreadsheet\Helper\Html();
		// $privacy_ = $privacy->toRichTextObject('<font ="6">
		// 	DATA PRIVACY CONSENT: By filling-out this form, you agree with the Data Privacy Policy of the Department of Science & Technology Regional Office VIII<br> 
		// 	(DOST VIII) and the National Privacy Commission (NPC). Both personal and non-personal information may be collected from you<br>
		// 	for using this form. Rest assured that these data shall be kept safe and secured, and will not be shared with anyone except to <br>
		// 	designated personnel who will process the needed information only for facilitating smooth participation and distribution of <br>
		// 	materials for such event. The collective information derived from this event will be useful for the improvement of implementing<br>
		// 	similar activities in the future.
		// 	</font>
		// ');

		// $privacy_ = $privacy->toRichTextObject('
		// 	DATA PRIVACY CONSENT<br>
		// 	By filling-out this form, you agree with the Data Privacy Policy of the Department of Science & Technology Regional Office VIII<br>  
		// 	(DOST VIII) and the National Privacy Commission (NPC). Both personal and non-personal
		// 	information may be collected from you
		// ');

		$privacy_ = $privacy->toRichTextObject('
			<img style="height: 70px;" src="'.base_url('assets/dist/img/dost8.png').'">
		');

		$html_rep__ = 'PM-TO-TCS-08-03-F1<br>Revision No.6<br>19 November 2021';
		$html_rep = new PhpOffice\PhpSpreadsheet\Helper\Html();
		$html_rep_ = $html_rep->toRichTextObject($html_rep__);
                    
		// $drawing = new \PhpOffice\PhpSpreadsheet\Worksheet\HeaderFooterDrawing();
		// $drawing->setName('PhpSpreadsheet logo');
		// $drawing->setPath('uploads/Privacy.png');
		// $drawing->setOffsetY(-10);
		// 		$drawing->setOffsetX(40);
		// $drawing->setHeight(25);
		// $sheet->getHeaderFooter()->addImage($drawing, \PhpOffice\PhpSpreadsheet\Worksheet\HeaderFooter::IMAGE_HEADER_RIGHT);

// Set header
		// $sheet->setCellValue('A1', 'DEPARTMENT OF SCIENCE AND TECHNOLOGY');
		// $sheet->setCellValue('A2', 'Regional Office No. 8');
		// $sheet->setCellValue('A4', 'ATTENDANCE SHEET');
		$regularFont = '&"-,Regular"Regional Office No. 8';
		// $sheet->getHeaderFooter()->setOddHeader("A4:O10");
		$sheet->getHeaderFooter()->setOddHeader("&C&G &BDEPARTMENT OF SCIENCE AND TECHNOLOGY\n ".$regularFont."\n\n&bATTENDANCE SHEET");

    	// $sheet->getHeaderFooter()->setOddFooter('&L&"Verdana,Negrita"&8HEADER TEXT&R&G');
    	// $sheet->getHeaderFooter()->setOddFooter('&L&6'.$privacy_.' &R&8'.$html_rep_);
    	// $sheet->getHeaderFooter()->setOddFooter('&L&6'.$privacy_.' &RPage &P of &N');
		// $page = '&BHello World';
		// $page = 'Page &P of &N<br style="mso-data-placement:same-cell;" /><br style="mso-data-placement:same-cell;" /><br style="mso-data-placement:same-cell;" /><br style="mso-data-placement:same-cell;" />';
		// $pages = new PhpOffice\PhpSpreadsheet\Helper\Html();
		// $pages_ = $pages->toRichTextObject($page);

		$pages_ = "Page &P of &N\n \n \n \n \n ";
		$drawing = new \PhpOffice\PhpSpreadsheet\Worksheet\HeaderFooterDrawing();
		$drawing->setName('PhpSpreadsheet logo');
		$drawing->setPath('uploads/Privacy.png');
		$drawing->setWidth(500);
		// $drawing->setOffsetX(-200);
		$sheet->getHeaderFooter()->addImage($drawing, \PhpOffice\PhpSpreadsheet\Worksheet\HeaderFooter::IMAGE_FOOTER_LEFT);
		$sheet->getHeaderFooter()->setOddFooter('&L&G &C&G '.$pages_.' &R &8'.$html_rep_);
// $sheet->getHeaderFooter()->setOddFooter('&C&G');
// $sheet->getHeaderFooter()->setOddFooter('&L&"Verdana,Negrita"&8HEADER TEXT&R&G');

// 
// aw
		$spreadsheet->getActiveSheet()->getPageSetup()
    	->setOrientation(\PhpOffice\PhpSpreadsheet\Worksheet\PageSetup::ORIENTATION_LANDSCAPE);
    	$spreadsheet->getActiveSheet()->getPageSetup()->setPaperSize(\PhpOffice\PhpSpreadsheet\Worksheet\PageSetup::PAPERSIZE_A4);
    	$spreadsheet->getActiveSheet()->getPageMargins()->setTop(1.1);
    	$spreadsheet->getActiveSheet()->getPageMargins()->setLeft(0.25);
		$spreadsheet->getActiveSheet()->getPageMargins()->setRight(0.25);
		$spreadsheet->getActiveSheet()->getPageMargins()->setBottom(1.2);

		$writer = new Xlsx($spreadsheet);
		$writer->save('hello world.xlsx');
		$filename = 'report';
		header('Content-Type: application/vnd.ms-excel');
	    header('Content-Disposition: attachment;filename="'. $filename .'.xlsx"'); 
	    header('Cache-Control: max-age=0');
		$writer->save('php://output');
	}

	public function GeneratePDF(){
		ini_set('memory_limit', '444M');
		$event_id =  $this->uri->segment(3);
  		$date =  $this->uri->segment(4);

  		$final_date = '';
  		if (empty($date)) {
  			$final_date = date('Y-m-d');
  		}else{
  			$final_date = $date;
  		}


		$where = [
			'a.date' => $final_date,
			'a.event_id' => $event_id
		];
		$data = $this->Dashboard_model->EmployeeRecordsAttendanceReport($where);
		$Events = $this->Dashboard_model->getData(['event_id' =>$event_id],'tbl_events');
		// $order_by = [
  //           'a' => 'abstract_id',
  //           'b' => 'desc'
  //       ];
	 //    $where = [
	 //            "event_id" => $event_id,
	 //            "date" => $event_id,
	 //        ];

	    // $data = $this->Dashboard_model->select_table_whereOrderBy($where,$order_by,"tbl_pr_abstract");
  		// echo $id;
  		// echo $date;
		// $order_by = [
  //           'a' => 'usr_id',
  //           'b' => 'desc'
  //       ];
  //       $user = $this->Dashboard_model->select_table_OrderBy($order_by,"usr_table");
        $data = [
        	'data' => $data,
        	'Events' => $Events];
		$this->load->view('dashboard/report',$data);

	}
}
