<?php

namespace Models;

class User
{
        public $id;
        private $email;
        private $password;
        private $role;  //Owner or Keeper
        private $firstName;
        private $lastName;
        private $dni;
        private $phoneNumber;
        private $keyword;

        public function getId()
        {
                return $this->id;
        }

        public function setId($id)
        {
                $this->id = $id;
                return $this;
        }

        public function getEmail()
        {
                return $this->email;
        }

        public function setEmail($email)
        {
                $this->email = $email;
                return $this;
        }


        public function getPassword()
        {
                return $this->password;
        }

        public function setPassword($password)
        {
                $this->password = $password;
                return $this;
        }

        public function getRole()
        {
                return $this->role;
        }
        
        public function setRole($role)
        {
                $this->role = $role;

                return $this;
        }

        public function getFirstName()
        {
                return $this->firstName;
        }

        public function setFirstName($firstName)
        {
                $this->firstName = $firstName;

                return $this;
        }

        public function getLastName()
        {
                return $this->lastName;
        }

        public function setLastName($lastName)
        {
                $this->lastName = $lastName;

                return $this;
        }
        
        public function getDni()
        {
                return $this->dni;
        }
        
        public function setDni($dni)
        {
                $this->dni = $dni;

                return $this;
        }

        public function getPhoneNumber()
        {
                return $this->phoneNumber;
        }

        public function setPhoneNumber($phoneNumber)
        {
                $this->phoneNumber = $phoneNumber;

                return $this;
        }

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
