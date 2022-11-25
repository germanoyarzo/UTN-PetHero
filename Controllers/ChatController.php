<?php
    namespace Controllers;

    use Controllers\UserController as UserController;
    use Controllers\MessageController as MessageController;
    use DAO\ChatDAOBD as ChatDAOBD;
    use Models\Chat as Chat;

    class ChatController
    {
        private $chatDAOBD;
        private $userController;
        private $messageController;

        public function __construct()
        {
            $this->chatDAOBD = new ChatDAOBD();
            $this->userController = new UserController();
            $this->messageController = new MessageController();
        }

        public function HomeOwner($message = "")
        {
            $frontMessage = $message;
            require_once(VIEWS_PATH."home-owner.php");
        }

        public function ShowKeeperList($message = "")
        {
            $this->userController->ShowAllKeepersAvailables();
        }

        public function ShowChat($message = "")
        {
            $frontMessage = $message;
            require_once(VIEWS_PATH."chat.php");
        }

        public function ShowChatById($idChat)
        {
            $messageList = $this->messageController->GetAllMessageByChatId($idChat);
            $frontMessage = null;
            
            $chat = $this->chatDAOBD->GetById($idChat);
            $idOwner = $chat->getOwner();
            $idKeeper = $chat->getKeeper();
            $ownerChat = $this->userController->GetUserById($idOwner);
            $keeperChat = $this->userController->GetUserById($idKeeper);

            $chatEmi = $_SESSION["loggedUser"]->getId() == $idOwner ? $ownerChat : $keeperChat;
            $chatDest = $_SESSION["loggedUser"]->getId() == $idOwner ? $keeperChat : $ownerChat;
            
            if(!$messageList){
                $frontMessage = "Empiece la conversación";
            }

            require_once(VIEWS_PATH."chat.php");
        }

        public function ShowMyChats($message = "")
        {
            $userId = $_SESSION["loggedUser"]->getId();
            $userRole = $_SESSION["loggedUser"]->getRole();

            $userList = $this->chatDAOBD->GetAllByUserPDO($userId);
            
            $chatListFront = [];
            $searchUser = null;
            
            if($userList) {
                foreach ($userList as $key => $value) {
                    if($userRole == "Owner"){
                        $searchUser["user"] = $this->userController->GetUserById($value->getKeeper());
                        $searchUser["chat"] = $value->getId();
                    }else{
                        $searchUser["user"] = $this->userController->GetUserById($value->getOwner());
                        $searchUser["chat"] = $value->getId();
                    }
                    array_push($chatListFront, $searchUser);
                }
            }else{
                $message = "Couldn't find Chats";
            }

            $frontMessage = $message;
            require_once(VIEWS_PATH."chats-list.php");
        }

        public function Add($keeperId)
        {
            $ownerId = $_SESSION["loggedUser"]->getId();
            $validateChat = false;

            if($keeperId){
                $validateChat = $this->chatDAOBD->ValidateChat($ownerId, $keeperId);
                if($validateChat){
                    $chat = new Chat();
                    $chat->setOwner($ownerId);
                    $chat->setKeeper($keeperId);
        
                    $this->chatDAOBD->Add($chat);
                    $this->ShowChat();
                }else{
                    $this->HomeOwner("Chat with keeper is Active\nGo to 'Show My Chats'");
                }
            }else{
                $this->HomeOwner("Error finding Keeper\nTry Again");
            }
        }

        // public function UpdateChat($owner, $keeper)
        // {
        //     $chat = new Chat();
        //     $chat->setOwner($owner);
        //     $chat->setKeeper($keeper);
        // }
    }
?>