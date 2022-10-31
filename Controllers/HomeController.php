<?php
    namespace Controllers;

    class HomeController
    {

        public function Index($message = "")
        {
            $frontMessage = $message;
            require_once(VIEWS_PATH."index.php");
        }
        public function Home($message = "")
        {
            $frontMessage = $message;
            require_once(VIEWS_PATH."home.php");
        }   

    }
?>