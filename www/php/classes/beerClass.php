<?php
    class Beer{
        protected $_id;
        protected $_name;
        protected $_brewery;
        protected $_category;
        protected $_price;
        protected $_abv;
        protected $_description;
        protected $_available;
        protected $_country;
        protected $_size;
        protected $_imageURL;

        function __construct($id, $name, $brewery, $category, $price, $abv, $description, $available, $country, $size, $imageURL){
            $this->_id = $id;
            $this->_name = $name; 
            $this->_brewery = $brewery;
            $this->_category = $category;
            $this->_price = $price;
            $this->_abv = $abv;
            $this->_description = $description;
            $this->_available = $available;
            $this->_country = $country;
            $this->_size = $size;
            $this->_imageURL = $imageURL;
        }

        public function get_id(){
            return $this->_id;
        }

        public function get_name(){
            return $this->_name;
        }

        public function get_brewery(){
            return $this->_brewery;
        }

        public function get_category(){
            return $this->_category;
        }

        public function get_price(){
            return $this->_price;
        }

        public function get_abv(){
            return $this->_abv;
        }

        public function get_description(){
            return $this->_description;
        }

        public function is_available(){
            return $this->_available;
        }

        public function get_country(){
            return $this->_country;
        }

        public function get_size(){
            return $this->_size;
        }

        public function get_imageURL(){
            return $this->_imageURL;
        }
    }
