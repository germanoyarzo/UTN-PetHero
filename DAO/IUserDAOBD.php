<?php
namespace DAO;

use Models\User as User;

interface IUserDAOBD{
    function Add(User $newUser);
    function GetAllPDO();
    function GetByEmailPDO($email, $password);
    function GetById($id);
}
?>