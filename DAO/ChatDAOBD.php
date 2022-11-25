<?php 
namespace DAO;

use DAO\IChatDAOBD as IChatDAOBD;
use Models\Chat as Chat;
use \Exception as Exception;
use DAO\Connection as Connection;

class ChatDAOBD implements IChatDAOBD{
    private $chatList = array();
    private $connection;
    private $tableName = "chat";

    public function GetAllPDO() {
        try {
            $chatList = array();
            $query = "SELECT * FROM " . $this->tableName;
            $this->connection = Connection::getInstance();
            $resultSet = $this->connection->Execute($query);
            foreach($resultSet as $row) {
                $chat = new Chat();
                $chat->setId($row["id"]);
                $chat->setOwner($row["owner"]);
                $chat->setKeeper($row["keeper"]);

                array_push($chatList, $chat);
            }
            return $chatList;
        } catch(Exception $ex) {
            throw $ex;
        }
    }

    public function GetAllByUserPDO($id) {
        try {
            $chatListById = array();
            $query = "SELECT DISTINCT c.id, c.owner, c.keeper FROM " . $this->tableName . " c WHERE c.owner='".$id."' OR c.keeper='".$id."';";
            $this->connection = Connection::getInstance();
            $resultSet = $this->connection->Execute($query);
            foreach($resultSet as $row) {
                $chat = new Chat();
                $chat->setId($row["id"]);
                $chat->setOwner($row["owner"]);
                $chat->setKeeper($row["keeper"]);
                
                array_push($chatListById, $chat);
            }
            return $chatListById;
        } catch(Exception $ex) {
            throw $ex;
        }
    }

    public function GetById($id) {
        try{
            $chatList = array();

            $query = "SELECT * FROM ".$this->tableName." WHERE (id = :id);";

            $parameters['id'] = $id;

            $this->connection = Connection::GetInstance();

            $resultSet = $this->connection->Execute($query, $parameters);
            
            foreach ($resultSet as $row)
            {      
                $chat = new Chat();
                $chat->setId($row["id"]);
                $chat->setOwner($row["owner"]);
                $chat->setKeeper($row["keeper"]);

                array_push($chatList, $chat);
            }

            return (count($chatList) > 0) ? $chatList[0] : null;

        }catch (\PDOException $ex){
            throw $ex;
        }
    }

    public function ValidateChat($owner, $keeper) {
        try{
            $chatList = array();

            $query = "SELECT * FROM ".$this->tableName." c WHERE c.owner=:owner AND c.keeper=:keeper;";

            $parameters['owner'] = $owner;
            $parameters['keeper'] = $keeper;

            $this->connection = Connection::GetInstance();

            $resultSet = $this->connection->Execute($query, $parameters);
            
            foreach ($resultSet as $row)
            {      
                $chat = new Chat();
                $chat->setId($row["id"]);
                $chat->setOwner($row["owner"]);
                $chat->setKeeper($row["keeper"]);

                array_push($chatList, $chat);
            }

            return (count($chatList) > 0) ? true : false;

        }catch (\PDOException $ex){
            throw $ex;
        }
    }

    public function Add(Chat $chat)
    {
        try{
            $query = "INSERT INTO ".$this->tableName." (id, owner, keeper) VALUES (:id, :owner, :keeper);";
            
            $parameters["id"] = $chat->getId();
            $parameters["owner"] = $chat->getOwner();
            $parameters["keeper"] = $chat->getKeeper();

            $this->connection = Connection::GetInstance();

            $this->connection->ExecuteNonQuery($query, $parameters);
        }catch (Exception $ex) {
            throw $ex;
        }
    }
}
?>