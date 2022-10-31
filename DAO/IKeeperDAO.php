<?php
namespace DAO;

use Models\Keeper as Keeper;
use Models\Pet as Pet;

interface IKeeperDAO{
    function Add(Keeper $newKeeper);
    function Delete($id);
    function GetAll();
    function getByEmail($email);
    function GetById($id);
}
?>