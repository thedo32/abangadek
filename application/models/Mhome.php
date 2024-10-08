<?php

use GeoIp2\Database\Reader;

class Mhome extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database();  // Load the database library
    }

    public function increment_hit_count($title, $user_id, $id, $ip_address, $referrer, $utm_params,$agent) {
        // Check if the IP address has already hit this entry within the last month
        $query = $this->db->get_where('hits', array(
            'art_id' => $id,
            'user_id' => $user_id,
            'title' => $title,
			'agent' => $agent,
            'ip_address' => $ip_address
        ));

        if ($query->num_rows() == 0 || (strtotime(date('Y-m-d H:i:s')) - strtotime($query->row()->hit_time)) >= 2592000) {
            // Use GeoIP2 library to get city and country
            require_once 'vendor/autoload.php';
            $reader = new Reader('extension/db/GeoLite2-City.mmdb');

            try {
                $record = $reader->city($ip_address);
                $city = $record->city->name ?? 'Other';
                $country = $record->country->name ?? 'Other';
            } catch (Exception $e) {
                $city = 'Other';
                $country = 'Other';
            }

            // Insert a new record in the hits table
            $data = array(
                'art_id' => $id,
                'user_id' => $user_id,
                'title' => $title,
                'ip_address' => $ip_address,
                'hit_time' => date('Y-m-d H:i:s'),
                'city' => $city,
                'country' => $country,
                'referrer' => $referrer,
                'utm_source' => isset($utm_params['utm_source']) ? $utm_params['utm_source'] : null,
                'utm_medium' => isset($utm_params['utm_medium']) ? $utm_params['utm_medium'] : null,
                'utm_campaign' => isset($utm_params['utm_campaign']) ? $utm_params['utm_campaign'] : null,
                'utm_term' => isset($utm_params['utm_term']) ? $utm_params['utm_term'] : null,
                'utm_content' => isset($utm_params['utm_content']) ? $utm_params['utm_content'] : null,
				'agent' => $agent,
            );

            $this->db->insert('hits', $data);


		    // Increment the hit count in the painan table
            //$this->db->where('id', $id);
            //$this->db->set('hit_count', 'hit_count+1', FALSE);
            //$this->db->update('painan');
        }
    }
}
