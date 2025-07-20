<?php
function get_connection_string()
{
    $db_name = get_db_name();
    $db_user = get_db_user();
    $db_password = get_db_password();
    $pdo_conn = new PDO("mysql:host=localhost;dbname=$db_name;charset=utf8", "$db_user", "$db_password", array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'"));
    return $pdo_conn;
}

function ex_query($sql, $params = []) {
  $pdo_conn = get_connection_string();
  $pdo_statement = $pdo_conn->prepare($sql);
  $pdo_statement->execute($params);
  return $pdo_conn->lastInsertId();
}