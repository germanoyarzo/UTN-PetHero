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

        public function ShowModifyView($id) {
            $user = $this->userDAO->GetById($id);
            require_once(VIEWS_PATH."modify-user.php");
        }

        public function SignUp($message = ""){
            $frontMessage = $message;
            require_once(VIEWS_PATH."add-user.php");
        }

        public function Add($email, $password, $role, $firstName, $lastName, $dni, $phoneNumber)
        {
            /*JSON/
           // $emailCheck= $this->userDAO->GetByEmail($email);
           /*BD*/
            $emailCheck= $this->userDAOBD->GetByEmailPDO($email, $password);

            if(!$emailCheck){ /// if the email doestn exist in the json.. add user
                $user = new User();
                $user->setEmail($email);
                $user->setPassword($password);
                $user->setRole($role);
                $user->setFirstName($firstName);
                $user->setLastName($lastName);
                $user->setDni($dni);
                $user->setPhoneNumber($phoneNumber);

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

        public function Modify($email, $password, $id)
        {
            require_once(VIEWS_PATH."validate-session.php");

            $user = new User();
            $user->setId($id);
            $user->setEmail($email);
            $user->setPassword($password);

            $this->userDAO->Modify($user);

            $this->ShowListView();
        }

        public function Delete($id)
        {
            $this->userDAO->Delete($id);

            $this->ShowListView();
        }

        

        ///LOGEO
        public function Login($email, $password) {
            $validationUser = false;
            $validationRolKeeper= false;
            $validationRolOwner= false;

            if($email){
                /*Get in JSON*/
                //$user = $this->userDAO->GetByEmail($email);
                $user = $this->userDAOBD->GetByEmailPDO($email, $password);
                ///descryp password
                $hash= $user->getPassword();
                $verify = password_verify($password, $hash);
            }else{
                $this->Index("Email no válido");
            }
            
            if($user != null && $verify){
               
                $validationUser = ($user->getPassword() === $password);
                $validationRolKeeper= ($user->getRole() === "Keeper");
                $validationRolOwner= ($user->getRole() === "Owner");
            }

            if($verify && $validationRolKeeper)
            {   //Entra a home Keeper
                $_SESSION["loggedUser"] = $user;
                $this->HomeKeeper();
                
            }else if($verify && $validationRolOwner){
                //Entra a home Owner
                $_SESSION["loggedUser"] = $user;
                $this->HomeOwner();
                
            }else{
                //Devuelve al Login por error en validacion de datos.
                $errorMessage = $user != null ? "Contraseña incorrecta" : "Usuario incorrecto";
                $this->Index($errorMessage);
            }
        }

        public function Logout () {
			session_destroy();
            //use javascript to redirect to index to show the icon.
            echo "<script>window.location = '../index.php';
                </script>";
        }
    }        
?>