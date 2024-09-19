<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MY_Session_database_driver extends CI_Session_database_driver {

    public function __construct($params) {
        parent::__construct($params);
    }

    // Overriding the write function to update last_activity and user_id
    public function write($session_id, $session_data) {
        // Perform the standard write operation first
        if (!parent::write($session_id, $session_data)) {
            return FALSE;
        }

        // Extract user_id (stored as "id") from session data
        $session_array = $this->_unserialize($session_data);
        $user_id = isset($session_array['id']) ? $session_array['id'] : 0;

        // Update the last_activity and user_id fields
        $this->CI->db->set('last_activity', time())
                     ->set('user_id', $user_id)
                     ->where('id', $session_id)
                     ->update($this->_config['save_path']);
                     
        log_message('debug', 'Session updated with user_id: ' . $user_id . ' and last_activity: ' . time());
             
        return TRUE;
    }

    // Add the unserialize function to convert session data to an array
    protected function _unserialize($data) {
        $data = @unserialize($this->_prepare_raw_data($data));
        return is_array($data) ? $data : array();
    }

    // Add the prepare_raw_data function to prepare raw data
    protected function _prepare_raw_data($data) {
        return (substr($data, 0, 4) === 'ci_s') ? substr($data, 4) : $data;
    }
}
