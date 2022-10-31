<?php
    namespace Controllers;

    use DAO\KeeperDAO as KeeperDAO;
    use DAO\KeeperDAOBD as KeeperDAOBD;
    use Models\Keeper as Keeper;
   

    class KeeperController
    {
        private $keeperDAO;
        private $keeperDAOBD;

        public function __construct()
        {
            $this->keeperDAO = new KeeperDAO();
            $this->keeperDAOBD = new KeeperDAOBD();
        }

        public function Index($message = "")
        {
            require_once(VIEWS_PATH."index.php");
        }
        public function Home($message = "")
        {
            require_once(VIEWS_PATH."home.php");
        }

        public function HomeKeeper($message = "")
        {
            $frontMessage = $message;
            require_once(VIEWS_PATH."home-keeper.php");
        }

        
        public function ShowAddView()
        {
            //require_once("validate-session.php");
            require_once(VIEWS_PATH."add-keeper.php");
        }

        public function ShowListView($message = "")
        {
            $errorMessage = $message;
            
            //$keeperList = $this->keeperDAO->getAll();
            $keeperList = $this->keeperDAOBD->GetAllPDO();
            
            require_once(VIEWS_PATH."keeper-list.php");
        }

        public function ShowListViewFilter($dateStart, $dateEnd)
        {
            //$keeperListFilter = $this->keeperDAO->getAllFilter($dateStart, $dateEnd);
            $keeperListFilter = $this->keeperDAOBD->GetAllFilterPDO($dateStart, $dateEnd);
            
            require_once(VIEWS_PATH."keeper-listfilter.php");
        }

        public function ShowModifyView($id) {
            $keeper = $this->keeperDAO->GetById($id);
           
            require_once(VIEWS_PATH."modify-keeper.php");
            
        }


        public function RegistrationKeeper(){
            require_once(VIEWS_PATH."add-keeper.php");
        }
       

        public function Add($size,$salary, $available,$dateStart, $dateEnd)
        {
            $keeper = new Keeper();
            $keeper->setSize($size);
            $keeper->setSalary($salary);
            $keeper->setAvailable($available);
            $keeper->setDateStart($dateStart);
            $keeper->setDateEnd($dateEnd);

            //$this->keeperDAO->Add($keeper);
            $this->keeperDAOBD->Add($keeper);

            $this->HomeKeeper();

            
            
        }

        public function CheckAvailability($dateStart, $dateEnd){
            $this->ShowListViewFilter($dateStart, $dateEnd);

        }


        // public function Modify($email, $password, $id)
        // {
        //     require_once(VIEWS_PATH."validate-session.php");

        //     $user = new User();
        //     $user->setId($id);
        //     $user->setEmail($email);
        //     $user->setPassword($password);

        //     $this->userDAO->Modify($user);
           

        //     $this->ShowListView();
        // }

        // public function Delete($id)
        // {
        //     $this->userDAO->Delete($id);

        //     $this->ShowListView();
        // }
    }        
?>