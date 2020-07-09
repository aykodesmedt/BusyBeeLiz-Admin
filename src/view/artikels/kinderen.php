<?php
  $categorien = array("Jurken"=>"jurken", "Tops & T-shirts"=>"topsandshirts", "Rokken"=>"rokken", "Truien"=>"truien", "Vesten"=>"vesten", "Broeken"=>"broeken", "Blouses"=>"blouses", "Accessoires"=>"accessoires");
  $soortenStof = array("Jersey" => 1, "Katoen" => 2, "Katoen Lycra" => 3, "Katoen Tricot" => 4, "Viscose" => 5, "Jeans" => 6, "Polyester" => 7, "Sweater" => 8, "Voile" => 9, "Kant" => 10, "Velours" => 11, "Babyrib" => 12, "Gebreid" => 13, "Punta di Roma" => 14, "French Terry" => 15, "Jassen" => 16, "Overig" => 17);
?>
<section>
  <div class="artikelsHeader">
    <img src="./assets/img/kinderen.png" alt="..." width="285" height="247" />
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
        <li <?php if(empty($_GET["onderCategorie"])){
          echo 'class="onderCategorie menu_active"';
        }else{
          echo 'class="onderCategorie"';
        } ?>>
          <a href="index.php?page=kinderen<?php if(!empty($_GET["kleur"])){
            echo '&amp;kleur=' . $_GET["kleur"];
          }; ?>">Alles</a>
        </li>
        <?php foreach($categorien as $categorie => $categorie_value): ?>
          <li class="verticalLine"></li>
          <li <?php if(!empty($_GET["onderCategorie"]) && $_GET["onderCategorie"] == $categorie_value){
            echo 'class="onderCategorie menu_active"';
          }else{
            echo 'class="onderCategorie"';
          } ?>>
            <a href="index.php?page=kinderen&amp;onderCategorie=<?php echo $categorie_value ?><?php if(!empty($_GET["kleur"])){
              echo '&amp;kleur=' . $_GET["kleur"];
            }; ?>"><?php echo $categorie ?></a>
          </li>
        <?php endforeach; ?>
      </ul>
    </div>
  </div>
  <ul class="kleurenUl">
    <li <?php if(empty($_GET["leeftijd"])){ echo 'class="activeColorFilter"';}; ?>>
      <a href="index.php?page=kinderen<?php if(!empty($_GET["onderCategorie"])){
        echo '&amp;onderCategorie=' . $_GET["onderCategorie"];
      }; ?>">Alles</a>
    </li>
    <li <?php if(!empty($_GET["leeftijd"]) && $_GET["leeftijd"] == 'babys'){ echo 'class="activeColorFilter"';}; ?>>
      <a href="index.php?page=kinderen<?php if(!empty($_GET["onderCategorie"])){
        echo '&amp;onderCategorie=' . $_GET["onderCategorie"];
      }; ?>&amp;leeftijd=babys">Babys</a>
    </li>
    <li <?php if(!empty($_GET["leeftijd"]) && $_GET["leeftijd"] == 'meisjes'){ echo 'class="activeColorFilter"';}; ?>>
      <a href="index.php?page=kinderen<?php if(!empty($_GET["onderCategorie"])){
        echo '&amp;onderCategorie=' . $_GET["onderCategorie"];
      }; ?>&amp;leeftijd=meisjes">Meisjes</a>
    </li>
    <li <?php if(!empty($_GET["leeftijd"]) && $_GET["leeftijd"] == 'jongens'){ echo 'class="activeColorFilter"';}; ?>>
      <a href="index.php?page=kinderen<?php if(!empty($_GET["onderCategorie"])){
        echo '&amp;onderCategorie=' . $_GET["onderCategorie"];
      }; ?>&amp;leeftijd=jongens">Jongens</a>
    </li>
  </ul>
