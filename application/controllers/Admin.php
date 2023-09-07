<?php
defined('BASEPATH') OR exit('No direct script access allowed');
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

class Admin extends CI_Controller {

	public function __construct()
    {
        parent::__construct();
        date_default_timezone_set("Asia/Manila");
        $this->load->model('Functions');
        $this->load->model('Admin_model');

    }

	public function index()
	{
		if (isset($this->session->admin_id)) {
			$this->load->view('Templates/admin/header');
			$this->load->view('Admin/DashboardAdmin');
		}else{
			$this->load->view('Templates/script');
        	$this->load->view('GeneralSettings/AdminLogin');
		}
		

	}

	public function SignIn(){
		$password = sha1($this->input->post('password'));
		
		$data = [
				'username' => $this->input->post('username'),
				'password' =>$password
				];

		$verify = $this->Functions->getData($data,"tbl_admin");

		if ($verify == TRUE) {

			$array = array(
				'admin_id' => $verify->admin_id,
				'name' => $verify->name,
				'username' => $verify->username,
			);
			$this->session->set_userdata( $array );
			echo json_encode(array('success' => true));
		
		} else {
			echo json_encode(array('error' => true));	
			
		}	
	}

	public function ApprovalStats(){
		$data = $this->Admin_model->ApprovalStats();
		echo json_encode($data);
	}

	public function GenderStats(){
		$data = $this->Admin_model->GenderStats();
		echo json_encode($data);
	}

	public function AgeBracket(){
		$data = $this->Admin_model->AgeBracket();
		// echo json_encode($data);
		$Age15TO30 = 0;
        $Age31TO45 = 0;
        $Age46TO59 = 0;
        $Age60Above = 0;

		foreach ($data as $var) {
			$dateOfBirth = $var['birth_date'];
            $today = date("Y-m-d");
            $diff = date_diff(date_create($dateOfBirth), date_create($today));
            $age = $diff->format('%y');
            
            if ($age <= 30) {
                $Age15TO30 = $Age15TO30 + 1;
            }
 			else if ($age >= 31 && $age <=45) {
                $Age31TO45 = $Age31TO45 + 1;
            }
 			else if ($age >= 46 && $age <=59) {
                $Age46TO59 = $Age46TO59 + 1;
            }
 			else if ($age >= 60) {
                $Age60Above = $Age60Above + 1;
            }

		}

		$array = [
			'Age15TO30' => $Age15TO30,
			'Age31TO45' => $Age31TO45,
			'Age46TO59' => $Age46TO59,
			'Age60Above' => $Age60Above
		];

		echo json_encode($array);
	}

	public function ClusterGraph(){
		$data = $this->Admin_model->ClusterGraph();
		echo json_encode($data);
	}
	
	public function EventStats(){
		$data = $this->Admin_model->EventStats();
		echo json_encode($data);
	}

	public function EventPeningStats(){
		$data = $this->Admin_model->EventPeningStats();
		echo json_encode($data);
	}

	public function RoleStats(){
		$data = $this->Admin_model->RoleStats();
		echo json_encode($data);
	}

	public function EventParticipants(){
		$event_id = $this->input->post('event_id');
		$status = $this->input->post('status');
		$displayStatus = '';
		if ($status == 1) {
			$displayStatus = 'Approved';
			$EventParticipants = $this->Admin_model->EventParticipants($event_id, $status);
		}else{
			$displayStatus = 'Pending';
			$EventParticipants = $this->Admin_model->EventParticipantsPending($event_id, $status);
		}
		$tbl_events = $this->Functions->getData(['event_id' => $event_id],'tbl_events');
		$data = [
			'displayStatus' => $displayStatus,
			'EventParticipants' => $EventParticipants,
			'event' => $tbl_events
		];
		echo json_encode($data);
	}

	public function ParticipantsPrint($event_id, $status){
		$displayStatus = '';
		if ($status == 1) {
			$displayStatus = 'Approved';
			$EventParticipants = $this->Admin_model->EventParticipants($event_id, $status);
		}else{
			$displayStatus = 'Pending';
			$EventParticipants = $this->Admin_model->EventParticipantsPending($event_id, $status);
		}
		$tbl_events = $this->Functions->getData(['event_id' => $event_id],'tbl_events');
		$data = [
			'displayStatus' => $displayStatus,
			'EventParticipants' => $EventParticipants,
			'event' => $tbl_events
		];

		
        $this->load->view('Admin/Print',$data);
	}

