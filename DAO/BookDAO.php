<?php
    namespace DAO;

    use DAO\IBookDAO as IBookDAO;
    use Models\Book as Book;
    use Models\Keeper as Keeper;

    class BookDAO implements IBookDAO {
        private $fileName = ROOT."Database/books.json";
        private $bookList = array();

        function Add(Book $book)
        {
            //var_dump($book);
            $this->RetrieveData();

            $book->setId($this->GetNextId());

            array_push($this->bookList, $book);

            $this->SaveData();
        }

        public function GetAll() {
            $this->RetrieveData();
            return $this->bookList;
        }

        public function Remove($id) {
            $this->RetrieveData();

            $this->bookList = array_filter($this->bookList, function($Book) use($id) {
                return $Book->getId() != $id;
            });

            $this->SaveData();
        }

        public function GetById($id) {
            $this->RetrieveData();

            $aux = array_filter($this->bookList, function($Book) use($id) {
                return $Book->getId() == $id;
            });

            $aux = array_values($aux);

            return (count($aux) > 0 ) ? $aux[0] : null;
        }

        private function SaveData() {
            sort($this->bookList);
            $arrayEncode = array();

            foreach($this->bookList as $Book) {
                
                $value["id"] = $Book->getId();
                $value["idKeeper"] = $Book->getIdKeeper();
                $value["idOwner"] = $Book->getIdOwner();
               // $value["dateBook"] = $Book->getDateBook();
           
                array_push($arrayEncode, $value);
            }
            $jsonContent = json_encode($arrayEncode, JSON_PRETTY_PRINT);
            file_put_contents($this->fileName, $jsonContent);
        }

        private function RetrieveData()
        {
             $this->bookList = array();

             if(file_exists($this->fileName))
             {
                 $jsonContent = file_get_contents($this->fileName);
                 $arrayDecode = ($jsonContent) ? json_decode($jsonContent, true) : array();
                 
                 foreach($arrayDecode as $value) {
                   
                    $Book = new Book();
                    $Book->setId($value["id"]);
                    $Book->setKeeper($value["idKeeper"]);
                    $Book->setUser($value["idOwner"]);
                    //$Book->setDateBook($value["dateKeeper"]);

                    array_push($this->bookList, $Book);
                 }
             }
        }

        private function GetNextId()
        {
            $id = 0;

            foreach($this->bookList as $book)
            {
                $id = ($book->getId() > $id) ? $book->getId() : $id;
            }

            return $id + 1;
        }
    }