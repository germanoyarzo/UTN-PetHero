<?php
    namespace DAO;

    use DAO\IUserDAO as IUserDAO;
    use Models\User as User;
    use Models\Keeper as Keeper;

    class UserDAO implements IUserDAO
    {
        private $userList = array();
        private $fileName = ROOT."Database/user.json";
        private $connection;
        private $tableName = "user";

        public function Add(User $user)
        {
            $this->RetrieveData();
            
            $user->setId($this->GetNextId());
            
            array_push($this->userList, $user);

            $this->SaveData();
        }
   
        public function GetAll()
        {
            $this->RetrieveData();

            return $this->userList;
        }

        public function Delete($id)
        {            
            $this->RetrieveData();
            
            $this->userList = array_filter($this->userList, function($user) use($id){                
                return $user->getId() != $id;
            });
            
            $this->SaveData();
        }

        private function RetrieveData()
        {
            $this->userList = array();

            if(file_exists($this->fileName))
            {
                $jsonToDecode = file_get_contents($this->fileName);

                $contentArray = ($jsonToDecode) ? json_decode($jsonToDecode, true) : array();
                
                foreach($contentArray as $content)
                {
                    $user = new User();
                    $user->setId($content["id"]);
                    $user->setEmail($content["email"]);
                    $user->setPassword($content["password"]);
                    $user->setRole($content["role"]);
                    $user->setFirstName($content["firstName"]);
                    $user->setLastName($content["lastName"]);
                    $user->setDni($content["dni"]);
                    $user->setPhoneNumber($content["phoneNumber"]);

                    array_push($this->userList, $user);
                }
            }
        }

    

        function Modify(User $user)
        {
            $this->RetrieveData();
            $id = $user->getId();
            $this->userList = array_filter($this->userList, function($user) use($id){
                return $user->getId() != $id;
            });

            array_push($this->userList, $user);

            $this->SaveData();
        }

        function GetById($id)
        {
            //var_dump($id);
            $this->RetrieveData();

            $user = array_filter($this->userList, function($user) use($id){
                return $user->getId() == $id;
            });

            $user = array_values($user); //Reorderding array
            

            return (count($user) > 0) ? $user[0] : null;
        }

        public function GetByEmail($email)
        {
            $user = null;

            $this->RetrieveData();

            $users = array_filter($this->userList, function($user) use($email){
                return $user->getEmail() == $email;
            });

            $users = array_values($users); //Reordering array indexes

            return (count($users) > 0) ? $users[0] : null;
        }

        private function SaveData()
        {
            $arrayToEncode = array();

            foreach($this->userList as $user)
            {
                $valuesArray = array();
                $valuesArray["id"] = $user->getId();
                $valuesArray["email"] = $user->getEmail();
                $valuesArray["password"] = $user->getPassword();
                $valuesArray["role"] = $user->getRole();
                $valuesArray["firstName"] = $user->getFirstName();
                $valuesArray["lastName"] = $user->getLastName();
                $valuesArray["dni"] = $user->getDni();
                $valuesArray["phoneNumber"] = $user->getPhoneNumber();
                array_push($arrayToEncode, $valuesArray);
            }

            $fileContent = json_encode($arrayToEncode, JSON_PRETTY_PRINT);

            file_put_contents($this->fileName, $fileContent);
        }

        private function GetNextId()
        {
            $id = 0;

            foreach($this->userList as $user)
            {
                $id = ($user->getId() > $id) ? $user->getId() : $id;
            }

            return $id + 1;
        }
       
    }
?>