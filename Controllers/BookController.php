<?php
    namespace Controllers;

    use Controllers\KeeperController as KeeperController;
    use Controllers\OwnerController as OwnerController;
    use DAO\UserDAO as UserDAO;
    use DAO\UserDAOBD as UserDAOBD;
    use DAO\BookDAO as BookDAO;
    use DAO\BookDAOBD as BookDAOBD;
    use DAO\KeeperDAO as KeeperDAO;
    use DAO\KeeperDAOBD as KeeperDAOBD;
    use DAO\PetDAOBD as PetDAOBD;
    use Models\Book as Book;
    use Models\Keeper as Keeper;
    use Models\User as User;
   

    class BookController
    {
        private $bookDAO;
        private $bookDAOBD;
        private $keeperDAO;
        private $keeperDAOBD;
        private $userDAOBD;
        private $petDAOBD;
        private $keeperController;
        private $ownerController;

        public function __construct()
        {
            $this->bookDAO = new BookDAO();
            $this->bookDAOBD = new BookDAOBD();
            $this->keeperDAO = new KeeperDAO();
            $this->keeperDAOBD = new KeeperDAOBD();
            $this->userDAOBD = new UserDAOBD();
            $this->petDAOBD = new PetDAOBD();
            $this->keeperController = new KeeperController();
            $this->ownerController = new OwnerController();
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

        public function HomeKeeper($message = "")
        {
            $frontMessage = $message;
            require_once(VIEWS_PATH."home-keeper.php");
        }

        public function BookConfirm($message = "")
        {
            $frontMessage = $message;
            require_once(VIEWS_PATH."add-book.php");
        }
        
        public function ShowStartBooking($message = "")
        {
            $frontMessage = $message;
            $petList = $this->petDAOBD->GetAllPDO();
            require_once(VIEWS_PATH."startBooking.php");
        }

        public function StartBooking($petsId = null)
        {
            $arrayPets = [];
            $catTrue = false;
            $dogTrue = false;
            $sizeTrue = false;
            // $firstId = $petsId[array_key_first($petsId)];
            // $sizeType = $this->petDAOBD->GetById($firstId)->getSize();
            $sizeType = 'small';

            if($petsId != null){
                foreach ($petsId as $key => $value) {
                    $pet = $this->petDAOBD->GetById($value);
                    if($pet && $pet->getType() == "Cat"){
                        $catTrue = true;
                    }else{
                        $dogTrue = true;
                    }
                    if($pet && $pet->getSize() == "medium" && $sizeType != "big"){
                        $sizeType = "medium";
                    }
                    if ($pet && $pet->getSize() == "big") {
                        $sizeType = "big";
                    }
                    array_push($arrayPets, $pet);
                }

                if($catTrue && $dogTrue){
                    $this->ShowStartBooking("Debe seleccionar mascotas del mismo tipo");
                }else{
                    $_SESSION["arrayPetsForBooking"] = $arrayPets;
                    $this->keeperController->ShowListView();
                }
            }else{
                $this->ShowStartBooking("Debe seleccionar al menos una mascota");
            }
        }

        public function ShowListView($message = "")
        {
            $frontMessage = $message;
            $bookListFront = array();
            $loggedUserId = $_SESSION["loggedUser"]->getId();
            $loggedUserRole = $_SESSION["loggedUser"]->getRole();

            if($loggedUserRole == "Owner"){
                $bookListFront = $this->bookDAOBD->GetBookByOwner($loggedUserId);
            }else{
                $bookListFront = $this->bookDAOBD->GetBookByKeeper($loggedUserId);
            }

            // foreach($bookListFront as $book)
            // {
            //     var_dump($book);
            //     // if($book->getStatus() =="confirmed")
            //     // {
            //     //     $userId = $book->getUser()->getId();
            //     //     $user = $this->userDAOBD->GetById($userId);
            //     //     //var_dump($user);
    
            //     //     $keeperId = $book->getKeeper()->getId();
            //     //     $keeper = $this->keeperDAOBD->GetById($keeperId);
    
            //     //     $book->setUser($user);
            //     //     $book->setKeeper($keeper);
    
            //     //     $countDays = $this->CountDays($keeper);
            //     //     $book->setCountDays($countDays);
                    
            //     //     $amount = $this->GetAmount($keeper, $countDays);
            //     //     $book->setAmount($amount);  
                  
            //     // }
            //     /*else{
            //         $this->HomeKeeper("You don't have confirmed book");
            //     }*/
                
                
            // }
            require_once(VIEWS_PATH."book-list.php");
        }

        public function CountDays($keeperId)
        {
            //***total days */
            $datetime1 = strtotime($keeperId->getDateStart());
            $datetime2 = strtotime($keeperId->getDateEnd());
            $difference = $datetime2 - $datetime1;
            // 1 day = 24 hours
            // 24 * 60 * 60 = 86400 seconds
            $result = abs(round($difference / 86400));
            return $result;
        }

        //recieve CountDays Result
        public function GetAmount($keeperId, $result)
        {
            $amount= $result * $keeperId->getSalary();
            return $amount; 
        }

        public function ShowModifyView($keeperId) {
            
            //$Book = $this->bookDAO->GetById($keeperId);
            $keeper = $this->keeperDAO->GetById($keeperId);
            //require_once(VIEWS_PATH."modify-book.php");
            
        }

        public function Reservation($bookDateStart, $bookDateEnd, $bookPrice, $keeperBookId){
            //$keeper = $this->keeperDAO->GetById($keeperId);
            $keeper = $this->keeperDAOBD->GetById($keeperBookId);
            if($keeper != NULL){
                $frontBookPets = $_SESSION["arrayPetsForBooking"];
                $frontKeeperBook = $keeperBookId;
                $frontOwnerBook = $_SESSION["loggedUser"];
                $frontKeeper = $this->userDAOBD->GetById($keeper->getIdKeeper());
                $frontDateStart = $bookDateStart;
                $frontDateEnd = $bookDateEnd;
                $frontPrice = $bookPrice;
                $petType= $keeper->getTypePet();
                $petSize= $keeper->getSize();
                require_once(VIEWS_PATH."add-book.php");
            }else{
                $this->ownerController->HomeOwner("Error booking the Keeper");
            }
        }

        public function ShowListViewKeeper()
        {
            $frontMessage = '';
            $bookListFront = array();
            $idKeeper = $_SESSION["loggedUser"]->getId();
            $bookList = $this->bookDAOBD->GetBookByKeeper($idKeeper);
            // $keeper = $this->keeperDAOBD->GetById($idKeeper);

            if($bookList != NULL){
                // $_SESSION["bookAvailable"] = $book;
                foreach ($bookList as $book) {

                    if($book->getStatus() != "confirmed"){
                        array_push($bookListFront, $book);
                    }
                }

                // if($bookList["status"] != "confirmed")
                // {
                //     var_dump($bookList["status"] );
                //     require_once(VIEWS_PATH."add-book.php");
                // }else{
                //     $this->HomeKeeper("You don't have pending's book");
                // }
                require_once(VIEWS_PATH."book-list.php");
            }else{
                $this->HomeKeeper("You don't have pending books");
            }  
        }

        public function ConfirmReservation($idBook)
        {
            $book = $this->bookDAOBD->GetById($idBook);
            $idKeeper =$book->getIdKeeper();
            $keeper = $this->keeperDAOBD->GetById($idKeeper);
            $idKeeperBook= $this->keeperDAOBD->GetById($book->getIdKeeperBook());

            if($book)
            {
                $pet= $idKeeperBook->getTypePet();
                $frontOwnerBook = $book->getIdOwner();
                $userEmail= $this->userDAOBD->GetById($frontOwnerBook)->getEmail();
                $frontKeeper = $_SESSION["loggedUser"];
                $frontDateStart = $book->getDateStart();
                $frontDateEnd = $book->getDateEnd();
                $frontPrice = $book->getBookPrice();
                $frontIdKeeperBook = $book->getIdKeeperBook();
                require_once(VIEWS_PATH."confirm-book-keeper.php");
            }else{
                $this->HomeKeeper("You don't have pending books");
            }
        }

        public function PaymentReservation($idBook)
        {
            //var_dump($idBook);
            $book = $this->bookDAOBD->GetById($idBook);
            // $idKeeper = $book->getIdKeeper();
            // $keeper = $this->userDAOBD->GetById($idKeeper); 

            //Ger te comente las dos lineas de arriba porque veo que no estas usando ninguna de las dos:
            //Ademas en la linea 261 habias puesto "keeperDAOBD" y tendria que ser "userDAOBD" porque
            //le estas pasando el id del User keeper, no de la disponibilidad del keeper.

            $idKeeperBook = $this->keeperDAOBD->GetById($book->getIdKeeperBook());

            if($book)
            {
                $petType = $idKeeperBook->getTypePet();
                $petSize = $idKeeperBook->getsize();
                $frontOwnerBook = $book->getIdOwner();
                $userEmail= $this->userDAOBD->GetById($frontOwnerBook)->getEmail();
                $frontKeeper = $_SESSION["loggedUser"];
                $frontDateStart = $book->getDateStart();
                $frontDateEnd = $book->getDateEnd();
                $frontPrice = $book->getBookPrice();
                $frontIdKeeperBook = $book->getIdKeeperBook();
                require_once(VIEWS_PATH."payment.php");
            }else{
                $this->HomeKeeper("You don't have pending books");
            }
        }

        public function Add($idKeeper, $idOwner, $idKeeperBook, $petType, $petSize, $dateStart, $dateEnd, $bookPrice, $emailOwner)
        {
            $book = new Book();
            $book->setIdKeeper($idKeeper);
            $book->setIdOwner($idOwner);
            $book->setIdKeeperBook($idKeeperBook);
            $book->setPetType($petType);
            $book->setPetSize($petSize);
            $book->setDateStart($dateStart);
            $book->setDateEnd($dateEnd);
            $book->setBookPrice($bookPrice);
            $book->setPayed("notpayed");

            // $book->setId($id);

            // $book->setKeeper($keeper);
            // $idOwner = $_SESSION["loggedUser"]->getId();

            // $user = new User();
            // $idUser = $_SESSION["loggedUser"]->getId();
            // $user->setId($idUser);
            
            // $book->setUser($user);
            
            // $book->setDateBook($dateBook);

            if($book != null){
                //$this->bookDAO->Add($book);
                $this->bookDAOBD->Add($book);
                $this->HomeOwner("&#x2705; Book created correctly");  
            }else{
                $this->HomeOwner("Booking error, please try again");
            }
            
        }

        public function UpdateBook($idBook, $idKeeper, $idOwner, $petType, $dateStart, $dateEnd, $emailOwner)
        {
            if($idBook != null){
                $book = $this->bookDAOBD->GetById($idBook);
                
                // $idKeeper =$book->getIdKeeper();

                //Ger te comente la linea de arriba porque ya lo estas trayendo del form (llega por parametros.)
                //Todos los input que tengas dentro de un form van a viajar por post(en este caso a esta funcion UpdateBook)
                //Vi que quisite poner inputs con "id" para que con JS los captures con getElementById().

                $idByBook= $this->bookDAOBD->GetBookByKeeper($idKeeper);
                $bookDateStart= $book->getDateStart();
                $bookDateEnd= $book->getDateEnd();

                foreach ($idByBook as $key => $value) {
                    $dateStart = $value->getDateStart();
                    $dateEnd = $value->getDateEnd();

                    if($idKeeper != $value && ($bookDateStart >$dateEnd))
                    {
                        $this->bookDAOBD->UpdateBook($idBook);
                        $idKeeperBook = $book->getIdKeeperBook();
                        // $petType = $book->getPetType();
                        $this->keeperDAOBD->UpdateKeeperBook($idKeeperBook, $petType);
                        // set keeper petType
                        $this->HomeKeeper("&#x2705; Book confirm correctly");  
                    }else{
                        $this->HomeKeeper("&#10060; Keeper already has a reservation for that date");  
                    }
                    
                }
               
            }else{
                $this->HomeKeeper("Confirm error, please try again");
            }
        }

        public function ConfirmPayment($idBook, $idKeeper, $idOwner, $idKeeperBook, $petType, $petSize , $dateStart, $dateEnd, $bookPrice)
        {
            if($idBook != null){
                $book = $this->bookDAOBD->GetById($idBook);
                $this->bookDAOBD->PaymentBook($idBook);
                $this->HomeKeeper("&#x2705; Book confirm correctly");  
            }    
        }
    }        
?>