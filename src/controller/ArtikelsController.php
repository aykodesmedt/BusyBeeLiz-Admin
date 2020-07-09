<?php

require_once __DIR__ . '/Controller.php';
require_once './dao/ArtikelDAO.php';
require_once './dao/KleurDAO.php';
require_once './dao/CommentDAO.php';

class ArtikelsController extends Controller {

  function __construct() {
    $this->artikelDAO = new ArtikelDAO();
    $this->kleurDAO = new KleurDAO();
    $this->commentDAO = new CommentDAO();
  }

  public function index() {
    $this->set('title', 'Home');
    $this->set('currentPage', 'home');
  }

  public function dames() {
    $this->set('title', 'dames');
    $this->set('currentPage', 'dames');
    if(!empty($_GET["onderCategorie"])){
      if(!empty($_GET["kleur"])){
        $artikels = $this->artikelDAO->search('dames', $_GET["onderCategorie"], $_GET["kleur"]);
        $this->set('artikels', $artikels);
      }else{
        $artikels = $this->artikelDAO->search('dames', $_GET["onderCategorie"], '');
        $this->set('artikels', $artikels);
      }
    }else if(!empty($_GET["kleur"])){
      if(!empty($_GET["onderCategorie"])){
        $artikels = $this->artikelDAO->search('dames', $_GET["onderCategorie"], $_GET["kleur"]);
        $this->set('artikels', $artikels);
      }else{
        $artikels = $this->artikelDAO->search('dames', '', $_GET["kleur"]);
        $this->set('artikels', $artikels);
      }
    }else{
      // $artikels = $this->artikelDAO->selectAllDames();
      $artikels = $this->artikelDAO->search('dames');
      $this->set('artikels', $artikels);
    }

    if(!empty($_FILES['imageEen'])) {
      $this->_handlePostArtikel();
      // $this->set('artikels', $this->damesDAO->selectAll());
      $this->set('artikels', $this->artikelDAO->search($_GET["page"]));
    }

    if (!empty($_GET['action'])) {
      if ($_GET['action'] == 'delete' && !empty($_GET['id'])) {
        $this->_handleDeleteArtikel();
      }
      if($_GET['action'] == 'update' && !empty($_GET['id'])){
        $this->_handleUpdateArtikel();
      }
    }

    $kleuren = $this->kleurDAO->selectAll();
    $this->set('kleuren', $kleuren);

  }

  public function heren() {
    $this->set('title', 'heren');
    $this->set('currentPage', 'heren');
    if(!empty($_GET["onderCategorie"])){
      // $artikels = $this->artikelDAO->selectHerenByOndercategorie($_GET["onderCategorie"]);
      if(!empty($_GET["kleur"])){
        $artikels = $this->artikelDAO->search('heren', $_GET["onderCategorie"], $_GET["kleur"],'');
        $this->set('artikels', $artikels);
      }else{
        $artikels = $this->artikelDAO->search('heren', $_GET["onderCategorie"], '','');
        $this->set('artikels', $artikels);
      }
    }else if(!empty($_GET["kleur"])){
      if(!empty($_GET["onderCategorie"])){
        $artikels = $this->artikelDAO->search('heren', $_GET["onderCategorie"], $_GET["kleur"],'');
        $this->set('artikels', $artikels);
      }else{
        $artikels = $this->artikelDAO->search('heren', '', $_GET["kleur"],'');
        $this->set('artikels', $artikels);
      }
    }else{
      // $artikels = $this->artikelDAO->selectAllheren();
      $artikels = $this->artikelDAO->search('heren');
      $this->set('artikels', $artikels);
    }

    if(!empty($_FILES['imageEen'])) {
      $this->_handlePostArtikel();
      $this->set('artikels', $this->artikelDAO->search($_GET["page"]));
    }

    if (!empty($_GET['action'])) {
      if ($_GET['action'] == 'delete' && !empty($_GET['id'])) {
        $this->handleDeleteArtikel();
      }
    }

    $kleuren = $this->kleurDAO->selectAll();
    $this->set('kleuren', $kleuren);
  }