	public function UserApproved(){
		$this->Functions->if_not_logged_in();
		$this->load->view('Templates/admin/header');
		$this->load->view('Admin/UserApproved');
		// $this->load->view('Admin/UserApproved', $data);
	}
	public function ApprovedParticipants(){
		$data = $this->Admin_model->ApprovedParticipants();
		echo json_encode($data);
	}
	public function UserPending(){
		$this->Functions->if_not_logged_in();
		$order_by = [
            'a' => 'event_name',
            'b' => 'asc'
        ];
        $events = $this->Functions->select_table_OrderBy($order_by,"tbl_events");

        $order_byR = [
            'a' => 'role_id',
            'b' => 'asc'
        ];
        $roles = $this->Functions->select_table_OrderBy($order_byR,"tbl_roles");

        $data = [ 
            'events' => $events,
            'roles' => $roles,

        ];

		$this->load->view('Templates/admin/header');
		$this->load->view('Admin/UserPending', $data);
	}

	public function PendingParticipants(){
		$data = $this->Admin_model->PendingParticipants();
		echo json_encode($data);
	}

	public function getParticipantData(){
		$verify = array(
            'usr_id' => $this->input->post('usr_id')
        );

        $data = $this->Functions->getData($verify,'usr_table');

        echo json_encode($data);
	}
	public function ApproveParticipant(){
		$usr_id = $this->input->post('usr_id');

       
		$qrcode = 'RSTW2023-'.$usr_id;
		$event_approved_id = implode(',', $this->input->post('event_approved_id'));
		$array = [
			'qrcode' => $qrcode, 
			'event_approved_id' => $event_approved_id,
			'approval_status' => 1
		];
        $this->Functions->update_table(['usr_id' => $usr_id], $array, 'usr_table');

    }
    public function ConfirmationEmail(){
    	$usr_id = $this->input->post('usr_id');
    	$email_status = $this->input->post('email_status');

    	$data = $this->Admin_model->userInfoWithEvents($usr_id);

    	$d = new DateTime('now');
		$d->setTimezone(new DateTimeZone('Asia/Manila'));
		$dateTime = $d->format('Y-m-d');

    	$qrcode = 'RSTW2023-'.$usr_id;
    	$number_of_email = $data->number_of_email + 1;

    	require_once(APPPATH.'third_party/phpmailer/src/Exception.php');
        require_once(APPPATH.'third_party/phpmailer/src/SMTP.php');
        require_once(APPPATH.'third_party/phpmailer/src/PHPMailer.php');
        $mail = new PHPMailer(true);

		try {
		    //Server settings
		    $mail->SMTPDebug = 1;                      //Enable verbose debug output
		    $mail->isSMTP();                                            //Send using SMTP
		    $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
		    $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
		    $mail->Username   = 'notif.rstwcaraga@gmail.com';                     //SMTP username
		    $mail->Password   = 'eiyhxsvspdjimnyc';                               //SMTP password
		    $mail->SMTPSecure = 'tls';            //Enable implicit TLS encryption
		    $mail->Port       = 587;                                    //TCP port to connect to; use 587 if you have set SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS

		    //Recipients
		    $mail->setFrom('notif.rstwcaraga@gmail.com', 'REGISTRATION CONFIRMATION');    //Add a recipient
		    $mail->addAddress($data->usr_email);               //Name is optional
		    //$mail->addReplyTo('info@example.com', 'Information');
		    // $mail->addCC('pulmaats@gmail.com');                     //CC
		    //$mail->addCC('');
		    //$mail->addBCC('bcc@example.com');

		    //Attachments
		    //$mail->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
		    //$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name
		    $file = 'assets/img/Program-at-a-Glance-4.jpg'; 
			if (is_readable($file)) {
				$mail->addAttachment($file,'application/octet-stream');
			}
		    //Content
		    $mail->isHTML(true);                                  //Set email format to HTML
		    $mail->Subject = '2023 Caraga Regional Science, Technology, and Innovation Week Registration (As of '.$dateTime.')';                        //$subject

		    $salutation = '';
		    if ($data->usr_gender == 'Male') {
		    	$salutation = 'Mr.';
		    }else{
		    	$salutation = 'Ms.';
		    }
		    $body = '';

		    $body = '<img src="https://scontent.fmnl10-1.fna.fbcdn.net/v/t39.30808-6/372687441_321131676950638_1880914990816172129_n.jpg?_nc_cat=111&ccb=1-7&_nc_sid=49d041&_nc_ohc=20mp_kV0IuYAX9mHUAi&_nc_ht=scontent.fmnl10-1.fna&_nc_e2o=s&oh=00_AfASMJ9b47vEqj3SIQTwJYnpfrGYFb7wk67Xh18lurQFMw&oe=64F6E27A" width="1100px" />';

		    $body .='
		    	<p>Dear '.$salutation.'<b> '.$data->usr_fname.' '.$data->usr_lname.',</b></p>

				<p>Maradjaw na adlaw!</p>

				<p>Thank you for confirming your participation in the <b>2023 Caraga Regional Science, Technology, and Innovation Week (RSTW) Celebration</b> on September 29, 2023 until October 01, 2023, in Surigao City.</p>

				<p>With the theme, <i>"Siyensya, Teknolohiya at Inobasyon: Kabalikat sa Maunlad at Matatag na Kinabukasan."</i> this year\'s celebration aims to highlight the crucial role of health research and innovation in achieving our sustainable development goals in the post-pandemic era.</p>


				<p>Please be reminded that only the participants with <b>approved registration</b> will be allowed.</p>

				<p>For your guidance, please refer to the program with your <b><i>approved registration</i></b> below: </p>
				<b><i>'.$data->event_name.'</i></b>
		    ';
		    // 1 confirmation, 2 re confirmation 
		    // if ($email_status == 1) {
		    // 	$body .='<p>The approval of registrations to the Pre-Conference sessions will be sent starting next week. A separate email will be sent to you regarding updates on your registration to the said sessions.</p>';
		   	// 	$body .='<p>You may access your QR code below or by logging in at <a href="https://pnhrsregistration2023.dost8.ph/Registration/SignIn">https://pnhrsregistration2023.dost8.ph/Registration/SignIn</a>. Please print this QR code or store a screenshot on your mobile device. Upon arrival at the event venue, please scan your unique QR code at the kiosk or laptop placed at the entrance of the meeting rooms.</p>';
		    // }else{
		    // 	$body .='<p>You may access your QR code below or by logging in at <a href="https://pnhrsregistration2023.dost8.ph/Registration/SignIn">https://pnhrsregistration2023.dost8.ph/Registration/SignIn</a>. For confirmed registration last week, please note that this is the same QR code. Kindly print this QR code or store a screenshot on your mobile device. Upon arrival at the event venue, please scan your unique QR code at the kiosk or laptop placed at the entrance of the meeting rooms.</p>';
		    // }

		    $body .='<p>You may access your QR code below or by logging in at <a href="https://rstw2023.dostcaraga.ph/Registration/SignIn">https://rstw2023.dostcaraga.ph/Registration/SignIn</a>. <i>For registrations confirmed earlier, please be informed that this is the same QR code.</i></p>';

		    $body .='<p>Kindly print the QR code or store a screenshot on your mobile device. Upon arrival at the event venue, please scan your unique QR code at the kiosk or laptop placed at the entrance of the meeting rooms.</p>';

		   	$body .= '<img src="https://chart.googleapis.com/chart?chs=300x300&cht=qr&chl='.$qrcode.'" title="My QRCode" />';

		    $body .='<p>Attached herewith is the provisional program, for your reference.</p>';
		    $body .='<p>Should you have any questions or concerns, please do not hesitate to contact us at</p>';
		    $body .='<p><b>supprt.rstwcaraga@gmail.com</b></p>';
		    $body .='<p>Thank you, and we look forward to seeing you soon!</p>';
		    $body .='<p>Ibani kami sa Surigao! Tsana!<br>';

		    $mail->Body    = $body; //$body
		    
		    $mail->AltBody = ' ';
		    $mail->send();
		    $this->Functions->update_table(['usr_id' => $usr_id], ['number_of_email' => $number_of_email], 'usr_table');
		    echo json_encode(array('success' => true, 'number_of_email' => $number_of_email, 'usr_id' => $usr_id));

		    
		} catch (Exception $e) {
		    // echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
		    echo json_encode(array('error' => true, 'error_messages' =>  "Message could not be sent. Mailer Error: {$mail->ErrorInfo}"));
		}
    }

