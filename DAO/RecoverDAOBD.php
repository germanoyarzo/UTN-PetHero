<?php namespace DAO;

    use Models\Recover as Recover;
    use DAO\IRecoverDAO as IRecoverDAO;

    class JobOfferDAO implements IJobOfferDAO {

        private $connection;
        private $tableName = "recover";

        private $recoverList = array();


        public function AddPDO(Recover $recover) {
            try {
                $query = "INSERT INTO ".$this->tableName." (email, newPass) VALUES (:email, :newPass);";
                $parameters['email'] = $recover->getEmail();
                $parameters['newPass'] = $recover->getNewPass();
        
                $this->connection = Connection::GetInstance();
                $this->connection->ExecuteNonQuery($query, $parameters);
            } catch(Exception $ex) {
                throw $ex;
            }
        }

        public function GetAllPDO() {
            try {
                $recoverList = array();
                $query = "SELECT * FROM ".$this->tableName;
                $this->connection = Connection::GetInstance();
                $resultSet = $this->connection->Execute($query);
                
                foreach ($resultSet as $row) {                
                    $recover = new Recover();
                    $recover->setEmail($row['email']);
                    $recover->setNewPass($row['newPass']);

                    array_push($this->recoverList , $recover);
                }
                return $recoverList;
            } catch(Exception $ex) {
                throw $ex;
            }
        }
    }

?>