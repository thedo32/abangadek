<?php
class News extends CI_Controller {
    
    public function __construct() {
        parent::__construct();
        $this->load->model(array('Mnews','Mclient', 'Mproduk'));
	    $this->load->library('pagination');
		$this->load->helper(array('form', 'url', 'text'));

		$this->load->library('form_validation'); // Load form validation library
       
      
    }


	//check if user login
	/* private function check_login() {
        if (!$this->session->userdata('status') || $this->session->userdata('status') != 'login') {
            redirect('login'); // Redirect to login page if not logged in
        }
    } 
	*/


    public function add($menu) {
        // Check if form submitted
		 
      if ($this->input->post()) {
            // Form validation rules
            $this->form_validation->set_rules('title', 'Title', 'required|is_unique[news.title]');
            $this->form_validation->set_rules('text', 'Text', 'required');

            // If form validation succeeds
            if ($this->form_validation->run() == TRUE) {
                // Get form data

				$config['upload_path'] = './storage/app/public/images/blog/';
				$config['allowed_types'] = 'gif|jpg|jpeg|png|heic|webp';
				$config['max_size'] = 2048; // 2MB
				$config['max_width'] = 2048;
				$config['max_height'] = 1536;

				$this->load->library('upload', $config);

				if (!$this->upload->do_upload('cover')) {
					$error = array('error' => $this->upload->display_errors());
					$this->session->set_tempdata('add_success',$error['error'], 15);

					 if ($menu === "client"){
    					redirect('client/index');
					}elseif ($menu === "printing"){
						redirect('produk/printing/index');
					}elseif ($menu === "interior"){
						redirect('produk/interior/index');
					}elseif ($menu === "baliho"){
						redirect('produk/baliho/index');
					}else{
						// Redirect to news list page
						redirect('news/index');
					}

				} else {
					$upload_data = $this->upload->data();
					$cover_path = '/storage/app/public/images/blog/' . $upload_data['file_name'];

					$slug = url_title($this->input->post('title'), 'dash', TRUE);
					$data = array(
						'title' => $this->input->post('title'),
						'slug' => $slug,
						'text' => $this->input->post('text'),
						'cover'=> $cover_path,
						'created_at' => date('Y-m-d H:i:s'),
						'produk' => $this->input->post('produk'),
						'user_id' => 1
					);

					if ($menu === "client"){
    				// Add client in database
					$this->Mclient->add_client($data);
					}elseif (strpos($menu, 'produk') !== false){
						// add produk in database
						$this->Mproduk->add_produk($data);
					}else{
						// add news from database
						$this->Mnews->add_news($data);
					}
					// temporary notification after add success
					$this->session->set_tempdata('add_success','Data baru berhasil ditambahkan', 15);

					if ($menu === "client"){
    					redirect('client/index');
					}elseif (strpos($menu, 'printing') !== false){
						redirect('produk/printing/index');
					}elseif (strpos($menu, 'interior') !== false){
						redirect('produk/interior/index');
					}elseif (strpos($menu, 'baliho') !== false){
						redirect('produk/baliho/index');
					}else{
						// Redirect to news list page
						redirect('news/index');
					}

				}				
												
            }
        }

        // Load add user view
		$this->load->view('view_header');
        $this->load->view('vaddnews');
		$this->load->view('view_footer');
    }