</section>
<section class="mainSection">
  <section class="stofResultatenSection">
    <?php
      if(count($artikels) == 0){
        echo "<p>er zijn geen producten gevonden</p>";
      }else{
        ?>
        <p class="aantalResultaten"><?php echo count($artikels); ?> producten</p>
        <div class="resultatenDiv">
          <?php
            foreach ($artikels as $artikel):
          ?>
          <div>
            <a href="index.php?page=kinderen&id=<?php echo $artikel["id"]; ?>&action=delete" class="resultaatDelete">
              <img src="./assets/img/icons/delete.png" alt="" width="14" height="18">
            </a>
            <a href="index.php?page=detail&amp;id=<?php echo $artikel["id"]; ?>">
              <article class="resultaat">
              <div>
                  <?php if(!empty($artikel["image1"])): ?>
                    <img src="<?php echo $artikel["image1"]; ?>" alt="" width="148" height="216" class="resultaatImg">
                  <?php else: ?>
                    <img src="./assets/img/kledingItem.png" alt="" width="148" height="216" class="resultaatImg">
                  <?php endif; ?>
                    <img src="./assets/img/decoration/yellowDotsSmall.png" alt="" width="112" height="52" class="resultaatDeco">
                </div>
                <div class="resultaatP">
                  <p><?php echo $artikel["titel"]; ?></p>
                  <p><?php echo $artikel["maat"]; ?></p>
                </div>
              </article>
            </a>
          </div>
          <?php
            endforeach;
          ?>
        </div>

      <?php
      }
    ?>
  </section>
  <section class="form__section">
    <form action="index.php?page=kinderen" method="post" enctype="multipart/form-data" class="itemInfo">
      <input type="text" name="categorie" class="hidden" value="Kinderen" />
      <h2><b>Artikel toevoegen</b></h2>
      <div class="fileUpload__div">
        <div class="artikelFileUpload">
          <label>
            <script type='text/javascript'>
              function preview_imageEen(event)
              {
              var reader = new FileReader();
              reader.onload = function()
              {
                var output = document.getElementById('output_imageEen');
                output.src = reader.result;
              }
              reader.readAsDataURL(event.target.files[0]);
              }
              function preview_imageTwee(event)
              {
                var readerTwee = new FileReader();
              readerTwee.onload = function()
              {
                var output = document.getElementById('output_imageTwee');
                output.src = readerTwee.result;
              }
              readerTwee.readAsDataURL(event.target.files[0]);
              }
              function preview_imageDrie(event)
              {
                var readerDrie = new FileReader();
              readerDrie.onload = function()
              {
                var output = document.getElementById('output_imageDrie');
                output.src = readerDrie.result;
              }
              readerDrie.readAsDataURL(event.target.files[0]);
              }
              function preview_imageVier(event)
              {
                var readerVier = new FileReader();
              readerVier.onload = function()
              {
                var output = document.getElementById('output_imageVier');
                output.src = readerVier.result;
              }
              readerVier.readAsDataURL(event.target.files[0]);
              }
              function preview_imageVijf(event)
              {
                var readerVijf = new FileReader();
              readerVijf.onload = function()
              {
                var output = document.getElementById('output_imageVijf');
                output.src = readerVijf.result;
              }
              readerVijf.readAsDataURL(event.target.files[0]);
              }
              function preview_imageZes(event)
              {
                var readerZes = new FileReader();
              readerZes.onload = function()
              {
                var output = document.getElementById('output_imageZes');
                output.src = readerZes.result;
              }
              readerZes.readAsDataURL(event.target.files[0]);
              }
            </script>
            <div class="outputimages">
              <img id="output_imageEen" class="output_imageArtikel"/>
              <img src="./assets/img/icons/camera.png" alt="" class="cameraIcon" width="23" height="17">
            </div>
            <div>
              <input name="imageEen" type="file" accept="image/*" onchange="preview_imageEen(event)"/>
              <?php if(!empty($errors['imageEen'])) echo '<span class="error">' . $errors['imageEen'] . '</span>';?>
            </div>
          </label>
        </div>
        <div class="artikelFileUpload">
          <label>
            <div class="outputimages">
              <img id="output_imageTwee" class="output_imageArtikel"/>
              <img src="./assets/img/icons/camera.png" alt="" class="cameraIcon" width="23" height="17">
            </div>
            <div>
              <input name="imageTwee" type="file" accept="image/*" onchange="preview_imageTwee(event)"/>
              <?php if(!empty($errors['imageTwee'])) echo '<span class="error">' . $errors['imageTwee'] . '</span>';?>
            </div>
          </label>
        </div>
        <div class="artikelFileUpload">
          <label>
            <div class="outputimages">
              <img id="output_imageDrie" class="output_imageArtikel"/>
              <img src="./assets/img/icons/camera.png" alt="" class="cameraIcon" width="23" height="17">
            </div>
            <div>
              <input name="imageDrie" type="file" accept="image/*" onchange="preview_imageDrie(event)"/>
              <?php if(!empty($errors['imageDrie'])) echo '<span class="error">' . $errors['imageDrie'] . '</span>';?>
            </div>
          </label>
        </div>
        <div class="artikelFileUpload">
          <label>
            <div class="outputimages">
              <img id="output_imageVier" class="output_imageArtikel"/>
              <img src="./assets/img/icons/camera.png" alt="" class="cameraIcon" width="23" height="17">
            </div>
            <div>
              <input name="imageVier" type="file" accept="image/*" onchange="preview_imageVier(event)"/>
              <?php if(!empty($errors['imageVier'])) echo '<span class="error">' . $errors['imageVier'] . '</span>';?>
            </div>
          </label>
        </div>
        <div class="artikelFileUpload">
          <label>
            <div class="outputimages">
              <img id="output_imageVijf" class="output_imageArtikel"/>
              <img src="./assets/img/icons/camera.png" alt="" class="cameraIcon" width="23" height="17">
            </div>
            <div>
              <input name="imageVijf" type="file" accept="image/*" onchange="preview_imageVijf(event)"/>
              <?php if(!empty($errors['imageVijf'])) echo '<span class="error">' . $errors['imageVijf'] . '</span>';?>
            </div>
          </label>
        </div>
        <div class="artikelFileUpload">
          <label>
            <div class="outputimages">
              <img id="output_imageZes" class="output_imageArtikel"/>
              <img src="./assets/img/icons/camera.png" alt="" class="cameraIcon" width="23" height="17">
            </div>
            <div>
              <input name="imageZes" type="file" accept="image/*" onchange="preview_imageZes(event)"/>
              <?php if(!empty($errors['imageZes'])) echo '<span class="error">' . $errors['imageZes'] . '</span>';?>
            </div>
          </label>
        </div>
      </div>
      <div class="inputFieldDiv">
        <label for="titel">Titel</label>
        <input type="text" name="titel" placeholder="1" value="<?php
          if (!empty($_POST['titel'])) {
            echo $_POST['titel'];
          }
          ?>" />
          <?php
          if (!empty($_POST) && empty($_POST['titel'])) {
            echo '<span class="error">gelieve een titel in te vullen</span>';
          }
          ?>
      </div>
      <div class="inputFieldDiv">
        <label for="beschrijving">Beschrijving</label>
        <textarea cols="30" rows="4" name="beschrijving" placeholder="Een blauwe tshirt met daarop een prachtige tijger. De tijger is erop vast geborduurd. Een blauwe tshirt met daarop een prachtige tijger. De tijger is erop vast geborduurd."><?php
          if (!empty($_POST['beschrijving'])) {
            echo $_POST['beschrijving'];
          }
          ?></textarea>
          <?php
          if (!empty($_POST) && empty($_POST['beschrijving'])) {
            echo '<span class="error">gelieve een beschrijving in te vullen</span>';
          }
          ?>
      </div>
      <div class="inputFieldDiv2">
        <label for="maat">Maat</label>
        <select name="maat" id="maat">
          <option value="36-38" <?php
              if (!empty($_POST['maat']) && $_POST['maat'] == '36-38') {
                echo 'selected';
              }
            ?>>36-38</option>
          <option value="40-42" <?php
              if (!empty($_POST['maat']) && $_POST['maat'] == '40-42') {
                echo 'selected';
              }
            ?>>40-42</option>
          <option value="44-46" <?php
              if (!empty($_POST['maat']) && $_POST['maat'] == '44-46') {
                echo 'selected';
              }
            ?>>44-46</option>
        </select>
      </div>
      <div class="inputFieldDiv2">
        <label for="onderCategorie">Soort artikel</label>
        <select name="onderCategorie" id="onderCategorie">
          <?php foreach($categorien as $categorie => $index): ?>
          <option value="<?php echo $index ?>" <?php
              if (!empty($_POST['onderCategorie']) && $_POST['onderCategorie'] == $index) {
                echo 'selected';
              }
            ?>><?php echo $categorie ?></option>
          <?php endforeach; ?>
        </select>
      </div>
      <div class="boxesGrid">
        <h3>Leeftijdsgroep</h3>
        <div class="inputFieldDivSoort">
        <?php $leeftijden = array("Baby's" => "babies", "Meisjes" => "meisjes", "Jongens" => "jongens"); ?>
          <?php foreach($leeftijden as $leeftijd => $index): ?>
            <input type="radio" name="leeftijd" id="radio<?php echo $index; ?>" value="<?php echo $index; ?>" <?php
              if (!empty($_POST['leeftijd']) && $_POST['leeftijd'] == $leeftijd || $index == "babies") {
                echo 'checked';
              }
            ?>>
            <label for="radio<?php echo $index; ?>"><?php echo $leeftijd; ?></label>
          <?php endforeach; ?>
          <?php
          if (!empty($_POST) && empty($_POST['leeftijd'])) {
            echo '<span class="error">gelieve een leeftijd te selecteren</span>';
          }
          ?>
        </div>
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
      <div class="boxesGrid">
        <h3>Soort stof</h3>
        <div class="inputFieldDivSoort">
          <?php foreach($soortenStof as $soortStof => $index): ?>
            <input type="radio" name="stofSoort" id="radio<?php echo $index; ?>" value="<?php echo $soortStof; ?>" <?php
              if (!empty($_POST['stofSoort']) && $_POST['stofSoort'] == $soortStof || $soortStof == "Tricot") {
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
        <label for="stofLengte">Nodige lengte (in m)</label>
        <input type="text" name="stofLengte" placeholder="1" value="<?php
          if (!empty($_POST['stofLengte'])) {
            echo $_POST['stofLengte'];
          }
          ?>" />
          <?php
          if (!empty($_POST) && empty($_POST['stofLengte'])) {
            echo '<span class="error">gelieve een stofLengte in te vullen</span>';
          }
          ?>
      </div>
      <div class="inputFieldDiv2">
        <label for="stofBreedte">Nodige breedte (in m)</label>
        <input type="text" name="stofBreedte" placeholder="1" value="<?php
          if (!empty($_POST['stofBreedte'])) {
            echo $_POST['stofBreedte'];
          }
          ?>" />
          <?php
          if (!empty($_POST) && empty($_POST['stofBreedte'])) {
            echo '<span class="error">gelieve een stofBreedte in te vullen</span>';
          }
          ?>
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
