<?php
  $onderCategorien = array("Jurken"=>"jurken", "Tops & T-shirts"=>"topsandshirts", "Rokken"=>"rokken", "Truien"=>"truien", "Vesten"=>"vesten", "Broeken"=>"broeken", "Blouses"=>"blouses", "Accessoires"=>"accessoires");
  $soortenStof = array("Jersey" => 1, "Katoen" => 2, "Katoen Lycra" => 3, "Katoen Tricot" => 4, "Viscose" => 5, "Jeans" => 6, "Polyester" => 7, "Sweater" => 8, "Voile" => 9, "Kant" => 10, "Velours" => 11, "Babyrib" => 12, "Gebreid" => 13, "Punta di Roma" => 14, "French Terry" => 15, "Jassen" => 16, "Overig" => 17);
?>
<button onclick="history.go(-1);" class="backButton" >Overzicht</button>
<section >
  <form action="index.php?page=detail&id=<?php echo $artikel['id']; ?>" method="post" class="detailSection">
    <section class="imageSection">
      <?php if(!empty($artikel["image1"])): ?>
        <img src="<?php echo $artikel["image1"]; ?>" alt="..." width="285" height="415" />
        <input type="hidden" name="imageEen" value="<?php echo $artikel["image1"]; ?>">
      <?php endif; ?>
      <?php if(!empty($artikel["image2"])): ?>
        <img src="<?php echo $artikel["image2"]; ?>" alt="..." width="285" height="415" />
        <input type="hidden" name="imageTwee" value="<?php echo $artikel["image2"]; ?>">
      <?php endif; ?>
      <?php if(!empty($artikel["image3"])): ?>
        <img src="<?php echo $artikel["image3"]; ?>" alt="..." width="285" height="415" />
        <input type="hidden" name="imageDrie" value="<?php echo $artikel["image3"]; ?>">
      <?php endif; ?>
      <?php if(!empty($artikel["image4"])): ?>
        <img src="<?php echo $artikel["image4"]; ?>" alt="..." width="285" height="415" />
        <input type="hidden" name="imageVier" value="<?php echo $artikel["image4"]; ?>">
      <?php endif; ?>
      <?php if(!empty($artikel["image5"])): ?>
        <img src="<?php echo $artikel["image5"]; ?>" alt="..." width="285" height="415" />
        <input type="hidden" name="imageVijf" value="<?php echo $artikel["image5"]; ?>">
      <?php endif; ?>
      <?php if(!empty($artikel["image6"])): ?>
        <img src="<?php echo $artikel["image6"]; ?>" alt="..." width="285" height="415" />
        <input type="hidden" name="imageZes" value="<?php echo $artikel["image6"]; ?>">
      <?php endif; ?>
    </section>
    <section class="infoSection">
      <div class="itemInfoDetail">
        <input type="hidden" name="categorie" value="<?php echo $artikel['categorie']; ?>">
        <input type="hidden" name="leeftijd" value=" ">
        <div class="inputFieldDiv">
        <label for="titel">Titel</label>
        <input type="text" name="titel" placeholder="1" value="<?php
          if (!empty($_POST['titel'])) {
            echo $_POST['titel'];
          }else{
            echo $artikel['titel'];
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
            }else{
              echo $artikel['beschrijving'];
            }
            ?></textarea>
            <?php
            if (!empty($_POST) && empty($_POST['beschrijving'])) {
              echo '<span class="error">gelieve een beschrijving in te vullen</span>';
            }
            ?>
        </div>
        <input type="hidden" name="action" value="update">
        <!-- <input type="submit" value="upload" class="yellowButton"> -->
        <!-- <button class="yellowButton" type="submit">Updaten</button> -->
      </div>
    </section>
  </form>
</section>
<section class="comment__section">
  <h3 class="boldTitel">Comments</h3>
  <div class="comment__div">
    <?php foreach($comments as $comment): ?>
      <article class="comment__article">
        <div class="comment_info_div">
          <div>
            <h4 class="smallTitel"><?php echo $comment['naam']; ?></h4>
            <p><?php echo $comment['email']; ?></p>
            <p><?php echo $comment['boodschap']; ?></p>
          </div>
          <a href="index.php?page=detail&id=<?php echo $artikel['id']; ?>&action=delete&commentId=<?php echo $comment['id']; ?>">
            <span><?php echo $comment['id']; ?></span>
            <img src="./assets/img/icons/delete.png" alt="" width="14" height="18">
          </a>
        </div>
        <?php
          if(!empty($comment['reden'])){
            $redenen = explode(",", $comment['reden']);
            array_pop($redenen);
            foreach($redenen as $reden): ?>
              <span class="tag"><?php echo $reden ?></span>
            <?php endforeach;
          } else {
            ?>
              <span>Er werden geen redenen gegeven.</span>
            <?php
          }
        ?>
      </article>
    <?php endforeach; ?>
  </div>
</section>