  public function kinderen() {
    $this->set('title', 'kinderen');
    $this->set('currentPage', 'kinderen');
    if(!empty($_GET["onderCategorie"])){
      if(!empty($_GET["leeftijd"])){
        $artikels = $this->artikelDAO->search('kinderen', $_GET["onderCategorie"], '', $_GET["leeftijd"]);
        $this->set('artikels', $artikels);
      }else{
        $artikels = $this->artikelDAO->search('kinderen', $_GET["onderCategorie"], '', '');
        $this->set('artikels', $artikels);
      }
    }else if(!empty($_GET["leeftijd"])){
      if(!empty($_GET["onderCategorie"])){
        $artikels = $this->artikelDAO->search('kinderen', $_GET["onderCategorie"], '', $_GET["leeftijd"]);
        $this->set('artikels', $artikels);
      }else{
        $artikels = $this->artikelDAO->search('kinderen', '', '', $_GET["leeftijd"]);
        $this->set('artikels', $artikels);
      }
    }else{
      $artikels = $this->artikelDAO->search('kinderen');
      $this->set('artikels', $artikels);
    }

    if(!empty($_FILES['imageEen'])) {
      $this->_handlePostArtikel();
      $this->set('artikels', $this->kinderenDAO->selectAll());
    }

    if (!empty($_GET['action'])) {
      if ($_GET['action'] == 'delete' && !empty($_GET['id'])) {
        $this->handleDeleteArtikel();
      }
    }

    $kleuren = $this->kleurDAO->selectAll();
    $this->set('kleuren', $kleuren);
  }

  public function cadeaus() {
    $this->set('title', 'cadeaus');
    $this->set('currentPage', 'cadeaus');
    if(!empty($_GET["onderCategorie"])){
      // $artikels = $this->artikelDAO->selectCadeausByOndercategorie($_GET["onderCategorie"]);
      if(!empty($_GET["kleur"])){
        $artikels = $this->artikelDAO->search('cadeaus', $_GET["onderCategorie"], $_GET["kleur"]);
        $this->set('artikels', $artikels);
      }else{
        $artikels = $this->artikelDAO->search('cadeaus', $_GET["onderCategorie"], '');
        $this->set('artikels', $artikels);
      }
    }else if(!empty($_GET["kleur"])){
      if(!empty($_GET["onderCategorie"])){
        $artikels = $this->artikelDAO->search('cadeaus', $_GET["onderCategorie"], $_GET["kleur"]);
        $this->set('artikels', $artikels);
      }else{
        $artikels = $this->artikelDAO->search('cadeaus', '', $_GET["kleur"]);
        $this->set('artikels', $artikels);
      }
    }else{
      // $artikels = $this->artikelDAO->selectAllcadeaus();
      $artikels = $this->artikelDAO->search('cadeaus');
      $this->set('artikels', $artikels);
    }

    if(!empty($_FILES['imageEen'])) {
      $this->_handlePostArtikel();
      $this->set('artikels', $this->cadeausDAO->selectAll());
    }

    if (!empty($_GET['action'])) {
      if ($_GET['action'] == 'delete' && !empty($_GET['id'])) {
        $this->_handleDeleteArtikel();
      }
    }

    $kleuren = $this->kleurDAO->selectAll();
    $this->set('kleuren', $kleuren);
  }

  public function detail() {

    if(!empty($_GET['id'])){
      $artikel = $this->artikelDAO->selectById($_GET['id']);
      $this->set('artikel', $artikel);
    }
    if(!empty($artikel)){
      $stoffen = $this->artikelDAO->searchStoffenByArtikel($_GET['id'], $artikel["stofLengte"], $artikel["stofBreedte"]);
      $this->set('stoffen', $stoffen);
    }

    $categorie = $artikel["categorie"];
    $this->set('currentPage', $categorie);

    if(empty($artikel)){
      $_SESSION['error'] = 'Dit artikel werd niet gevonden.';
      header('Location: index.php');
      exit();
    }

    if (!empty($_GET['action'])) {
      if ($_GET['action'] == 'delete' && !empty($_GET['commentId'])) {
        $this->_handleDeleteComment();
      }
      if ($_GET['action'] == 'update' && !empty($_GET['id'])) {
        $this->_handleUpdateArtikel();
      }
    }

    $kleuren = $this->kleurDAO->selectAll();
    $this->set('kleuren', $kleuren);

    $comments = $this->commentDAO->selectByArtikelId($_GET['id']);
    $this->set('comments', $comments);
  }

