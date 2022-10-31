<?php
namespace DAO;

use Models\Pet as Pet;

interface IPetDAO{
    function Add(Pet $newPet);
    function Delete($id);
    function GetAll();
    function Modify(Pet $pet);
    function GetById($id);
}
?>