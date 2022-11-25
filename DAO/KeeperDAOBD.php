<?php
    namespace DAO;

    use DAO\IKeeperDAOBD as IKeeperDAOBD;
    use Models\Keeper as Keeper;
    use Models\Pet as Pet;
    use \Exception as Exception;
    use DAO\Connection as Connection;

    class KeeperDAOBD implements IKeeperDAOBD
    {
        private $keeperList = array();
        private $keeperListFilter = array();
        private $connection;
        private $tableName = "keeper";
    
    
        public function GetAllPDO() {
            try {
                $keeperList = array();
                $query = "SELECT * FROM " . $this->tableName;
                $this->connection = Connection::getInstance();
                $resultSet = $this->connection->Execute($query);
                foreach($resultSet as $row) {
                    $keeper = new Keeper();
                    $keeper->setId($row["id"]);
                    $keeper->setIdKeeper($row["idKeeper"]);
                    $keeper->setTypePet($row["typePet"]);
                    $keeper->setSize($row["size"]);
                    $keeper->setSalary($row["salary"]);
                    $keeper->setAvailable($row["available"]);
                    $keeper->setDateStart($row["dateStart"]);
                    $keeper->setDateEnd($row["dateEnd"]);


                    array_push($keeperList, $keeper);
                }
                return $keeperList;
            } catch(Exception $ex) {
                throw $ex;
            }
        }

        public function GetAllFilterByPetSizePDO($typePet, $size) {
            try {
                $keeperList = array();

                //$queryTypePet = $typePet == "Cat" ? "cat" : "dog" : "All"; select query typePet All
                
                if($size == "small"){
                    $query = "SELECT * FROM " . $this->tableName . " k WHERE k.available='true' AND (k.typePet='" . $typePet . "' OR k.typePet='All') ;";
                }else if($size == "medium"){
                    $query = "SELECT * FROM " . $this->tableName . " k WHERE k.available='true' AND (k.typePet='" . $typePet . "' OR k.typePet='All') AND (k.size='medium' OR k.size='big') ;";
                }else{
                    $query = "SELECT * FROM " . $this->tableName . " k WHERE k.available='true' AND (k.typePet='" . $typePet . "' OR k.typePet='All') AND k.size='big' ;";
                }

                $this->connection = Connection::getInstance();
                $resultSet = $this->connection->Execute($query);
                foreach($resultSet as $row) {
                    $keeper = new Keeper();
                    $keeper->setId($row["id"]);
                    $keeper->setIdKeeper($row["idKeeper"]);
                    $keeper->setTypePet($row["typePet"]);
                    $keeper->setSize($row["size"]);
                    $keeper->setSalary($row["salary"]);
                    $keeper->setAvailable($row["available"]);
                    $keeper->setDateStart($row["dateStart"]);
                    $keeper->setDateEnd($row["dateEnd"]);

                    array_push($keeperList, $keeper);
                }
                return $keeperList;
            } catch(Exception $ex) {
                throw $ex;
            }
        }

        public function GetAllFilterPDO($dateStart, $dateEnd, $size, $type) {
            try {
                $keeperList = array();

                //$queryTypePet = $type == "Cat" ? "cat" : "dog";

                if($size == "small"){
                    $queryPet = "AND (k.typePet='" . $type . "' OR k.typePet='All') ;";
                }else if($size == "medium"){
                    $queryPet = "AND (k.typePet='" . $type . "' OR k.typePet='All') AND (k.size='medium' OR k.size='big') ;";
                }else{
                    $queryPet = "AND (k.typePet='" . $type . "' OR k.typePet='All') AND k.size='big' ;";
                }

                $query = "SELECT * FROM ".$this->tableName." k WHERE '".$dateStart."'>=k.dateStart AND '".$dateEnd."'<=k.dateEnd ". $queryPet .";";
                $this->connection = Connection::getInstance();
                // $resultSet = $this->connection->Execute($query, $parameters);
                $resultSet = $this->connection->Execute($query);

                foreach($resultSet as $row) {
                    $keeper = new Keeper();
                    $keeper->setId($row["id"]);
                    $keeper->setIdKeeper($row["idKeeper"]);
                    $keeper->setTypePet($row["typePet"]);
                    $keeper->setSize($row["size"]);
                    $keeper->setSalary($row["salary"]);
                    $keeper->setAvailable($row["available"]);
                    $keeper->setDateStart($row["dateStart"]);
                    $keeper->setDateEnd($row["dateEnd"]);

                    array_push($keeperList, $keeper);
                }
                return $keeperList;
            } catch(Exception $ex) {
                throw $ex;
            }
        }
    
        public function GetById($id) 
        {
            try
            {
                $keeperList = array();

                $query = "SELECT * FROM ".$this->tableName." WHERE (id = :id);";
    
                $parameters['id'] = $id;
    
                $this->connection = Connection::GetInstance();
    
                $resultSet = $this->connection->Execute($query, $parameters);

                foreach ($resultSet as $row)
                {      

                    $keeper = new Keeper();
                    $keeper->setId($row["id"]);
                    $keeper->setIdKeeper($row["idKeeper"]);
                    $keeper->setTypePet($row["typePet"]);
                    $keeper->setSize($row["size"]);
                    $keeper->setSalary($row["salary"]);
                    $keeper->setAvailable($row["available"]);
                    $keeper->setDateStart($row["dateStart"]);
                    $keeper->setDateEnd($row["dateEnd"]);

                    array_push($keeperList, $keeper);
                }
    
                    ///return the array in position 0
                    return (count($keeperList) > 0) ? $keeperList[0] : null;
            }catch(\PDOException $ex)
            {
                throw $ex;
            }
        }

        public function UpdateKeeperBook($idKeeperBook, $petType) 
        {
            try
            {
                $query = "UPDATE ".$this->tableName." k SET typePet='" . $petType . "' WHERE k.id='". $idKeeperBook ."';";

                //$query = "UPDATE ".$this->tableName." k SET available='false' WHERE k.id='". $idKeeperBook ."';";

                $this->connection = Connection::GetInstance();

                $this->connection->ExecuteNonQuery($query);
            }
            catch(Exception $ex)
            {
                throw $ex;
            }
        }

        public function Add(Keeper $keeper)
        {
            try
            {
                $query = "INSERT INTO ".$this->tableName." (id, idKeeper, typePet, size, salary, available, dateStart, dateEnd) VALUES (:id, :idKeeper, :typePet, :size, :salary, :available, :dateStart, :dateEnd);";
                
                $parameters["id"] = $keeper->getId();
                $parameters["idKeeper"] = $_SESSION["loggedUser"]->getId();
                $parameters["typePet"] = $keeper->getTypePet();
                $parameters["size"] = $keeper->getSize();
                $parameters["salary"] = $keeper->getSalary();
                $parameters["available"] = $keeper->getAvailable();
                $parameters["dateStart"] = $keeper->getDateStart();
                $parameters["dateEnd"] = $keeper->getDateEnd();
    
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