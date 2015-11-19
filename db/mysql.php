<?php
require_once 'abstract.php';
class Db_Mysql extends Db_Abstract
{
    public $connection;

    public function connect()
    {
        $config = $this->_config;
        $this->connection = new mysqli ($config['host'],$config['username'],
            $config['password'],$config['dbname']);
        $mysqli = $this->connection;
        if ($mysqli->connect_error)
            printf ($this->errno().": ". $this->error());

    }

    public function ping()
    {
        $mysqli = $this->connection;
        if (mysqli_ping($mysqli))
            return true;
        else
            return false;

    }

    public function close()
    {
        $mysqli = $this->connection;
        mysqli_close($mysqli);
        if ($mysqli == true)
            return true;
        else
            return false;
    }

    public function error()
    {
        $mysqli = $this->connection;
           return ($mysqli->connect_error);

    }

    public function errno()
    {
        $mysqli = $this->connection;
            return($mysqli->connect_errno);
    }

    public function query($query)
    {
        $mysqli = $this->connection;
        $result = mysqli_query($mysqli, $query );
        if (!$result)
            return false;
        else
        return $result;
    }

    public function fetch($result, $resultType = null)
    {
        if ($result != true) {
            $row = $result->fetch_array(MYSQLI_NUM, $resultType);
            printf("%s (%s)\n", $row[0], $row[1]);
            /* associative array */
            $row = $result->fetch_array(MYSQLI_ASSOC);
            printf("%s (%s)\n", $row["user_id"], $row["fullname"]);
            /* associative and numeric array */
            $row = $result->fetch_array(MYSQLI_BOTH);
            printf("%s (%s)\n", $row[0], $row["country"]);
            /* free result set */
            var_dump($row);
            $result->free();
            return $row;
        }
        else
            return true;
    }

    public function affectedRows()
    {
        $mysqli = $this->connection;
        $num = mysqli_affected_rows($mysqli);
        if ($num == -1){
            printf('Error');
        }
        else
            echo $num;
    }

    public function insertId()
    {
        $mysqli = $this->connection;
        $num = mysqli_insert_id ( $mysqli );
        echo $num;
    }

    public function escape($unescapedString)
    {
        $mysqli = $this->connection;
        $escape_string = mysqli_real_escape_string ( $mysqli ,
            $unescapedString );
        echo $escape_string;
    }

}