  private function _handleDeleteComment() {
    $this->commentDAO->delete($_GET['commentId']);
    $_SESSION['info'] = 'Comment werd verwijderd!';
    header('Location: index.php?page=detail&id=' . $_GET['id']);
    exit();
  }

  private function _handleUpdateArtikel() {
    $data = array_merge($_POST, array('id' => $_GET['id']));
    $this->artikelDAO->update($data);
    // $data = $_POST;
    // $this->artikelDAO->update($data, $id);
    $_SESSION['info'] = 'Artikel werd upgedate!';
    header('Location: index.php?page=detail&id=' . $_GET['id']);
    exit();
  }

  private function _handleDeleteArtikel() {
    $this->artikelDAO->delete($_GET['id']);
    $_SESSION['info'] = 'Artikel werd verwijderd!';
    if($_GET['page'] == 'dames'){
      header('Location: index.php?page=dames');
    }else if($_GET['page'] == 'heren'){
      header('Location: index.php?page=heren');
    }else if($_GET['page'] == 'kinderen'){
      header('Location: index.php?page=kinderen');
    }else if($_GET['page'] == 'cadeaus'){
      header('Location: index.php?page=cadeaus');
    }
    exit();
  }

  private function _handlePostArtikel(){
    $data = array_merge($_POST, array(
      'imageEen' => 'will-be-set-later',
      'imageTwee' => 'will-be-set-later',
      'imageDrie' => 'will-be-set-later',
      'imageVier' => 'will-be-set-later',
      'imageVijf' => 'will-be-set-later',
      'imageZes' => 'will-be-set-later'
    ));
    // valideer de non-file data (gallery_id, title)
    if(!empty($data['categorie'])){
      $errors = $this->artikelDAO->validate($data);
    }
    if (empty($_FILES['imageEen']) || !empty($_FILES['imageEen']['error'])) {
      $errors['imageEen'] = 'Gelieve een bestand te selecteren';
    }
    if (empty($errors)) {
      // controleer of het een afbeelding is
      $fileinfo = finfo_open(FILEINFO_MIME_TYPE);
      $whitelist_type = array('image/jpeg', 'image/png','image/gif');
      if (!in_array(finfo_file($fileinfo, $_FILES['imageEen']['tmp_name']), $whitelist_type)) {
        $errors['imageEen'] = 'Gelieve een jpeg, png of gif te selecteren';
      }
      if (!in_array(finfo_file($fileinfo, $_FILES['imageTwee']['tmp_name']), $whitelist_type)) {
        $errors['imageTwee'] = 'Gelieve een jpeg, png of gif te selecteren';
      }
      if (!in_array(finfo_file($fileinfo, $_FILES['imageDrie']['tmp_name']), $whitelist_type)) {
        $errors['imageDrie'] = 'Gelieve een jpeg, png of gif te selecteren';
      }
      if (!in_array(finfo_file($fileinfo, $_FILES['imageVier']['tmp_name']), $whitelist_type)) {
        $errors['imageVier'] = 'Gelieve een jpeg, png of gif te selecteren';
      }
      if (!in_array(finfo_file($fileinfo, $_FILES['imageVijf']['tmp_name']), $whitelist_type)) {
        $errors['imageVijf'] = 'Gelieve een jpeg, png of gif te selecteren';
      }
      if (!in_array(finfo_file($fileinfo, $_FILES['imageZes']['tmp_name']), $whitelist_type)) {
        $errors['imageZes'] = 'Gelieve een jpeg, png of gif te selecteren';
      }
    }
    if (empty($errors)) {
      // controleer de afmetingen van het bestand
      $sizeEen = getimagesize($_FILES['imageEen']['tmp_name']);
      if ($sizeEen[0] < 285 || $sizeEen[1] < 415) {
        $errors['imageEen'] = 'De afbeelding moet minimum 285 pixels groot zijn';
      }
      $sizeTwee = getimagesize($_FILES['imageTwee']['tmp_name']);
      if ($sizeTwee[0] < 285 || $sizeTwee[1] < 415) {
        $errors['imageTwee'] = 'De afbeelding moet minimum 285 pixels groot zijn';
      }
      $sizeDrie = getimagesize($_FILES['imageDrie']['tmp_name']);
      if ($sizeDrie[0] < 285 || $sizeDrie[1] < 415) {
        $errors['imageDrie'] = 'De afbeelding moet minimum 285 pixels groot zijn';
      }
      $sizeVier = getimagesize($_FILES['imageVier']['tmp_name']);
      if ($sizeVier[0] < 285 || $sizeVier[1] < 415) {
        $errors['imageVier'] = 'De afbeelding moet minimum 285 pixels groot zijn';
      }
      $sizeVijf = getimagesize($_FILES['imageVijf']['tmp_name']);
      if ($sizeVijf[0] < 285 || $sizeVijf[1] < 415) {
        $errors['imageVijf'] = 'De afbeelding moet minimum 285 pixels groot zijn';
      }
      $sizeZes = getimagesize($_FILES['imageZes']['tmp_name']);
      if ($sizeZes[0] < 285 || $sizeZes[1] < 415) {
        $errors['imageZes'] = 'De afbeelding moet minimum 285 pixels groot zijn';
      }
    }
    if (empty($errors)) {
      $projectFolder = realpath(__DIR__ . '/..');
      $targetFolder = $projectFolder . '/assets/img';
      $targetFolder = @tempnam($targetFolder, '');
      unlink($targetFolder);
      mkdir($targetFolder, 0777, true);

      $targetFileNameEen = $targetFolder . '/' . $_FILES['imageEen']['name'];
      $this->_resizeAndCrop(
        $_FILES['imageEen']['tmp_name'],
        $targetFileNameEen,
        285, 415
      );
      $relativeFileNameEen = substr($targetFileNameEen, 1 + strlen($projectFolder));
      $data['imageEen'] = $relativeFileNameEen;

      $targetFileNameTwee = $targetFolder . '/' . $_FILES['imageTwee']['name'];
      $this->_resizeAndCrop(
        $_FILES['imageTwee']['tmp_name'],
        $targetFileNameTwee,
        285, 415
      );
      $relativeFileNameTwee = substr($targetFileNameTwee, 1 + strlen($projectFolder));
      $data['imageTwee'] = $relativeFileNameTwee;

      $targetFileNameDrie = $targetFolder . '/' . $_FILES['imageDrie']['name'];
      $this->_resizeAndCrop(
        $_FILES['imageDrie']['tmp_name'],
        $targetFileNameDrie,
        285, 415
      );
      $relativeFileNameDrie = substr($targetFileNameDrie, 1 + strlen($projectFolder));
      $data['imageDrie'] = $relativeFileNameDrie;

      $targetFileNameVier = $targetFolder . '/' . $_FILES['imageVier']['name'];
      $this->_resizeAndCrop(
        $_FILES['imageVier']['tmp_name'],
        $targetFileNameVier,
        285, 415
      );
      $relativeFileNameVier = substr($targetFileNameVier, 1 + strlen($projectFolder));
      $data['imageVier'] = $relativeFileNameVier;

      $targetFileNameVijf = $targetFolder . '/' . $_FILES['imageVijf']['name'];
      $this->_resizeAndCrop(
        $_FILES['imageVijf']['tmp_name'],
        $targetFileNameVijf,
        285, 415
      );
      $relativeFileNameVijf = substr($targetFileNameVijf, 1 + strlen($projectFolder));
      $data['imageVijf'] = $relativeFileNameVijf;

      $targetFileNameZes = $targetFolder . '/' . $_FILES['imageZes']['name'];
      $this->_resizeAndCrop(
        $_FILES['imageZes']['tmp_name'],
        $targetFileNameZes,
        285, 415
      );
      $relativeFileNameZes = substr($targetFileNameZes, 1 + strlen($projectFolder));
      $data['imageZes'] = $relativeFileNameZes;

      if(!empty($data['categorie'])){
        $insertedImage = $this->artikelDAO->insert($data);
        // if($data['categorie'] == 'Dames'){
        //   $insertedImage = $this->damesDAO->insert($data);
        // }
      }
      if (!empty($insertedImage)) {
        $_SESSION['info'] = 'Het bestand werd ge-upload!';
        if($_GET['page'] == 'dames'){
          header('Location: index.php?page=dames');
        }else if($_GET['page'] == 'heren'){
          header('Location: index.php?page=heren');
        }else if($_GET['page'] == 'kinderen'){
          header('Location: index.php?page=kinderen');
        }else if($_GET['page'] == 'cadeaus'){
          header('Location: index.php?page=cadeaus');
        }
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