    public function ReminderEmail(){
    	$usr_id = $this->input->post('usr_id');

    	$data = $this->Admin_model->userInfoWithEvents($usr_id);

    	$number_of_email = $data->number_of_email + 1;
    	require_once(APPPATH.'third_party/phpmailer/src/Exception.php');
        require_once(APPPATH.'third_party/phpmailer/src/SMTP.php');
        require_once(APPPATH.'third_party/phpmailer/src/PHPMailer.php');
        $mail = new PHPMailer(true);

		try {
		    //Server settings
		    $mail->SMTPDebug = 0;                      //Enable verbose debug output
		    $mail->isSMTP();                                            //Send using SMTP
		    $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
		    $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
		    $mail->Username   = 'supprt.rstwcaraga@gmail.com';                     //SMTP username
		    $mail->Password   = 'dostcaraga13';                               //SMTP password
		    $mail->SMTPSecure = 'tls';            //Enable implicit TLS encryption
		    $mail->Port       = 587;                                    //TCP port to connect to; use 587 if you have set SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS

		    //Recipients
		    $mail->setFrom('notif.rstwcaraga@gmail.com', 'REGISTRATION CONFIRMATION EMAIL');    //Add a recipient
		    $mail->addAddress($data->usr_email);               //Name is optional
		   
		    $file = 'assets/img/Program-at-a-Glance-4.jpg'; 
			if (is_readable($file)) {
				$mail->addAttachment($file,'application/octet-stream');
			}
			$fileGuide = 'assets/img/EventGuide.pdf'; 
			if (is_readable($fileGuide)) {
				$mail->addAttachment($fileGuide,'application/octet-stream');
			}

		    //Content
		    $mail->isHTML(true);                                  //Set email format to HTML
		    $mail->Subject = '16th PNHRS Week Event Reminder';                        //$subject

		    $salutation = '';
		    if ($data->usr_gender == 'Male') {
		    	$salutation = 'Mr.';
		    }else{
		    	$salutation = 'Ms.';
		    }
		    $body = '';

		    $body = '<img src="https://rstw2023.dostcaraga.ph/assets/img/webheadfinal.png" width="1100px" />';

		    $body .='
		    	<p>Dear '.$salutation.'<b> '.$data->usr_fname.' '.$data->usr_lname.',</b></p>

				<p>Maupay na Adlaw!</p>

				<p>We are looking forward to your enthusiastic participation in the 16th Philippine National Health Research System (PNHRS) 
				Week Celebration which will be held on August 8-11, 2023 at the Summit Hotel, Tacloban City.</p>

				<p>With the theme, <i>“Sustainable Development: Resilience through Health Research,”</i> this year’s celebration aims to highlight the crucial role of health research and innovation in achieving our sustainable development goals in the post-pandemic era.</p>


				<p>Please see attached <b>provisional program</b> and <b>event guide</b> for your reference.</p>

				<p>Should you have any questions or concerns, please do not hesitate to contact us at<br>
					<b>supprt.rstwcaraga@gmail.com</b>
				</p>

				<p>Thank you, and we look forward to seeing you soon!</p>
				<p>Regards,<br>
				16th PNHRS Registration Committee</p>
		    ';

		    $mail->Body    = $body; //$body
		    
		    $mail->AltBody = ' ';
		    $mail->send();
		    $this->Functions->update_table(['usr_id' => $usr_id], ['number_of_email' => $number_of_email], 'usr_table');
		    echo json_encode(array('success' => true, 'number_of_email' => $number_of_email, 'usr_id' => $usr_id));

		    
		} catch (Exception $e) {
		    echo json_encode(array('error' => true, 'error_messages' =>  "Message could not be sent. Mailer Error: {$mail->ErrorInfo}"));
		}
    }
    public function Events(){
    	$this->Functions->if_not_logged_in();
    	$this->load->view('Templates/admin/header');
        $this->load->view('Admin/Events');
    }
     public function AdminLogout() {
        $this->session->sess_destroy();  
        redirect(base_url('Admin'));
    }  

