<?php

//fetch_data.php

$connect = new PDO("mysql:host=localhost;dbname=crud", "root", "");

$method = $_SERVER['REQUEST_METHOD'];

if($method == 'GET')
{
 $data = array(
  ':name'   => "%" . $_GET['name'] . "%",
  ':sg'   => "%" . $_GET['sg'] . "%",
  ':step'     => "%" . $_GET['step'] . "%",
  ':salary'    => "%" . $_GET['salary'] . "%",
  ':position'    => "%" . $_GET['position'] . "%"
 );
 $query = "SELECT * FROM data WHERE name LIKE :name AND sg LIKE :sg AND step LIKE :step AND salary LIKE :salary AND position LIKE :position ORDER BY id DESC";

 $statement = $connect->prepare($query);
 $statement->execute($data);
 $result = $statement->fetchAll();
 foreach($result as $row)
 {
  $output[] = array(
   'id'    => $row['id'],   
   'name'  => $row['name'],
   'sg'   => $row['sg'],
   'step'    => $row['step'],
   'salary'   => $row['salary'],
   'position'   => $row['position'],
  );
 }
 header("Content-Type: application/json");
 echo json_encode($output);
}

if($method == "POST")
{
 $data = array(
  ':name'  => $_POST['name'],
  ':sg'  => $_POST["sg"],
  ':step'    => $_POST["step"],
  ':salary'   => $_POST["salary"],
  ':position'   => $_POST["position"]
 );

 $query = "INSERT INTO data (name, sg, step, salary, position) VALUES (:name, :sg, :step, :salary, :position)";
 $statement = $connect->prepare($query);
 $statement->execute($data);
}

if($method == 'PUT')
{
 parse_str(file_get_contents("php://input"), $_PUT);
 $data = array(
  ':id'   => $_PUT['id'],
  ':name' => $_PUT['name'],
  ':sg' => $_PUT['sg'],
  ':step'   => $_PUT['step'],
  ':salary'  => $_PUT['salary'],
  ':position'  => $_PUT['position']
 );
 $query = "
 UPDATE data 
 SET name = :name, 
 sg = :sg, 
 step = :step, 
 salary = :salary,
 position = :position 
 WHERE id = :id
 ";
 $statement = $connect->prepare($query);
 $statement->execute($data);
}

if($method == "DELETE")
{
 parse_str(file_get_contents("php://input"), $_DELETE);
 $query = "DELETE FROM data WHERE id = '".$_DELETE["id"]."'";
 $statement = $connect->prepare($query);
 $statement->execute();
}

?>