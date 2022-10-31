<?php
namespace DAO;

use Models\Pet as Pet;

interface IPetDAOBD{
    function Add(Pet $newPet);
    //function Delete($id);
    function GetAllPDO();
    //function Modify(Pet $pet);
    function GetById($id);
}
?>