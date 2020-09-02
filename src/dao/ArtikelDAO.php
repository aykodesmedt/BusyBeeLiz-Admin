<?php

require_once( __DIR__ . '/DAO.php');

class ArtikelDAO extends DAO {

  public function search($categorie, $ondercategorie = '', $kleur = '', $leeftijd = ''){
    $sql = "SELECT * FROM artikels
    WHERE 1";

    if (!empty($categorie)) {
      $sql .= " AND categorie = :categorie";
    }
    if (!empty($ondercategorie)) {
      $sql .= " AND ondercategorie = :ondercategorie";
    }
    if (!empty($kleur)) {
      $sql .= " AND kleuren LIKE :kleur";
    }
    if (!empty($leeftijd)) {
      $sql .= " AND leeftijd LIKE :leeftijd";
    }

    // $sql .= " ORDER BY `titel` DESC LIMIT :max";

    $stmt = $this->pdo->prepare($sql);

    if (!empty($categorie)) {
      $stmt->bindValue(':categorie', $categorie);
    }
    if (!empty($ondercategorie)) {
      $stmt->bindValue(':ondercategorie', $ondercategorie);
    }
    if (!empty($kleur)) {
      $stmt->bindValue(':kleur', '%' . $kleur . '%');
    }
    if (!empty($leeftijd)) {
      $stmt->bindValue(':leeftijd', $leeftijd);
    }

    // $stmt->bindValue(':max', $max);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
  }

  public function selectByCategory($categorie){
    $sql= "SELECT * FROM producten WHERE `categorie` = :categorie";
    $stmt = $this->pdo->prepare($sql);
    $stmt->bindValue(':categorie', $categorie);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
  }

  public function searchStoffenByArtikel($id, $stofLengte, $stofBreedte){
    $sql = "SELECT stoffen .*
    FROM artikels
    INNER JOIN stoffen
    ON artikels.stofSoort = stoffen.stofSoort
    WHERE artikels.id = :id
    AND :stofLengte <= stoffen.lengte
    AND :stofBreedte <= stoffen.breedte";
    $stmt = $this->pdo->prepare($sql);
    $stmt->bindValue(':id', $id);
    $stmt->bindValue(':stofLengte', $stofLengte);
    $stmt->bindValue(':stofBreedte', $stofBreedte);


    // $stmt->bindValue(':max', $max);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
  }

  public function selectAllDames(){
    $sql = "SELECT * FROM `artikels` WHERE categorie = 'dames'";
    $stmt = $this->pdo->prepare($sql);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
  }

  public function selectAllHeren(){
    $sql = "SELECT * FROM `artikels` WHERE categorie = 'heren'";
    $stmt = $this->pdo->prepare($sql);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
  }

  public function selectAllKinderen(){
    $sql = "SELECT * FROM `artikels` WHERE categorie = 'kinderen'";
    $stmt = $this->pdo->prepare($sql);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
  }

  public function selectAllCadeaus(){
    $sql = "SELECT * FROM `artikels` WHERE categorie = 'cadeaus'";
    $stmt = $this->pdo->prepare($sql);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
  }

  // public function selectDamesByOndercategorie($onderCategorie){
  //   $sql = "SELECT * FROM `artikels` WHERE categorie = 'dames' AND onderCategorie = :onderCategorie";
  //   $stmt = $this->pdo->prepare($sql);
  //   $stmt->bindValue(':onderCategorie', $onderCategorie);
  //   $stmt->execute();
  //   return $stmt->fetchAll(PDO::FETCH_ASSOC);
  // }

  public function selectById($id){
    $sql = "SELECT * FROM `producten` WHERE id = :id";
    $stmt = $this->pdo->prepare($sql);
    $stmt->bindValue(':id', $id);
    $stmt->execute();
    return $stmt->fetch(PDO::FETCH_ASSOC);
  }

  public function delete($id){
    $sql = "DELETE FROM `producten` WHERE id = :id";
    $stmt = $this->pdo->prepare($sql);
    $stmt->bindValue(':id', $id);
    $stmt->execute();
    return $stmt->fetch(PDO::FETCH_ASSOC);
  }

  public function insert($data){
    $errors = $this->validate($data);
    if (empty($errors)) {
      $sql = "INSERT INTO `producten` (`categorie`, `titel`, `beschrijving`, `image1`, `image2`, `image3`, `image4`, `image5`, `image6`) VALUES (:categorie, :titel, :beschrijving, :imageEen, :imageTwee, :imageDrie, :imageVier, :imageVijf, :imageZes)";
      $stmt = $this->pdo->prepare($sql);
      $stmt->bindValue(':categorie', $data['categorie']);
      $stmt->bindValue(':titel', $data['titel']);
      $stmt->bindValue(':beschrijving', $data['beschrijving']);
      $stmt->bindValue(':imageEen', $data['imageEen']);
      $stmt->bindValue(':imageTwee', $data['imageTwee']);
      $stmt->bindValue(':imageDrie', $data['imageDrie']);
      $stmt->bindValue(':imageVier', $data['imageVier']);
      $stmt->bindValue(':imageVijf', $data['imageVijf']);
      $stmt->bindValue(':imageZes', $data['imageZes']);
      if ($stmt->execute()) {
        return $this->selectByCategory($data['categorie']);
      }
    }
    return false;
  }

  public function update($data){
      $sql = "UPDATE `artikels` SET `categorie` = :categorie, `titel` = :title, `beschrijving` = :beschrijving, `maat` = :maat, `onderCategorie` = :onderCategorie, `leeftijd` = :leeftijd, `kleuren` = :kleuren, `stofSoort` = :stofSoort, `stofLengte` = :stofLengte, `stofBreedte` = :stofBreedte, `prijs` = :prijs WHERE id = :id";
      $stmt = $this->pdo->prepare($sql);
      $stmt->bindValue(':categorie', $data['categorie']);
      $stmt->bindValue(':titel', $data['titel']);
      $stmt->bindValue(':beschrijving', $data['beschrijving']);
      $stmt->bindValue(':id', $data['id']);
      if ($stmt->execute()) {
        return $this->selectById($data['id']);
      }
  }

  public function validate($data) {
    $errors = array();
    if (empty($data['categorie'])) {
      $errors['categorie'] = 'Please enter a categorie';
    }
    if (empty($data['titel'])) {
      $errors['titel'] = 'Please enter an image';
    }
    if (empty($data['beschrijving'])) {
      $errors['beschrijving'] = 'Please enter a beschrijving';
    }
    return $errors;
  }

}
