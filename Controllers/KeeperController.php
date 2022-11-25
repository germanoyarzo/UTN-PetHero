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
            require_once(VIEWS_PATH."add-keeper.php");
        }

        public function ShowListView($message = "")
        {
            $arrayPets = $_SESSION["arrayPetsForBooking"];
            $type = $_SESSION["arrayPetsForBooking"][0]->getType();
            $sizeType = "small";
            foreach ($arrayPets as $pet) {
                if($pet->getSize() == "medium" && $sizeType != "big"){
                    $sizeType = "medium";
                }
                if ($pet->getSize() == "big") {
                    $sizeType = "big";
                }
            }

            $keeperList = $this->keeperDAOBD->GetAllFilterByPetSizePDO($type, $sizeType);

            // $keeperList = $this->keeperDAO->getAll();
            // $keeperList = $this->keeperDAOBD->GetAllPDO();
            
            $frontMessage = $message;
            require_once(VIEWS_PATH."keeper-list.php");
        }

        public function ShowListViewFilter($dateStart, $dateEnd)
        {
            $arrayPets = $_SESSION["arrayPetsForBooking"];
            $type = $_SESSION["arrayPetsForBooking"][0]->getType();
            $sizeType = "small";
            foreach ($arrayPets as $pet) {
                if($pet->getSize() == "medium" && $sizeType != "big"){
                    $sizeType = "medium";
                }
                if ($pet->getSize() == "big") {
                    $sizeType = "big";
                }
            }
            
            //$keeperListFilter = $this->keeperDAO->getAllFilter($dateStart, $dateEnd);
            $keeperListFilter = $this->keeperDAOBD->GetAllFilterPDO($dateStart, $dateEnd, $sizeType, $type);

            $dateStartFront = $dateStart;
            $dateEndFront = $dateEnd;
            $cantPets = count($arrayPets);

            require_once(VIEWS_PATH."keeper-listfilter.php");
        }

        public function ShowModifyView($id) {
            $keeper = $this->keeperDAO->GetById($id);
            require_once(VIEWS_PATH."modify-keeper.php");
        }

        public function RegistrationKeeper(){
            require_once(VIEWS_PATH."add-keeper.php");
        }

        public function Add($typePet, $size, $salary, $available, $dateStart, $dateEnd)
        {
            $keeper = new Keeper();
            $keeper->setTypePet($typePet);
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