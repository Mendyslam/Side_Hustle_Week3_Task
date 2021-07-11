<?php
require ('dbase.php');
//SELECT data from database
try {
    $sql = 'SELECT * FROM todo';
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $record = $stmt->fetchAll(PDO::FETCH_OBJ);
} catch(PDOException $e) {
    echo "Error: " . $e->getMessage();
}

try {
    if($_SERVER['REQUEST_METHOD'] == "POST") {
        if(!empty($_POST['task'])) {
            $newtask = htmlspecialchars($_POST['task']);
            $date = date("G:i:s", time());
            $sql = "INSERT INTO todo(task, task_date) VALUES('$newtask', '$date')";
            $stmt = $conn->prepare($sql);
            if($stmt->execute()) {
                header('location:index.php');
            }
        }
    }
} catch(PDOException $e) {
    echo $sql . "<br>" . $e->getMessage();
}

try {
    if(isset($_GET['del'])) {
        $del = $_GET['del'];
        $sql = "DELETE FROM todo WHERE id= $del";
        $stmt = $conn->prepare($sql);
        if($stmt->execute()) {
            header('location:index.php');
        }
    }
} catch(PDOException $e) {
    echo "Error: " . $e->getMessage();
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
            margin-bottom: 5px;
            font-size: 35px;
            color: purple;
        }
        form {
            text-align: center;
        }
        #input {
            margin-bottom: 15px;
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
        #table {
            border-collapse: collapse;
            width: 100%;
        }
        #table th {
            padding: 12px 0px;
            /* background-color: gray; */
            color: black;
        }
        #table td, #table th {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: center;
        }
        #table tr:nth-child(even) {
            background-color: #f2f2f2;
        }
        #table tr:hover {
            background-color: #ddd;
        }
        a {
            text-decoration: none;
            color: white;
        }
        .green:hover {
            cursor: pointer;
        }
    </style>
</head>
<body>
    <div id="header">
        <h1>Todo List App</h1><br />
        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
            <input type="text" name="task" id="input" placeholder="Enter todo"><br/>
            <input type="submit" name="submit" value="Add to List" class="green btn">
        </form>
    </div>
    <div>
        <table id="table">
        <thead>
            <th>ID</th>
            <th>TASK</th>
            <th>SET TIME</th>
            <th>UPDATE</th>
            <th>DELETE</th>
        </thead>
        <tbody>
            <?php foreach($record as $row) { ?>
            <tr>
                <td><?php echo $row->id;?></td>
                <td><?php echo htmlspecialchars($row->task);?></td>
                <td><?php echo $row->task_date;?></td>
                <td><button class="blue btn"><a href="update.php?update=<?php echo $row->id;?>">Update</a></button></td>
                <td><button class="red btn"><a href="index.php?del=<?php echo $row->id;?>">Delete</a></button></td>
            </tr>
            <?php } ?>
        </tbody>
        </table>
    </div>
</body>
</html>