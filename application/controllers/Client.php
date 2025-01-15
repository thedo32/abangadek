<?php

use GeoIp2\Database\Reader;

class Client extends CI_Controller {
    
    public function __construct() {
        parent::__construct();
		$this->load->model('Mhome');
        $this->load->model('Mclient');
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


    public function add() {
        // Check if form submitted
		 
      if ($this->input->post()) {
            // Form validation rules
            $this->form_validation->set_rules('title', 'Title', 'required|is_unique[client.title]');
            $this->form_validation->set_rules('text', 'Text', 'required');

            // If form validation succeeds
            if ($this->form_validation->run() == TRUE) {
                // Get form data

				$slug = url_title($this->input->post('title'), 'dash', TRUE);
                $data = array(
                    'title' => $this->input->post('title'),
                    'slug' => $slug,
                    'text' => $this->input->post('text')
                );

                // Add client to database
                $this->Mclient->add_client($data);

				// temporary notification after add success
				$this->session->set_tempdata('add_success','Berita baru berhasil ditambahkan', 15);

                // Redirect to user list page
                redirect('client/index');
				
            }
        }

        // Load add user view
		$this->load->view('view_header');
        $this->load->view('vaddclient');
		$this->load->view('view_footer');
    }

    public function edit($id) {
    // Check if user id is provided
    if (!$id) {
        show_404();
    }

    // Get client data by id
    $client = $this->Mclient->get_client($id);

    // If client not found
    if (!$client) {
        show_404();
    }

    // Check if form submitted
    if ($this->input->post()) {
        // Form validation rules

		if ($this->input->post('title') === $client->title): 
			$this->form_validation->set_rules('title', 'Title', 'required');
       	else:
		   $this->form_validation->set_rules('title', 'Title', 'required|is_unique[client.title]');
		endif;
		$this->form_validation->set_rules('text', 'Text', 'required');

        // If form validation succeeds

        if ($this->form_validation->run() == TRUE) {
            // Get form data
			$slug = url_title($this->input->post('title'), 'dash', TRUE);
            $data = array(
                'title' => $this->input->post('title'),
                'slug' => $slug,
				'text' => $this->input->post('text')
            );

            // Update client in database
            $this->Mclient->edit_client($id, $data);

			// temporary notification after edit success
				$this->session->set_tempdata('edit_success','Berita berhasil diupdate', 15);

            // Redirect to client list page
            redirect('client/index');
        }
    }

    // Pass client data to view
    $data['client'] = $client;

    // Load edit client view
	$this->load->view('view_header');
    $this->load->view('veditclient', $data);
	$this->load->view('view_footer');
}


    public function delete($id) {
        // Check if client id is provided
        if (!$id) {
            show_404();
        }

        // Delete client from database
        $this->Mclient->delete_client($id);

        // Redirect to client list page
        redirect('client/index');
    }

    public function index() {

		 // $this->check_login(); // Check if client is logged in

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
        $title = "Client";
        $this->Mhome->increment_hit_count($title, $user_id, $art_id, $ip_address, $referrer, $utm_params, $agent);

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
		$config['base_url'] = base_url('client/index');
		$config['total_rows'] = $this->Mclient->get_total_client();
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

    // Get client with pagination
		$page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
		$data['client'] = array(); // Initialize as empty array
		$data['client'] = $this->Mclient->get_client_client($config['per_page'], $page);
		// Log the fetched data for debugging
		log_message('debug', 'Fetched client data: ' . print_r($data['client'], true));


    // Load client list view
		$this->load->view('view_header');
		$this->load->view('vclientlist', $data);
		$this->load->view('view_footer');
	}


	// View the client 
	public function view($slug = NULL){
        $data['client'] = $this->Mclient->get_client_view($slug);

        if (empty($data['client']))
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

        $title=$data['client']->title;
		$art_id=$data['client']->id;
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


        // $data['title'] = $data['client_item']['title'];

		$this->load->view('view_header');
        $this->load->view('vclient', $data);
		$this->load->view('view_footer');
   
	}

}
