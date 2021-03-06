<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Email  extends CI_Model{
	
	public function send($to,$subject,$msg)
	{
		$this->load->library('email');
        $this->load->model('setting');

		$config['charset'] = 'utf-8';
		$config['protocol'] = 'smtp';
		$config['smtp_host'] = $this->setting->get_var('smtp_server');
		$config['smtp_user'] = $this->setting->get_var('smtp_user');
		$config['smtp_pass'] = $this->setting->get_var('smtp_pwd');
		$config['smtp_port'] = $this->setting->get_var('smtp_port') ? $this->setting->get_var('smtp_port') : 25;
		$config['mailtype'] = 'html';
		$this->email->initialize($config);
		$this->email->from($this->setting->get_var('smtp_email'), $this->setting->get_var('smtp_user'));
		$this->email->to($to);

		$this->email->subject($subject);
		$this->email->message($msg);

		if($this->email->send())
		{
			
			return true;
		}
		else
		{
			echo $this->email->print_debugger();
			return false;
		}
		exit;


		$CI =& get_instance();
		$CI->load->library('email');
        $CI->load->model('setting');

		$this->email->from($this->setting->get_var('smtp_email'), $this->setting->get_var('smtp_user'));
		$this->email->to($to);

		$this->email->subject($subject);
		$this->email->message($msg);
		$config['protocol'] = 'mail';
		$config['smtp_host'] = $this->setting->get_var('smtp_server');
		$config['smtp_user'] = $this->setting->get_var('smtp_user');
		$config['smtp_pass'] = $this->setting->get_var('smtp_pwd');
		$config['smtp_port'] = $this->setting->get_var('smtp_port') ? $this->setting->get_var('smtp_port') : 25;
		$this->email->initialize($config);
		if($this->email->send())
		{
			//echo $this->email->print_debugger();
			return true;
		}
		else
		{
			return false;
		}

	}
	//-------------------------------------------------------
	
}
/* End of file email.php */
/* Location: ./application/models/email.php */	