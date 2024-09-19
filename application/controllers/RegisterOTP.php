<?php
//use Twilio\Rest\Client;
//use Twilio\Exceptions\TwilioException;

class Register extends CI_Controller {
    

    public function __construct() {
        parent::__construct();
        $this->load->model('Muser');
        $this->load->library('pagination');
		$this->load->helper('url');
	$this->load->library('form_validation'); // Load form validation library
        $this->load->helper('form'); // Load form helper
		$this->load->helper('text'); // Load text helper
		$this->load->library('email'); //load library for email
		//$this->load->config('twilio'); // Load Twilio configuration
    }


	//check if user login
	private function check_login() {
        if (!$this->session->userdata('status') || $this->session->userdata('status') != 'login') {
            redirect('login'); // Redirect to login page if not logged in
        }
    }

	/*
	private function send_otp($mobile, $otp) {
        // Load the Twilio PHP SDK
        require_once(APPPATH . 'vendor/autoload.php');

        $sid = $this->config->item('twilio_account_sid');
        $token = $this->config->item('twilio_auth_token');
        $twilio = new Client($sid, $token);

        try {
            $message = $twilio->messages->create(
                $mobile, // Text this number
                [
                    'from' => $this->config->item('twilio_phone_number'), // From a valid Twilio number
                    'body' => 'Your OTP code is: ' . $otp
                ]
            );
            return $message->sid;
        } catch (TwilioException $e) {
            return $e->getMessage();
        }
    }
	*/

    public function add() {
        // Check if form submitted
        if ($this->input->post()) {
            // Form validation rules
            $this->form_validation->set_rules('username', 'Username', 
												'trim|required|is_unique[users.username]|min_length[4]|max_length[20]|alpha_numeric', 
												'callback_username_check');
			$this->form_validation->set_rules('email', 'Email', 'required|is_unique[users.email]|valid_email');
			$this->form_validation->set_rules('mobile', 'Mobile', 'required|is_unique[users.mobile]|min_length[10]|max_length[20]');
			$this->form_validation->set_rules('address', 'Address', 'required|min_length[10]|max_length[254]');
            $this->form_validation->set_rules('password', 'Password', 
											  'trim|required|min_length[8]|regex_match[/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[a-zA-Z]).{8,}$/]');
			$this->form_validation->set_rules('passconf', 'Password Confirmation', 'trim|required|matches[password]');
            
            // If form validation succeeds
            
			/*	if (strpos($send_result, 'SM') !== false) { // Check if the send result is a message SID
                    $this->session->set_userdata('otp', $otp);
                    $this->session->set_userdata('registration_data', array(
                        'username' => $this->input->post('username'),
                        'email' => $this->input->post('email'),
                        'mobile' => $this->input->post('mobile'),
                        'address' => $this->input->post('address'),
                        'password' => password_hash($this->input->post('password'), PASSWORD_DEFAULT)
                    ));
                    redirect('register/verify_otp');
                } else {
                    // Display error message to the user
                    $this->session->set_tempdata('otp_error', 'Failed to send OTP: ' . $send_result, 15);
                    redirect('register/add');
                }
				*/

				    //$this->session->set_userdata('otp', $otp);
                     $data = array(
                    'username' => $this->input->post('username'),
                    'email' => $this->input->post('email'),
					'mobile' => $this->input->post('email'),
					'address' => $this->input->post('address'),
                    'password' => password_hash($this->input->post('password'), PASSWORD_DEFAULT)
					);
                    
					 // Add user to database
                $this->Muser->add_user($data);

				//sending email for notification
				
				/* $this->email->from('jeffriargon@gmail.com', 'jeffriargon@gmail.com');
				$this->email->to($this->input->post('email'));
				
				$this->email->subject('Email Test');
				$this->email->message('Testing the email for registration.'); */

			

				if ($this->email->send()): 
					// temporary notification after send 
					$this->session->set_tempdata('email_sent','Email untuk verifikasi user berhasil dikirimkan', 15);
				else: 
					// temporary notification after send fail
					$this->session->set_tempdata('email_failed','Email untuk verifikasi user masih terkendala untuk dikirimkan', 15);
				endif;
								
								
                // Redirect to user list page
				if ($this->session->userdata("name") === 'Alpha' ){
					redirect('register/index');
				}else{
					redirect('login');
				}

                
			}

        $this->load->view('view_header');
        $this->load->view('vadduser');
        $this->load->view('view_footer');
    }

