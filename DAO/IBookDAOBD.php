<?php
namespace DAO;

use Models\Book as Book;

interface IBookDAOBD{
    function Add(Book $newBook);
    //function Remove($id);
    function GetAllPDO();
    function GetById($id);
    function GetBookByKeeper($keeperId);
}
?>