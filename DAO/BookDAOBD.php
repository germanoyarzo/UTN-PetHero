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

    
        public function GetAllPDO() {
            try {
                $bookList = array();
                $query = "SELECT * FROM " . $this->tableName;
                $this->connection = Connection::getInstance();
                $resultSet = $this->connection->Execute($query);
                foreach($resultSet as $row) {
                    $book = new book();
                    $book->setId($row["id"]);
                    $book->setIdKeeper($row["idKeeper"]);
                    $book->setIdUser($row["idUser"]);

                    array_push($bookList, $book);
                }
                return $bookList;
            } catch(Exception $ex) {
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
                    $book->setKeeper($row["idKeeper"]);
                    $book->setUser($row["idUser"]);
                    
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
    
                $query = "INSERT INTO ".$this->tableName." (id,idKeeper,idUser) VALUES (:id, :idKeeper, :idUser);";
                
                $parameters["id"] = $book->getId();
                $parameters["idKeeper"] = $book->getIdKeeper();
                $parameters["idUser"] = $book->getIdUser();
                
    
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