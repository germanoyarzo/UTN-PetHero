<?php
    namespace DAO;

    use DAO\IPetDAO as IPetDAO;
    use Models\Pet as Pet;

    class PetDAO implements IPetDAO
    {
        private $petLis = array();
        private $fileName = ROOT."Database/pet.json";

        public function Add(Pet $pet)
        {
            $this->RetrieveData();
            
            $pet->setId($this->GetNextId());
            
            array_push($this->petList, $pet);

            $this->SaveData();
        }

        public function GetAll()
        {
            $this->RetrieveData();

            return $this->petList;
        }

        public function Delete($id)
        {            
            $this->RetrieveData();
            
            $this->petList = array_filter($this->petList, function($pet) use($id){                
                return $pet->getId() != $id;
            });
            
            $this->SaveData();
        }

        private function RetrieveData()
        {
            $this->petList = array();

            if(file_exists($this->fileName))
            {
                $jsonToDecode = file_get_contents($this->fileName);

                $contentArray = ($jsonToDecode) ? json_decode($jsonToDecode, true) : array();
                
                foreach($contentArray as $content)
                {
                    $pet = new Pet();
                    $pet->setId($content["id"]);
                    $pet->setIdOwner($content["idOwner"]);
                    $pet->setRace($content["race"]);
                    $pet->setSize($content["size"]);
                    $pet->setVaccination($content["vaccination"]);
                    $pet->setDescription($content["description"]);
                    $pet->setImage($content["image"]);

                    array_push($this->petList, $pet);
                }
            }
        }

        function Modify(Pet $pet)
        {
            $this->RetrieveData();
            $id = $pet->getId();
            $this->petList = array_filter($this->petList, function($pet) use($id){
                return $pet->getId() != $id;
            });

            array_push($this->petList, $pet);

            $this->SaveData();
        }

        function GetById($id)
        {
            $this->RetrieveData();

            $pet = array_filter($this->petList, function($pet) use($id){
                return $pet->getId() == $id;
            });

            $pet = array_values($pet); //Reorderding array

            return (count($pet) > 0) ? $pet[0] : null;
        }

        private function SaveData()
        {
            $arrayToEncode = array();

            foreach($this->petList as $pet)
            {
                $valuesArray = array();
                $valuesArray["id"] = $pet->getId();
                $valuesArray["idOwner"] = $pet->getIdOwner();
                $valuesArray["race"] = $pet->getRace();
                $valuesArray["size"] = $pet->getSize();
                $valuesArray["vaccination"] = $pet->getVaccination();
                $valuesArray["description"] = $pet->getDescription();
                $valuesArray["image"] = $pet->getImage();

                array_push($arrayToEncode, $valuesArray);
            }

            $fileContent = json_encode($arrayToEncode, JSON_PRETTY_PRINT);

            file_put_contents($this->fileName, $fileContent);
        }

        private function GetNextId()
        {
            $id = 0;

            foreach($this->petList as $pet)
            {
                $id = ($pet->getId() > $id) ? $pet->getId() : $id;
            }

            return $id + 1;
        }
    }
?>