    public function edit($menu,$id) {
    // Check if user id is provided
    if (!$id) {
        show_404();
    }

	

	if ($menu === "client"){
    // Get news data by id
		$news = $this->Mclient->get_client($id);
	}elseif (strpos($menu, 'produk') !== false{
		$news = $this->Mproduk->get_produk($id);
	}else{
		$news = $this->Mnews->get_news($id);
	}

    // If news not found
    if (!$news) {
        show_404();
    }

    // Check if form submitted
    if ($this->input->post()) {
        // Form validation rules

		if ($this->input->post('title') === $news->title): 
			$this->form_validation->set_rules('title', 'Title', 'required');
       	else:
		   $this->form_validation->set_rules('title', 'Title', 'required|is_unique[news.title]');
		endif;
		$this->form_validation->set_rules('text', 'Text', 'required');

        // If form validation succeeds

        if ($this->form_validation->run() == TRUE) {
            // Get form data
				$config['upload_path'] = './storage/app/public/images/blog/';
				$config['allowed_types'] = 'gif|jpg|jpeg|png|heic|webp';
				$config['max_size'] = 2048; // 2MB
				$config['max_width'] = 2048;
				$config['max_height'] = 1536;

				$this->load->library('upload', $config);

				if (!$this->upload->do_upload('cover')) {
					//$error = array('error' => $this->upload->display_errors());
					//$this->session->set_tempdata('add_success',$error['error'], 15);


					$slug = url_title($this->input->post('title'), 'dash', TRUE);
					$data = array(
						'title' => $this->input->post('title'),
						'slug' => $slug,
						'text' => $this->input->post('text'),
						'produk' => $this->input->post('produk'),
						'updated_at' => date('Y-m-d H:i:s')
					);

					
					if ($menu === "client"){
    					// Update kafe in database
						$this->Mclient->edit_client($id, $data);
					}elseif (strpos($menu, 'produk') !== false){
						// Update wisata in database
						$this->Mproduk->edit_produk($id, $data);
					}else{
						// Update news in database
						$this->Mnews->edit_news($id, $data);
					}
					          

					// temporary notification after edit success
					$this->session->set_tempdata('edit_success','Data berhasil diupdate', 15);


					if ($menu === "client"){
    					redirect('client/index');
					}elseif (strpos($menu, 'printing') !== false){
						redirect('produk/printing/index');
					}elseif (strpos($menu, 'interior') !== false){
						redirect('produk/interior/index');
					}elseif (strpos($menu, 'baliho') !== false){
						redirect('produk/baliho/index');
					}else{
						// Redirect to news list page
						redirect('news/index');
					}

				} else {
					$upload_data = $this->upload->data();
					$cover_path = '/storage/app/public/images/blog/' . $upload_data['file_name'];

					$slug = url_title($this->input->post('title'), 'dash', TRUE);
					$data = array(
						'title' => $this->input->post('title'),
						'slug' => $slug,
						'text' => $this->input->post('text'),
						'produk' => $this_>input->post('produk'),
						'cover'=> $cover_path,
						'updated_at' => date('Y-m-d H:i:s')
					);

					if ($menu === "padang"){
    					// Update kafe in database
						$this->Mpadang->edit_padang($id, $data);
					}elseif ($menu === "taluak"){
						// Update wisata in database
						$this->Mtaluak->edit_taluak($id, $data);
					}elseif ($menu === "painan"){
						// Update creative space in database
						$this->Mpainan->edit_painan($id, $data);
					}else{
						// Update news in database
						$this->Mnews->edit_news($id, $data);
					}

          

					// temporary notification after edit success
					$this->session->set_tempdata('edit_success','Berita berhasil diupdate', 15);

					if ($menu === "client"){
    					redirect('client/index');
					}elseif (strpos($menu, 'printing') !== false){
						redirect('produk/printing/index');
					}elseif (strpos($menu, 'interior') !== false){
						redirect('produk/interior/index');
					}elseif (strpos($menu, 'baliho') !== false){
						redirect('produk/baliho/index');
					}else{
						// Redirect to news list page
						redirect('news/index');
					}
				}
			
		}
    }

    // Pass news data to view
    $data['news'] = $news;

    // Load edit news view
	$this->load->view('view_header');
    $this->load->view('veditnews', $data);
	$this->load->view('view_footer');
}


    public function delete($menu, $id) {
        // Check if news id is provided
        if (!$id) {
            show_404();
        }


		if ($menu === "client"){
    		// Delete kafe in database
			$this->Mclient->delete_client($id);
		}elseif ($menu === "produk"){
			// delete wisata in database
			$this->Mproduk->delete_produk($id);
		}else{
			// Delete news from database
			$this->Mnews->delete_news($id);
		}
		
		if ($menu === "client"){
    		redirect('client/index');
		}elseif (strpos($menu, 'printing') !== false){
			redirect('produk/printing/index');
		}elseif (strpos($menu, 'interior') !== false){
			redirect('produk/interior/index');
		}elseif (strpos($menu, 'baliho') !== false){
			redirect('produk/baliho/index');
		}else{
			// Redirect to news list page
			redirect('news/index');
		}

		
    }

    public function index() {

		 // $this->check_login(); // Check if news is logged in

    // Pagination configuration
		$config['base_url'] = base_url('news/index');
		$config['total_rows'] = $this->Mnews->get_total_news();
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

    // Get news with pagination
		$page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
		$data['news'] = array(); // Initialize as empty array
		$data['news'] = $this->Mnews->get_news_news($config['per_page'], $page);
		// Log the fetched data for debugging
		log_message('debug', 'Fetched news data: ' . print_r($data['news'], true));


    // Load news list view
		$this->load->view('view_header');
		$this->load->view('vnewslist', $data);
		$this->load->view('view_footer');
	}


	// View the news 
	public function view($slug = NULL){
        $data['news'] = $this->Mnews->get_news_view($slug);

        if (empty($data['news']))
        {
                show_404();
        }

        // $data['title'] = $data['news_item']['title'];

		$this->load->view('view_header');
        $this->load->view('vnews', $data);
		$this->load->view('view_footer');
   
	}

}
