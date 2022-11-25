<?php 
namespace DAO;
use DAO\IUserDAOBD as IUserDAOBD;
use Models\User as User;
use \Exception as Exception;
use DAO\Connection as Connection;

class UserDAOBD implements IUserDAOBD{
    private $userList = array();
    private $connection;
    private $tableName = "user";
    private $keepersTableName = "keeper";

    public function GetAllPDO() {
        try {
            $userList = array();
            $query = "SELECT * FROM " . $this->tableName;
            $this->connection = Connection::getInstance();
            $resultSet = $this->connection->Execute($query);
            foreach($resultSet as $row) {
                $user = new User();
                $user->setId($row["id"]);
                $user->setEmail($row["email"]);
                $user->setPassword($row["password"]);
                $user->setRole($row["role"]);
                $user->setFirstName($row["firstName"]);
                $user->setLastName($row["lastName"]);
                $user->setDni($row["dni"]);
                $user->setPhoneNumber($row["phoneNumber"]);
                $user->setKeyword($row["keyword"]);


                array_push($userList, $user);
            }
            return $userList;
        } catch(Exception $ex) {
            throw $ex;
        }
    }

    public function GetByEmailPDO($email, $password) 
    {
        try
        {
            $userList = array();

            $query = "SELECT * FROM ".$this->tableName." WHERE (email = :email);";

            $parameters['email'] = $email;

            $this->connection = Connection::GetInstance();

            $resultSet = $this->connection->Execute($query, $parameters);
            
            foreach ($resultSet as $row)
            {      
                ///validation for descrypt password
                $hash= $row["password"];
                $verify = password_verify($password, $hash);
                
                if($verify){
                    $user = new User();
                    $user->setId($row["id"]);
                    $user->setEmail($row["email"]);
                    $user->setPassword($row["password"]);
                    $user->setRole($row["role"]);
                    $user->setFirstName($row["firstName"]);
                    $user->setLastName($row["lastName"]);
                    $user->setDni($row["dni"]);
                    $user->setPhoneNumber($row["phoneNumber"]);
                    $user->setKeyword($row["keyword"]);

                    array_push($userList, $user);
                }
                
            }

            ///return the array in position 0
            return (count($userList) > 0) ? $userList[0] : null;
        }catch(\PDOException $ex)
        {
            throw $ex;
        }
    }  
    
    public function GetByEmailRepeatPDO($email)
    {
        try
        {
            $findUser = false;

            $query = "SELECT * FROM ".$this->tableName." WHERE (email = :email);";

            $parameters['email'] = $email;

            $this->connection = Connection::GetInstance();

            $resultSet = $this->connection->Execute($query, $parameters);
            
            if($resultSet){
                $findUser = true;
            }

            return $findUser;
        }catch(\PDOException $ex)
        {
            throw $ex;
        }
    }  

    public function GetById($id) 
    {
        try
        {
            $userList = array();

            $query = "SELECT * FROM ".$this->tableName." WHERE (id = :id);";

            $parameters['id'] = $id;

            $this->connection = Connection::GetInstance();

            $resultSet = $this->connection->Execute($query, $parameters);
            
            foreach ($resultSet as $row)
            {      
                 ///validation for descrypt password
               // $hash= $row["password"];
               // $verify = password_verify($password, $hash);
                
              
                    $user = new User();
                    $user->setId($row["id"]);
                    $user->setEmail($row["email"]);
                    $user->setPassword($row["password"]);
                    $user->setRole($row["role"]);
                    $user->setFirstName($row["firstName"]);
                    $user->setLastName($row["lastName"]);
                    $user->setDni($row["dni"]);
                    $user->setPhoneNumber($row["phoneNumber"]);
                    $user->setKeyword($row["keyword"]);

                    array_push($userList, $user);
                
                
            }

                ///return the array in position 0
                return (count($userList) > 0) ? $userList[0] : null;
        }catch(\PDOException $ex)
        {
            throw $ex;
        }
    }   

    public function Add(User $user)
    {
        
        try
        {
            //encrypt passord
            $pass = $_POST["password"];
            $password_crypt= password_hash($pass, PASSWORD_DEFAULT);

            $query = "INSERT INTO ".$this->tableName." (id,email, password, role, firstName, lastName, dni, phoneNumber, keyword) VALUES (:id, :email, :password, :role, :firstName, :lastName, :dni, :phoneNumber, :keyword);";
            
            $parameters["id"] = $user->getId();
            $parameters["email"] = $user->getEmail();
            $parameters["password"] = $password_crypt;
            $parameters["role"] = $user->getRole();
            $parameters["firstName"] = $user->getFirstName();
            $parameters["lastName"] = $user->getLastName();
            $parameters["dni"] = $user->getDni();
            $parameters["phoneNumber"] = $user->getPhoneNumber();
            $parameters["keyword"] = $user->getKeyword();

            $this->connection = Connection::GetInstance();

            $this->connection->ExecuteNonQuery($query, $parameters);
        }
        catch(Exception $ex)
        {
            throw $ex;
        }
    }

    public function Change($email, $password, $keyword) {
        try {
            $query = "UPDATE ".$this->tableName." SET email=:email, password=:password, keyword=:keyword WHERE email=:email;";
            
            $pass = $_POST["password"];
            $password_crypt= password_hash($pass, PASSWORD_DEFAULT);

            $parameters['email'] = $email;
            $parameters["password"] = $password_crypt;
            $parameters['keyword'] = $keyword;
            
    
            $this->connection = Connection::GetInstance();
            $this->connection->ExecuteNonQuery($query, $parameters);
           
        } catch(Exception $ex) {
            return "Ha ocurrido un error, usuario o palabra clave incorrectos:( " . $ex->getMessage();     
        }
    }    
    public function GetKeepersAvailablePDO() {
        try {
            $keeperList = array();
            $query = "SELECT DISTINCT u.id, u.firstName, u.lastName, u.email, u.dni, u.phoneNumber FROM " . $this->tableName . " u JOIN ". $this->keepersTableName ." k ON u.id=k.idKeeper WHERE u.role='keeper';";
            $this->connection = Connection::getInstance();
            $resultSet = $this->connection->Execute($query);
            foreach($resultSet as $row) {
                $user = new User();
                $user->setId($row["id"]);
                $user->setFirstName($row["firstName"]);
                $user->setLastName($row["lastName"]);
                $user->setEmail($row["email"]);
                $user->setDni($row["dni"]);
                $user->setPhoneNumber($row["phoneNumber"]);

                array_push($keeperList, $user);
            }
            return $keeperList;
        } catch(Exception $ex) {
            throw $ex;
        }
    }


    public function Modify($id,$email, $password, $role, $firstName, $lastName, $dni, $phoneNumber,$keyword) {
        try {

            $query = "UPDATE ".$this->tableName." SET email=:email, password=:password,role=:role, firstName=:firstName , lastName=:lastName, dni=:dni, phoneNumber=:phoneNumber, keyword=:keyword WHERE id=:id;";
            $parameters['id'] = $id;
            $parameters['email'] = $email;
            $password_crypt= password_hash($password, PASSWORD_DEFAULT);
            $parameters['password'] = $password_crypt;
            $parameters['role'] = $role;
            $parameters['firstName'] = $firstName;
            $parameters['lastName'] = $lastName;
            $parameters['dni'] = $dni;
            $parameters['phoneNumber'] = $phoneNumber;
            $parameters['keyword'] = $keyword;

            $this->connection = Connection::GetInstance();
            $this->connection->ExecuteNonQuery($query, $parameters);
        } catch(Exception $ex) {
            throw $ex;
        }
    }
}
?>