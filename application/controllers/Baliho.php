<?php

use GeoIp2\Database\Reader;

class Baliho extends CI_Controller {
    
    public function __construct() {
        parent::__construct();
		$this->load->model('Mhome');
        $this->load->model('Mproduk');
        $this->load->library('pagination');
		$this->load->helper('url');

		$this->load->library('form_validation'); // Load form validation library
        $this->load->helper('form'); // Load form helper
		$this->load->helper('text'); // Load text helper
    }


	//check if user login
	/* private function check_login() {
        if (!$this->session->userdata('status') || $this->session->userdata('status') != 'login') {
            redirect('login'); // Redirect to login page if not logged in
        }
    } 
	*/


    public function index() {

		 // $this->check_login(); // Check if printing is logged in

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
            'utm_content' => $this->input->get('utm_content')
        );


        $user_id = $this->session->userdata("name") != null ? $this->session->userdata("id") : 0;

        $art_id = 0;
        $title = "Baliho";
        $this->Mhome->increment_hit_count($title, $user_id, $art_id, $ip_address, $referrer, $utm_params, $agent);
		//$this->Mhome->bulk_update_coordinates();


		// Get city and country based on IP address
        require_once 'vendor/autoload.php';
        $reader = new Reader('extension/db/GeoLite2-City.mmdb');
        try {
            $record = $reader->city($ip_address);
            $data['city'] = $record->city->name;
            $data['country'] = $record->country->name;
			
			// Get latitude and longitude
			$data['lat'] = $record->location->latitude ?? 0;
			$data['lon'] = $record->location->longitude ?? 0;

			if  ($data['city'] == 'Unknown') { $data['city'] = 'Other'; }
			if  ($data['country'] == 'Unknown') { $data['country'] = 'Other'; }

			// error_log("IP: $ip_address, City: $city, Country: $country, Latitude: $latitude, Longitude: $longitude");


        } catch (Exception $e) {
			//error_log("GeoIP Error: " . $e->getMessage());

            $data['city'] = 'Other';
            $data['country'] = 'Other';
			$data['lat'] = 0;
			$data['lon'] = 0;
        }

    // Pagination configuration
		$config['base_url'] = base_url('baliho/index');
		$config['total_rows'] = $this->Mproduk->get_total_produk("Baliho");
		$config['per_page'] = 6;
		$config['uri_segment'] = 3;

    // Additional pagination settings for better display
		$config['full_tag_open'] = '<div class="pagination">';
		$config['full_tag_close'] = '</div>';
		$config['first_link'] = 'First';
		$config['last_link'] = 'Last';
		$config['next_link'] = '&gt;';
		$config['prev_link'] = '&lt;';

		$this->pagination->initialize($config);

    // Get baliho with pagination
		$page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
		$data['baliho'] = array(); // Initialize as empty array
		$data['baliho'] = $this->Mproduk->get_produk_produk($config['per_page'], $page, "Baliho");
		
		// Fetch all Baliho coordinates for the map (no pagination)
		$data['baliho_all'] = $this->Mproduk->get_all_coordinates('Baliho'); // Assuming this method returns all Baliho data with coordinates


		// Log the fetched data for debugging
		//log_message('debug', 'Fetched baliho data: ' . print_r($data['baliho'], true));


    // Load baliho list view
		$this->load->view('view_header');
		$this->load->view('vbaliholist', $data);
		$this->load->view('view_footer');
	}


	// View the baliho 
	public function view($slug = NULL){
        $data['baliho'] = $this->Mproduk->get_produk_view($slug);

        if (empty($data['baliho']))
        {
                show_404();
        }

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
            'utm_content' => $this->input->get('utm_content')
        );


        $user_id = $this->session->userdata("name") != null ? $this->session->userdata("id") : 0;

        $title=$data['baliho']->title;
		$art_id=$data['baliho']->id;
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


        // $data['title'] = $data['baliho_item']['title'];

		$this->load->view('view_header');
        $this->load->view('vbaliho', $data);
		$this->load->view('view_footer');
   
	}

}
