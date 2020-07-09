<?php

require_once( __DIR__ . '/DAO.php');

class PatroonDAO extends DAO {

  public function search($boek = '', $maand = '', $jaar = ''){
    $sql = "SELECT * FROM `patronen`
    WHERE 1";

    // if (!empty($categorie)) {
    //   $sql .= " AND categorie = :categorie";
    // }
    if (!empty($boek)) {
      $sql .= " AND boek = :boek";
    }
    if (!empty($maand)) {
      $sql .= " AND maand = :maand";
    }
    if (!empty($jaar)) {
      $sql .= " AND jaar = :jaar";
    }

    // $sql .= " ORDER BY `titel` DESC LIMIT :max";

    $stmt = $this->pdo->prepare($sql);

    // if (!empty($categorie)) {
    //   $stmt->bindValue(':categorie',$categorie);
    // }
    if (!empty($boek)) {
      $stmt->bindValue(':boek', $boek);
    }
    if (!empty($maand)) {
      $stmt->bindValue(':maand',$maand);
    }
    if (!empty($jaar)) {
      $stmt->bindValue(':jaar', $jaar);
    }

    // $stmt->bindValue(':max', $max);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
  }

  public function selectAll(){
    $sql = "SELECT * FROM `patronen`";
    $stmt = $this->pdo->prepare($sql);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
  }

  public function selectById($id) {
    $sql = "SELECT * FROM `patronen` WHERE `id` = :id";
    $stmt = $this->pdo->prepare($sql);
    $stmt->bindValue("id", $id);
    $stmt->execute();
    return $stmt->fetch(PDO::FETCH_ASSOC);
  }

  public function delete($id){
    $sql = "DELETE FROM `patronen` WHERE id = :id";
    $stmt = $this->pdo->prepare($sql);
    $stmt->bindValue(':id', $id);
    $stmt->execute();
    return $stmt->fetch(PDO::FETCH_ASSOC);
  }

  public function insert($data){
    $errors = $this->validate($data);
    if (empty($errors)) {
      $sql = "INSERT INTO `patronen` (`image`, `model`, `boek`, `maand`, `jaar`, `categorie`, `maat`) VALUES (:image, :model, :boek, :maand, :jaar, :categorie, :maat)";
      $stmt = $this->pdo->prepare($sql);
      $stmt->bindValue(':image', $data['image']);
      $stmt->bindValue(':model', $data['model']);
      $stmt->bindValue(':boek', $data['boek']);
      $stmt->bindValue(':maand', $data['maand']);
      $stmt->bindValue(':jaar', $data['jaar']);
      $stmt->bindValue(':categorie', $data['categorie']);
      $stmt->bindValue(':maat', $data['maat']);
      if ($stmt->execute()) {
        return $this->selectAll();
      }
    }
    return false;
  }

  public function validate($data) {
    $errors = array();
    if (empty($data['image'])) {
      $errors['image'] = 'Please enter an image';
    }
    if (empty($data['model'])) {
      $errors['model'] = 'Please enter a model';
    }
    if (empty($data['boek'])) {
      $errors['boek'] = 'Please enter a boek';
    }
    if (empty($data['maand'])) {
      $errors['maand'] = 'Please enter a maand';
    }
    if (empty($data['jaar'])) {
      $errors['jaar'] = 'Please enter a jaar';
    }
    if (empty($data['categorie'])) {
      $errors['categorie'] = 'Please enter a categorie';
    }
    if (empty($data['maat'])) {
      $errors['maat'] = 'Please enter a maat';
    }
    return $errors;
  }

}
