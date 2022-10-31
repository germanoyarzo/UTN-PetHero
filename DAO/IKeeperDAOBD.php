<?php
namespace DAO;

use Models\Keeper as Keeper;
use Models\Pet as Pet;

interface IKeeperDAOBD{
    function Add(Keeper $newKeeper);
    function GetAllPDO();
    function GetById($id);
    function GetAllFilterPDO($dateStart, $dateEnd);
}
?>