<?php
  class dbModel{
    protected $con = "";
    public function __construct(){
        try {
            //Get connector by enter credential info
            $this->con = new mysqli(env('DB_HOST'), env('DB_USERNAME'), env('DB_PASSWORD'), env('DB_DATABASE_NAME')); 
            //Throw exception when there is error in database connection
            if($this->con-> connect_errno){
                throw new Exception("Database is not connected!");  
            }
        } catch (Exception $e) {
            throw new Exception($e->getMessage());   
        }           
    }
    //Make the code more reuesable and reduce amounts of code.
    public function queryBasics($query,$types = null,$params = null){
        try{
            //Prepare the statement in order to prevent sql injection
            $stmt = $this->con->prepare($sql);
            //Bind it with params you have 
            $stmt->bind_param($types, ...$params);
            if(!$stmt->execute()) return false;
            return $stmt->get_result();


        }

    }
 
     
  }

?>