<?php
    namespace Models;

    class Book{
        private $id;
        private $idKeeper; 
        private $idUser; 
        //private $dateBook;

        
          /**
         * Get the value of id
         */ 
        public function getId()
        {
                return $this->id;
        }

        /**
         * Set the value of id
         *
         * @return  self
         */ 
        public function setId($id)
        {
                $this->id = $id;

                return $this;
        }

        /**
         * Get the value of idKeeper
         */ 
        public function getIdKeeper()
        {
                return $this->idKeeper;
        }

        /**
         * Set the value of idKeeper
         *
         * @return  self
         */ 
        public function setIdKeeper($idKeeper)
        {
                $this->idKeeper = $idKeeper;

                return $this;
        }

       

        /**
         * Get the value of idUser
         */ 
        public function getIdUser()
        {
                return $this->idUser;
        }

        /**
         * Set the value of idUser
         *
         * @return  self
         */ 
        public function setIdUser($idUser)
        {
                $this->idUser = $idUser;

                return $this;
        }
    }
?>