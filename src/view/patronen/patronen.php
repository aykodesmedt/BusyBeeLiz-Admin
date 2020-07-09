<?php
  $maanden = array("Jan" => 1, "Feb" => 2, "Maa" => 3, "Apr" => 4, "Mei" => 5, "Jun" => 6, "Jul" => 7, "Aug" => 8, "Sep" => 9, "Okt" => 10, "Nov" => 11, "Dec" => 12);
  $jaren = array("2004" => 1, "2012" => 2, "2013" => 3, "2014" => 4, "2015" => 5, "2016" => 6, "2017" => 7, "2018" => 8, "2019" => 9);
  $categorien = array("dames", "heren", "kinderen", "accessoires");
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
          <a href="index.php?page=patronen<?php if(!empty($_GET["stofSoort"])){
            echo '&amp;stofSoort=' . $_GET["stofSoort"];
          }; ?>">Alles</a>
        </li>
        <?php foreach($categorien as $categorie): ?>
          <li class="verticalLine"></li>
          <li <?php if(!empty($_GET["categorie"]) && $_GET["categorie"] == $categorie){
            echo 'class="onderCategorie menu_active"';
          }else{
            echo 'class="onderCategorie"';
          } ?>>
            <a href="index.php?page=patronen&amp;categorie=<?php echo $categorie; ?>"><?php echo $categorie; ?></a>
          </li>
        <?php endforeach; ?>
      </ul>
    </div>
  </div>
  <form action="index.php?page=patronen<?php if(!empty($_GET["categorie"])){ echo "&categorie=" . $categorie; }; ?>" class="patroon">
    <input type="hidden" name="page" value="patronen" />
    <?php if(!empty($_GET["categorie"])): ?>
      <input type="hidden" name="categorie" value="<?php echo $categorie; ?>">
    <?php endif; ?>
    <input type="hidden" name="action" value="filter" />
    <div class="filter__div">
      <div>
        <input type="radio" name="boekFilter" id="boekFilter1" value="" <?php
          if($currentBoek == ""){
            echo 'checked';
          }
        ?> >
        <label for="boekFilter1">Alles</label>
      </div>
      <div>
        <input type="radio" name="boekFilter" id="boekFilter2" value="Knip" <?php
          // if (!empty($_POST['boek']) && $_POST['boek'] == 'Knip') {
          if($currentBoek == "Knip"){
            echo 'checked';
          }
        ?> >
        <label for="boekFilter2">Knip</label>
      </div>
      <div>
        <input type="radio" name="boekFilter" id="boekFilter3" value="Lmv" <?php
          // if (!empty($_POST['boek']) && $_POST['boek'] == 'Lmv') {
          //   echo 'checked';
          // }
          if($currentBoek == "Lmv"){
            echo 'checked';
          }
        ?> >
        <label for="boekFilter3">Lmv</label>
      </div>
      <div>
        <input type="radio" name="boekFilter" id="boekFilter4" value="Burda" <?php
          // if (!empty($_POST['boek']) && $_POST['boek'] == 'Burda') {
          //   echo 'checked';
          // }
          if($currentBoek == "Burda"){
            echo 'checked';
          }
        ?> >
        <label for="boekFilter4">Burda</label>
      </div>
    </div>
    <div class="filter__div">
      <div>
        <input type="radio" name="maandFilter" id="maand" value="" <?php
          if ($currentMaand == "") {
            echo 'checked';
          }
        ?> >
        <label for="maand">Alles</label>
      </div>
      <?php foreach($maanden as $maand => $index): ?>
        <div>
          <input type="radio" name="maandFilter" id="maand<?php echo $index; ?>" value="<?php echo $maand; ?>" <?php
            // if (!empty($_POST['maand']) && $_POST['maand'] == $maand) {
            //   echo 'checked';
            // }
            if($currentMaand == $maand){
              echo 'checked';
            }
          ?> >
          <label for="maand<?php echo $index; ?>"><?php echo $maand; ?></label>
        </div>
      <?php endforeach; ?>
    </div>
    <div class="filter__div">
      <div>
        <input type="radio" name="jaarFilter" id="jaar" value="" <?php
          if ($currentJaar == "") {
            echo 'checked';
          }
        ?> >
        <label for="jaar">Alles</label>
      </div>
      <?php foreach($jaren as $jaar => $index): ?>
        <div>
          <input type="radio" name="jaarFilter" id="jaar<?php echo $index; ?>" value="<?php echo $jaar; ?>" <?php
            // if (!empty($_POST['jaar']) && $_POST['jaar'] == $jaar) {
            //   echo 'checked';
            // }
            if($currentJaar == $jaar){
              echo 'checked';
            }
          ?> >
          <label for="jaar<?php echo $index; ?>"><?php echo $jaar; ?></label>
        </div>
      <?php endforeach; ?>
    </div>
    <!-- <input type="hidden" name="filter" value="filter"> -->
    <button class="yellowButton" type="submit">Filter</button>
  </form>
