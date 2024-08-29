<?php

$servername = $_SERVER['SERVER_NAME'];
$username = 'root';
$password = '';
$dbname = 'website_template';

try {
    $db = new PDO("mysql:host=$servername;dbname=$dbname; charset=utf8mb4", '' . $username . '', '' . $password . '');
} catch (PDOException $e) {
    echo $e->getMessage();
}

/// RETRIEVES ALL TABLE
function select_all_data($table)
{
    global $db;
    $sql = "select * from $table";
    return $db->query($sql)->fetchAll(PDO::FETCH_ASSOC);
}

/// SELECT ONE COLUMN 
function select_column($table, $column) {
    global $db;
    $sql = "select $column from $table";
    return $db->query($sql)->fetchAll(PDO::FETCH_ASSOC);
}
/// RETRIEVES LIMITED TABLE DATA
function select_limited_data($table, $limit)
{
    global $db;
    $sql = "select * from $table limit $limit";
    return $db->query($sql)->fetchAll(PDO::FETCH_ASSOC);
}
/// RETRIEVES ONLY ID BASED DATA
function select_id_based_data($table, $id, $id_array)
{
    global $db;
    $id_array = explode(', ', $id_array);

    $sql = count($id_array) > 1 ? "select * from $table where $id in (" . implode(', ', $id_array) . ')' : "select * from $table where $id = $id_array[0]";
    return $db->query($sql)->fetchAll(PDO::FETCH_ASSOC);
}

/// RETRIEVES ID BASED 
function select_id_based_column($table, $column, $id, $id_array) {
    global $db;
    $id_array = explode(', ', $id_array);

    $sql = count($id_array) > 1 ? "select $column from $table where $id in (" . implode(', ', $id_array) . ')' : "select * from $table where $id = $id_array[0]";
    return $db->query($sql)->fetchAll(PDO::FETCH_ASSOC);
}

// RETURNS COUNT OF ROWS 
function get_count_table($table, $id = null, $id_array = null)
{
    global $db;
    $id_array = explode(', ', $id_array);
    if ($id == null) {
        return $db->query("select count(*) from $table")->fetchColumn();
    } else if ($id != null) {
        $sql = count($id_array) > 1 ? "select count(*) from $table where $id in (" . implode(', ', $id_array) . ')' : "select * from $table where $id = $id_array[0]";
        return $db->query($sql)->fetchColumn();
    } 
}

function insert_data($table, $data) {
    global $db;
    $keys = array_keys($data);
    $values = array_values($data);

    $sql = "INSERT INTO $table (" . implode (", ", $keys) . ") VALUES ('" . implode ("', '", $values) . "')";
    try {
        return $db->query($sql); 
    } catch (PDOException $e) {
        return false;
    }
}

$some = "data";

function change_data() {
    global $some;
    $some = 'new data';
}

?>
