<?php
    class User{
        protected $_username;
        protected $_email;
        protected $_admin;
        protected $_id;

        function __construct($username, $email, $admin, $id){
            $this->_username = $username;
            $this->_email = $email;
            $this->_admin = $admin;
            $this->_id = $id;
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

        function get_id(){
            return $this->_id;
        }
    }
?>
