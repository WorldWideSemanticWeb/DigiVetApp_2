<!DOCTYPE HTML>
<html>
    <head>
        <title>PDO Create New Record</title>
  
    </head>
<body>
 
<!-- just a header -->
<h1>PDO: Create a Record</h1>

<?php
if($_POST){
 
    // include database connection
    include 'database.php';
 
    try{
     
        // insert query
        $query = "INSERT INTO products SET name=:name, description=:description, price=:price, created=:created";
 
        // prepare query for execution
        $stmt = $con->prepare($query);
 
        // bind the parameters
        $stmt->bindParam(':name', $_POST['name']);
        $stmt->bindParam(':description', $_POST['description']);
        $stmt->bindParam(':price', $_POST['price']);
         
        // specify when this record was inserted to the database
        $created=date('Y-m-d H:i:s');
        $stmt->bindParam(':created', $created);
         
        // Execute the query
        if($stmt->execute()){
            echo "<div>Record was saved.</div>";
        }else{
            die('Unable to save record.');
        }
         
    }
     
    // show error
    catch(PDOException $exception){
        die('ERROR: ' . $exception->getMessage());
    }
}
?>

<!-- html form here where the product information will be entered -->
<form action='create.php' method='post'>
    <table border='0'>
        <tr>
            <td>Name</td>
            <td><input type='text' name='name' /></td>
        </tr>
        <tr>
            <td>Description</td>
            <td><textarea name='description'></textarea></td>
        </tr>
        <tr>
            <td>Price</td>
            <td><input type='text' name='price' /></td>
        </tr>
        <tr>
            <td></td>
            <td>
                <input type='submit' value='Save' /> 
                <a href='read.php'>Back to read records</a>
            </td>
        </tr>
    </table>
</form>
 
</body>
</html>