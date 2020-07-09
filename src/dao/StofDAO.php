<?php

require_once( __DIR__ . '/DAO.php');

class StofDAO extends DAO {

  public function search($categorie = '', $stofSoort = ''){
    $sql = "SELECT * FROM stoffen
    WHERE 1";

    if (!empty($categorie)) {
      $sql .= " AND categorie = :categorie";
    }
    if (!empty($stofSoort)) {
      $sql .= " AND stofSoort = :stofSoort";
    }

    // $sql .= " ORDER BY `titel` DESC LIMIT :max";

    $stmt = $this->pdo->prepare($sql);

    if (!empty($categorie)) {
      $stmt->bindValue(':categorie', $categorie);
    }
    if (!empty($stofSoort)) {
      $stmt->bindValue(':stofSoort', $stofSoort);
    }

    // $stmt->bindValue(':max', $max);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
  }

  public function selectAll(){
    $sql = "SELECT * FROM `stoffen` ORDER BY kleurNummer";
    $stmt = $this->pdo->prepare($sql);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
  }

  public function selectById($id){
    $sql = "SELECT * FROM `stoffen` WHERE id = :id";
    $stmt = $this->pdo->prepare($sql);
    $stmt->bindValue(':id', $id);
    $stmt->execute();
    return $stmt->fetch(PDO::FETCH_ASSOC);
  }

  public function delete($id){
    $sql = "DELETE FROM `stoffen` WHERE id = :id";
    $stmt = $this->pdo->prepare($sql);
    $stmt->bindValue(':id', $id);
    $stmt->execute();
    return $stmt->fetch(PDO::FETCH_ASSOC);
  }

  public function update($data){
    $errors = $this->validate($data);
    if (empty($errors)) {
      // $sql = "INSERT INTO `stoffen` (`categorie`, `image`, `kleurNummer`, `lengte`, `breedte`) VALUES (:categorie, :image, :kleurNummer, :lengte, :breedte)";
      $sql = "UPDATE `stoffen` SET `categorie` = :categorie, `image` = :image, `kleurNummer` = :kleurNummer, `stofSoort` = :stofSoort, `lengte` = :lengte, `breedte` = :breedte) WHERE `id` = :id";
      $stmt = $this->pdo->prepare($sql);
      $stmt->bindValue(':categorie', $data['categorie']);
      $stmt->bindValue(':image', $data['image']);
      $stmt->bindValue(':kleurNummer', $data['kleurNummer']);
      $stmt->bindValue(':stofSoort', $data['stofSoort']);
      $stmt->bindValue(':lengte', $data['lengte']);
      $stmt->bindValue(':breedte', $data['breedte']);
      $stmt->bindValue(':id', $data['id']);
      if ($stmt->execute()) {
        return $this->selectAll();
      }
    }
    return false;
  }

  public function insert($data){
    $errors = $this->validate($data);
    if (empty($errors)) {
      // $sql = "INSERT INTO `stoffen` (`categorie`, `image`, `kleurNummer`, `lengte`, `breedte`) VALUES (:categorie, :image, :kleurNummer, :lengte, :breedte)";
      $sql = "INSERT INTO `stoffen` (`categorie`, `image`, `kleurNummer`, `stofSoort`, `lengte`, `breedte`) VALUES (:categorie, :image, :kleurNummer, :stofSoort, :lengte, :breedte)";
      $stmt = $this->pdo->prepare($sql);
      $stmt->bindValue(':categorie', $data['categorie']);
      $stmt->bindValue(':image', $data['image']);
      $stmt->bindValue(':kleurNummer', $data['kleurNummer']);
      $stmt->bindValue(':stofSoort', $data['stofSoort']);
      $stmt->bindValue(':lengte', $data['lengte']);
      $stmt->bindValue(':breedte', $data['breedte']);
      if ($stmt->execute()) {
        return $this->selectAll();
      }
    }
    return false;
  }

  public function validate($data) {
    $errors = array();
    if (empty($data['categorie'])) {
      $errors['categorie'] = 'Please enter a categorie';
    }
    if (empty($data['image'])) {
      $errors['image'] = 'Please enter an image';
    }
    if (empty($data['kleurNummer'])) {
      $errors['kleurNummer'] = 'Please enter a kleurNummer';
    }
    if (empty($data['stofSoort'])) {
      $errors['stofSoort'] = 'Please enter a stofSoort';
    }
    if (empty($data['lengte'])) {
      $errors['lengte'] = 'Please enter a lengte';
    }
    if (empty($data['breedte'])) {
      $errors['breedte'] = 'Please enter a breedte';
    }
    return $errors;
  }

}