    public function UpdateInfoParticipant(){
        // $qrcode = $this->input->post('usr_fname').''.$this->input->post('usr_lname');
        $qrcode = 'RSTW2023-'.$this->input->post('usr_id');
        $event_id = implode(',', $this->input->post('event_name'));
        $event_approved_id = implode(',', $this->input->post('event_approved_id'));
        $data = [
            'usr_fname' => $this->input->post('usr_fname'),
            'usr_mname' => $this->input->post('usr_mname'),
            'usr_lname' => $this->input->post('usr_lname'),
            'usr_suffix' => $this->input->post('usr_suffix'),
            'birth_date' => $this->input->post('birth_date'),
            'usr_gender' => $this->input->post('usr_gender'),
            'usr_contact' => $this->input->post('usr_contact'),
            'usr_municipality' => $this->input->post('usr_municipality'),
            'usr_occupation' => $this->input->post('usr_occupation'),
            'usr_institution' => $this->input->post('usr_institution'),
            'usr_email' => $this->input->post('usr_email'),
            'usr_sector' => $this->input->post('usr_sector'),
            'usr_cluster' => $this->input->post('usr_cluster'),
            'event_approved_id' => $event_approved_id,
            'usr_role' => $this->input->post('usr_role'),
            // 'participation_status' => $this->input->post('participation_status'),
            'event_id' => $event_id,
            'qrcode' => $qrcode
        ];

        $array_verify = array(
            'usr_fname' => $this->input->post('usr_fname'),
            'usr_lname' => $this->input->post('usr_lname'),
            'usr_id !=' => $this->input->post('usr_id')
        );

        $verify = $this->Functions->getData($array_verify,'usr_table');
        
        $email_verify = array(
            'usr_id !=' => $this->input->post('usr_id'),
            'usr_email' => $this->input->post('usr_email')
        );
        
        $email = $this->Functions->getData($email_verify,'usr_table');
        if ($verify) {
            echo json_encode(array('invalid' => true));
        }else if($email){
            echo json_encode(array('invalid_email' => true));
        }else{
            $data = $this->Functions->update_table(['usr_id' => $this->input->post('usr_id')], $data, 'usr_table');
            $affected_rows = $this->db->affected_rows();
            if ($affected_rows >= 1) {
                echo json_encode(array('success' => true));
            }else{
                echo json_encode(array('same_value' => true));
            }
        }
    }
    
