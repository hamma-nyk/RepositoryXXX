<?php
function getCount($query)
{
    global $db;
    $count = mysqli_query($db, $query)->num_rows;
    return $count;
}
function select($query)
{
    global $db;
    $result = mysqli_query($db, $query);
    $rows = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $rows[] = $row;
    }
    return $rows;
    $db->close();
}
function delete($query)
{
    global $db;
    $result = mysqli_query($db, $query);
    return $result;
    $db->close();
}
function create($query)
{
    global $db;
    $result = mysqli_query($db, $query);
    return $result;
    $db->close();
}
