<?php
require ('dbase.php');

try {
    if (isset($_GET['update'])) {
        $id = $_GET['update'];
        $sql = "SELECT * FROM todo WHERE id = $id";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $row = $stmt->fetchAll(PDO::FETCH_OBJ);
    }
} catch(PDOException $e) {
    echo $sql . "<br>" . $e->getMessage();
}

try {
    if(isset($_POST['new'])) {
        $new = $_POST['task'];
        $sql = "UPDATE todo SET task='$new' WHERE id = $id";
        $stmt = $conn->prepare($sql);
        if($stmt->execute()) {
            header('location:index.php');
        }
    }
} catch(PDOException $e) {
    echo $sql . "<br>" . $e->getMessage();
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Todo App</title>
    <style>
        #header {
            margin-bottom: 50px;
            width: 100%;
        }
        h1 {
            text-align: center;
            margin-bottom: 7px;
            font-size: 35px;
            color: purple;
        }
        form {
            text-align: center;
        }
        #input {
            margin-bottom: 20px;
            width: 25%;
            height: 20px;
        }
        .btn {
            color: white;
            padding: 10px;
            border-radius: 5px;
            border: none;
            font-size: 15px;
        }
        .blue {
            background-color: blue; 
        }
        .red {
            background-color: red;
        }
        .green {
            background-color: green;
        }
        .green:hover {
            cursor: pointer;
        }
    </style>
</head>
<body>
    <div id="header">
        <h1>Update Todo List App</h1><br />
        <form action="" method="POST">
        <input id="input" type="text" name="task" value="<?php foreach($row as $r) { echo $r->task; } ?>" placeholder="Update task"><br />
        <input type="submit" name="new" value="Update task" class="green btn">
        </form>
    </div>