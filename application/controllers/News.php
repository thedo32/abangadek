<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class News extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Mnews');
        $this->load->model('Mclient');
        $this->load->model('Mproduk');
        $this->load->library('form_validation');
        $this->load->helper('url');
    }

    // Function to add news/client/produk
    public function add($menu) {
        // Check if form is submitted
        if ($this->input->post()) {
            // Form validation rules
            if ($menu === "client") {
                $this->form_validation->set_rules('title', 'Title', 'required|is_unique[client.title]');
            } elseif ($menu === "produk") {
                $this->form_validation->set_rules('title', 'Title', 'required|is_unique[produk.title]');
            } else {
                $this->form_validation->set_rules('title', 'Title', 'required|is_unique[news.title]');
            }

            $this->form_validation->set_rules('text', 'Text', 'required');
            $this->form_validation->set_rules('produk', 'Produk', 'required');

            // If form validation succeeds
            if ($this->form_validation->run() == TRUE) {
                $config['upload_path'] = './storage/app/public/images/blog/';
                $config['allowed_types'] = 'gif|jpg|jpeg|png|heic|webp';
                $config['max_size'] = 4096; // 4MB
                $config['max_width'] = 3000;
                $config['max_height'] = 3000;

                $this->load->library('upload', $config);

                // Check if an image is uploaded or if an existing cover is selected
                $existing_cover = $this->input->post('existing_cover'); // Field for existing cover path

                if (!$this->upload->do_upload('cover') && empty($existing_cover)) {
                    // Handle file upload error and no existing cover selected
                    $error = array('error' => $this->upload->display_errors());
                    $this->session->set_tempdata('add_success', $error['error'], 15);
                    $this->_redirect_based_on_menu($menu);

                } else {
                    // Use the uploaded cover if it exists, otherwise use the existing cover
                    if ($this->upload->data()) {
                        $upload_data = $this->upload->data();
                        $cover_path = '/storage/app/public/images/blog/' . $upload_data['file_name'];
                    } else {
                        $cover_path = $existing_cover; // Use existing cover from hosting
                    }

                    // Prepare data for insertion
                    $slug = url_title($this->input->post('title'), 'dash', TRUE);
                    $data = array(
                        'title' => $this->input->post('title'),
                        'slug' => $slug,
                        'text' => $this->input->post('text'),
                        'cover' => $cover_path,
                        'created_at' => date('Y-m-d H:i:s'),
                        'produk' => $this->input->post('produk'),
                        'coordinate' => $this->input->post('coordinate'),
                        'user_id' => 1 // Assuming user_id is always 1, or fetch dynamically
                    );

                    // Insert into the relevant table based on the menu
                    $this->_insert_based_on_menu($menu, $data);

                    // Set success notification
                    $this->session->set_tempdata('add_success', 'Data baru berhasil ditambahkan', 15);
                    $this->_redirect_based_on_menu($menu);
                }
            }
        }

        // Load view for adding news
        $this->load->view('view_header');
        $this->load->view('vaddnews');
        $this->load->view('view_footer');
    }

    // Function to edit news/client/produk
    public function edit($menu, $id) {
        // Check if news exists by ID
        if (!$id) {
            show_404();
        }

        // Fetch the news record based on the menu
        if ($menu === "client") {
            $news = $this->Mclient->get_client($id);
        } elseif ($menu === "produk") {
            $news = $this->Mproduk->get_produk($id);
        } else {
            $news = $this->Mnews->get_news($id);
        }

        if (!$news) {
            show_404();
        }

        // Check if form submitted
        if ($this->input->post()) {
            // Form validation
            $this->_set_validation_rules($menu, $news);

            // If form validation succeeds
            if ($this->form_validation->run() == TRUE) {
                $config['upload_path'] = './storage/app/public/images/blog/';
                $config['allowed_types'] = 'gif|jpg|jpeg|png|heic|webp';
                $config['max_size'] = 4096; // 4MB
                $config['max_width'] = 3000;
                $config['max_height'] = 3000;

                $this->load->library('upload', $config);

                // Handle file upload or existing cover
                $existing_cover = $this->input->post('existing_cover');

                if (!$this->upload->do_upload('cover') && empty($existing_cover)) {
                    // Handle file upload error and no existing cover
                    $slug = url_title($this->input->post('title'), 'dash', TRUE);
                    $data = array(
                        'title' => $this->input->post('title'),
                        'slug' => $slug,
                        'text' => $this->input->post('text'),
                        'produk' => $this->input->post('produk'),
                        'updated_at' => date('Y-m-d H:i:s')
                    );
                    $this->_update_based_on_menu($menu, $id, $data);
                    $this->_redirect_based_on_menu($menu);

                } else {
                    // Use the uploaded cover if it exists, otherwise use the existing cover
                    if ($this->upload->data()) {
                        $upload_data = $this->upload->data();
                        $cover_path = '/storage/app/public/images/blog/' . $upload_data['file_name'];
                    } else {
                        $cover_path = $existing_cover;
                    }

                    $slug = url_title($this->input->post('title'), 'dash', TRUE);
                    $data = array(
                        'title' => $this->input->post('title'),
                        'slug' => $slug,
                        'text' => $this->input->post('text'),
                        'produk' => $this->input->post('produk'),
                        'coordinate' => $this->input->post('coordinate'),
                        'cover' => $cover_path,
                        'updated_at' => date('Y-m-d H:i:s')
                    );
                    $this->_update_based_on_menu($menu, $id, $data);
                    $this->session->set_tempdata('edit_success', 'Data berhasil diupdate', 15);
                    $this->_redirect_based_on_menu($menu);
                }
            }
        }

        // Pass the news data to the view
        $data['news'] = $news;

        // Load the edit view
        $this->load->view('view_header');
        $this->load->view('veditnews', $data);
        $this->load->view('view_footer');
    }

    // Helper function to redirect based on menu
    private function _redirect_based_on_menu($menu) {
        if ($menu === "client") {
            redirect('client/index');
        } elseif ($menu === "produk") {
            redirect('produk/index');
        } else {
            redirect('news/index');
        }
    }

    // Helper function to insert data based on menu
    private function _insert_based_on_menu($menu, $data) {
        if ($menu === "client") {
            $this->Mclient->add_client($data);
        } elseif ($menu === "produk") {
            $this->Mproduk->add_produk($data);
        } else {
            $this->Mnews->add_news($data);
        }
    }

    // Helper function to update data based on menu
    private function _update_based_on_menu($menu, $id, $data) {
        if ($menu === "client") {
            $this->Mclient->edit_client($id, $data);
        } elseif ($menu === "produk") {
            $this->Mproduk->edit_produk($id, $data);
        } else {
            $this->Mnews->edit_news($id, $data);
        }
    }

    // Helper function to set validation rules
    private function _set_validation_rules($menu, $news) {
        if ($menu === "client") {
            if ($this->input->post('title') === $news->title) {
                $this->form_validation->set_rules('title', 'Title', 'required');
            } else {
                $this->form_validation->set_rules('title', 'Title', 'required|is_unique[client.title]');
            }
        } elseif ($menu === "produk") {
            if ($this->input->post('title') === $news->title) {
                $this->form_validation->set_rules('title', 'Title', 'required');
            } else {
                $this->form_validation->set_rules('title', 'Title', 'required|is_unique[produk.title]');
            }
        } else {
            if ($this->input->post('title') === $news->title) {
                $this->form_validation->set_rules('title', 'Title', 'required');
            } else {
                $this->form_validation->set_rules('title', 'Title', 'required|is_unique[news.title]');
            }
        }

        $this->form_validation->set_rules('text', 'Text', 'required');
        $this->form_validation->set_rules('produk', 'Produk', 'required');
    }
}
