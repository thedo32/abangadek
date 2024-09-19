<?php

use GeoIp2\Database\Reader;

class Mproduk extends CI_Model {

    public function __construct() {
        parent::__construct();
       
        $this->load->database();  // Load the database library
    }

    // Add news to the database
    public function add_produk($data) {
        return $this->db->insert('product', $data);
    }

    // Get news by ID
     public function get_produk($id) {
        $query = $this->db->get_where('product', array('id' => $id));
        return $query->row(); // Fetch the row as an object
    }

	// Get news by slug
     public function get_produk_view($slug) {
		$query = $this->db->get_where('product', array('slug' => $slug));
        return $query->row(); // Fetch the row as an object
    }

    // Update news in the database
    public function edit_produk($id, $data) {
        $this->db->where('id', $id);
        return $this->db->update('product', $data);
    }

    // Delete news from the database
    public function delete_produk($id) {
        $this->db->where('id', $id);
        return $this->db->delete('product');
    }

    // Get total number of news
    public function get_total_produk($menu) {
        $this->db->where('produk', $menu);
		//return $this->db->count_all('product');
		return $this->db->count_all_results('product');  // Use count_all_results() with where condition
    }

    // Get news with pagination
    public function get_produk_produk($limit, $offset, $menu) {
		$this->db->where('produk', $menu);
		$this->db->order_by('updated_at', 'DESC');
        $this->db->limit($limit, $offset);
        $query = $this->db->get('product');
        return $query->result_array();
    }


	public function increment_hit_count($title, $user_id, $id, $ip_address, $referrer) {
        
		 // Increment the hit count in the taluak table
         //$this->db->where('id', $id);
         //$this->db->set('hit_count', 'hit_count+1', FALSE);
         //$this->db->update('taluak');
    }	
}
