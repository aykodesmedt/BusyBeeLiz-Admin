<?php

require_once __DIR__ . '/Controller.php';
require_once './dao/ArtikelDAO.php';
require_once './dao/StofDAO.php';
require_once './dao/KleurDAO.php';

class StoffenController extends Controller {

  function __construct() {
    $this->artikelDAO = new ArtikelDAO();
    $this->stofDAO = new StofDAO();
    $this->kleurDAO = new KleurDAO();
  }

  public function stoffen() {
    $this->set('title', 'Stoffen');
    $this->set('currentPage', 'stoffen');

    if(!empty($_GET["categorie"])){
      if(!empty($_GET["stofSoort"])){
        $stoffen = $this->stofDAO->search($_GET["categorie"], $_GET["stofSoort"]);
        $this->set('stoffen', $stoffen);
      }else{
        $stoffen = $this->stofDAO->search($_GET["categorie"], '');
        $this->set('stoffen', $stoffen);
      }
    }else if(!empty($_GET["stofSoort"])){
      if(!empty($_GET["categorie"])){
        $stoffen = $this->stofDAO->search($_GET["categorie"], $_GET["stofSoort"]);
        $this->set('stoffen', $stoffen);
      }else{
        $stoffen = $this->stofDAO->search('', $_GET["stofSoort"]);
        $this->set('stoffen', $stoffen);
      }
    }else{
      $stoffen = $this->stofDAO->search();
      $this->set('stoffen', $stoffen);
    }

    if (!empty($_GET['action'])) {
      if ($_GET['action'] == 'delete' && !empty($_GET['id'])) {
        $this->_handleDeleteStof();
      }
    }

    if(!empty($_FILES['image'])) {
      $this->_handlePostStof();
      $this->set('stoffen', $this->stofDAO->selectAll());
    }

    $kleuren = $this->kleurDAO->selectAll();
    $this->set('kleuren', $kleuren);

  }

  public function editStof() {
    if (!empty($_GET['action'])) {
      if ($_GET['action'] == 'update' && !empty($_GET['id'])) {
        $this->_handleUpdateStof();
      }
    }

    if(!empty($_GET['id'])){
      $stof = $this->stofDAO->selectById($_GET['id']);
      $this->set('stof', $stof);
    }

  }

  private function _handleUpdateStof() {
    $data = array_merge($_POST, array('id' => $_GET['id']));
    $this->stofDAO->update($data);
    $_SESSION['info'] = 'Artikel werd upgedate!';
    header('Location: index.php?page=stoffen');
    exit();
  }

  private function _handleDeleteStof() {
    $this->stofDAO->delete($_GET['id']);
    $_SESSION['info'] = 'Artikel werd verwijderd!';
    header('Location: index.php?page=stoffen');
    exit();
  }

  private function _handlePostStof(){
    $data = array_merge($_POST, array(
      'image' => 'will-be-set-later'
    ));
    // valideer de non-file data (gallery_id, title)
    $errors = $this->stofDAO->validate($data);
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
      $insertedImage = $this->stofDAO->insert($data);
      if (!empty($insertedImage)) {
        $_SESSION['info'] = 'Het bestand werd ge-upload!';
        header('Location: index.php?page=stoffen');
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
