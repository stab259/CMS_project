<?php

function confirmQuery($result)
{
    global $connection;

    if (!$result) {
        die("QUERY FAILED ." . mysqli_error($connection));
    }
}

function redirect($location)
{
    return header("Location: " . $location);
}
