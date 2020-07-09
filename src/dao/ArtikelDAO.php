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
    $sql = "SELECT * FROM `artikels` WHERE id = :id";
    $stmt = $this->pdo->prepare($sql);
    $stmt->bindValue(':id', $id);
    $stmt->execute();
    return $stmt->fetch(PDO::FETCH_ASSOC);
  }

  public function delete($id){
    $sql = "DELETE FROM `artikels` WHERE id = :id";
    $stmt = $this->pdo->prepare($sql);
    $stmt->bindValue(':id', $id);
    $stmt->execute();
    return $stmt->fetch(PDO::FETCH_ASSOC);
  }

  public function insert($data){
    $errors = $this->validate($data);
    if (empty($errors)) {
      $sql = "INSERT INTO `artikels` (`categorie`,`titel`, `beschrijving`, `maat`, `onderCategorie`, `leeftijd`, `kleuren`, `stofSoort`, `stofLengte`, `stofBreedte`, `prijs`, `image1`, `image2`, `image3`, `image4`, `image5`, `image6`) VALUES (:categorie, :titel, :beschrijving, :maat, :onderCategorie, :leeftijd, :kleuren, :stofSoort, :stofLengte, :stofBreedte, :prijs, :imageEen, :imageTwee, :imageDrie, :imageVier, :imageVijf, :imageZes)";
      $stmt = $this->pdo->prepare($sql);
      $stmt->bindValue(':categorie', $data['categorie']);
      $stmt->bindValue(':titel', $data['titel']);
      $stmt->bindValue(':beschrijving', $data['beschrijving']);
      $stmt->bindValue(':maat', $data['maat']);
      $stmt->bindValue(':onderCategorie', $data['onderCategorie']);
      $stmt->bindValue(':leeftijd', $data['leeftijd']);
      $stmt->bindValue(':kleuren', $data['kleur']);
      $stmt->bindValue(':stofSoort', $data['stofSoort']);
      $stmt->bindValue(':stofLengte', $data['stofLengte']);
      $stmt->bindValue(':stofBreedte', $data['stofBreedte']);
      $stmt->bindValue(':prijs', $data['prijs']);
      $stmt->bindValue(':imageEen', $data['imageEen']);
      $stmt->bindValue(':imageTwee', $data['imageTwee']);
      $stmt->bindValue(':imageDrie', $data['imageDrie']);
      $stmt->bindValue(':imageVier', $data['imageVier']);
      $stmt->bindValue(':imageVijf', $data['imageVijf']);
      $stmt->bindValue(':imageZes', $data['imageZes']);
      if ($stmt->execute()) {
        return $this->search($data['categorie']);
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
      $stmt->bindValue(':maat', $data['maat']);
      $stmt->bindValue(':onderCategorie', $data['onderCategorie']);
      $stmt->bindValue(':leeftijd', $data['leeftijd']);
      $stmt->bindValue(':kleuren', $data['kleur']);
      $stmt->bindValue(':stofSoort', $data['stofSoort']);
      $stmt->bindValue(':stofLengte', $data['stofLengte']);
      $stmt->bindValue(':stofBreedte', $data['stofBreedte']);
      $stmt->bindValue(':prijs', $data['prijs']);
      // $stmt->bindValue(':imageEen', $data['imageEen']);
      // $stmt->bindValue(':imageTwee', $data['imageTwee']);
      // $stmt->bindValue(':imageDrie', $data['imageDrie']);
      // $stmt->bindValue(':imageVier', $data['imageVier']);
      // $stmt->bindValue(':imageVijf', $data['imageVijf']);
      // $stmt->bindValue(':imageZes', $data['imageZes']);
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
    if (empty($data['maat'])) {
      $errors['maat'] = 'Please enter a maat';
    }
    if (empty($data['onderCategorie'])) {
      $errors['onderCategorie'] = 'Please enter a onderCategorie';
    }
    if (empty($data['leeftijd'])) {
      $errors['leeftijd'] = 'Please enter a leeftijd';
    }
    if (empty($data['kleur'])) {
      $errors['kleur'] = 'Please enter a kleuren';
    }
    if (empty($data['stofSoort'])) {
      $errors['stofSoort'] = 'Please enter a stofSoort';
    }
    if (empty($data['stofLengte'])) {
      $errors['stofLengte'] = 'Please enter a stofLengte';
    }
    if (empty($data['stofBreedte'])) {
      $errors['stofBreedte'] = 'Please enter a stofBreedte';
    }
    if (empty($data['prijs'])) {
      $errors['prijs'] = 'Please enter a prijs';
    }
    // if (empty($data['imageEen'])) {
    //   $errors['imageEen'] = 'Please enter a image';
    // }
    // if (empty($data['imageTwee'])) {
    //   $errors['imageTwee'] = 'Please enter a image';
    // }
    // if (empty($data['imageDrie'])) {
    //   $errors['imageDrie'] = 'Please enter a image';
    // }
    // if (empty($data['imageVier'])) {
    //   $errors['imageVier'] = 'Please enter a image';
    // }
    // if (empty($data['imageVijf'])) {
    //   $errors['imageVijf'] = 'Please enter a image';
    // }
    // if (empty($data['imageZes'])) {
    //   $errors['imageZes'] = 'Please enter a image';
    // }
    return $errors;
  }

}
