<?php
    namespace Controllers;

    use Controllers\KeeperController as KeeperController;
    use DAO\UserDAO as UserDAO;
    use DAO\BookDAO as BookDAO;
    use DAO\BookDAOBD as BookDAOBD;
    use DAO\KeeperDAO as KeeperDAO;
    use DAO\KeeperDAOBD as KeeperDAOBD;
    use Models\Book as Book;
    use Models\Keeper as Keeper;
    use Models\User as User;
   

    class BookController
    {
        private $bookDAO;
        private $bookDAOBD;
        private $keeperDAO;
        private $keeperDAOBD;
        private $keeperController;

        public function __construct()
        {
            $this->bookDAO = new BookDAO();
            $this->bookDAOBD = new BookDAOBD();
            $this->keeperDAO = new KeeperDAO();
            $this->keeperDAOBD = new KeeperDAOBD();
            $this->keeperController = new KeeperController();
        }

        public function Index($message = "")
        {
            require_once(VIEWS_PATH."index.php");
        }
        public function Home($message = "")
        {
            require_once(VIEWS_PATH."home.php");
        }

        public function HomeOwner($message = "")
        {
            $frontMessage = $message;
            require_once(VIEWS_PATH."home-owner.php");
        }

        
        public function ShowAddView()
        {
            //require_once("validate-session.php");
            require_once(VIEWS_PATH."add-book.php");
        }

        public function ShowListView($message = "")
        {
            $frontMessage = $message;
            //$bookList = $this->bookDAO->getAll();
            $bookList = $this->bookDAOBD->GetAllPDO();
            
            require_once(VIEWS_PATH."book-list.php");
        }


        public function ShowModifyView($keeperId) {
            
            //$Book = $this->bookDAO->GetById($keeperId);
            $keeper = $this->keeperDAO->GetById($keeperId);
            //require_once(VIEWS_PATH."modify-book.php");
            
        }


        public function Reservation($keeperId){
            //$keeper = $this->keeperDAO->GetById($keeperId);
            $keeper = $this->keeperDAOBD->GetById($keeperId);
            if($keeper!=NULL){
                $_SESSION["keeperAvailable"]= $keeper;

                require_once(VIEWS_PATH."add-book.php");
            }else{
               $this->keeperController->ShowListView("Keeper doest´n exist");
            }
        }
       

        public function Add($idKeeper)
        {
            $book = new Book();
            //$book->setId($id);
            $book->setIdKeeper($idKeeper);
            //$idOwner = $_SESSION["loggedUser"]->getId();
            $idUser = $_SESSION["loggedUser"]->getId();
            $book->setIdUser($idUser);

           //$book->setDateBook($dateBook);
            if($book !=null){
                //$this->bookDAO->Add($book);
                $this->bookDAOBD->Add($book);
                $this->HomeOwner("&#x2705; Book created correctly");  
            }else{
                $errorMessage = "";
                $this->HomeOwner($errorMessage);
            }
        }

        

    }        
?>