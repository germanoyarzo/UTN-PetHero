<?php
namespace Models;

class Book{
        private $id;
        private $idKeeper;
        private $idOwner;
        private $idKeeperBook;
        private $petType;
        private $petSize;
        public $dateStart;
        public $dateEnd; 
        public $bookPrice;
        public $status;
        public $payed;

        public function getId()
        {
                return $this->id;
        }

        public function setId($id)
        {
                $this->id = $id;

                return $this;
        }

        public function getIdKeeper()
        {
                return $this->idKeeper;
        }

        public function setIdKeeper($idKeeper)
        {
                $this->idKeeper = $idKeeper;
                return $this;
        }

        public function getIdOwner()
        {
                return $this->idOwner;
        }

        public function setIdOwner($idOwner)
        {
                $this->idOwner = $idOwner;

                return $this;
        }

        public function getIdKeeperBook()
        {
                return $this->idKeeperBook;
        }

        public function setIdKeeperBook($idKeeperBook)
        {
                $this->idKeeperBook = $idKeeperBook;

                return $this;
        }

        public function getDateStart()
        {
                return $this->dateStart;
        }

        public function setDateStart($dateStart)
        {
                $this->dateStart = $dateStart;

                return $this;
        }
        
        public function getDateEnd()
        {
                return $this->dateEnd;
        }

        public function setDateEnd($dateEnd)
        {
                $this->dateEnd = $dateEnd;

                return $this;
        }

        public function getBookPrice()
        {
                return $this->bookPrice;
        }

        public function setBookPrice($bookPrice)
        {
                $this->bookPrice = $bookPrice;

                return $this;
        }

        public function getStatus()
        {
                return $this->status;
        }

        public function setStatus($status)
        {
                $this->status = $status;

                return $this;
        }


        /**
         * Get the value of petSize
         */ 
        public function getPetSize()
        {
                return $this->petSize;
        }

        /**
         * Set the value of petSize
         *
         * @return  self
         */ 
        public function setPetSize($petSize)
        {
                $this->petSize = $petSize;

                return $this;
        }

        /**
         * Get the value of petType
         */ 
        public function getPetType()
        {
                return $this->petType;
        }

        /**
         * Set the value of petType
         *
         * @return  self
         */ 
        public function setPetType($petType)
        {
                $this->petType = $petType;

                return $this;
        }

        /**
         * Get the value of payed
         */ 
        public function getPayed()
        {
                return $this->payed;
        }

        /**
         * Set the value of payed
         *
         * @return  self
         */ 
        public function setPayed($payed)
        {
                $this->payed = $payed;

                return $this;
        }
}
?>