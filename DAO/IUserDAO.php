<?php
namespace DAO;

use Models\User as User;

interface IUserDAO{
    function Add(User $newUser);
    function Delete($id);
    function GetAll();
    function getByEmail($email);
    function GetById($id);
}
?>