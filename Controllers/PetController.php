<?php
    namespace Controllers;

    use DAO\PetDAO as PetDAO;
    use DAO\PetDAOBD as PetDAOBD;
    use Models\Pet as Pet;
    use DAO\Connection as Connection;

    class PetController
    {
        private $PetDAO;
        private $PetDAOBD;

        public function __construct()
        {
            $this->PetDAO = new PetDAO();
            $this->PetDAOBD = new PetDAOBD();
        }

        public function Index($message = "")
        {
            $frontMessage = $message;
            require_once(VIEWS_PATH."index.php");
        }

        public function HomeOwner($message = "")
        {
            $frontMessage = $message;
            require_once(VIEWS_PATH."home-owner.php");
        }

        public function HomeKeeper($message = "")
        {
            $frontMessage = $message;
            require_once(VIEWS_PATH."home-keeper.php");
        }

        public function ShowListView()
        {
           // $petList = $this->PetDAO->getAll();
            $petList = $this->PetDAOBD->GetAllPDO();
            
            require_once(VIEWS_PATH."pet-list.php");
        }

        public function ShowModifyView($id) {
            //$pet = $this->petDAO->GetById($id);
            $pet = $this->petDAOBD->GetById($id);
        
            require_once(VIEWS_PATH."modify-pet.php");
        }

        public function SignUpPet($message = ""){
            $frontMessage = $message;
            require_once(VIEWS_PATH."add-pet.php");
        }

        public function UploadImage(){
            // Get reference to uploaded image
            $vaccinationImg_file = $_FILES["vaccinationImg"];
            $petImg_file = $_FILES["petImage"];

            // Exit if no file uploaded
            if (!isset($vaccinationImg_file) || !isset($petImg_file)) {
                die('No file uploaded.');
            }

            // Exit if is not a valid image file
            $vaccinationImg_type = exif_imagetype($vaccinationImg_file["tmp_name"]);
            $petImg_type = exif_imagetype($petImg_file["tmp_name"]);
            
            if (!$vaccinationImg_type || !$petImg_type) {
                die('Uploaded file is not an image.');
            }

            // Move the temp image file to the images/ directory
            $petImageNameNoExtension = substr($petImg_file["name"], 0, strpos($petImg_file["name"], "."));
            if (isset($vaccinationImg_file)) {
                move_uploaded_file(
                    // Temp image location
                    $vaccinationImg_file["tmp_name"],
                    // New image location
                    IMG_PATH . "/vaccination/". $petImageNameNoExtension . "_" . $vaccinationImg_file["name"]
                );
            }
            if (isset($petImg_file)) {
                move_uploaded_file(
                    // Temp image location
                    $petImg_file["tmp_name"],
    
                    // New image location
                    IMG_PATH . "/pets/" . $petImg_file["name"]
                );
            }
        }

        public function UploadImageBD()
        {
            var_dump("entro al upload image db");
            $targetDir = IMG_PATH . "/vaccination/";
            $fileName = basename($_FILES["vaccinationImg"]["name"]);
            $targetFilePath = $targetDir . $fileName;
            $fileType = pathinfo($targetFilePath,PATHINFO_EXTENSION);

            if(isset($_POST["submit"]) && !empty($_FILES["vaccinationImg"]["name"])){
                // Allow certain file formats
                $allowTypes = array('jpg','png','jpeg','gif','pdf');
                if(in_array($fileType, $allowTypes)){
                    // Upload file to server
                    if(move_uploaded_file($_FILES["vaccinationImg"]["tmp_name"], $targetFilePath)){
                        // Insert image file name into database
                        
                        $insert = "INSERT into pet (vaccination VALUES ('".$fileName."')";
                        var_dump($insert);
                        $connection = Connection::getInstance();
                        $resultSet = $connection->Execute($insert);
                        if($resultSet){
                            $statusMsg = "The file ".$fileName. " has been uploaded successfully.";
                        }else{
                            $statusMsg = "File upload failed, please try again.";
                        } 
                    }else{
                        $statusMsg = "Sorry, there was an error uploading your file.";
                    }
                }else{
                    $statusMsg = 'Sorry, only JPG, JPEG, PNG, GIF, & PDF files are allowed to upload.';
                }
            }else{
                $statusMsg = 'Please select a file to upload.';
            }


        }

        public function Add($race, $size, $description, $vaccinationImg, $petImage)
        {
            //var_dump($vaccinationImg["name"]);
            $pet = new Pet();
            $pet->setRace($race);
            $pet->setSize($size);
            //$pet->setVaccination($vaccinationImg);//JSON
            $pet->setVaccination($vaccinationImg["name"]);
            $pet->setDescription($description);
            //$pet->setImage($petImage); //JSON
            $pet->setImage($petImage["name"]);
            $pet->setIdUser($_SESSION["loggedUser"]->id);

            if($pet != null){
                //$this->PetDAO->Add($pet);
                var_dump($pet);
                $this->PetDAOBD->Add($pet);
                $this->UploadImage();
                //$this->UploadImageBD();
                $this->HomeOwner("&#x2705; Pet created correctly");
            }else{
                $errorMessage = "";
                $this->SignUpPet($errorMessage);
            }
        }

        public function Delete($id)
        {
            $this->petDAO->Delete($id);

            $this->ShowListView();
        }
    }        
?>