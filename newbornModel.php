<?php
require_once "./dbModel.php";
 
class UserModel extends dbModel
{
    public function searchNewBorns()
    {   //Dynamically build the filter
        $name = $_GET['name'];
        $date_of_birth = $_GET['date_of_birth'];
        $conditionSql='';
        $params=[];
        //rendering the condition of string
        if(isset($name) && $name!=''){
            $conditionSql=' name = ?';
            array_push($params,$name)
        }
        if(isset($date_of_birth) && $date_of_birth!=''){
            $conditionSql.= $conditionSql==""? " date_of_birth = ?":" AND date_of_birth = ?";
            array_push($params,$date_of_birth)
        }
        //run the sql command from base class
        $sql = "SELECT `name`,`date_of_birth` FROM `newborn` where".$conditionSql;
        return $this->queryBasics($sql,$types = 'ss',$params = [];
    }
    public function getAllNewBorns()
    {   //run the sql command from base class
        $sql = "SELECT `name`,`date_of_birth` FROM `newborn`";
        return $this->queryBasics($sql,$types = null,$params = []);
    }
    public function registerNewBorns()
    {   //Get post data from name
        $name = $_POST['name'];
        $date_of_birth = $_POST['date_of_birth'];
        $filter = ['name'=>$name,'date_of_birth'=>$date_of_birth];
        $marks='';
        $params=[];
        //Get Columns needs and params wanna insert
        foreach($filter as $key => $value){
           if($value!=''&&isset($value)){
               unset($filter[$key]);
               $marks.= $marks==''?'?':',?';
               array_push($params,$value)
               
           }
        }
        if(count($filter)>0)
        {   $questionsMark='('.
            $cols = '('.implode(',' array_keys($filter)).')';
            $marks='('.$marks.')';
        }
        $sql = "INSERT INTO newborn ".$cols.' VALUES '.$marks;
        return $this->queryBasics($sql,$types = 'ss',$params = []);
    }
}