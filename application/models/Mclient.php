<?php

use GeoIp2\Database\Reader;

class Mclient extends CI_Model {

    public function __construct() {
        parent::__construct();
       
        $this->load->database();  // Load the database library
    }

    // Add news to the database
    public function add_client($data) {
        return $this->db->insert('client', $data);
    }

    // Get news by ID
     public function get_client($id) {
        $query = $this->db->get_where('client', array('id' => $id));
        return $query->row(); // Fetch the row as an object
    }

	// Get news by slug
     public function get_client_view($slug) {
		$query = $this->db->get_where('client', array('slug' => $slug));
        return $query->row(); // Fetch the row as an object
    }

    // Update news in the database
    public function edit_client($id, $data) {
        $this->db->where('id', $id);
        return $this->db->update('client', $data);
    }

    // Delete news from the database
    public function delete_client($id) {
        $this->db->where('id', $id);
        return $this->db->delete('client');
    }

    // Get total number of news
    public function get_total_client() {
        return $this->db->count_all('client');
    }

    // Get news with pagination
    public function get_client_client($limit, $offset) {
		$this->db->order_by('updated_at', 'DESC');
        $this->db->limit($limit, $offset);
        $query = $this->db->get('client');
        return $query->result_array();
    }


	public function increment_hit_count($title, $user_id, $id, $ip_address, $referrer) {
        
		 // Increment the hit count in the taluak table
         //$this->db->where('id', $id);
         //$this->db->set('hit_count', 'hit_count+1', FALSE);
         //$this->db->update('taluak');
    }	
}
