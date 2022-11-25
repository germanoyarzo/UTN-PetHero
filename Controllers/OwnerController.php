<?php
    namespace Controllers;

    use Models\Pet as Pet;
    use DAO\KeeperDAO as KeeperDAO;
    use DAO\KeeperDAOBD as KeeperDAOBD;
    use DAO\PetDAOBD as PetDAOBD;
    use Models\Keeper as Keeper;
   

    class OwnerController
    {
        private $keeperDAO;
        private $keeperDAOBD;
        private $petDAOBD;

        public function __construct()
        {
            $this->keeperDAO = new keeperDAO();
            $this->petDAOBD = new PetDAOBD();
            $this->keeperDAOBD = new keeperDAOBD();
        }

        public function Index($message = "")
        {
            require_once(VIEWS_PATH."index.php");
        }

        public function HomeOwner($message = "")
        {
            require_once(VIEWS_PATH."home-owner.php");
        }
    
        public function ShowListKeeperView($message = "")
        {
            $frontMessage  = $message;
            //$keeperList = $this->keeperDAO->getAll();
            $keeperList = $this->keeperDAOBD->GetAllPDO();
            require_once(VIEWS_PATH."keeper-list.php");
        }

        public function StartBooking($message = "")
        {
            $frontMessage = $message;
            $petList = $this->petDAOBD->GetAllPDO();
            require_once(VIEWS_PATH."startBooking.php");
        }

        public function RegistrationPet(){
            require_once(VIEWS_PATH."add-pet.php");
        }
    }        
?>