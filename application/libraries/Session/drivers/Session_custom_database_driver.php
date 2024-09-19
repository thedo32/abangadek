<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class CI_Session_custom_database_driver extends CI_Session_driver implements CI_Session_driver_interface, SessionHandlerInterface {

    protected $db;
    protected $table;

    public function __construct(&$params) {
        parent::__construct($params);

        // Load the database library
        $this->CI =& get_instance();
        $this->CI->load->database();
        $this->db = $this->CI->db;

        // Set the session table name
        $this->table = $this->_config['save_path'];
    }

    public function open($save_path, $name) {
        return true;
    }

    public function close() {
        return true;
    }

    public function read($session_id) {
        $result = $this->db->get_where($this->table, array('id' => $session_id));

        if ($result->num_rows() === 1) {
            $row = $result->row();
            return $row->data;
        }

        return '';
    }

    public function write($session_id, $session_data) {
        $CI =& get_instance();
        $CI->load->database();

        $user_id = $CI->session->userdata('id') ? $CI->session->userdata('id') : 0;

        // Prepare the data to insert/update
        $data = array(
            'id' => $session_id,
            'ip_address' => $CI->input->ip_address(),
            'timestamp' => time(),
            'data' => $session_data,
            'user_id' => $user_id,
        );

        // Check if session ID already exists
        $query = $CI->db->get_where('ci_sessions', array('id' => $session_id));

        if ($query->num_rows() > 0) {
            // Update the existing session data
            $CI->db->where('id', $session_id);
            $CI->db->update('ci_sessions', $data);
        } else {
            // Insert new session data
            $CI->db->insert('ci_sessions', $data);
        }

        return true;
    }

    public function destroy($session_id) {
        $CI =& get_instance();
        $CI->load->database();

        // Update the user's session_id to NULL in the database
        $CI->db->where('session_id', $session_id);
        $CI->db->update('users', array('session_id' => NULL));

        // Delete the session from the sessions table
        $CI->db->where('id', $session_id);
        $CI->db->delete('ci_sessions');

        return true;
    }

    public function gc($maxlifetime) {
        $CI =& get_instance();
        $CI->load->database();

        // Calculate the expiration time
        $expire_time = time() - $maxlifetime;

        // Set session_id to NULL for expired sessions in users table
        $CI->db->where('last_activity <', $expire_time);
        $CI->db->update('users', array('session_id' => NULL));

        // Erase data for expired sessions in sessions table
        $CI->db->where('timestamp <', $expire_time);
        $CI->db->delete('ci_sessions');

        return true;
    }

    public function updateTimestamp($session_id, $data) {
        $this->db->set('timestamp', time())
                 ->where('id', $session_id)
                 ->update($this->table);
        return true;
    }

    public function validateId($session_id) {
        $result = $this->db->get_where($this->table, array('id' => $session_id));

        return $result->num_rows() === 1;
    }

    protected function _unserialize($data) {
        $data = @unserialize($this->_prepare_raw_data($data));
        return is_array($data) ? $data : array();
    }

    protected function _prepare_raw_data($data) {
        return (substr($data, 0, 4) === 'ci_s') ? substr($data, 4) : $data;
    }
}
