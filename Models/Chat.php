<?php
    namespace Models;

    class Chat{
        private $id;
        private $owner;
        private $keeper;

        public function getId()
        {
            return $this->id;
        }

        public function setId($id)
        {
            $this->id = $id;
            return $this;
        }

        public function getOwner()
        {
            return $this->owner;
        }

        public function setOwner($owner)
        {
            $this->owner = $owner;
            return $this;
        }

        public function getKeeper()
        {
            return $this->keeper;
        }
        
        public function setKeeper($keeper)
        {
            $this->keeper = $keeper;
            return $this;
        }
    }
?>