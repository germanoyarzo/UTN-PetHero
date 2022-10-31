<?php
namespace DAO;

use Models\Book as Book;

interface IBookDAO{
    function Add(Book $newBook);
    function Remove($id);
    function GetAll();
    function GetById($id);
}
?>