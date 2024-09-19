<?php
use GeoIp2\Database\Reader;

 class About extends CI_Controller{

	function __construct(){

		parent::__construct();
		$this->load->model('Mhome');
		$this->load->helper('url');
		
	
               
		/*
		if($this->session->userdata('status') != "login"){

			redirect(base_url("login"));

            } */

    }
	
    function index(){

		// Increment hit count
        $this->load->library('user_agent');
        $ip_address = $this->input->ip_address();


		if ($this->agent->is_browser())
		{
			$agent = $this->agent->browser().' '.$this->agent->version();
		}
		elseif ($this->agent->is_robot())
		{
			$agent = $this->agent->robot();
		}
		elseif ($this->agent->is_mobile())
		{
			$agent = $this->agent->mobile();
		}
		else
		{
        $agent = 'Other';
		}



        if ($this->agent->is_referral())
		{
			$referrer = $this->agent->referrer();
		}else{
			$referrer = $this->input->server('HTTP_REFERER');
		}


		$utm_params = array(
            'utm_source' => $this->input->get('utm_source'),
            'utm_medium' => $this->input->get('utm_medium'),
            'utm_campaign' => $this->input->get('utm_campaign'),
            'utm_term' => $this->input->get('utm_term'),
            'utm_content' => $this->input->get('utm_content'),
			'utm_link' => $this->input->get('utm_link')
        );

		
        $user_id = $this->session->userdata("name") != null ? $this->session->userdata("id") : 0;

        $art_id = 0;
        $title = "Tentang Kami";
        $this->Mhome->increment_hit_count($title, $user_id, $art_id, $ip_address, $referrer, $utm_params, $agent);


		// Get city and country based on IP address
        require_once 'vendor/autoload.php';
        $reader = new Reader('extension/db/GeoLite2-City.mmdb');
        try {
            $record = $reader->city($ip_address);
            $data['city'] = $record->city->name;
            $data['country'] = $record->country->name;
			if  ($data['city'] == 'Unknown') { $data['city'] = 'Other'; }
			if  ($data['country'] == 'Unknown') { $data['country'] = 'Other'; }
        } catch (Exception $e) {
            $data['city'] = 'Other';
            $data['country'] = 'Other';
        }

		//load the view page
		$this->load->view('view_header');
		$this->load->view('vabout');
		$this->load->view('view_footer');
     }

}
