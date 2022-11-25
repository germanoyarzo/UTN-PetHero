<?php namespace Models;

    class Recover {
        
        private $email;
        private $newPass;
        private $keyword;
    
        public function getEmail() { return $this->email; }
        public function getNewPass() { return $this->newPass; }

        public function setEmail($email) { $this->email = $email; }
        public function setNewPass($newPass) { $this->newPass = $newPass; }



        /**
         * Get the value of keyword
         */ 
        public function getKeyword()
        {
                return $this->keyword;
        }

        /**
         * Set the value of keyword
         *
         * @return  self
         */ 
        public function setKeyword($keyword)
        {
                $this->keyword = $keyword;

                return $this;
        }
    }

?>