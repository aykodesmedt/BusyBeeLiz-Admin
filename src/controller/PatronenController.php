<?php

require_once __DIR__ . '/Controller.php';
// require_once './dao/ArtikelDAO.php';
// require_once './dao/StofDAO.php';
require_once './dao/PatroonDAO.php';

class PatronenController extends Controller {

  function __construct() {
  //   $this->artikelDAO = new ArtikelDAO();
  //   $this->stofDAO = new StofDAO();
    $this->patroonDAO = new PatroonDAO();
  }

  public function patronen() {
    $this->set('title', 'Patronen');
    $this->set('currentPage', 'patronen');

    $patronen = $this->patroonDAO->selectAll();
    $this->set('patronen', $patronen);

    if (!empty($_GET['action']) && $_GET['action'] == 'filter') {
      $patronen = $this->patroonDAO->search($_GET['boekFilter']);
      // $this->set('categorie',$_GET['categorie']);
      $this->set('boekFilter', $_GET['boekFilter']);
      $this->set('currentBoek', $_GET['boekFilter']);
      $this->set('maandFilter',$_GET['maandFilter']);
      $this->set('currentMaand', $_GET['maandFilter']);
      $this->set('jaarFilter', $_GET['jaarFilter']);
      $this->set('currentJaar', $_GET['jaarFilter']);
    }else{
      $patronen = $this->patroonDAO->search('1');
      // $this->set('categorie','');
      $this->set('currentBoek','');
      $this->set('currentMaand','');
      $this->set('currentJaar', '');
    }

    if (strtolower($_SERVER['HTTP_ACCEPT']) == 'application/json') {
      header('Content-Type: application/json');
      echo json_encode($patronen);
      exit();
    }

    if (!empty($_GET['action'])) {
      if ($_GET['action'] == 'delete' && !empty($_GET['id'])) {
        $this->_handleDeletePatroon();
      }
    }

    if(!empty($_FILES['image'])) {
      $this->_handlePostPatroon();
      $this->set('stoffen', $this->patroonDAO->selectAll());
    }

  }

  public function editPatroon() {
    $patroon = $this->patroonDAO->selectById($_GET['id']);
    $this->set('patroon', $patroon);
  }

  private function _handleDeletePatroon() {
    $this->patroonDAO->delete($_GET['id']);
    $_SESSION['info'] = 'Artikel werd verwijderd!';
    header('Location: index.php?page=patronen');
    exit();
  }

  private function _handlePostPatroon(){
    $data = array_merge($_POST, array(
      'image' => 'will-be-set-later'
    ));
    // valideer de non-file data (gallery_id, title)
    $errors = $this->patroonDAO->validate($data);
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
      $insertedImage = $this->patroonDAO->insert($data);
      if (!empty($insertedImage)) {
        $_SESSION['info'] = 'Het bestand werd ge-upload!';
        header('Location: index.php?page=patronen');
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
