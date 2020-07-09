<?php

require_once( __DIR__ . '/DAO.php');

class FournituurDAO extends DAO {

  public function search($kleur = '', $soort = ''){
    $sql = "SELECT * FROM fournituren
    WHERE 1";

    if (!empty($kleur)) {
      $sql .= " AND kleur = :kleur";
    }
    if (!empty($soort)) {
      $sql .= " AND soort = :soort";
    }

    // $sql .= " ORDER BY `titel` DESC LIMIT :max";

    $stmt = $this->pdo->prepare($sql);

    if (!empty($kleur)) {
      $stmt->bindValue(':kleur', $kleur);
    }
    if (!empty($soort)) {
      $stmt->bindValue(':soort', $soort);
    }

    // $stmt->bindValue(':max', $max);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
  }

  public function selectAll(){
    $sql = "SELECT * FROM `fournituren`";
    $stmt = $this->pdo->prepare($sql);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
  }

  public function selectById($id){
    $sql= "SELECT * FROM `fournituren` WHERE id = :id";
    $stmt = $this->pdo->prepare($sql);
    $stmt->bindValue(':id', $id);
    $stmt->execute();
    return $stmt->fetch(PDO::FETCH_ASSOC);
  }

  public function update($data, $id){
    $sql = "UPDATE `fournituren` SET `soort` = :soort, `kleur` = :kleur, `stuks` = :stuks, `lengte` = :lengte WHERE `id` = :id";
    $stmt = $this->pdo->prepare($sql);
    $stmt->bindValue(':soort', $data['soort']);
    $stmt->bindValue(':kleur', $data['kleur']);
    $stmt->bindValue(':stuks', $data['stuks']);
    $stmt->bindValue(':lengte', $data['lengte']);
    $stmt->bindValue(':id', $id);
    return $stmt->fetch(PDO::FETCH_ASSOC);
  }

  public function delete($id){
    $sql = "DELETE FROM `fournituren` WHERE id = :id";
    $stmt = $this->pdo->prepare($sql);
    $stmt->bindValue(':id', $id);
    $stmt->execute();
    return $stmt->fetch(PDO::FETCH_ASSOC);
  }

  public function insert($data){
    $errors = $this->validate($data);
    if (empty($errors)) {
      $sql = "INSERT INTO `fournituren` (`image`, `soort`, `kleur`, `stuks`, `lengte`) VALUES (:image, :soort, :kleur, :stuks, :lengte)";
      $stmt = $this->pdo->prepare($sql);
      $stmt->bindValue(':image', $data['image']);
      $stmt->bindValue(':soort', $data['soort']);
      $stmt->bindValue(':kleur', $data['kleur']);
      $stmt->bindValue(':stuks', $data['stuks']);
      $stmt->bindValue(':lengte', $data['lengte']);
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
    if (empty($data['soort'])) {
      $errors['soort'] = 'Please enter a soort';
    }
    if (empty($data['kleur'])) {
      $errors['kleur'] = 'Please enter a kleur';
    }
    if (empty($data['stuks'])) {
      $errors['stuks'] = 'Please enter a stuks';
    }
    if (empty($data['lengte'])) {
      $errors['lengte'] = 'Please enter a lengte';
    }
    return $errors;
  }

}
