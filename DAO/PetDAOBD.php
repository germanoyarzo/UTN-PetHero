<?php
    namespace DAO;

    use DAO\IPetDAOBD as IPetDAOBD;
    use Models\Pet as Pet;
    use \Exception as Exception;
    use DAO\Connection as Connection;

    class PetDAOBD implements IPetDAOBD
    {
        private $petLis = array();
        private $connection;
        private $tableName = "pet";

        public function GetAllPDO() {
            try {
                $petList = array();
                $query = "SELECT * FROM " . $this->tableName;
                $this->connection = Connection::getInstance();
                $resultSet = $this->connection->Execute($query);
                foreach($resultSet as $row) {
                    $pet = new Pet();
                    $pet->setId($row["id"]);
                    $pet->setIdUser($row["idUser"]);
                    $pet->setType($row["type"]);
                    $pet->setRace($row["race"]);
                    $pet->setSize($row["size"]);
                    $pet->setVaccination($row["vaccination"]);
                    $pet->setDescription($row["description"]);
                    $pet->setImage($row["image"]);

                    array_push($petList, $pet);
                }
                return $petList;
            } catch(Exception $ex) {
                throw $ex;
            }
        }

        public function GetById($id) 
        {
            try
            {
                $petList = array();
    
                $query = "SELECT * FROM ".$this->tableName." WHERE (id = :id);";
    
                $parameters['id'] = $id;
    
                $this->connection = Connection::GetInstance();
    
                $resultSet = $this->connection->Execute($query, $parameters);
                
                foreach ($resultSet as $row)
                {      
                    $pet = new Pet();
                    $pet->setId($row["id"]);
                    $pet->setIdUser($row["idUser"]);
                    $pet->setType($row["type"]);
                    $pet->setRace($row["race"]);
                    $pet->setSize($row["size"]);
                    $pet->setVaccination($row["vaccination"]);
                    $pet->setDescription($row["description"]);
                    $pet->setImage($row["image"]);
                    
                    array_push($petList, $pet);
                }

                ///return the array in position 0
                return (count($petList) > 0) ? $petList[0] : null;
            }catch(\PDOException $ex)
            {
                throw $ex;
            }
        }    
        public function Add(Pet $pet)
        {
            try
            {
                //var_dump($pet);
                $query = "INSERT INTO ".$this->tableName." (id,idUser, type, race, size ,vaccination , description, image ) VALUES (:id, :idUser, :type, :race, :size, :vaccination, :description, :image);";

                $parameters["id"] = $pet->getId();
                $parameters["idUser"] = $pet->getIdUser();
                $parameters["type"] = $pet->getType();
                $parameters["race"] = $pet->getRace();
                $parameters["size"] = $pet->getSize();
                $parameters["vaccination"] = $pet->getVaccination();
                $parameters["description"] = $pet->getDescription();
                $parameters["image"] = $pet->getImage();
                
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