    /*
    public function verify_otp() {
        if ($this->input->post()) {
            $submitted_otp = $this->input->post('otp');

            if ($submitted_otp == $this->session->userdata('otp')) {
                $registration_data = $this->session->userdata('registration_data');

                $this->Muser->add_user($registration_data);

                $this->session->unset_userdata('otp');
                $this->session->unset_userdata('registration_data');

                redirect('register/index');
            } else {
                $this->session->set_flashdata('error', 'Invalid OTP. Please try again.');
            }
        }

        $this->load->view('view_header');
        $this->load->view('vverifyotp');
        $this->load->view('view_footer');
    }
	*/

	public function username_check($str)
        {
			 	
		   if ($str == 'test')
           {
				$this->form_validation->set_message('username_check', 'The {field} field can not be the word "test"');
				return FALSE;
           }
           else 
           {
                return TRUE;
		   }
        }

    public function edit($id) {
    // Check if user id is provided
    if (!$id) {
        show_404();
    }

    // Get user data by id
    $user = $this->Muser->get_user($id);

    // If user not found
    if (!$user) {
        show_404();
    }

    // Check if form submitted
    if ($this->input->post()) {
        // Form validation rules
			if ($this->input->post('username') === $user->username || $this->input->post('username') === "Alpha" ): 
				$this->form_validation->set_rules('username', 'Username', 
												'required|min_length[4]|max_length[20]|alpha_numeric', 
												'callback_username_check');
			else:
				$this->form_validation->set_rules('username', 'Username', 
												'required|is_unique[users.username]|min_length[4]|max_length[20]|alpha_numeric', 
												'callback_username_check');
			endif;									

			if ($this->input->post('username') === $user->username || $this->input->post('username') === "Alpha"  ): 
				$this->form_validation->set_rules('email', 'Email', 'required');
			else:
				$this->form_validation->set_rules('email', 'Email', 'required|is_unique[users.email]');
			endif;	

			$this->form_validation->set_rules('mobile', 'Mobile', 'required|is_unique[users.mobile]|min_length[10]|max_length[20]');
			$this->form_validation->set_rules('address', 'Address', 'required|min_length[10]|max_length[254]');
            $this->form_validation->set_rules('password', 'Password', 
											  'trim|required|min_length[8]|regex_match[/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[a-zA-Z]).{8,}$/]');
			$this->form_validation->set_rules('passconf', 'Password Confirmation', 'trim|required|matches[password]');
            
        // If form validation succeeds
        if ($this->form_validation->run() == TRUE) {
            // Get form data
            $data = array(
				'username' => $this->input->post('username'),
                'email' => $this->input->post('email'),
				'mobile' => $this->input->post('email'),
				'address' => $this->input->post('address'),
                'password' => password_hash($this->input->post('password'), PASSWORD_DEFAULT)
                );

            // Update user in database
            $this->Muser->edit_user($id, $data);


			// temporary notification after edit success
				$this->session->set_tempdata('edit_success','User berhasil diupdate', 15);

            // Redirect to user list page
            redirect('register/index');
        }
    }

    // Pass user data to view
    $data['user'] = $user;

    // Load edit user view
		
	$this->load->view('view_header');
    $this->load->view('vedituser', $data);
	$this->load->view('view_footer');
}


    public function delete($id) {
        // Check if user id is provided
        if (!$id) {
            show_404();
        }

        // Delete user from database
        $this->Muser->delete_user($id);

        // Redirect to user list page
		redirect('register/index');
    }

    public function index() {

		 //$this->check_login(); // Check if user is logged in

    // Pagination configuration
		$config['base_url'] = base_url('register/index');
		$config['total_rows'] = $this->Muser->get_total_users();
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

    // Get users with pagination
		$page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
		$data['users'] = $this->Muser->get_users($config['per_page'], $page);

    // Load user list view
		
		$this->load->view('view_header');
		$this->load->view('vuserlist', $data);
		$this->load->view('view_footer');
		
	}

}
