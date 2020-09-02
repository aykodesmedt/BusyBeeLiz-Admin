<?php
  $categorien = array("Jurken"=>"jurken", "Tops & T-shirts"=>"topsandshirts", "Rokken"=>"rokken", "Truien"=>"truien", "Vesten"=>"vesten", "Broeken"=>"broeken", "Blouses"=>"blouses", "Accessoires"=>"accessoires");
  $soortenStof = array("Jersey" => 1, "Katoen" => 2, "Katoen Lycra" => 3, "Katoen Tricot" => 4, "Viscose" => 5, "Jeans" => 6, "Polyester" => 7, "Sweater" => 8, "Voile" => 9, "Kant" => 10, "Velours" => 11, "Babyrib" => 12, "Gebreid" => 13, "Punta di Roma" => 14, "French Terry" => 15, "Jassen" => 16, "Overig" => 17);

?>
<section>
  <div class="artikelsHeader">
    <img src="./assets/img/dames.png" alt="..." width="285" height="247" />
    <div>
      <div class="headerTitelSearch">
        <h2 class="boldTitel"><?php echo $title; ?></h2>
      </div>
      <p class="yellowLineArtikels"></p>
      <!-- <ul class="onderCategorieUl">
        <li <?php if(empty($_GET["onderCategorie"])){
          echo 'class="onderCategorie menu_active"';
        }else{
          echo 'class="onderCategorie"';
        } ?>>
          <a href="index.php?page=dames<?php if(!empty($_GET["kleur"])){
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
            <a href="index.php?page=dames&amp;onderCategorie=<?php echo $categorie_value ?><?php if(!empty($_GET["kleur"])){
              echo '&amp;kleur=' . $_GET["kleur"];
            }; ?>"><?php echo $categorie ?></a>
          </li>
        <?php endforeach; ?>
      </ul> -->
    </div>
  </div>
  <!-- <ul class="kleurenUl">
    <li <?php if(empty($_GET["kleur"])){ echo 'class="activeColorFilter"';}; ?>>
      <a href="index.php?page=dames<?php if(!empty($_GET["onderCategorie"])){
        echo '&amp;onderCategorie=' . $_GET["onderCategorie"];
      }; ?>">Alles</a>
    </li>
    <?php foreach($kleuren as $kleur): ?>
      <li <?php if(!empty($_GET["kleur"]) && $_GET["kleur"] == $kleur["kleur"]){ echo 'class="activeColorFilter"';}; ?>>
        <a href="index.php?page=dames<?php if(!empty($_GET["onderCategorie"])){
          echo '&amp;onderCategorie=' . $_GET["onderCategorie"];
        }; ?>&amp;kleur=<?php echo $kleur["kleur"]; ?>"><div class="<?php echo $kleur["kleur"]; ?>Hexagon"></div><?php echo $kleur["kleur"]; ?></a>
      </li>
    <?php endforeach; ?>
  </ul> -->
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
              <a href="index.php?page=dames&id=<?php echo $artikel["id"]; ?>&action=delete" class="resultaatDelete">
                <img src="./assets/img/icons/delete.png" alt="" width="14" height="18">
              </a>
              <a href="index.php?page=detail&amp;id=<?php echo $artikel["id"]; ?>">
                <article class="resultaat">
                <div>
                  <?php if(!empty($artikel["image1"])): ?>
                    <img src="<?php echo $artikel["image1"]; ?>" alt="" width="148" height="148" class="resultaatImg">
                  <?php else: ?>
                    <img src="./assets/img/kledingItem.png" alt="" width="148" height="148" class="resultaatImg">
                  <?php endif; ?>
                    <img src="./assets/img/decoration/yellowDotsSmall.png" alt="" width="112" height="52" class="resultaatDeco">
                </div>
                  <div class="resultaatP">
                    <p><?php echo $artikel["titel"]; ?></p>
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
    <form action="index.php?page=gepersonaliseerdeArtikelen" method="post" enctype="multipart/form-data" class="itemInfo">
      <input type="text" name="categorie" class="hidden" value="gepersonaliseerdeArtikelen" />
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
      <input type="hidden" name="action" value="upload">
      <!-- <input type="submit" value="upload" class="yellowButton"> -->
      <button class="yellowButton" type="submit">Toevoegen</button>
    </form>
  </section>
</section>
