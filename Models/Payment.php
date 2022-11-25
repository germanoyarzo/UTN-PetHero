<?php
    namespace Models;

    class Payment{
        private $totalAmount;
        private $date;

        public function getTotalAmount(){
            return $this->totalAmount;
        }

        public function setTotalAmount($totalAmount){
            $this->totalAmount = $totalAmount;
            return $this;
        }

        public function getDate(){
            return $this->date;
        }

        public function setDate($date){
            $this->date = $date;
            return $this;
        }
    }
?>