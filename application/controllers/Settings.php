<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Settings extends CI_Controller {

	public function __construct()
    {
        parent::__construct();
        date_default_timezone_set("Asia/Manila");
        $this->load->model('Functions');
    }

    public function index(){
        // $this->load->view('GeneralSettings/RegistrationPage');
    }

    public function Accounts(){
        $this->load->view('Templates/script');
        $this->load->view('GeneralSettings/Accounts');
    }

    public function Profile($usr_id){
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
            'data' => $this->Functions->getData(['usr_id' => $usr_id],'usr_table'),
            'events' => $events,
            'roles' => $roles,
        ];
        $this->load->view('Templates/script');
        $this->load->view('GeneralSettings/Profile', $data);
    }

    public function AccountsRecords(){
        $order_by = [
            'a' => 'usr_id',
            'b' => 'desc'
        ];
        $data = $this->Functions->select_table_OrderBy($order_by,"usr_table");
        echo json_encode($data);
    }

    public function AccountsRecordsAPI(){
        $order_by = [
            'a' => 'usr_id',
            'b' => 'desc'
        ];
        $data = $this->Functions->select_table_OrderByApi($order_by,"usr_table");
        echo json_encode($data);
    }


    public function EventsList(){
        $this->load->view('Templates/script');
        $this->load->view('GeneralSettings/Events');
    }

    public function EventsRecords(){
        $order_by = [
            'a' => 'date_start',
            'b' => 'asc'
        ];
        $data = $this->Functions->select_table_OrderBy($order_by,"tbl_activities");
        echo json_encode($data);
    }

    public function Addevent(){
        $verify = $this->Functions->getData(['event_name' => $this->input->post('event_name')],'tbl_activities');

        if ($verify) {
            echo json_encode(array('duplicate' => true));
        }else{

            $this->Functions->insert("tbl_activities",
            [
                'event_name' => $this->input->post('event_name'),
                'date_start' => $this->input->post('date_start'),
                'date_finished' => $this->input->post('date_finished'),
                'link' => $this->input->post('link'),
            ]);
            echo json_encode(array('success' => true));
        }
    }

    public function getEventData(){
        $data = $this->Functions->getData(['id' => $this->input->post('id')],'tbl_activities');
        echo json_encode($data);
    }

    public function EditEvent(){
        $array_verify = array(
            'event_name' => $this->input->post('event_name'),
            'id !=' => $this->input->post('id')
        );

        $verify = $this->Functions->getData($array_verify,'tbl_activities');
        if ($verify) {
            echo json_encode(array('duplicate' => true));
        }else{
            $data = $this->Functions->update_table(['id' => $this->input->post('id')], 
            [
                'event_name' => $this->input->post('event_name'),
                'date_start' => $this->input->post('date_start'),
                'date_finished' => $this->input->post('date_finished'),
                'link' => $this->input->post('link'),
            ], 'tbl_activities');
            $affected_rows = $this->db->affected_rows();
            if ($affected_rows >= 1) {
                echo json_encode(array('success' => true));
            }else{
                echo json_encode(array('same_value' => true));
            }
        }
    }

    public function Deleteevent(){
        // $verify = $this->Functions->getData(['charge_to' => $this->input->post('event_id')],'tbl_ppmp');

        // if ($verify) {
        //  echo json_encode(array('not_allowed' => true));
        // }else{
            $this->Functions->delete_table_where(["id" => $this->input->post('id')],"tbl_activities");
            echo json_encode(array('success' => true));
        // }
    }

    // public function EventAttendance($event_id){
    //     $tbl_activities = $this->Functions->getData(['event_id' =>$event_id],'tbl_activities');

    //     $data = [
    //         'tbl_activities' => $tbl_activities,
    //         'usr_table' => $this->Functions->getTbl('usr_table','usr_lname','asc'),
    //     ];
    //     // $this->load->view('dashboard/index');
    //     $this->load->view('dashboard/EventAttendance',$data);
    // }

    public function AccountsHide(){
        $this->load->view('Templates/script');
        $this->load->view('GeneralSettings/AccountsHide');
    }

    public function AccountsRecordsHide(){
        $order_by = [
            'a' => 'usr_id',
            'b' => 'desc'
        ];
        $data = $this->Functions->select_table_OrderBy($order_by,"usr_table");
        echo json_encode($data);
    }

}