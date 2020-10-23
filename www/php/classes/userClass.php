<?php
    class User{
        protected $_username;
        protected $_email;
        protected $_admin;

        function __construct($username, $email, $admin){
            $this->_username = $username;
            $this->_email = $email;
            $this->_admin = $admin;
        }

        public function get_name(){
            return $this->_username;
        }

        function is_admin(){
            return $this->_admin;
        }

        function get_email(){
            return $this->_email;
        }
    }
?>
