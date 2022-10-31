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

        public function GetAllFilterPDO($dateStart, $dateEnd) {
            try {
                $keeperList = array();
                //$query = "SELECT * FROM " . $this->tableName." WHERE (dateStart = :dateStart and dateEnd = :dateEnd);";
                $query = "SELECT * FROM " . $this->tableName." WHERE ( dateEnd = :dateEnd) ;";
                //$parameters['dateStart'] = $dateStart;
                $parameters['dateEnd'] = $dateEnd;
             
                $this->connection = Connection::getInstance();
                $resultSet = $this->connection->Execute($query, $parameters);

                foreach($resultSet as $row) {
                    $keeper = new Keeper();
                    $keeper->setId($row["id"]);
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
        public function Add(Keeper $keeper)
        {
            try
            {
    
                $query = "INSERT INTO ".$this->tableName." (id,size, salary, available, dateStart, dateEnd) VALUES (:id, :size, :salary, :available, :dateStart, :dateEnd);";
                
                $parameters["id"] = $keeper->getId();
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