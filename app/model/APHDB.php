<?php

class APHDB extends PDO {
  public $db;
  public $dbhost;
  public $dbname;
  public $dbuser;
  public $dbpw;

  function __construct($db, $dbhost, $dbname, $dbuser, $dbpw) {
    $this->db = $db;
    $this->dbhost = $dbhost;
    $this->dbname = $dbname;
    $this->dbuser = $dbuser;
    $this->dbpw = $dbpw;

    if (!new PDO('mysql:host='.$this->dbhost.';dbname='.$this->dbname, $this->dbuser, $this->dbpw)) {
      try {
        $this->db = new PDO('mysql:host='.$this->dbhost.';', $this->dbuser, $this->dbpw);
        databaseCreate();

      } catch (Exception $e) {
        echo '<h3>DATABASE SERVER CONNECTION FAILED:</h3><p><b>'.$e->getCode().': </b>'.$e->getMessage().'</p>';
      }
    }

    try {
      $this->db = new PDO('mysql:host='.$this->dbhost.';dbname='.$this->dbname, $this->dbuser, $this->dbpw);

    } catch (Exception $e) {
      echo '<h3>DATABASE CONNECTION FAILED:</h3><p><b>'.$e->getCode().': </b>'.$e->getMessage().'</p>';
    }

  } // end construct

  public function databaseCreate() {
    try {
      $this->db = new PDO('mysql:host='.$this->dbhost.';', $this->dbuser, $this->dbpw);
      $stmt = $this->prepare("
        CREATE DATABASE IF NOT EXISTS `?`
        SET storage_engine=InnoDB
        DEFAULT COLLATE utf8_general_ci
        DEFAULT CHARSET=utf8;
      ");
      $stmt = bindParam($this->dbname);
      $stmt->execute();

    } catch (Exception $e) {
      echo '<h3>DATABASE CREATION FAILED:</h3><p><b>'.$e->getCode().': </b>'.$e->getMessage().'</p>';
    }
  } // end databaseCreate

  public function tblCreate($tblname, $createCols = array($colsname => $colsettings)) {
    //extract($createCols);

    try {
      foreach ($createCols as $key => $value) {
        $sql = '';
        // $stmt = $this->prepare("
        // CREATE TABLE IF NOT EXISTS `?` (
        //   ) ENGINE=InnoDB DEFAULT CHARSET=utf8;
        // ");.
      }
    } catch (Exception $e) {

    }

  } // end tblCreate

  public function tblInsert($tblname, $cols = [], $values = []) {
    try {
      for ($i=0; $i < count($cols); $i++) {
        $stmt = $this->prepare("INSERT INTO $tblname ($cols[$i], $values[$i]) VALUES (?, ?)");
        $stmt = bindParam($cols[$i], $values[$i]);
        $stmt->execute();
      }
    } catch (Exception $e) {
      echo '<h3>TABLE INSERT FAILED:</h3><p><b>'.$e->getCode().': </b>'.$e->getMessage().'</p>';
    }

  } // end tblInsert
}
