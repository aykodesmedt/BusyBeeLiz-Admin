<?php
  $maanden = array("Jan" => 1, "Feb" => 2, "Maa" => 3, "Apr" => 4, "Mei" => 5, "Jun" => 6, "Jul" => 7, "Aug" => 8, "Sep" => 9, "Okt" => 10, "Nov" => 11, "Dec" => 12);
  $jaren = array("2004" => 1, "2012" => 2, "2013" => 3, "2014" => 4, "2015" => 5, "2016" => 6, "2017" => 7, "2018" => 8, "2019" => 9);
  $categorien = array("dames", "heren", "kinderen", "accessoires");
?>
<section class="form__section">
    <form action="index.php?page=patronen" method="post" enctype="multipart/form-data" class="itemInfo stofForm">
      <h2><b>Patroon toevoegen</b></h2>
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
      <img src="<?php echo $patroon['image']; ?>" alt="" width="75" height="75">
      <div class="inputFieldDiv2">
        <label for="model">Model</label>
        <input type="text" name="model" placeholder="1 of Susan T-shirt" value="<?php
          if (!empty($_POST['model'])) {
            echo $_POST['model'];
          }
          ?>" />
          <?php
          if (!empty($_POST) && empty($_POST['model'])) {
            echo '<span class="error">gelieve een model in te vullen</span>';
          }
          ?>
      </div>
      <div class="boxesGrid">
        <h3>Boek</h3>
        <div class="inputFieldDivSoort">
          <input type="radio" name="boek" id="boek1" value="Knip" <?php
              if (!empty($_POST['boek']) && $_POST['boek'] == 'Knip' || $patroon['boek'] == "Knip") {
                echo 'checked';
              }
          ?> >
          <label for="boek1">Knip</label>
          <input type="radio" name="boek" id="boek2" value="Lmv" <?php
            if (!empty($_POST['boek']) && $_POST['boek'] == 'Lmv' || $patroon['boek'] == "Lmv") {
              echo 'checked';
            }
          ?>>
          <label for="boek2">Lmv</label>
          <input type="radio" name="boek" id="boek3" value="Burda" <?php
            if (!empty($_POST['boek']) && $_POST['boek'] == 'Burda' || $patroon['boek'] == "Burda") {
              echo 'checked';
            }
          ?>>
          <label for="boek3">Burda</label>
        </div>
      </div>
      <div class="inputFieldDiv2">
        <label for="maand">Maand</label>
        <select name="maand" id="maand">
          <?php foreach($maanden as $maand => $index): ?>
            <option value="<?php echo $maand ?>" <?php
              if (!empty($_POST['maand']) && $_POST['maand'] == $maand || $patroon['maand'] == $maand) {
                echo 'selected';
              }
            ?>><?php echo $maand ?></option>
          <?php endforeach; ?>
        </select>
      </div>
      <div class="inputFieldDiv2">
        <label for="jaar">Jaar</label>
        <select name="jaar" id="jaar">
          <?php foreach($jaren as $jaar => $index): ?>
            <option value="<?php echo $jaar ?>" <?php
              if (!empty($_POST['jaar']) && $_POST['jaar'] == $jaar || $patroon['jaar'] == $jaar) {
                echo 'selected';
              }
            ?>><?php echo $jaar ?></option>
          <?php endforeach; ?>
        </select>
      </div>
      <div class="boxesGrid">
        <h3>Categorie</h3>
        <div class="inputFieldDivSoort">
          <input type="radio" name="categorie" id="categorie1" value="dames" <?php
            if (!empty($_POST['categorie']) && $_POST['categorie'] == 'dames' || $patroon['categorie'] == 'dames') {
              echo 'checked';
            }
          ?> >
          <label for="categorie1">Dames</label>
          <input type="radio" name="categorie" id="categorie2" value="heren" <?php
            if (!empty($_POST['categorie']) && $_POST['categorie'] == 'heren' || $patroon['categorie'] == 'heren') {
              echo 'checked';
            }
          ?>>
          <label for="categorie2">Heren</label>
          <input type="radio" name="categorie" id="categorie3" value="kinderen" <?php
            if (!empty($_POST['categorie']) && $_POST['categorie'] == 'kinderen' || $patroon['categorie'] == 'kinderen') {
              echo 'checked';
            }
          ?>>
          <label for="categorie3">Kinderen</label>
          <input type="radio" name="categorie" id="categorie4" value="accessoires" <?php
            if (!empty($_POST['categorie']) && $_POST['categorie'] == 'accessoires' || $patroon['categorie'] == 'accessoires') {
              echo 'checked';
            }
          ?>>
          <label for="categorie4">Accessoires</label>
        </div>
      </div>
      <div class="inputFieldDiv2">
        <label for="maat">Maat</label>
        <select name="maat" id="maat">
        <option value="36-38" <?php
              if (!empty($_POST['maat']) && $_POST['maat'] == '36-38' || $patroon['maat'] == '36-38') {
                echo 'selected';
              }
            ?>>36-38</option>
          <option value="40-42" <?php
              if (!empty($_POST['maat']) && $_POST['maat'] == '40-42' || $patroon['maat'] == '40-42') {
                echo 'selected';
              }
            ?>>40-42</option>
          <option value="44-46" <?php
              if (!empty($_POST['maat']) && $_POST['maat'] == '44-46' || $patroon['maat'] == '44-46') {
                echo 'selected';
              }
            ?>>44-46</option>
        </select>
      </div>
      <input type="hidden" name="action" value="updatePatroon">
      <button class="yellowButton" type="submit">Update</button>
    </form>
  </section>
