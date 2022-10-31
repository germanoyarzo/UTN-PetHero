<?php

namespace DAO;

class Connection
{
    private $pdo = null; ///Objetos de Datos PHP
    private $pdoStatement = null;
    private static $instance = null;


    public function __construct()
    {
        try {
            $this->pdo = new \PDO("mysql:host=" . DB_HOST . ";dbname=" . DB_NAME, DB_USER, DB_PASS);
            $this->pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
        } catch (\Exception $ex) {
            throw $ex;
        }
    }

    public static function getInstance()
    {
        if (self::$instance == null) {
            self::$instance = new Connection();
        }
        return self::$instance;
    }

    public function execute($query, $parameters = array())
    {
         try
         {
         // I create a statement by calling prepare. This returns a statement object
              $this->pdoStatement = $this->pdo->prepare($query);

              foreach($parameters as $parameterName => $value)
              {
                   // I replace the parameter markers with the actual values using the bindParam () method.
                   $this->pdoStatement->bindParam(":".$parameterName, $value);
              }

              $this->pdoStatement->execute();

              return $this->pdoStatement->fetchAll();
         }
         catch(\Exception $ex)
         {
              throw $ex; 
         }
    } 

    public function executeNonQuery($query, $parameters = array())
    {
         
         try
         {
              // Creo una sentencia llamando a prepare. Esto devuelve un objeto statement
              $this->pdoStatement = $this->pdo->prepare($query);
              foreach($parameters as $parameterName => $value)
              {
                   // Reemplazo los marcadores de parametro por los valores reales utilizando el método bindParam().
                   //$this->pdoStatement->bindParam(":".$parameterName, $value);
                   $this->pdoStatement->bindParam(":$parameterName", $parameters[$parameterName]);
              }
              $this->pdoStatement->execute();
              return $this->pdoStatement->rowCount();
         }
         catch(\Exception $ex)
         {   
              throw $ex;
         }
    }

    function conectarse(){
     //---------------------------TIPO DE CONEXION 1-----------------------------------
     /*$conectarse= mysql_connect($this->ruta,$this->usuario, $this->contrasena) or die(mysql_error()); //conexion al BD
     if($conectarse){
          mysql_select_db($this->baseDatos);
          return($conectarse);
     }else{
          return ("Error");
          }*/
     //------------------------TIPO DE CONEXION 2 - RECOMENDADA---------------------------------------------
     $enlace = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);
     if($enlace){
          echo "Conexion exitosa";	//si la conexion fue exitosa nos muestra este mensaje como prueba, despues lo puedes poner comentarios de nuevo: //
     }else{
          die('Error de Conexión (' . mysqli_connect_errno() . ') '.mysqli_connect_error());
     }
     return($enlace);
     // mysqli_close($enlace); //cierra la conexion a nuestra base de datos, un ounto de seguridad importante.
}

}

?>