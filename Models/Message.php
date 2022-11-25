<?php
    namespace Models;

    class Message{
        public $id;
        public $id_chat;
        public $user;
        public $message;
        public $date;

        public function getId()
        {
            return $this->id;
        }

        public function setId($id)
        {
            $this->id = $id;
            return $this;
        }

        public function getIdChat()
        {
            return $this->id_chat;
        }

        public function setIdChat($id_chat)
        {
            $this->id_chat = $id_chat;
            return $this;
        }

        public function getUser()
        {
            return $this->user;
        }

        public function setUser($user)
        {
            $this->user = $user;
            return $this;
        }

        public function getMessage()
        {
            return $this->message;
        }
        
        public function setMessage($message)
        {
            $this->message = $message;
            return $this;
        }

        public function getDate()
        {
            return $this->date;
        }

        public function setDate($date)
        {
            $this->date = $date;
            return $this;
        }
    }
?>