    public function IDPrinting(){
        // $this->Functions->if_not_logged_in();
    	if (empty($_GET['cluster'])) {
    		$cluster = 'Visayas';
    	}else{
    		$cluster = $_GET['cluster'];
    	}

    	$data = ['cluster' => $cluster];
    	$this->Functions->if_not_logged_in();
    	$this->load->view('Templates/admin/header');
    	$this->load->view('Templates/admin/idPrintingCSS');
        $this->load->view('Admin/IDPrinting', $data);
    }

    public function IDPrintingFetch(){
    	$array = ['cluster' => $_POST['cluster']];
    	$data = $this->Admin_model->ApprovedParticipantsPrintID($array);
    	echo json_encode($data);
    }

    public function IDPrintingSolo(){
		if (empty($_GET['id'])) {
    		$usr_id = 1;
    	}else{
    		$usr_id = $_GET['id'];
    	}    	

    	$data = ['usr_id' => $usr_id];
    	$this->Functions->if_not_logged_in();
    	$this->load->view('Templates/admin/header');
    	$this->load->view('Templates/admin/idPrintingCSS');
        $this->load->view('Admin/IDPrintingSolo', $data);
    }

    public function IDPrintingSoloBlank(){
		if (empty($_GET['id'])) {
    		$usr_id = 1;
    	}else{
    		$usr_id = $_GET['id'];
    	}    	

    	$data = ['usr_id' => $usr_id];
    	$this->Functions->if_not_logged_in();
    	$this->load->view('Templates/admin/header');
        $this->load->view('Admin/IDPrintingSoloBlank', $data);
    }

