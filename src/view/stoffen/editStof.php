<?php
  $soortenStof = array("Tricot" => 1, "Katoen" => 2, "Wol" => 3, "Viscose" => 4, "Linnen" => 5, "Jeans" => 6, "Polyester" => 7, "Sweater" => 8, "Fleece" => 9);
?>
<section class="form__section">
  <form action="index.php?page=stoffen" method="post" enctype="multipart/form-data" class="itemInfo stofForm">
    <h2><b>Stof updaten</b></h2>
    <!-- <div class="stofFileUpload">
      <label>
        <script type='text/javascript'>
          function preview_image(event)
          {
          var reader = new FileReader();
          reader.onload = function()
          {
            var output = document.getElementById('output_image');
            output.src = reader.result;
          }
          reader.readAsDataURL(event.target.files[0]);
          }
        </script>
        <div class="outputimages">
          <img id="output_image"  id="output_image" class="output_imageStof"/>
          <img src="./assets/img/icons/camera.png" alt="" class="cameraIcon">
        </div>
        <div >
          <input name="image" type="file" accept="image/*" onchange="preview_image(event)"/>
          <?php if(!empty($errors['image'])) echo '<span class="error">' . $errors['image'] . '</span>';?>
        </div>
      </label>
    </div> -->
    <img src="<?php echo $stof['image']; ?>" alt="" width="75" height="75">
    <div class="inputFieldDiv2">
      <label for="kleurNummer">Kleurnummer</label>
      <input type="text" name="kleurNummer" placeholder="1" value="<?php
        if (!empty($_POST['kleurNummer'])) {
          echo $_POST['kleurNummer'];
        }else{
          echo $stof['kleurNummer'];
        }
        ?>" />
        <?php
        if (!empty($_POST) && empty($_POST['kleurNummer'])) {
          echo '<span class="error">gelieve een kleurNummer in te vullen</span>';
        }
        ?>
    </div>
    <div class="boxesGrid">
      <h3>Categorie</h3>
      <div class="inputFieldDivSoort">
        <input type="radio" name="categorie" id="categorie1" value="dames" <?php
          if (!empty($_POST['categorie']) && $_POST['categorie'] == 'dames') {
            echo 'checked';
          }else if(!empty($stof['categorie']) && $stof['categorie'] == 'dames'){
            echo 'checked';
          }
        ?> >
        <label for="categorie1">Dames</label>
        <input type="radio" name="categorie" id="categorie2" value="heren" <?php
          if (!empty($_POST['categorie']) && $_POST['categorie'] == 'heren') {
            echo 'checked';
          } else if(!empty($stof['categorie']) && $stof['categorie'] == 'heren'){
            echo 'checked';
          }
        ?>>
        <label for="categorie2">Heren</label>
        <input type="radio" name="categorie" id="categorie3" value="kinderen" <?php
          if (!empty($_POST['categorie']) && $_POST['categorie'] == 'kinderen') {
            echo 'checked';
          } else if(!empty($stof['categorie']) && $stof['categorie'] == 'kinderen'){
            echo 'checked';
          }
        ?>>
        <label for="categorie3">Kinderen</label>
      </div>
    </div>
    <div class="boxesGrid">
      <h3>Soort stof</h3>
      <div class="inputFieldDivSoort">
        <?php foreach($soortenStof as $soortStof => $index): ?>
          <input type="radio" name="stofSoort" id="radio<?php echo $index; ?>" value="<?php echo $soortStof; ?>" <?php
            if (!empty($_POST['stofSoort']) && $_POST['stofSoort'] == $soortStof) {
              echo 'checked';
            } else if($stof['stofSoort'] == $soortStof) {
              echo 'checked';
            }
          ?>>
          <label for="radio<?php echo $index; ?>"><?php echo $soortStof; ?></label>
        <?php endforeach; ?>
        <?php
        if (!empty($_POST) && empty($_POST['stofSoort'])) {
          echo '<span class="error">gelieve een stofSoort te selecteren</span>';
        }
        ?>
      </div>
    </div>
    <div class="inputFieldDiv2">
      <label for="lengte">Lengte</label>
      <input type="text" name="lengte" placeholder="1" value="<?php
        if (!empty($_POST['lengte'])) {
          echo $_POST['lengte'];
        }else{
          echo $stof['lengte'];
        }
        ?>" />
        <?php
        if (!empty($_POST) && empty($_POST['lengte'])) {
          echo '<span class="error">gelieve een lengte in te vullen</span>';
        }
        ?>
    </div>
    <div class="inputFieldDiv2">
      <label for="breedte">Breedte</label>
      <input type="text" name="breedte" placeholder="1" value="<?php
        if (!empty($_POST['breedte'])) {
          echo $_POST['breedte'];
        }else{
          echo $stof['breedte'];
        }
        ?>" />
        <?php
        if (!empty($_POST) && empty($_POST['breedte'])) {
          echo '<span class="error">gelieve een breedte in te vullen</span>';
        }
        ?>
    </div>
    <input type="hidden" name="action" value="update">
    <!-- <input type="submit" value="upload" class="yellowButton"> -->
    <button class="yellowButton" type="submit">Toevoegen</button>
  </form>
</section>

