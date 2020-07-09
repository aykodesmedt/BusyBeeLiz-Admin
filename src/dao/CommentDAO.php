<?php

require_once( __DIR__ . '/DAO.php');

class CommentDAO extends DAO {

  public function selectByArtikelId($id){
    $sql = "SELECT * FROM `comments` WHERE `artikel_id` = :id ORDER BY `id` DESC";
    $stmt = $this->pdo->prepare($sql);
    $stmt->bindValue(':id', $id);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
  }

  public function delete($id){
    $sql = "DELETE FROM `comments` WHERE `id` = :id";
    $stmt = $this->pdo->prepare($sql);
    $stmt->bindValue(':id', $id);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
  }

}