    public function IDPrintingSoloData(){
    	$array = ['usr_id' => $_POST['usr_id']];
    	$data = $this->Admin_model->IDPrintingSoloData($array);
    	echo json_encode($data);
    }
    
    public function UserOnsite(){
    	$this->Functions->if_not_logged_in();
		$this->load->view('Templates/admin/header');
		$this->load->view('Admin/UserOnsite');
	}

	public function OnsiteParticipants(){
		$data = $this->Admin_model->OnsiteParticipants();
    	echo json_encode($data);
	}

	public function MoveToPending(){
		$data = [
			'move_to_pending_status' => 1,
			'approval_status' => 0
		];
		$this->Functions->update_table(['usr_id' => $this->input->post('usr_id')], $data, 'usr_table');
		echo json_encode(array('success' => true));
	}

	public function updateIDCardStatus(){
		$data = [
			'idcard_status' => $this->input->post('idcard_status'),
		];
		$this->Functions->update_table(['usr_id' => $this->input->post('usr_id')], $data, 'usr_table');
		echo json_encode(array('success' => true));
	}
	
	public function checkList($event_id){
    	$this->load->view('Templates/admin/header');
		$EventParticipants = $this->Admin_model->EventParticipantsChecklist($event_id);
		$tbl_events = $this->Functions->getData(['event_id' => $event_id],'tbl_events');
		$currentNumParticipants = $this->Admin_model->EventCountBySession($event_id);
		$data = [
			'currentNumParticipants' => $currentNumParticipants,
			'EventParticipants' => $EventParticipants,
			'event' => $tbl_events
		];

		$this->load->view('Admin/CheckList', $data);
    }

	public function ApprovedBySession(){
		$usr_id = $this->input->post('usr_id');
		$event_id = $this->input->post('event_id');

		$verify = $this->Functions->getData(['event_id' => $event_id],"tbl_events");
		$currentNumParticipants = $this->Admin_model->EventCountBySession($event_id);
		if ($currentNumParticipants >= $verify->maximum) {
			$erroM = $verify->maximum." is the Maximum approval";
			echo json_encode(array('invalid' => true, 'erroM' => $erroM));
		}else{
			$usrData = $this->Functions->getData(['usr_id' => $usr_id],"usr_table");
			if (empty($usrData->event_approved_id)) {
				$data = [
					'event_approved_id' => $event_id,
					'approval_status' => 1,
				];
			}else{
				$data_string = $usrData->event_approved_id;
	            $data_string = str_replace(' ', '', $data_string);
	            $data_array = explode(',', $data_string);

				$data_array[] = $event_id;
				$event_approved_id = implode(',', $data_array);

				$data = [
					'event_approved_id' => $event_approved_id,
				];
			}
			
			$this->Functions->update_table(['usr_id' => $this->input->post('usr_id')], $data, 'usr_table');
            $currentNumParticipants = $currentNumParticipants + 1;
            echo json_encode(array('success' => true, 'approvedParticipantsNum' => $currentNumParticipants));
		}
		
	}

	public function UncheckedSession(){
		$usr_id = $this->input->post('usr_id');
		$event_id = $this->input->post('event_id');

		$usrData = $this->Functions->getData(['usr_id' => $usr_id],"usr_table");
		$data_string = $usrData->event_approved_id;
        $data_string = str_replace(' ', '', $data_string);
        $data_array = explode(',', $data_string);

		$value_to_remove = $event_id;
		$key = array_search($value_to_remove, $data_array);
		if ($key !== false) {
		    unset($data_array[$key]);
		}

		$event_approved_id = implode(',', $data_array);
		if (empty($data_array)) {
			$data = [
				'event_approved_id' => $event_approved_id,
				'approval_status' => 0,
			];
		}else{
			$data = [
				'event_approved_id' => $event_approved_id,
			];
		}

		$currentNumParticipants = $this->Admin_model->EventCountBySession($event_id);
		$currentNumParticipants = $currentNumParticipants - 1;
		$this->Functions->update_table(['usr_id' => $this->input->post('usr_id')], $data, 'usr_table');
		echo json_encode(array('success' => true, 'approvedParticipantsNum' => $currentNumParticipants));
	}
}
