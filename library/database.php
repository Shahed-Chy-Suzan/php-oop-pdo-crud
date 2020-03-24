<?php

	/**
	 *  OOP and PDO Database Connection with our Project 
	 */
	class DATABASE
	{
		private $dbhost = "localhost";
		private $dbuser = "root";
		private $dbpass = "";
		private $dbname = "employeplatform";
		private $pdo;
		
		function __construct()
		{
			if ( !isset($this->pdo) ){
				try{
					$link = new PDO("mysql:host=".$this->dbhost.";dbname=".$this->dbname, $this->dbuser, $this->dbpass);
					$link->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
					$link->exec("SET CHARACTER SET utf8");
					$this->pdo = $link;
				}
				catch(PDOException $e){
					die("Failed to Connect with the Database " . $e->getMessage());
				}
			}
		}


		// This Function Will Select the Dynamic Data From Database

		/*

		$sql = $this->pdo->prepare("SELECT * FROM tableName WHERE em_id:em_id AND name:name LIMIT 1,2 ORDER BY DESC");
		$sql->bindValue('em_id', $em_id);
		$sql->bindValue('name', $name);
		$this->pdo->prepare($sql);
		$sql->execute();*/
		
		public function select( $table, $data = array() )
		{
			$sql = 'SELECT ';

			// to identify the Select column Name or all(*)
			$sql .= array_key_exists("select", $data) ? $data['select']: '*';

			$sql .= ' FROM ' .$table;

			// to Identify if we have any kinds of WHERE condition exists or NOT
			if (array_key_exists("where", $data))
			{
				$sql .= ' WHERE ';
				$i = 0;
				foreach ($data['where'] as $key => $value) {
					$add = ($i > 0)? ' AND ':'';
					$sql .= "$add". "$key=:$key";
					$i++;
				}
			}

			// to identify ORDER BY if exists in our Program
			if ( array_key_exists("order_by", $data) ){
				$sql .= ' ORDER BY ' . $data['order_by'];
			}

			// Error Has I Guess ->to identify if we have any limit condition in our query code
			/*if(array_key_exists('start', $data) && array_key_exists('limit', $data))
			{
				$sql .= ' LIMIT ' . $data['start']. ',' . $data['limit'];
			}
			elseif(!array_key_exists('start', $data) && array_key_exists('limit', $data))
			{
				$sql .= ' LIMIT ' . $data['limit'];
			}*/


			$query = $this->pdo->prepare($sql);

			if ( array_key_exists("where", $data) )
			{
				foreach ($data["where"] as $key => $value) {
					$query->bindValue(":$key", $value);
				}
			}

			$query->execute();

			if ( array_key_exists('return_type', $data) )
			{
				switch ($data["return_type"])
				{
					case 'count':
						$value = $query->rowCount();
					break;

					case 'single':
						$value = $query->fetch(PDO::FETCH_ASSOC);
					break;

					default: 
						$value = '';
					break;
				}
			}
			else{
				if ( $query->rowCount() > 0 )
				{
					$value = $query->fetchAll();
				}
			}
			return !empty($value)?$value:false;
		}


		// This Function will Insert Data From the Static Page
		/*$sql = "INSERT INTO tableName (name, email, phone) VALUES (:name, :email, :phone)";
		$query = $this->pdo->prepare($sql);
		$query->bindValue(:name, $name);
		$query->bindValue(:email, $email);
		$query->bindValue(:phone, $phone);
		$query->execute();*/
		public function insert($table, $data)
		{	
			if ( !empty($data) && is_array($data))
			{
				$keys = '';
				$values = '';
				$i = 0;

				$keys = implode(',', array_keys($data));
				$values = ":".implode(', :', array_keys($data));
				$sql = "INSERT INTO ". $table ." (" . $keys . ") VALUES (". $values .")";
				$query = $this->pdo->prepare($sql);

				foreach ($data as $key => $val) {
					$query->bindValue(":$key", $val);
				}

				$insertdata = $query->execute();

				if ($insertdata)
				{
					$lastId = $this->pdo->lastInsertId();
					return $lastId;
				}
				else
				{
					return false;
				}

			}
		}


		// This Function will Update Data From the Static Page
		/*$sql = "UPDATE tableName SET name=:name, email=:email , phone=:phone WHERE em_id=:em_id";
		$query = $this->pdo->prepare($sql);
		$query->bindValue(:name, $name);
		$query->bindValue(:email, $email);
		$query->bindValue(:phone, $phone);
		$query->bindValue(:em_id, $em_id);
		$query->execute();*/


		public function update( $table, $data, $condition )
		{

			if ( !empty($data) && is_array($data))
			{
				$keyvalue	 	= '';
				$whereCond	 	= '';

				$i = 0;
				foreach ($data as $key => $val){
					$add 		= ($i > 0)? ' , ':'';
					$keyvalue 	.= "$add" . "$key=:$key";
					$i++;
				}

				if (!empty($condition) && is_array($condition))
				{
					$whereCond .= " WHERE ";
					$i = 0;
					foreach ($condition as $key => $val) 
					{
						$add 		= ($i > 0)? ' AND ':'';
						$whereCond 	.= "$add" . "$key=:$key";
						$i++;
					}
				}	
			
				$sql = "UPDATE ". $table . " SET " . $keyvalue. " " .$whereCond;
				$query = $this->pdo->prepare($sql);

				foreach ($data as $key => $val) 
				{
					$query->bindValue(":$key", $val);
				}

				foreach ($condition as $key => $val) {
					$query->bindValue(":$key", $val);
				}

				$update = $query->execute();
				return $update?$query->rowCount():false;	
			}
			else{
				return false;
			}
		}


		// This Function will Insert Delete Data From the Static Page
		/*$sql = "DELETE FROM tableName WHERE em_id=:em_id";
		$query->bindValue(:em_id, $em_id);
		$query->execute();*/

		public function delete($table, $data)
		{
			if ( !empty($data) && is_array($data)) 
			{
				$whereCond .= " WHERE ";
				$i = 0;
				foreach ($data as $key => $val) 
				{
					$add 		= ($i > 0)? ' AND ':'';
					$whereCond 	.= $add.$key." = '" . $val . "'";
					$i++;
				}
			}

			$sql = "DELETE FROM " . $table .$whereCond;
			$delete = $this->pdo->exec($sql);
			return $delete?true:false;

			

		}

	}

?>



