<?php
require '../helpers.php';

/*
 * Adatbázis
 */

// Adatok
$hostname = 'localhost';
$port = 3306; // Alapértelmezett port, nem kötelező megadni
$username = 'root';
$password = '';
$dbname = 'info2';

// Person osztály
class Person
{
    public string $first_name;
    public string $last_name;

    public function __toString(): string
    {
        return $this->first_name . ' ' . $this->last_name;
    }
}


#region Procedurális
// Adatbázis kapcsolódás
$db = mysqli_connect($hostname, $username, $password, $dbname, $port);
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
if (!$db) {
    println('Sikertelen kapcsolódás: ' . mysqli_connect_error());
    exit;
}

// Query összeállítás
$select = "SELECT * FROM people WHERE city = '%s'";
$city = mysqli_real_escape_string($db, 'Budapest'); // SQL injection elleni védelem
$query = sprintf($select, $city);
println($query);

// Query futtatása
$result = mysqli_query($db, $query);

// Eredmények száma
println('Sorok száma: ' . mysqli_num_rows($result));
println('Oszlopok száma: ' . mysqli_num_fields($result));

// Eredmények felszabadítása
mysqli_free_result($result);

// Prepared statement
$select = "SELECT * FROM people WHERE city = ?";
$statement = mysqli_prepare($db, $select);
mysqli_stmt_bind_param($statement, 's', $city);

// Query futtatása
$city = 'Budapest'; // Nincs SQL injection veszély
mysqli_stmt_execute($statement);
$result = mysqli_stmt_get_result($statement);

// Összes eredmény kiolvasása
$all = mysqli_fetch_all($result, MYSQLI_NUM);
foreach ($all as $row) {
    println($row[1] . ' ' . $row[2]);
}

// Eredmények listázása soronként

// Indexelt tömb
mysqli_data_seek($result, 0);
while ($row = mysqli_fetch_row($result)) {
    println($row[1] . ' ' . $row[2]);
}

// Asszociatív tömb
mysqli_data_seek($result, 0);
while ($row = mysqli_fetch_assoc($result)) {
    println($row['first_name'] . ' ' . $row['last_name']);
}

// Vegyes tömb
mysqli_data_seek($result, 0);
while ($row = mysqli_fetch_array($result, MYSQLI_BOTH)) {
    println($row[1] . ' ' . $row['last_name']);
}

// stdClass objektum
mysqli_data_seek($result, 0);
while ($row = mysqli_fetch_object($result)) {
    println($row->first_name . ' ' . $row->last_name);
}

// Saját osztály objektum
mysqli_data_seek($result, 0);
while ($row = mysqli_fetch_object($result, Person::class)) {
    println((string)$row);
}

// Eredmények felszabadítása
mysqli_free_result($result);

// Tranzakció
try {
    // Tranzakció létrehozása
    mysqli_begin_transaction($db);

    // Helyes query
    mysqli_query($db, "INSERT INTO people (first_name, last_name, city) VALUES ('John', 'Doe', 'New York')");
    // Hibás query
    mysqli_query($db, "INSERT INTO people2 (first_name, last_name, city) VALUES ('John', 'Doe', 'London')");

    // Tranzakció végrehajtása
    mysqli_commit($db);
    println('Sikeres tranzakció');
} catch (Exception $e) {
    // Tranzakció visszavonása
    mysqli_rollback($db);
    println('Sikertelen tranzakció: ' . $e->getMessage());
}

// Adatbázis kapcsolat bezárása
mysqli_close($db);
#endregion

#region PDO
// Adatbázis kapcsolódás
try {
    $db = new PDO("mysql:host=$hostname;port=$port;dbname=$dbname", $username, $password);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    println('Sikertelen kapcsolódás: ' . $e->getMessage());
    exit;
}

// Query összeállítás
$select = "SELECT * FROM people WHERE city = %s";
$city = $db->quote('Budapest'); // SQL injection elleni védelem
$query = sprintf($select, $city);
println($query);

// Query futtatása
$result = $db->query($query);

// Eredmények száma
println('Sorok száma: ' . $result->rowCount());
println('Oszlopok száma: ' . $result->columnCount());

// Eredmények felszabadítása
$result->closeCursor();

// Prepared statement
$select = "SELECT * FROM people WHERE city = :city";
$statement = $db->prepare($select);
$statement->bindParam(':city', $city, PDO::PARAM_STR);

// Query futtatása
$city = 'Budapest'; // Nincs SQL injection veszély
$statement->execute();
$result = $statement;

// Összes eredmény kiolvasása
$all = $result->fetchAll(PDO::FETCH_NUM);
foreach ($all as $row) {
    println($row[1] . ' ' . $row[2]);
}

// Eredmények listázása soronként

// Indexelt tömb
$result->execute();
while ($row = $result->fetch(PDO::FETCH_NUM)) {
    println($row[1] . ' ' . $row[2]);
}

// Asszociatív tömb
$result->execute();
while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
    println($row['first_name'] . ' ' . $row['last_name']);
}

// Vegyes tömb
$result->execute();
while ($row = $result->fetch(PDO::FETCH_BOTH)) {
    println($row[1] . ' ' . $row['last_name']);
}

// stdClass objektum
$result->execute();
while ($row = $result->fetchObject()) {
    println($row->first_name . ' ' . $row->last_name);
}

// Saját osztály objektum
$result->execute();
while ($row = $result->fetchObject(Person::class)) {
    println((string)$row);
}

// Eredmények felszabadítása
$result->closeCursor();

// Tranzakció
try {
    // Tranzakció létrehozása
    $db->beginTransaction();

    // Helyes query
    $db->query( "INSERT INTO people (first_name, last_name, city) VALUES ('John', 'Doe', 'New York')");
    // Hibás query
    $db->query( "INSERT INTO people2 (first_name, last_name, city) VALUES ('John', 'Doe', 'London')");

    // Tranzakció végrehajtása
    $db->commit();
    println('Sikeres tranzakció');
} catch (Exception $e) {
    // Tranzakció visszavonása
    $db->rollBack();
    println('Sikertelen tranzakció: ' . $e->getMessage());
}

// Adatbázis kapcsolat bezárása
unset($db);
#endregion



