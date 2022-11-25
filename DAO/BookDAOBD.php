<?php
    namespace DAO;

    use DAO\IKeeperDAOBD as IKeeperDAOBD;
    use DAO\IBookDAOBD as IBookDAOBD;
    use Models\Keeper as Keeper;
    use Models\Pet as Pet;
    use Models\Book as Book;
    use Models\User as User;
    use \Exception as Exception;
    use DAO\Connection as Connection;

    class BookDAOBD implements IBookDAOBD
    {
        private $bookList = array();
        private $connection;
        private $tableName = "book";
        private $tableNameUser = "user";
        private $tableNameKeeper = "keeper";

    
        public function GetAllPDO() {
            try {
                $bookList = array();
                $query = "SELECT * FROM " . $this->tableName;
                $this->connection = Connection::getInstance();
                $resultSet = $this->connection->Execute($query);
                foreach($resultSet as $row) {
                    // $book = new book();
                    // $book->setId($row["id"]);

                    // $keeper = new Keeper();
                    // $keeper->setId($row["idKeeper"]);

                    // $user = new User();
                    // $user->setId($row["idUser"]);
                
                    // $book->setKeeper($keeper);
                    // $book->setUser($user);
                    // $book->setStatus($row["status"]);

                    $book = new Book();
                    $book->setId($row["id"]);
                    $book->setIdKeeper($row["idKeeper"]);
                    $book->setIdOwner($row["idOwner"]);
                    $book->setIdKeeperBook($row["idKeeperBook"]);
                    $book->setPetType($row["petType"]);
                    $book->setPetSize($row["petSize"]);
                    $book->setDateStart($row["dateStart"]);
                    $book->setDateEnd($row["dateEnd"]);
                    $book->setBookPrice($row["bookPrice"]);
                    $book->setStatus($row["status"]);
                    $book->setPayed($row["payed"]);

                    array_push($bookList, $book);
                    
                }
                return $bookList;
            } catch(Exception $ex) {
                throw $ex;
            }
        }

        public function GetBookByOwner($idOwner) {
            try {
                $bookList = array();
                $bookListFront = array();

                $query = "SELECT bo.id,dateStart, dateEnd, bookPrice, status, payed FROM ". $this->tableName. " bo INNER JOIN ". $this->tableNameUser. " u ON u.id = bo.idOwner WHERE '".$idOwner."'=u.id";

                // $parameters['idOwner'] = $idOwner;
                $this->connection = Connection::GetInstance();

                // $bookList = $this->connection->Execute($query, $parameters);
                $bookList = $this->connection->Execute($query);

                foreach ($bookList as $row) {         
                    $book = new Book();
                    $book->setId($row["id"]);
                    $book->setDateStart($row["dateStart"]);
                    $book->setDateEnd($row["dateEnd"]);
                    $book->setBookPrice($row["bookPrice"]);
                    $book->setStatus($row["status"]);
                    $book->setPayed($row["payed"]);
                
                    array_push($bookListFront, $book);
                }
                return $bookListFront;
            } catch(\PDOException $ex) {
                throw $ex;
            }
        }

        public function GetBookByKeeper($idKeeper) {
            try {
                $bookList = array();
                $bookListFront = array();

                $query = "SELECT bo.id, idKeeper, idOwner, idKeeperBook, petType, petSize, dateStart, dateEnd, bookPrice, status, payed FROM ". $this->tableName. " bo INNER JOIN ". $this->tableNameUser. " u on u.id = bo.idKeeper WHERE '".$idKeeper."'=u.id";

                // $parameters['idKeeper'] = $idKeeper;
                $this->connection = Connection::GetInstance();
                // $bookList = $this->connection->Execute($query, $parameters);
                $bookList = $this->connection->Execute($query);
                
                foreach ($bookList as $row) {
                    // $book['id'] = $row['id'];
                    // $book['idKeeper'] = $row["idKeeper"];
                    // $book['idOwner'] = $row["idOwner"];
                    // $book['idKeeperBook'] = $row["idKeeperBook"];
                    // $book['dateStart'] = $row["dateStart"];
                    // $book['dateEnd'] = $row["dateEnd"];
                    // $book['bookPrice'] = $row["bookPrice"];
                    // $book['status'] = $row["status"];

                    $book = new Book();
                    $book->setId($row["id"]);
                    $book->setIdKeeper($row["idKeeper"]);
                    $book->setIdOwner($row["idOwner"]);
                    $book->setIdKeeperBook($row["idKeeperBook"]);
                    $book->setPetType($row["petType"]);
                    $book->setPetSize($row["petSize"]);
                    $book->setDateStart($row["dateStart"]);
                    $book->setDateEnd($row["dateEnd"]);
                    $book->setBookPrice($row["bookPrice"]);
                    $book->setStatus($row["status"]);
                    $book->setPayed($row["payed"]);

                    array_push($bookListFront, $book);

                }
                return $bookListFront;
            } catch(\PDOException $ex) {
                throw $ex;
            }
        }
    
        public function GetById($id) 
        {
            try
            {
                $bookList = array();
    
                $query = "SELECT * FROM ".$this->tableName." WHERE (id = :id);";
    
                $parameters['id'] = $id;
    
                $this->connection = Connection::GetInstance();
    
                $resultSet = $this->connection->Execute($query, $parameters);
                
                foreach ($resultSet as $row)
                {      
                    
                    $book = new Book();
                    $book->setId($row["id"]);
                    $book->setIdKeeper($row["idKeeper"]);
                    $book->setIdOwner($row["idOwner"]);
                    $book->setIdKeeperBook($row["idKeeperBook"]);
                    $book->setPetType($row["petType"]);
                    $book->setPetSize($row["petSize"]);
                    $book->setDateStart($row["dateStart"]);
                    $book->setDateEnd($row["dateEnd"]);
                    $book->setBookPrice($row["bookPrice"]);
                    $book->setStatus($row["status"]);
                    $book->setPayed($row["payed"]);
                    
                    array_push($bookList, $book);
                }
    
                ///return the array in position 0
                return (count($bookList) > 0) ? $bookList[0] : null;
            }catch(\PDOException $ex)
            {
                throw $ex;
            }
        }   

        public function Add(Book $book)
        {
            try
            {
                if($_SESSION["loggedUser"]->getRole() == "Owner")
                {
                    $query = "INSERT INTO ".$this->tableName." (id, idKeeper, idOwner, idKeeperBook,petType, petSize, dateStart, dateEnd, bookPrice, status, payed) VALUES (:id, :idKeeper, :idOwner, :idKeeperBook, :petType, :petSize, :dateStart, :dateEnd, :bookPrice, :status, :payed);";
                    
                    $parameters["id"] = $book->getId();
                    $parameters["idKeeper"] = $book->getIdKeeper();
                    $parameters["idOwner"] = $book->getIdOwner();
                    $parameters["idKeeperBook"] = $book->getIdKeeperBook();
                    $parameters["petType"] = $book->getPetType();
                    $parameters["petSize"] = $book->getPetSize();
                    $parameters["dateStart"] = $book->getDateStart();
                    $parameters["dateEnd"] = $book->getDateEnd();
                    $parameters["bookPrice"] = $book->getBookPrice();
                    $parameters["status"] = "pending";
                    $parameters["payed"] = "notpayed";

                    $this->connection = Connection::GetInstance();
                    $this->connection->ExecuteNonQuery($query, $parameters);

                }else{
                    $query= "UPDATE ".$this->tableName." SET status=:status WHERE status='pending';";

                    $parameters["status"] = "confirmed";
                    $this->connection = Connection::GetInstance();
    
                    $this->connection->ExecuteNonQuery($query, $parameters);
                }
            }
            catch(Exception $ex)
            {
                throw $ex;
            }
        }

        public function UpdateBook($idBook)
        {
            $queryBook= $this->GetById($idBook);
            //$query = "SELECT bo.id, bo.dateStart, bo.dateEnd, bo.idKeeper".$this->tableName." bo WHERE bo.id=". $idBook ." AND status='pending';";

            try
            {
                $query = "UPDATE ".$this->tableName." bo SET status=:status WHERE bo.id=". $idBook ." AND status='pending';";

                $parameters["status"] = "confirmed";
                $this->connection = Connection::GetInstance();

                $this->connection->ExecuteNonQuery($query, $parameters);
            }
            catch(Exception $ex)
            {
                throw $ex;
            }
        }

        public function PaymentBook($idBook)
        {
            $queryBook= $this->GetById($idBook);
            //$query = "SELECT bo.id, bo.dateStart, bo.dateEnd, bo.idKeeper".$this->tableName." bo WHERE bo.id=". $idBook ." AND status='pending';";

            try
            {
                $query = "UPDATE ".$this->tableName." bo SET payed=:payed WHERE bo.id=". $idBook ." AND payed='notpayed';";

                $parameters["payed"] = "payed";
                $this->connection = Connection::GetInstance();

                $this->connection->ExecuteNonQuery($query, $parameters);
            }
            catch(Exception $ex)
            {
                throw $ex;
            }
        }
    }
?>