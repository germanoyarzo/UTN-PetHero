<?php 
namespace DAO;

use DAO\IMessageDAOBD as IMessageDAOBD;
use Models\Message as Message;
use \Exception as Exception;
use DAO\Connection as Connection;

class MessageDAOBD implements IMessageDAOBD{
    private $messageList = array();
    private $connection;
    private $tableName = "message";

    public function GetById($id) {
        try{
            $messageList = array();

            $query = "SELECT * FROM ".$this->tableName." WHERE (id = :id);";

            $parameters['id'] = $id;

            $this->connection = Connection::GetInstance();

            $resultSet = $this->connection->Execute($query, $parameters);
            
            foreach ($resultSet as $row)
            {      
                $message = new Message();
                $message->setId($row["id"]);
                $message->setIdChat($row["id_chat"]);
                $message->setUser($row["user"]);
                $message->setMessage($row["message"]);
                $message->setDate($row["date"]);

                array_push($messageList, $message);
            }

            return (count($messageList) > 0) ? $messageList[0] : null;

        }catch (\PDOException $ex){
            throw $ex;
        }
    }

    public function GetAllByChatId($idChat) {
        try{
            $messageList = array();

            $query = "SELECT * FROM ".$this->tableName." m WHERE m.id IS NOT NULL AND m.id_chat = '". $idChat ."' ORDER BY m.date;";

            $this->connection = Connection::GetInstance();

            $resultSet = $this->connection->Execute($query);
            
            foreach ($resultSet as $row)
            {      
                $message = new Message();
                $message->setId($row["id"]);
                $message->setIdChat($row["id_chat"]);
                $message->setUser($row["user"]);
                $message->setMessage($row["message"]);
                $message->setDate($row["date"]);

                array_push($messageList, $message);
            }

            return (count($messageList) > 0) ? $messageList : null;

        }catch (\PDOException $ex){
            throw $ex;
        }
    }

    public function Add(Message $message)
    {
        try{
            $query = "INSERT INTO ".$this->tableName." (id, id_chat, user, message, date) VALUES (:id, :id_chat, :user, :message, :date);";

            $parameters["id"] = $message->getId();
            $parameters["id_chat"] = $message->getIdChat();
            $parameters["user"] = $message->getUser();
            $parameters["message"] = $message->getMessage();
            $parameters["date"] = $message->getDate();

            $this->connection = Connection::GetInstance();

            $this->connection->ExecuteNonQuery($query, $parameters);
        }catch (Exception $ex) {
            throw $ex;
        }
    }
}
?>