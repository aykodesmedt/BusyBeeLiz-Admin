<?php
  $soortFournituur = array("Garen", "Biaislint", "Ritsen", "Paspel", "Lint", "Knopen", "Elastiek", "Handtas", "Opstrijklabel", "Boord", "Keperband", "Sierelastiek", "Patroonpapier");
  $formKleuren = array("1"=>"Rood", "2"=>"Blauw", "3"=>"Geel", "4"=>"Zwart", "5"=>"Wit", "6"=>"Groen", "7"=>"Beige", "8"=>"Paars", "9"=>"Bruin");
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
        <li <?php if(empty($_GET["soort"])){
          echo 'class="onderCategorie menu_active"';
        }else{
          echo 'class="onderCategorie"';
        } ?>>
          <a href="index.php?page=fournituren<?php if(!empty($_GET["kleur"])){
            echo '&amp;kleur=' . $_GET["kleur"];
          }; ?>">Alles</a>
        </li>
        <?php foreach($soortFournituur as $soort): ?>
        <li class="verticalLine"></li>
        <li <?php if(!empty($_GET["soort"]) && $_GET["soort"] == $soort){
          echo 'class="onderCategorie menu_active"';
        }else{
          echo 'class="onderCategorie"';
        } ?>>
          <a href="index.php?page=fournituren&amp;soort=<?php echo $soort ?><?php if(!empty($_GET["kleur"])){
            echo '&amp;kleur=' . $_GET["kleur"];
          }; ?>"><?php echo $soort ?></a>
        </li>
        <?php endforeach; ?>
      </ul>
    </div>
  </div>
  <ul class="kleurenUl">
    <li <?php if(empty($_GET["kleur"])){ echo 'class="activeColorFilter"';}; ?>>
      <a href="index.php?page=fournituren<?php if(!empty($_GET["kleur"])){
        echo '&amp;kleur=' . $_GET["kleur"];
      }; ?>">Alles</a>
    </li>
    <?php foreach($kleuren as $kleur): ?>
      <li <?php if(!empty($_GET["kleur"]) && $_GET["kleur"] == $kleur["kleur"]){ echo 'class="activeColorFilter"';}; ?>>
        <a href="index.php?page=fournituren<?php if(!empty($_GET["soort"])){
          echo '&amp;soort=' . $_GET["soort"];
        }; ?>&amp;kleur=<?php echo $kleur["kleur"]; ?>"><div class="<?php echo $kleur["kleur"]; ?>Hexagon"></div><?php echo $kleur["kleur"]; ?></a>
      </li>
    <?php endforeach; ?>
  </ul>
</section>
<section class="mainSection">
  <section class="stofResultatenSection">
    <?php
      if(count($fournituren) == 0){
        echo "<p>er zijn geen producten gevonden</p>";
      }else{
        ?>
        <p class="aantalResultaten"><?php echo count($fournituren); ?> producten</p>
        <div class="stofResultatenDiv">
          <?php
            foreach ($fournituren as $fournituur):
          ?>
            <article class="stofResultaat">
              <div class="resultaat_img">
                <img src="<?php echo $fournituur["image"]; ?>" alt="" width="115" height="115">
                <div>
                  <div class="resultaten__div">
                    <div class="fournituur__info__div">
                      <p><?php echo $fournituur["stuks"]; ?> stuks</p>
                      <p><?php echo $fournituur["lengte"]; ?></p>
                    </div>
                    <div class="fournituur__icon__div">
                      <a href="index.php?page=editFournituur&action=updateFournituur&id=<?php echo $fournituur['id']; ?>">
                        <img src="./assets/img/icons/edit.png" alt="" width="18" height="18">
                      </a>
                      <a href="index.php?page=fournituren&id=<?php echo $fournituur["id"]; ?>&action=delete">
                        <img src="./assets/img/icons/delete.png" alt="" width="14" height="18">
                      </a>
                    </div>
                  </div>
                  <div class="resultaat__tag">
                    <span class="tag"><?php echo $fournituur["soort"]; ?></span>
                    <span class="tag"><?php echo $fournituur["kleur"]; ?></span>
                  </div>
                </div>
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
    <form action="index.php?page=fournituren" method="post" enctype="multipart/form-data" class="itemInfo stofForm">
      <h2><b>Fournituur toevoegen</b></h2>
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
      <div class="boxesGrid">
        <h3>Soort</h3>
        <div class="inputFieldDivSoort">
          <?php foreach($soortFournituur as $index => $fournituur): ?>
            <input type="radio" name="soort" id="radio<?php echo $index; ?>" value="<?php echo $fournituur; ?>" <?php
              if (!empty($_POST['soort']) && $_POST['soort'] == $fournituur || $fournituur == "Garen") {
                echo 'checked';
              }
            ?> >
            <label for="radio<?php echo $index; ?>"><?php echo $fournituur; ?></label>
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
              if (!empty($_POST['kleur']) && $_POST['kleur'] == $kleur || $kleur == "Rood") {
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
          }
          ?>" />
          <?php
          if (!empty($_POST) && empty($_POST['lengte'])) {
            echo '<span class="error">gelieve een lengte in te vullen</span>';
          }
          ?>
      </div>
      <input type="hidden" name="action" value="upload">
      <button class="yellowButton" type="submit">Toevoegen</button>
    </form>
  </section>
</section>
