<?php
class Utility
{
	public static function removeFields(&$array, $unwanted_key)
	{
		// $unwated_key is always 1-dimention array
		if (!empty($array)) {

			foreach ($unwanted_key as $v) {
				foreach ($array as $key => &$value) {
					if ($key == $v) {
						unset($array[$v]);
					}
					if (is_array($value)) {
						self::removeFields($value, $unwanted_key);
					}
				}
			}
		}
	}


	public static function getTables()
	{
		$tables = [];
		try {
			$db = new DB();
			$conn = $db->open();
			if ($conn) {
				$query = "SELECT * FROM sqlite_master where type='table'";
				$stmt  = $conn->prepare($query);
				$stmt->execute();
				$result = $stmt->fetchAll();
				foreach ($result as $val) {
					$tables[] = $val["name"];
				}
			} else {
				// echo $conn;
			}
		} catch (PDOException $ex) {
			// echo $ex->getMessage();
		}
		return $tables;
	}

	private static function getColunmns($table_name)
	{
		if (in_array($table_name, self::getTables())) {
			$table_fields = [];
			try {
				$db = new DB();
				$conn = $db->open();
				if ($conn) {
					$stmt  = $conn->prepare("pragma table_info(" . $table_name . ");");
					$stmt->execute();
					$result = $stmt->fetchAll();
					foreach ($result as $val) {
						$table_fields[] = $val["name"];
					}

					return $table_fields;
				} else {
					return NUlL;
				}
			} catch (PDOException $ex) {
				return NULL;
			}
		}
	}

	public static function formBuilder($tag)
	{
		$table_form = self::getColunmns($tag);
		require_once(__DIR__ . "/../view/user/crud.php");
	}


	public static function getMax($table)
	{
		$total = "";
		try {

			$db = new DB();
			$conn = $db->Open();
			if ($conn) {

				$query = "SELECT COUNT(id) as total FROM (SELECT *FROM $table)";
				$stmt  = $conn->prepare($query);
				$stmt->execute();
				$total = $stmt->fetch();
			} else {
				// echo $conn;
			}
		} catch (PDOException $ex) {
			// echo $ex->getMessage();
		}


		return $total;
	}


	public static function getAll($table, $offset = null, $limit = null)
	{


		if ($limit < 0) {
			Messages::setMsg("wrong limit", "error");
			return;
		}
		if ($offset < 0) {
			Messages::setMsg("wrong offset", "error");
			return;
		}

		if (in_array($table, self::getTables())) {

			try {

				$db = new DB();
				$conn = $db->Open();
				if ($conn) {

					$query = "SELECT *  FROM $table limit ? , ? ";

					$stmt  = $conn->prepare($query);
					if (isset($limit) && isset($offset)) {
						$stmt->execute(array($offset, $limit));

						$tmp = $stmt->fetchAll();
						$query = "SELECT COUNT(id) as total FROM (SELECT * FROM $table)";
						$stmt  = $conn->prepare($query);
						$stmt->execute();
						$total = $stmt->fetch();
						$result = [];
						$result["res"] = $tmp;
						$result["total"] = $total;
					} else {
						$query = "SELECT * FROM $table";
						$stmt  = $conn->prepare($query);
						$stmt->execute();
						$result = $stmt->fetchAll();
					}
				} else {
					// echo $conn;
					Messages::setMsg('Cannot connect to db', 'error');
				}
			} catch (PDOException $ex) {
				//echo $ex->getMessage();
				Messages::setMsg('Cannot connect to db', 'error');
			}
		}

		return $result;
	}



	private static function sanitize($array, $crud)
	{

		$table_name = array_search($array[$crud], $GLOBALS["tables"]);

		if ($table_name === false) {
			$array = NULL;
		} else {
			$t_name = $GLOBALS["tables"][$table_name];

			try {

				$db = new DB();
				$columns = self::getColunmns($t_name);

				if ($columns) {
					foreach ($array as $cle => $val) {

						if (!in_array($cle, $columns)) {
							unset($array[$cle]);
						}
					}
					$array[$crud] = $t_name;
				} else {

					return NUlL;
				}
			} catch (PDOException $ex) {

				return NULL;
			}
		}

		return $array;
	}


	private static function prep_sql_create($arr)
	{
		$array = self::sanitize($arr, "create");

		$keys = $values = $rep = array();
		if ($array) {

			$placeholders = array_fill(0, count($array) - 1, '?');

			foreach ($array as $k => $v) {
				if ($k != "create") {
					$keys[] = $k;
					$values[] = $v;
				}
			}

			// assuming the PDO instance is $pdo
			$query = 'INSERT INTO ' . $_POST["create"] . ' ' .
				'(' . implode(',', $keys) . ') VALUES ' .
				'(' . implode(',', $placeholders) . ')';

			$rep[] = $query;
			$rep[] = $values;
		}


		return $rep;
	}

	private static function prep_sql_update($arr)
	{
		$array = self::sanitize($arr, "update");
		$values = $rep = array();

		if ($array) {

			$updates = array_filter($array, 'strlen');
			$query = "UPDATE " . $array["update"] . " SET";


			foreach ($updates as $name => $value) {
				if ($name == "id") {
					$values[':' . $name] = $value;
				}
				if ($name != "update" && $name != "id") {
					$query .= ' ' . $name . ' = :' . $name . ',';
					$values[':' . $name] = $value;
				}
			}

			$query = substr($query, 0, -1) . ' WHERE id=:id;'; // remove last , and add a ;

			$rep[] = $query;
			$rep[] = $values;
		}

		return $rep;
	}



