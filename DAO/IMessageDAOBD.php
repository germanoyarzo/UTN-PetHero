<?php
namespace DAO;

use Models\Message as Message;

interface IMessageDAOBD{
    function Add(Message $newMessage);
    function GetById($id);
}
?>