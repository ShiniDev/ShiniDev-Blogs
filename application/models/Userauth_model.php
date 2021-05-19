<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Userauth_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }
    /**
     *  Insert User
     * 
     *  Inserts the following data to the database 
     * 
     *  @param string $username
     *  @param string $password
     *  @param int    $status
     *  @return void
     */
    public function insert_user(string $user_name, string $password, int $status = 0): void
    {
        $query = $this->db->query('SELECT NULL FROM users LIMIT 1');
        if ($query->num_rows()) { // Not Empty, create a standard account
            $password = password_hash($password, PASSWORD_BCRYPT);
            $statement = "INSERT INTO users (status, name, password) VALUES (?, ?, ?)";
            $this->db->query($statement, array($status, $user_name, $password));
        } else {                  // Empty, create an admin account
            $password = password_hash($password, PASSWORD_BCRYPT);
            $statement = "INSERT INTO users (status, name, password) VALUES (?, ?, ?)";
            $this->db->query($statement, array(1, $user_name, $password));
        }
    }
    /**
     *  Verify User
     *  
     *  This functions verifies the given parameter if it exists in the
     *  database and checks if the password is correct. A value of 0 is
     *  returned if it is legit, 1 if the password is incorrect and 2 
     *  if the username does not exists.
     * 
     *  @param string $username
     *  @param string $password
     *  @return int $err_status
     */
    public function verify_user(string $username, string $password): int
    {
        $err_status = 0;
        $statement = "SELECT * FROM users WHERE name = ?";
        $query = $this->db->query($statement, array($username))->row_array();
        if ($query !== NULL) {
            $pass_hash = $query['password'];
            if (!password_verify($password, $pass_hash)) {
                $err_status = 1; // Invalid Password
            }
        } else {
            $err_status = 2;    // Username does not exists
        }
        return $err_status;
    }
}
