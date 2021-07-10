<?php
$servername = "localhost";
$username = "Practice";
$password = "@Mysqlphp";
$dbname = "mytodolist";
$title = "Todo List App";
$action = "Add task";

//Create Connection to data base
try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    // Set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "Connected successfully";
} catch(PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
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
            /* width: 100%; */
            display: flex;
            justify-content: center;
            align-items: center;
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
            /* color: white; */
        }
        .blue {
            /* background-color: blue; */
            /* border: 0.2px solid #ddd; */
        }
    </style>
</head>
<body>
    <div id="header">
        <h2><?php echo $title; ?></h2>
        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
            <input type="text" name="task">
            <input type="submit" name="submit" value="<?php echo $action; ?>">
        </form>
    </div>
    <div>
        <table id="table">
        <thead>
            <th>ID</th>
            <th>TASK</th>
            <th>DATE</th>
            <th>UPDATE</th>
            <th>DELETE</th>
        </thead>
        <tbody>
            <tr>
                <td></td>
                <td></td>
                <td></td>
                <td><button><a href="#">Update</a></button></td>
                <td><button><a href="#">Delete</a></button></td>
            </tr>
        </tbody>
        </table>
    </div>
</body>
</html>