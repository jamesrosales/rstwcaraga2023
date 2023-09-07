<?php
/**
 * 
 */
require_once dirname(__file__).'/tcpdf/tcpdf.php';

class Pdf extends TCPDF
{
	
	protected $ci;

	public function __construct()
	{
		$this->ci =& get_instance();
	}
}