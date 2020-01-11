<?php 
Class DatabaseCon
{   private $connection;
    private $dataFromSeclect;
    private $lastId;
    function getDataFromSelect(){
        return $this->dataFromSeclect;
    }
    function  openConnection()
    {
        $this->connection=mysqli_connect("127.0.0.1:3306","root","","movieshub");
        
        if($this->connection->connect_error)
        {
            die("Connection failed" .$this->connection->connect_error );
            return false;
        }
        return true;
    }
 function getConnection()
 {
     return $this->connection;
 }
 function getLastId(){
     return $this->lastId;
 }
 function closeConnection()
 {
     $this->connection->close();
 }
 function implementQuery($sqlQuery) {
     
     
     if(mysqli_query($this->connection, $sqlQuery)== true)
     {       
         $this->lastId = mysqli_insert_id($this->connection);
        return true;
     }
     else
     {
        
         echo  "Error: " .$sqlQuery. "<br>" .$this->connection->error;
         echo mysqli_errno($this->connection);
          return false;
     }
  }
function update($sqlQuery) {
     
     
     if(mysqli_query($this->connection, $sqlQuery)== true)
     {       
        return true;
     }
     else
     {
         echo  "Error: " .$sqlQuery. "<br>" .$this->connection->error;
         echo mysqli_errno($this->connection);
          return false;
     }
  }
 
 function deleteFromDatabase($sqlQuery)
 {
     if(($result =mysqli_query($this->connection, $sqlQuery))== true)
     {       
         $this->dataFromSeclect = $result;
         return true;
     }
     else
     {
        
         echo  "Error: " .$sqlQuery. "<br>" .$this->connection->error;
         echo mysqli_errno($this->connection);
          return false;
     }
     
 }
 
 function selectFromDatabase($sqlQuery){
      if(($result =(mysqli_query($this->connection, $sqlQuery))) == true)
     {       
         if(mysqli_num_rows($result)>0){
             $this->dataFromSeclect = $result;
             return true;
         }
         else{
             return false;
         }
         
     }
     else
     {
         return false;
         echo  "Error: " .$sqlQuery. "<br>" .$this->connection->error;
         echo mysqli_errno($this->connection);
     }
 }
}
?>