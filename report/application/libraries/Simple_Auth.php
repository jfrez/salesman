<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Tarek
 * Date: 4/18/12
 * Time: 5:27 PM
 * To change this template use File | Settings | File Templates.
 */

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Simple_Auth
{
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->CI =& get_instance();
    }

    // --------------------------------------------------------------------------

    public function log_in() { }

    // --------------------------------------------------------------------------

    public function log_out() { }

    // --------------------------------------------------------------------------

    /**
     * Create new user
     *
     * This function creates a new user.  It does check to make
     * sure a user with the same email or username does not already
     * exists.  Return FALSE if the user exists, return the new users
     * id if the user exists.
     *
     * @todo    consider just using callbacks in the controller
     * to test for a unique username or email
     *
     * @param   string      username
     * @param   string      password
     * @param   string      email address
     * @return  mixed       user_id
     */
    public function create_user($username, $password, $email)
    {
        $qry = $this->CI->db->where('username', $username)
            ->or_where('email', $email)
            ->get('simple_auth_users');

        if ($qry->num_rows() !== 0)
        {
            return FALSE;
        }

        $salt = $this->_create_salt();

        $data = array(
            'username'      => $username,
            'password'      => sha1($password.$salt),
            'email'         => $email,
            'salt'          => $salt,
            'status'        => 1,
        );

        $this->CI->db->where('status', 1)
            ->insert('simple_auth_users', $data);

        return $this->CI->db->insert_id();
    }

// --------------------------------------------------------------------------

    /**
     * Create Salt
     *
     * This function will create a salt hash to be used in
     * authentication
     *
     * @return  string      the salt
     */
    protected function _create_salt()
    {
        $this->CI->load->helper('string');
        return sha1(random_string('alnum', 32));
    }

    // --------------------------------------------------------------------------

    public function is_logged_in() { }

    // --------------------------------------------------------------------------

    public function change_password() { }

    // --------------------------------------------------------------------------

    public function forgot_password() { }

    // --------------------------------------------------------------------------
}