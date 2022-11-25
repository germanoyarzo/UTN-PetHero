<?php
    namespace Models;

    class Keeper{
        private $id;
        private $idKeeper;
        private $typePet;
        private $size; ///small, medium or big
        private $salary; 
        private $available; 
        private $dateStart; ///availabity date
        private $dateEnd; ///availabity date

        
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
        public function setIdKeeper($idKeeper)
        {
                $this->idKeeper = $idKeeper;

                return $this;
        }

        public function getIdKeeper()
        {
                return $this->idKeeper;
        }

        public function setId($id)
        {
                $this->id = $id;

                return $this;
        }

        public function getsize()
        {
                return $this->size;
        }

        
        public function setSize($size)
        {
                $this->size = $size;

                return $this;
        }

        public function getTypePet()
        {
                return $this->typePet;
        }

        
        public function setTypePet($typePet)
        {
                $this->typePet = $typePet;
                return $this;
        }
        
        /**
         * Get the value of salary
         */ 
        public function getSalary()
        {
                return $this->salary;
        }

        /**
         * Set the value of salary
         *
         * @return  self
         */ 
        public function setSalary($salary)
        {
                $this->salary = $salary;

                return $this;
        }
     
     

        /**
         * Get the value of available
         */ 
        public function getAvailable()
        {
                return $this->available;
        }

        /**
         * Set the value of available
         *
         * @return  self
         */ 
        public function setAvailable($available)
        {
                $this->available = $available;

                return $this;
        }

       /**
         * Get the value of date
         */ 
        public function getDateStart()
        {
                return $this->dateStart;
        }

        /**
         * Set the value of date
         *
         * @return  self
         */ 
        public function setDateStart($dateStart)
        {
                $this->dateStart = $dateStart;

                return $this;
        }


        /**
         * Get the value of date
         */ 
        public function getDateEnd()
        {
                return $this->dateEnd;
        }

        /**
         * Set the value of date
         *
         * @return  self
         */ 
        public function setDateEnd($dateEnd)
        {
                $this->dateEnd = $dateEnd;

                return $this;
        }
    }
