<?php
  $soortenStof = array("Jersey" => 1, "Katoen" => 2, "Katoen Lycra" => 3, "Katoen Tricot" => 4, "Viscose" => 5, "Jeans" => 6, "Polyester" => 7, "Sweater" => 8, "Voile" => 9, "Kant" => 10, "Velours" => 11, "Babyrib" => 12, "Gebreid" => 13, "Punta di Roma" => 14, "French Terry" => 15, "Jassen" => 16, "Overig" => 17);
?>
<section>
  <div class="artikelsHeader">
    <img src="./assets/img/dames.png" alt="..." width="285" height="247" />
    <div>
      <div class="headerTitelSearch">
        <h2 class="boldTitel"><?php echo $title; ?></h2>
        <form action="" method="post" class="searchForm">
          <input type="text" name="search" id="search" placeholder="t-shirt">
          <button type="submit" id="searchButton" class="searchButton"><img src="./assets/img/search.png" alt="" width="24" height="24"></button>
        </form>
      </div>
      <p class="yellowLineArtikels"></p>
      <ul class="onderCategorieUl">
        <li <?php if(empty($_GET["categorie"])){
          echo 'class="onderCategorie menu_active"';
        }else{
          echo 'class="onderCategorie"';
        } ?>>
          <a href="index.php?page=stoffen<?php if(!empty($_GET["stofSoort"])){
            echo '&amp;stofSoort=' . $_GET["stofSoort"];
          }; ?>">Alles</a>
        </li>
        <li class="verticalLine"></li>
        <li <?php if(!empty($_GET["categorie"]) && $_GET["categorie"] == 'dames'){
          echo 'class="onderCategorie menu_active"';
        }else{
          echo 'class="onderCategorie"';
        } ?>>
          <a href="index.php?page=stoffen&amp;categorie=dames<?php if(!empty($_GET["stofSoort"])){
            echo '&amp;stofSoort=' . $_GET["stofSoort"];
          }; ?>">Dames</a>
        </li>
        <li class="verticalLine"></li>
        <li <?php if(!empty($_GET["categorie"]) && $_GET["categorie"] == 'heren'){
          echo 'class="onderCategorie menu_active"';
        }else{
          echo 'class="onderCategorie"';
        } ?>>
          <a href="index.php?page=stoffen&amp;categorie=heren<?php if(!empty($_GET["stofSoort"])){
            echo '&amp;stofSoort=' . $_GET["stofSoort"];
          }; ?>">Heren</a>
        </li>
        <li class="verticalLine"></li>
        <li <?php if(!empty($_GET["categorie"]) && $_GET["categorie"] == 'kinderen'){
          echo 'class="onderCategorie menu_active"';
        }else{
          echo 'class="onderCategorie"';
        } ?>>
          <a href="index.php?page=stoffen&amp;categorie=kinderen<?php if(!empty($_GET["stofSoort"])){
            echo '&amp;stofSoort=' . $_GET["stofSoort"];
          }; ?>">Kinderen</a>
        </li>
      </ul>
    </div>
  </div>
  <ul class="kleurenUl">
    <li <?php if(empty($_GET["stofSoort"])){ echo 'class="activeColorFilter"';}; ?>>
      <a href="index.php?page=stoffen<?php if(!empty($_GET["categorie"])){
        echo '&amp;categorie=' . $_GET["categorie"];
      }; ?>">Alles</a>
    </li>
    <?php foreach($soortenStof as $soortStof => $index): ?>
    <li <?php if(!empty($_GET["stofSoort"]) && $_GET["stofSoort"] == $soortStof){ echo 'class="activeColorFilter"';}; ?>>
      <a href="index.php?page=stoffen<?php if(!empty($_GET["categorie"])){
        echo '&amp;categorie=' . $_GET["categorie"];
      }; ?>&amp;stofSoort=<?php echo $soortStof; ?>"><?php echo $soortStof; ?></a>
    </li>
    <?php endforeach; ?>
  </ul>
