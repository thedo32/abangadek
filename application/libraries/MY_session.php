<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MY_Session extends CI_Session {

    protected function _driver()
    {
        // Use custom database driver
        if ($this->_config['sess_driver'] === 'database') {
            $this->_config['sess_driver'] = 'MY_Session_database_driver';
        }

        parent::_driver();
    }
}
