<?php

require_once __DIR__ . '/Controller.php';
// require_once './dao/ArtikelDAO.php';
// require_once './dao/StofDAO.php';
require_once './dao/KleurDAO.php';
require_once './dao/FournituurDAO.php';

class FourniturenController extends Controller {

  function __construct() {
  //   $this->artikelDAO = new ArtikelDAO();
  //   $this->stofDAO = new StofDAO();
    $this->kleurDAO = new KleurDAO();
    $this->fournituurDAO = new FournituurDAO();
  }

  public function fournituren() {
    $this->set('title', 'Fournituren');
    $this->set('currentPage', 'fournituren');

    $kleuren = $this->kleurDAO->selectAll();
    $this->set('kleuren', $kleuren);

    $fournituren = $this->fournituurDAO->selectAll();
    $this->set('fournituren', $fournituren);

    if(!empty($_GET["kleur"])){
      if(!empty($_GET["soort"])){
        $fournituren = $this->fournituurDAO->search($_GET["kleur"], $_GET["soort"]);
        $this->set('fournituren', $fournituren);
      }else{
        $fournituren = $this->fournituurDAO->search($_GET["kleur"], '');
        $this->set('fournituren', $fournituren);
      }
    }else if(!empty($_GET["soort"])){
      if(!empty($_GET["kleur"])){
        $fournituren = $this->fournituurDAO->search($_GET["kleur"], $_GET["soort"]);
        $this->set('fournituren', $fournituren);
      }else{
        $fournituren = $this->fournituurDAO->search('', $_GET["soort"]);
        $this->set('fournituren', $fournituren);
      }
    }else{
      $fournituren = $this->fournituurDAO->search();
      $this->set('fournituren', $fournituren);
    }

    if (!empty($_GET['action'])) {
      if ($_GET['action'] == 'delete' && !empty($_GET['id'])) {
        $this->_handleDeleteFournituur();
      }
    }

    if(!empty($_FILES['image'])) {
      $this->_handlePostFournituur();
      $this->set('fournituren', $this->fournituurDAO->selectAll());
    }

  }

  public function editFournituur() {
    $this->set('currentPage', 'fournituren');
    $fournituur = $this->fournituurDAO->selectById($_GET['id']);
    $this->set('fournituur', $fournituur);

    if($_GET['action'] == 'updateFournituur' && !empty($_GET['id'])){
      $data = array_merge($_POST, array('id' => $_GET['id']));
      $this->fournituurDAO->update($data, $data['id']);
    }
  }

  private function _handleDeleteFournituur() {
    $this->fournituurDAO->delete($_GET['id']);
    $_SESSION['info'] = 'Artikel werd verwijderd!';
    header('Location: index.php?page=fournituren');
    exit();
  }

  private function _handlePostFournituur(){
    $data = array_merge($_POST, array(
      'image' => 'will-be-set-later'
    ));
    // valideer de non-file data (gallery_id, title)
    $errors = $this->fournituurDAO->validate($data);
    if (empty($_FILES['image']) || !empty($_FILES['image']['error'])) {
      $errors['image'] = 'Gelieve een bestand te selecteren';
    }
    if (empty($errors)) {
      // controleer of het een afbeelding is
      $fileinfo = finfo_open(FILEINFO_MIME_TYPE);
      $whitelist_type = array('image/jpeg', 'image/png','image/gif');
      if (!in_array(finfo_file($fileinfo, $_FILES['image']['tmp_name']), $whitelist_type)) {
        $errors['image'] = 'Gelieve een jpeg, png of gif te selecteren';
      }
    }
    if (empty($errors)) {
      // controleer de afmetingen van het bestand
      $size = getimagesize($_FILES['image']['tmp_name']);
      if ($size[0] < 115 || $size[1] < 115) {
        $errors['image'] = 'De afbeelding moet minimum 115x115 pixels groot zijn';
      }
    }
    if (empty($errors)) {
      $projectFolder = realpath(__DIR__ . '/..');
      $targetFolder = $projectFolder . '/assets/img';
      $targetFolder = @tempnam($targetFolder, '');
      unlink($targetFolder);
      mkdir($targetFolder, 0777, true);
      $targetFileName = $targetFolder . '/' . $_FILES['image']['name'];
      $this->_resizeAndCrop(
        $_FILES['image']['tmp_name'],
        $targetFileName,
        115, 115
      );
      $relativeFileName = substr($targetFileName, 1 + strlen($projectFolder));
      $data['image'] = $relativeFileName;
      $insertedImage = $this->fournituurDAO->insert($data);
      if (!empty($insertedImage)) {
        $_SESSION['info'] = 'Het bestand werd ge-upload!';
        header('Location: index.php?page=fournituren');
        exit();
      }
    }
    if (!empty($errors)) {
      $_SESSION['error'] = 'De afbeelding kon niet toegevoegd worden!';
    }
    $this->set('errors', $errors);
  }

  private function _resizeAndCrop($src, $dst, $thumb_width, $thumb_height) {
      $type = exif_imagetype($src);
      $allowedTypes = array(
        1,  // [] gif
        2,  // [] jpg
        3,  // [] png
        6   // [] bmp
      );
      if (!in_array($type, $allowedTypes)) {
        return false;
      }
      switch ($type) {
        case 1 :
          $image = imagecreatefromgif($src);
          break;
        case 2 :
          $image = imagecreatefromjpeg($src);
          break;
        case 3 :
          $image = imagecreatefrompng($src);
          break;
        case 6 :
          $image = imagecreatefrombmp($src);
          break;
      }

      $filename = $dst;

      $width = imagesx($image);
      $height = imagesy($image);

      $original_aspect = $width / $height;
      $thumb_aspect = $thumb_width / $thumb_height;

      if ( $original_aspect >= $thumb_aspect ) {
         // If image is wider than thumbnail (in aspect ratio sense)
         $new_height = $thumb_height;
         $new_width = $width / ($height / $thumb_height);
      } else {
         // If the thumbnail is wider than the image
         $new_width = $thumb_width;
         $new_height = $height / ($width / $thumb_width);
      }

      $thumb = imagecreatetruecolor( $thumb_width, $thumb_height );

      // Resize and crop
      imagecopyresampled($thumb,
                         $image,
                         0 - ($new_width - $thumb_width) / 2, // Center the image horizontally
                         0 - ($new_height - $thumb_height) / 2, // Center the image vertically
                         0, 0,
                         $new_width, $new_height,
                         $width, $height);
      imagejpeg($thumb, $filename, 80);
      return true;
    }

}
