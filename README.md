# MY PROJECT
1. Create Parking Slot form
2. Create database
3. database connection
4. check connection
5. binds the variables 
6. basic query of data
8. $stmt->execute() -Executes the query,  $stmt->close() - close statement and $conn->close() - close the connection
7. display the data

<!-- basic query 
// Fetch all records from the database
$result = $conn->query("SELECT * FROM gformdb");

//with specific table
$result = $conn->query("SELECT * FROM gformdb WHERE name;

//ascending
$result = $conn->query("SELECT * FROM gformdb ORDER BY name ASC LIMIT 10");

//Handling Form Submission (POST Request)
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    }

//reset unique id
SET @no : = 0;
UPDATE user SET id= @no := (@no+1);
ALTER TABLE user AUTO_INCEREMENT = 1;
-->