<?php
namespace DAO;

use Models\Chat as Chat;

interface IChatDAOBD{
    function Add(Chat $newChat);
    function GetAllPDO();
    function GetById($id);
    // function UpdateChat($id);
    // function DeleteChat($id);
}
?>