</section>
<section class="mainSection">
  <section class="stofResultatenSection">
    <?php
      if(count($stoffen) == 0){
        echo "<p>er zijn geen producten gevonden</p>";
      }else{
        ?>
        <p class="aantalResultaten"><?php echo count($stoffen); ?> producten</p>
        <div class="stofResultatenDiv">
          <?php
            foreach ($stoffen as $stof):
          ?>
            <article class="stofResultaat">
              <div class="resultaat_img">
                <img src="<?php echo $stof["image"]; ?>" alt="" width="115" height="115">
                <div>
                  <h3>Nr. <?php echo $stof["kleurNummer"]; ?></h3>
                  <p><?php echo $stof["categorie"]; ?></p>
                  <p><?php echo $stof["lengte"]; ?>m x <?php echo $stof["breedte"]; ?>m</p>
                  <p><?php echo $stof["prijs"] ?>/m</p>
                  <div class="resultaat__stofsoort">
                    <span class="tag"><?php echo $stof["stofSoort"]; ?></span>
                    <?php if(!empty($stof["kleur"])){ echo '<span class="tag">' . $stof["kleur"] . '</span>'; } ?>
                  </div>
                </div>
              </div>
              <div class="div__icons">
                <!-- <a href="index.php?page=editStof&id=<?php echo $stof["id"]; ?>">
                  <img src="./assets/img/icons/edit.png" alt="" width="18" height="18">
                </a> -->
                <a href="index.php?page=stoffen&id=<?php echo $stof["id"]; ?>&action=delete">
                  <img src="./assets/img/icons/delete.png" alt="" width="14" height="18">
                </a>
              </div>
            </article>
          <?php
            endforeach;
          ?>
        </div>

      <?php
      }
    ?>
  </section>
  <section class="form__section">
    <form action="index.php?page=stoffen" method="post" enctype="multipart/form-data" class="itemInfo stofForm">
      <h2><b>Stof toevoegen</b></h2>
      <div class="stofFileUpload">
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
      </div>
      <div class="inputFieldDiv2">
        <label for="kleurNummer">Kleurnummer</label>
        <input type="text" name="kleurNummer" placeholder="1" value="<?php
          if (!empty($_POST['kleurNummer'])) {
            echo $_POST['kleurNummer'];
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
            // if (!empty($_POST['categorie']) && $_POST['categorie'] == 'dames') {
              echo 'checked';
            // }
          ?> >
          <label for="categorie1">Dames</label>
          <input type="radio" name="categorie" id="categorie2" value="heren" <?php
            if (!empty($_POST['categorie']) && $_POST['categorie'] == 'heren') {
              echo 'checked';
            }
          ?>>
          <label for="categorie2">Heren</label>
          <input type="radio" name="categorie" id="categorie3" value="kinderen" <?php
            if (!empty($_POST['categorie']) && $_POST['categorie'] == 'kinderen') {
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
              if (!empty($_POST['stofSoort']) && $_POST['stofSoort'] == $soortStof || $soortStof == "Jersey") {
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
          }
          ?>" />
          <?php
          if (!empty($_POST) && empty($_POST['breedte'])) {
            echo '<span class="error">gelieve een breedte in te vullen</span>';
          }
          ?>
      </div>
      <div class="boxesGrid">
        <h3>Kleuren</h3>
        <div class="inputFieldDivSoort">
          <?php foreach($kleuren as $kleur): ?>
            <input type="radio" name="kleur" id="radio<?php echo $kleur["kleur"]; ?>" value="<?php echo $kleur["kleur"]; ?>" <?php
              if (!empty($_POST['kleur']) && $_POST['kleur'] == $kleur["kleur"] || $kleur["kleur"] == "Rood") {
                echo 'checked';
              }
            ?>>
            <label for="radio<?php echo $kleur["kleur"]; ?>"><?php echo $kleur["kleur"]; ?></label>
          <?php endforeach; ?>
          <?php
          if (!empty($_POST) && empty($_POST['kleur'])) {
            echo '<span class="error">gelieve een kleur te selecteren</span>';
          }
          ?>
        </div>
      </div>
      <div class="inputFieldDiv2">
        <label for="prijs">Prijs</label>
        <input type="text" name="prijs" placeholder="1" value="<?php
          if (!empty($_POST['prijs'])) {
            echo $_POST['prijs'];
          }
          ?>" />
          <?php
          if (!empty($_POST) && empty($_POST['prijs'])) {
            echo '<span class="error">gelieve een prijs in te vullen</span>';
          }
          ?>
      </div>
      <input type="hidden" name="action" value="upload">
      <!-- <input type="submit" value="upload" class="yellowButton"> -->
      <button class="yellowButton" type="submit">Toevoegen</button>
    </form>
  </section>
</section>
