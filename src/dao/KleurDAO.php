<?php

require_once( __DIR__ . '/DAO.php');

class KleurDAO extends DAO {

  public function selectAll(){
    $sql = "SELECT * FROM `kleuren`";
    $stmt = $this->pdo->prepare($sql);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
  }

}
