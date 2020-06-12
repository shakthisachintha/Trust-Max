<?php
class database {
    private $host="localhost";
    private $user ="ark-max";
    private $password ='z-si8X,q*TT.';
    private $database = "t-max-db";
    private $dbh;
    private $error;
    private $stmt;
	
	public $con;
    public function __construct(){
        try {
			$dsn='mysql:host='.$this->host.';dbname='.$this->database;
			$options = array(
				PDO::ATTR_PERSISTENT => true,
				PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
			);
            $this->dbh=new PDO($dsn, $this->user, $this->password, $options);
        }
        catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

//======================================================================================	
	public function insertrec($que) {
		try {
            $que = strip_tags($que,'<a><p><em><i><strong><h1><h2><h3><h4><h5><h6><div><ul><li>');
			$this->stmt=$this->dbh->prepare($que);
			return $this->stmt->execute();
		}
		catch(PDOException $e){
			echo $e->getMessage();
		}
	}
	
	public function insertid($que) {
		try {
            $que = strip_tags($que,'<a><p><em><i><strong><h1><h2><h3><h4><h5><h6><div>');
			$this->stmt=$this->dbh->prepare($que);
			$this->stmt->execute();
			return $this->dbh->lastInsertId();
		}
		catch(PDOException $e){
			echo $e->getMessage();
		}
	}
//======================================================================================	
	public function singlerec($que) {
		try {
			$this->stmt=$this->dbh->prepare($que);
			$this->stmt->execute();
			return $this->stmt->fetch();
		}
		catch(PDOException $e){
			echo $e->getMessage();
		}
	}
//======================================================================================	
	public function get_all($que) {
		try {
			$this->stmt=$this->dbh->prepare($que);
			$this->stmt->execute();
			return $this->stmt->fetchAll();
		}
		catch(PDOException $e){
			echo $e->getMessage();
		}
	}
	
//======================================================================================
	

	public function singlecolumn($que) {
		try {
			$this->stmt=$this->dbh->prepare($que);
			$this->stmt->execute();
			$result=$this->stmt->fetchAll();
			$x=0;
			foreach($result as $row) {
				$q[$x]=$row[0];
				$x++;
			}
			return $q;
		}
		catch(PDOException $e){
			echo $e->getMessage();
		}
	}
//======================================================================================	
	public function numrows($que) {
		try {
			$this->stmt=$this->dbh->prepare($que);
			$this->stmt->execute();
			return $this->stmt->rowCount();
		}
		catch(PDOException $e){
			echo $e->getMessage();
		}
	}
//======================================================================================	
	public function Extract_Single($que) {
		try {
			$this->stmt=$this->dbh->prepare($que);
			$this->stmt->execute();
			$result=$this->stmt->fetchAll();
			$x=0;
			foreach($result as $row) {
				$q[$x]=$row[0];
				$implode[]=$q[$x];
				$x++;
			}
			return @implode(',', $implode);
		}
		catch(PDOException $e){
			echo $e->getMessage();
		}
	}
//======================================================================================	
	public function check1column($table,$column,$v1) {
		try {
			$que="select * from $table where $column='$v1'";
			$this->stmt=$this->dbh->prepare($que);
			$this->stmt->execute();
			$count=$this->stmt->rowCount();
			if($count>=1)
				return 1;
			else
				return 0;
		}
		catch(PDOException $e){
			echo $e->getMessage();
		}
	}
//======================================================================================	
	public function check2column($table,$column1,$v1,$column2,$v2) {
		try {
			$que="select * from $table where $column2 ='$v2' and $column1='$v1'";
			$this->stmt=$this->dbh->prepare($que);
			$this->stmt->execute();
			$count=$this->stmt->rowCount();
			if($count>=1)
				return 1;
			else
				return 0;
		}
		catch(PDOException $e){
			echo $e->getMessage();
		}
	}
//======================================================================================	
	public function check3column($table,$column1,$v1,$column2,$v2,$column3,$v3) {
		try {
			$que="select * from $table where $column2 ='$v2' and $column1='$v1' and $column3='$v3'";
			$this->stmt=$this->dbh->prepare($que);
			$this->stmt->execute();
			$count=$this->stmt->rowCount();
			if($count>=1)
				return 1;
			else
				return 0;
		}
		catch(PDOException $e){
			echo $e->getMessage();
		}
	}

//======================================================================================
	
public function get_all_assoc($que) {
		try {
			$this->stmt=$this->dbh->prepare($que);
			$this->stmt->execute();
			return $this->stmt->fetchAll(PDO::FETCH_ASSOC);
		}
		catch(PDOException $e){
			echo $e->getMessage();
		}
	}
	
	
	/* Pagination *///==========================================================================================================
  function page_break($count,$records,$page){
		$livepage = $_SERVER["PHP_SELF"];
		$livepage = substr(strrchr($livepage, '/'), 1);
		$disp="";
		if($records < $count){
			$limit=$count / $records;
			for($i=0;$i<$limit;$i++){
				$slno=$i+1;
				$link="$livepage?page=".$slno;
				$disp .="<li><a href='$link'>$slno</a></li>";
			}
		}
		else{
			unset($_SESSION['limit']);
			unset($_SESSION['start']);
		}		
		return $disp;	
    }
	
		public function escapstr($str){
		return $str;
	}

//======================================================================================	
	public function check_colval($table,$column,$v1,$id) {
		try {
			$que="select * from $table where $column='$v1' and id='$id'";
			$this->stmt=$this->dbh->prepare($que);
			$this->stmt->execute();
			$count=$this->stmt->rowCount();
			if($count>=1)
				return 1;
			else
				return 0;
		}
		catch(PDOException $e){
			echo $e->getMessage();
		}
	}
	
}

	$GT_vadmin = 1;
//========================================================================
while(list($key,$value)=@each($_POST)) {
	if(is_array($value)){
		$$key=$value;	
	}else{
		$$key=addslashes($value);	
	}
}

while(list($key,$value)=@each($_GET)) {
    if(is_array($value)){
		$$key=$value;	
	}else{
		$$key=addslashes($value);	
	}
}	
?>