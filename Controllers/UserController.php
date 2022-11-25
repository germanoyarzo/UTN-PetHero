<?php
    namespace Controllers;

    use DAO\UserDAO as UserDAO;
    use DAO\UserDAOBD as UserDAOBD;
    use Models\User as User;

    class UserController
    {
        private $userDAO;
        private $userDAOBD;

        public function __construct()
        {
            $this->userDAO = new UserDAO();
            $this->userDAOBD = new UserDAOBD();
        }

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

        public function HomeKeeper($message = "")
        {
            $frontMessage = $message;
            require_once(VIEWS_PATH."home-keeper.php");
        }

        public function HomeOwner($message = "")
        {
            $frontMessage = $message;
            require_once(VIEWS_PATH."home-owner.php");
        }
        
        public function ShowAddView()
        {
            //require_once("validate-session.php");
            require_once(VIEWS_PATH."add-user.php");
        }

        public function ShowListView()
        {
            $userList = $this->userDAO->getAll();
            require_once(VIEWS_PATH."user-list.php");
        }

        public function ShowMyListView($id)
        {
            $user = $this->userDAOBD->GetById($id);
            require_once(VIEWS_PATH."user-list.php");
        }

        public function ShowModifyView($message = "") {
            $frontMessage = $message;
            //$user = $this->userDAOBD->GetById($id);
            require_once(VIEWS_PATH."modify-user.php");
        }

        public function SignUp($message = ""){
            $frontMessage = $message;
            require_once(VIEWS_PATH."add-user.php");
        }

        public function Add($email, $password, $role, $firstName, $lastName, $dni, $phoneNumber,$keyword)
        {
            /*JSON/
           // $emailCheck= $this->userDAO->GetByEmail($email);
           /*BD*/
            $emailCheck = $this->userDAOBD->GetByEmailRepeatPDO($email);

            if(!$emailCheck){ /// if the email doestn exist in the json.. add user
                $user = new User();
                $user->setEmail($email);
                $user->setPassword($password);
                $user->setRole($role);
                $user->setFirstName($firstName);
                $user->setLastName($lastName);
                $user->setDni($dni);
                $user->setPhoneNumber($phoneNumber);
                $user->setKeyword($keyword);

                $this->userDAOBD->Add($user);
                $validationUser = ($user != null) && ($user->getPassword() === $password);
                $validationRolKeeper= ($user->getRole() === "Keeper");
                $validationRolOwner= ($user->getRole() === "Owner");
    
                if($validationUser && $validationRolKeeper){
                    $_SESSION["loggedUser"] = $user;
                    $this->HomeKeeper();
                }else if($validationUser && $validationRolOwner){
                    $_SESSION["loggedUser"] = $user;
                    $this->HomeOwner();
                }else{
                    $this->Home();
                }
            }else{
                $this->SignUp("Email already exists in database");
            }
            

        }

        public function Modify($email, $password, $role, $firstName, $lastName, $dni, $phoneNumber,$keyword)
        {
            $user = new User();
            $user->setEmail($email);
            $user->setPassword($password);
            $user->setRole($role);
            $user->setFirstName($firstName);
            $user->setLastName($lastName);
            $user->setDni($dni);
            $user->setPhoneNumber($phoneNumber);
            $user->setKeyword($keyword);
           
            $id=$_SESSION["loggedUser"]->getId();
            $this->userDAOBD->Modify($id,$email, $password, $role, $firstName, $lastName, $dni, $phoneNumber,$keyword);

            //$validationUser = ($user != null) && ($user->getPassword() === $password);
            $validationRolKeeper= ($user->getRole() === "Keeper");
            $validationRolOwner= ($user->getRole() === "Owner");

            if($validationRolKeeper){
                $this->HomeKeeper("&#x2705; User edit correctly");
            }else if($validationRolOwner){
                $this->HomeOwner("&#x2705; User edit correctly");
            }
        }

        public function Delete($id)
        {
            $this->userDAO->Delete($id);

            $this->ShowListView();
        }

        ///LOGEO
        public function Login($email, $password) {
            $validationRolKeeper= false;

            if($email){
                /*Get in JSON*/
                //$user = $this->userDAO->GetByEmail($email);
                $user = $this->userDAOBD->GetByEmailPDO($email, $password);

                // La funcion GetByEmailPDO ya corrobora mail y password.
                // descryp password
                // $hash = $user->getPassword();
                // $verify = password_verify($password, $hash);
                if($user != null){
                    $validationRolKeeper = ($user->getRole() === "Keeper");
                    $_SESSION["loggedUser"] = $user;
                    if ($validationRolKeeper){
                        $this->HomeKeeper();
                    }else{
                        $this->HomeOwner();
                    }
                }else{
                    $this->Index("Information incorrect!");
                }
            }else{
                $this->Index("Email incorrect!");
            }
            
            // if($user != null && $verify){
            //     $validationUser = ($user->getPassword() === $password);
            //     $validationRolKeeper= ($user->getRole() === "Keeper");
            //     $validationRolOwner= ($user->getRole() === "Owner");
            // }

            // if($verify && $validationRolKeeper)
            // {   //Entra a home Keeper
            //     $_SESSION["loggedUser"] = $user;
            //     $this->HomeKeeper();
                
            // }else if($verify && $validationRolOwner){
            //     //Entra a home Owner
            //     $_SESSION["loggedUser"] = $user;
            //     $this->HomeOwner();
                
            // }else{
            //     //Devuelve al Login por error en validacion de datos.
            //     $errorMessage = $user != null ? "Contraseña incorrecta" : "Usuario incorrecto";
            //     $this->Index($errorMessage);
            // }
        }

        public function Logout () {
			session_destroy();
            //use javascript to redirect to index to show the icon.
            echo "<script>window.location = '../index.php';
                </script>";
        }

        public function ShowUserRecovery() {
            require_once(VIEWS_PATH."recover.php");
        }
        
        public function PasswordChange($email,$password, $keyword) {

            $userList = $this->userDAOBD->GetAllPDO();
            $user = null;
            foreach ($userList as $key => $value) {
                if($email === $value->getEmail() && $value->getKeyword() == $keyword){
                    $user = $this->userDAOBD->Change($email, $password, $keyword);
                    $this->Index("Password changed correctly");
                    //require_once(VIEWS_PATH."index.php");
                } else {
                    $this->Index("Something Wrong!");
                    //require_once(VIEWS_PATH."index.php");
                }                
            }
        }    
        public function ShowAllKeepersAvailables($message = ""){
            $keeperList = $this->userDAOBD->GetKeepersAvailablePDO();
            if(!$keeperList) $message = "Keepers are not available";
            $frontMessage = $message;
            require_once(VIEWS_PATH."keepersForChat.php");
        }

        public function GetUserById($id){
            $user = $this->userDAOBD->GetById($id);            
            return $user;
        }

        public function Contact(){
            
            require_once(VIEWS_PATH."contact.php");
        }
    }        
?>