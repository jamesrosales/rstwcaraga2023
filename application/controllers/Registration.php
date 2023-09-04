<?php
defined('BASEPATH') OR exit('No direct script access allowed');
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

class Registration extends CI_Controller {

	public function __construct()
    {
        parent::__construct();
        date_default_timezone_set("Asia/Manila");
        $this->load->model('Functions');
        $this->load->model('Admin_model');
    }


    public function index(){
        $this->load->view('Templates/script');
        $order_by = [
            'a' => 'event_name',
            'b' => 'asc'
        ];
        $events = $this->Functions->select_table_OrderBy($order_by,"tbl_events");
        $order_by = [
            'a' => 'role_id',
            'b' => 'asc'
        ];
        $roles = $this->Functions->select_table_OrderBy($order_by,"tbl_roles");

        $data = [
            'events' => $events,
            'roles' => $roles
        ];

        $this->load->view('registration/index',$data);
       
        // $this->load->view('GeneralSettings/RegistrationPage');

    }
    public function Onsite(){
        $this->load->view('Templates/script');
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
            'roles' => $roles
        ];

        $this->load->view('registration/index',$data);
    }

    public function addUser(){
        // $qrcode = $this->input->post('usr_fname').''.$this->input->post('usr_lname');
        $event_id = implode(',', $this->input->post('event_name'));
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
            // 'usr_sector_other' => $this->input->post('usr_sector_other'),
            'usr_role' => $this->input->post('usr_role'),
            'event_id' => $event_id,
            'approval_status' => 0,
        ];

        $array_verify = array(
            'usr_fname' => $this->input->post('usr_fname'),
            'usr_lname' => $this->input->post('usr_lname'),
        );

        $verify = $this->Functions->getData($array_verify,'usr_table');
        
        $email_verify = array(
            'usr_email' => $this->input->post('usr_email')
        );

        $email = $this->Functions->getData($email_verify,'usr_table');
      
        if ($verify) {
            echo json_encode(array('invalid' => true));
        }else if($email){
            echo json_encode(array('invalid_email' => true));
        }else{
            $this->Functions->insert("usr_table",$data);
            $insert_id = $this->db->insert_id();
            $qrcode = 'PNHRS2023-'.$insert_id;
            $this->Functions->update_table(['usr_id' => $insert_id], ['qrcode' => $qrcode], 'usr_table');

            $array = [
                'usr_id' => $insert_id,
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
                // 'usr_sector_other' => $this->input->post('usr_sector_other'),
                'usr_role' => $this->input->post('usr_role'),
                'event_id' => $event_id,
                'approval_status' => 0,
                'qrcode' => $qrcode
            ];
            $this->session->set_userdata( $array );
            echo json_encode(array('success' => true, 'usr_id' => $insert_id));
        }
    }

    public function UpdateInfo(){
        // $qrcode = $this->input->post('usr_fname').''.$this->input->post('usr_lname');
        $qrcode = 'PNHRS2023-'.$this->input->post('usr_id');
        $event_id = implode(',', $this->input->post('event_name'));
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
            // 'usr_sector_other' => $this->input->post('usr_sector_other'),
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
            'usr_email' => $this->input->post('usr_email'),
            'usr_id !=' => $this->input->post('usr_id')
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

    public function SignIn(){
        $this->load->view('Templates/script');
        $this->load->view('registration/Login');
    }
    public function Login(){
        $email_verify = array(
            'usr_email' => $this->input->post('usr_email')
        );

        $verify = $this->Functions->getData($email_verify,'usr_table');
        if ($verify) {
            $array = array(
                'usr_id' => $verify->usr_id,
                'usr_fname' => $verify->usr_fname,
                'usr_mname' => $verify->usr_mname,
                'usr_lname' => $verify->usr_lname,
                'usr_suffix' => $this->input->post('usr_suffix'),
                'birth_date' => $verify->birth_date,
                'usr_gender' => $verify->usr_gender,
                'usr_municipality' => $verify->usr_municipality,
                'usr_occupation' => $verify->usr_occupation,
                'usr_institution' => $verify->usr_institution,
                'usr_email' => $verify->usr_email,
                'usr_sector' => $verify->usr_sector,
                'usr_sector_other' => $verify->usr_sector_other,
                'usr_cluster' => $verify->usr_cluster,
                'qrcode' => $verify->qrcode
            );
            $this->session->set_userdata( $array );
            echo json_encode(array('success' => true, 'usr_id' => $verify->usr_id));
        }else{
            echo json_encode(array('invalid' => true));
        }
    }

    public function Logout() {
        $this->session->sess_destroy();  
        $validation = 0;
        //0 if registration is open, 1 if registration is closed
        if ($validation == 1) {
            redirect(base_url('Registration/Onsite'));
        }else{
            redirect(base_url());
        }
       
    }  

    public function Profile($usr_id) {
        $SessionID = $this->session->userdata('usr_id');
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
            'data' => $this->Functions->getData(['usr_id' => $SessionID],'usr_table'),
            'events' => $events,
            'roles' => $roles,

        ];

        if (!empty($SessionID)) {
            $this->load->view('Templates/script');
            $this->load->view('registration/Profile',$data);
        }else{
            $order_by = [
                'a' => 'event_name',
                'b' => 'asc'
            ];
            $events = $this->Functions->select_table_OrderBy($order_by,"tbl_events");

            $data = [
                'events' => $events
            ];
            $this->load->view('Templates/script');
            $this->load->view('registration/index',$data);
        }
        
    }

    public function getProfile(){
        $usr_id = $this->input->post('usr_id');
        $user_data = $this->Admin_model->getProfile($usr_id);

        if ($user_data->approval_status == 1) {
            $event_id = explode(',', $user_data->event_approved_id);
        }else{
            $event_id = explode(',', $user_data->event_id);
        }
        
        $events = $this->Admin_model->eventListUser($event_id);

        $data = [
            'user_data' => $user_data,
            'events'    => $events
        ];
        echo json_encode($data);
    }
}