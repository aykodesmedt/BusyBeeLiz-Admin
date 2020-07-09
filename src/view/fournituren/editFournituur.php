<?php
print_r($fournituur);
?>
<?php
  $soortFournituur = array("Garen", "Biaislint", "Ritsen", "Paspel", "Lint", "Knopen", "Elastiek", "Handtas", "Opstrijklabel", "Boord");
  $formKleuren = array("1"=>"Rood", "2"=>"Blauw", "3"=>"Geel", "4"=>"Zwart", "5"=>"Wit", "6"=>"Groen", "7"=>"Beige", "8"=>"Paars", "9"=>"Bruin");
?>
<section class="form__section">
    <form action="index.php?page=editFournituur&action=updateFournituur&id=<?php echo $fournituur['id']; ?>" method="post" class="itemInfo stofForm">
      <h2><b>Fournituur bewerken</b></h2>
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
            <?php //if(!empty($errors['image'])) echo '<span class="error">' . $errors['image'] . '</span>';?>
          </div>
        </label>
      </div> -->
      <img src="<?php echo $fournituur['image']; ?>" alt="" width="75" height="75">
      <div class="boxesGrid">
        <h3>Soort</h3>
        <div class="inputFieldDivSoort">
          <?php foreach($soortFournituur as $index => $soort): ?>
            <input type="radio" name="soort" id="radio<?php echo $index; ?>" value="<?php echo $soort; ?>" <?php
              if (!empty($_POST['soort']) && $_POST['soort'] == $soort || $soort == $fournituur['soort']) {
                echo 'checked';
              }
            ?> >
            <label for="radio<?php echo $index; ?>"><?php echo $soort; ?></label>
          <?php endforeach; ?>
          <?php
          if (!empty($_POST) && empty($_POST['soort'])) {
            echo '<span class="error">gelieve een soort te selecteren</span>';
          }
          ?>
        </div>
      </div>
      <div class="boxesGrid">
        <h3>Kleur</h3>
        <div class="inputFieldDivSoort">
          <?php
            foreach($formKleuren as $index => $kleur):
          ?>
            <input type="radio" name="kleur" id="kleur<?php echo $index; ?>" value="<?php echo $kleur; ?>" <?php
              if (!empty($_POST['kleur']) && $_POST['kleur'] == $kleur || $kleur == $fournituur['kleur']) {
                echo 'checked';
              }
            ?> >
            <label for="kleur<?php echo $index; ?>"><?php echo $kleur; ?></label>
          <?php
            endforeach;
            if (!empty($_POST) && empty($_POST['kleur'])) {
              echo '<span class="error">gelieve een kleur te selecteren</span>';
            }
          ?>
        </div>
      </div>
      <div class="inputFieldDiv2">
        <label for="stuks">Aantal stuks</label>
        <input type="text" name="stuks" placeholder="1" value="<?php
          if (!empty($_POST['stuks'])) {
            echo $_POST['stuks'];
          }else {
            echo $fournituur['stuks'];
          }
          ?>" />
          <?php
          if (!empty($_POST) && empty($_POST['stuks'])) {
            echo '<span class="error">gelieve een stuks in te vullen</span>';
          }
          ?>
      </div>
      <div class="inputFieldDiv2">
        <label for="lengte">Lengte (in cm)</label>
        <input type="text" name="lengte" placeholder="1" value="<?php
          if (!empty($_POST['lengte'])) {
            echo $_POST['lengte'];
          }else {
            echo $fournituur['lengte'];
          }
          ?>" />
          <?php
          if (!empty($_POST) && empty($_POST['lengte'])) {
            echo '<span class="error">gelieve een lengte in te vullen</span>';
          }
          ?>
      </div>
      <button class="yellowButton" type="submit">Update</button>
    </form>
  </section>