	public static function createData()
	{
		try {

			$db = new DB();
			$conn = $db->Open();


			$arr = self::prep_sql_create($_POST);



			if (count($arr[1]) - count(array_filter($arr[1], 'strlen')) > 1) {

				Messages::setMsg("Please provide data in the textbox", 'error');
			} else {
				if ($conn) {


					$stmt = $conn->prepare($arr[0]);
					$stmt->execute($arr[1]);


					Messages::setMsg("Record Successfully Inserted...!", 'success');
				} else {
					//echo $conn;

					Messages::setMsg("Unable to insert record", 'error');
				}
			}
		} catch (PDOException $ex) {
			echo $ex->getMessage();

			Messages::setMsg("Unable to insert record", 'error');
		}
	}



	public static function updateData()
	{

		try {

			$db = new DB();
			$conn = $db->Open();
			$arr = self::prep_sql_update($_POST);

			if ($conn) {
				$stmt = $conn->prepare($arr[0]);
				$stmt->execute($arr[1]);

				Messages::setMsg("Data Successfully Updated", 'success');
			} else {
				// echo $conn;
				Messages::setMsg("Unable to update record", 'error');
			}
		} catch (PDOException $ex) {
			// echo $ex->getMessage();

			Messages::setMsg("Unable to update record", 'error');
		}
	}


	public static function deleteData()
	{
		$array = self::sanitize($_POST, "delete");


		try {

			$db = new DB();
			$conn = $db->Open();
			if ($conn) {

				$query = "DELETE FROM " . $array['delete'] . " where id=:id ";
				$stmt = $conn->prepare($query);
				$stmt->execute([":id" => $array['id']]);

				Messages::setMsg("Data Successfully Deleted", 'success');
			} else {
				// echo $conn;
				Messages::setMsg('Cannot connect to db', 'error');
			}
		} catch (PDOException $ex) {
			//echo $ex->getMessage();
			Messages::setMsg('Cannot connect to db', 'error');
		}
	}



	public static function etd_all($offset = null, $limit = null)
	{

		$sql = "SELECT seance.*, 
		cours.name as cours,
		users.id as user_id,
		users.first_name,
		users.last_name,
		courstype.name as type,
		sum((case
		     when courstype.id=1 then ROUND((JULIANDAY(fin) - JULIANDAY(debut)) * 24)*1.5
			 else ROUND((JULIANDAY(fin) - JULIANDAY(debut)) * 24)
		end )) as etd
		FROM seance 
		left join cours on seance.cours_id =cours.id
		left join users on cours.user_id=users.id 
		left join courstype on seance.type_id=courstype.id 
		GROUP by user_id
		";

		if ($limit < 0) {
			Messages::setMsg("wrong limit", "error");
			return;
		}
		if ($offset < 0) {
			Messages::setMsg("wrong offset", "error");
			return;
		}

		try {

			$db = new DB();
			$conn = $db->Open();
			if ($conn) {

				$query = $sql . " limit ? , ? ";
				$stmt  = $conn->prepare($query);
				if (isset($limit) && isset($offset)) {
					$stmt->execute(array($offset, $limit));

					$tmp = $stmt->fetchAll();
					$query = "SELECT COUNT(*) as total FROM ( " . $sql . " )";
					$stmt  = $conn->prepare($query);
					$stmt->execute();
					$total = $stmt->fetch();
					$result = [];
					$result["res"] = $tmp;
					$result["total"] = $total;
				} else {
					// only count maximum records when no arguments
					$query = "SELECT COUNT(*) as total FROM ( " . $sql . " )";
					$stmt  = $conn->prepare($query);
					$stmt->execute();
					$total = $stmt->fetch();
					$result = [];
					$result["total"] = $total;
				}
			} else {
				// echo $conn;
				Messages::setMsg('Cannot connect to db', 'error');
			}
		} catch (PDOException $ex) {
			//echo $ex->getMessage();
			Messages::setMsg('Cannot connect to db', 'error');
		}


		return $result;
	}

	public static function etd_one()
	{
		$sql = "select * from (SELECT seance.*, 
		cours.name as cours,
		users.id as user_id,
		users.first_name,
		users.last_name,
		courstype.name as type,
		sum((case
		     when courstype.id=1 then ROUND((JULIANDAY(fin) - JULIANDAY(debut)) * 24)*1.5
			 else ROUND((JULIANDAY(fin) - JULIANDAY(debut)) * 24)
		end )) as etd
		FROM seance 
		left join cours on seance.cours_id =cours.id
		left join users on cours.user_id=users.id 
		left join courstype on seance.type_id=courstype.id
		GROUP by user_id
		)
		";


		$result = "";
		$id = "";
		try {

			$db = new DB();
			$conn = $db->Open();
			if (isset($_SESSION["user_data"])) {
				$id = $_SESSION["user_data"]["id"];
			}
			if ($conn) {

				$query = $sql . " where user_id=" . $id;
				$result  = $conn->query($query)->fetch();
			} else {
				// echo $conn;
				Messages::setMsg('Cannot connect to db', 'error');
			}
		} catch (PDOException $ex) {
			// echo $ex->getMessage();
			Messages::setMsg('Cannot connect to db', 'error');
		}

		return $result;
	}
}