</section>
<section class="mainSection">
  <section class="stofResultatenSection">
    <?php
      if(count($patronen) == 0){
        echo "<p>er zijn geen producten gevonden</p>";
      }else{
        ?>
        <p class="aantalResultaten"><?php echo count($patronen); ?> producten</p>
        <div class="stofResultatenDiv">
          <?php
            foreach ($patronen as $patroon):
              ?>
                <article class="stofResultaat">
                  <div class="resultaat_img">
                    <img src="<?php echo $patroon["image"]; ?>" alt="" width="115" height="115">
                    <div>
                      <div class="resultaten__div">
                        <div class="fournituur__info__div">
                          <h3><?php echo $patroon["model"]; ?></h3>
                          <p><?php echo $patroon["categorie"]; ?></p>
                          <p><?php echo $patroon["maat"]; ?></p>
                        </div>
                        <div class="fournituur__icon__div">
                          <a href="index.php?page=editPatroon&id=<?php echo $patroon["id"]; ?>">
                            <img src="./assets/img/icons/edit.png" alt="" width="18" height="18">
                          </a>
                          <a href="index.php?page=patronen&id=<?php echo $patroon["id"]; ?>&action=delete">
                            <img src="./assets/img/icons/delete.png" alt="" width="14" height="18">
                          </a>
                        </div>
                      </div>
                      <div class="resultaat__tag">
                        <span class="tag"><?php echo $patroon["boek"]; ?></span>
                        <span class="tag"><?php echo $patroon["maand"]; ?></span>
                        <span class="tag"><?php echo $patroon["jaar"]; ?></span>
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
    <form action="index.php?page=patronen" method="post" enctype="multipart/form-data" class="itemInfo stofForm">
      <h2><b>Patroon toevoegen</b></h2>
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
          <input type="radio" name="boek" id="boek1" value="knip" <?php
              echo 'checked';
          ?> >
          <label for="boek1">Knip</label>
          <input type="radio" name="boek" id="boek2" value="Lmv" <?php
            if (!empty($_POST['boek']) && $_POST['boek'] == 'Lmv') {
              echo 'checked';
            }
          ?>>
          <label for="boek2">Lmv</label>
          <input type="radio" name="boek" id="boek3" value="burda" <?php
            if (!empty($_POST['boek']) && $_POST['boek'] == 'burda') {
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
              if (!empty($_POST['maand']) && $_POST['maand'] == $maand) {
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
              if (!empty($_POST['jaar']) && $_POST['jaar'] == $jaar) {
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
          <input type="radio" name="categorie" id="categorie4" value="accessoires" <?php
            if (!empty($_POST['categorie']) && $_POST['categorie'] == 'accessoires') {
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
      <input type="hidden" name="action" value="upload">
      <button class="yellowButton" type="submit">Toevoegen</button>
    </form>
  </section>
</section>
