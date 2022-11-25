<?php
    namespace Controllers;

    use DAO\MessageDAOBD as MessageDAOBD;
    use Controllers\ChatController as ChatController;
    use Controllers\UserController as UserController;
    use Models\Message as Message;

    class MessageController
    {
        private $messageDAOBD;
        private $userController;

        public function __construct()
        {
            $this->messageDAOBD = new MessageDAOBD();
            $this->userController = new UserController();
        }

        public function ShowNewChat($message = "")
        {
            $frontMessage = $message;
            require_once(VIEWS_PATH."new-message.php");
        }

        public function GetAllMessageByChatId($chatId)
        {
            $messageList = $this->messageDAOBD->GetAllByChatId($chatId);
            return $messageList;
        }

        public function Add($messageText, $idChat)
        {
            $loggedUserId = $_SESSION["loggedUser"]->getId();

            $message = new Message();
            $message->setIdChat($idChat);
            $message->setUser($loggedUserId);
            $message->setMessage($messageText);
            $message->setDate(date("Y-m-d H:i:s"));

            if($message != null){
                $this->messageDAOBD->Add($message);
            }

            $chatController = new ChatController();
            $chatController->ShowChatById($idChat);
        }
    }
?>