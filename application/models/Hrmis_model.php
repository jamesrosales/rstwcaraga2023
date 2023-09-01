<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Hrmis_model extends CI_Model {

	function __construct()
	{
		$this->hrmis = $this->load->database('hrmis', TRUE);
		$this->hrmis->initialize();
    }

    public function getLatestData($empDateFrom, $empDateTo){
		$this->hrmis->select('*');
		$this->hrmis->where('dtrDate >= ',$empDateFrom);
		$this->hrmis->where('dtrDate <= ',$empDateTo);

		return $this->hrmis->get('tblEmpDtr')->result_array();
	}

	public function odbcConnect(){

		$conn = false;
		$mdb = 'C:\xampp\htdocs\qrcode\unis.mdb';

		extension_loaded( 'pdo_odbc' ) or trigger_error( 'The pdo odbc extension is required.', E_USER_ERROR );

		file_exists($mdb) or trigger_error('Could not find database file', E_USER_ERROR);

		$conn = new PDO('odbc:Driver={Microsoft Access Driver (*.mdb, *.accdb)}; Dbq='.$mdb.'; Pwd=unisamho');

		return $conn;
	}

	public function odbc_select($query){

		$conn = $this->odbcConnect();
		try{
			$result = $conn->query($query);
			$row = $result->fetchAll(PDO::FETCH_ASSOC);

			if($result === FALSE){
				var_dump($conn->errorInfo());
			 }
			return $row;
			
		}catch(PDOException $e){
			echo $e->getMessage();
		}
	}

	public function odbc_insert($query){
		$conn = $this->odbcConnect();
		try{
			$result = $conn->exec($query);

			if($result === FALSE){
				var_dump($conn->errorInfo());
			}else{
			#	echo $query;
			}
		}catch(PDOException $e){
			echo $e->getMessage();
		}

		return ;
	}

}
