<!DOCTYPE html>
<html lang="nl">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="icon" src="./assets/img/icons/icon.png">
  <!-- <script>
    WebFontConfig = {
      custom: {
        families: ['Montserrat', 'Gobold'],
        urls: ['./assets/fonts/fonts.css']
      }
    };

    (function(d) {
      var wf = d.createElement("script"),
        s = d.scripts[0];
      wf.src =
        "https://ajax.googleapis.com/ajax/libs/webfont/1.6.26/webfont.js";
      wf.async = true;
      s.parentNode.insertBefore(wf, s);
    })(document);
  </script> -->
      <title>Busybeeliz</title>
      <?php echo $css;?>
  </head>
  <body>
    <header>
      <nav id="menu">
        <ul>
          <li>
            <a href="index.php" class="logo">
              <h1 class="hidden">Busy Bee Liz</h1>
              <img src="./assets/img/logos/busybeeliz.png" alt="">
            </a>
          </li>
          <li class="<?php
                  if($currentPage == 'gepersonaliseerdeArtikelen'){
                    echo 'categorie menu_active"';
                    echo 'aria-describedby="current"';
                  }else {
                    echo 'categorie';
                  }
                ?>">
            <a href="index.php?page=gepersonaliseerdeArtikelen">Gepersonaliseerde Artikelen</a>
          </li>
          <li class="verticalLine"></li>
          <li class="<?php
                  if($currentPage == 'doeHetZelf'){
                    echo 'categorie menu_active"';
                    echo 'aria-describedby="current"';
                  }else {
                    echo 'categorie';
                  }
                ?>">
            <a href="index.php?page=doeHetZelf">Doe Het Zelf</a>
          </li>
          <li class="verticalLine"></li>
          <li class="<?php
                  if($currentPage == 'kledingcollectie'){
                    echo 'categorie menu_active"';
                    echo 'aria-describedby="current"';
                  }else {
                    echo 'categorie';
                  }
                ?>">
            <a href="index.php?page=kledingcollectie">Kledingcollectie</a>
          </li>
          <!-- <li class="verticalLine"></li>
          <li class="<?php
                  if($currentPage == 'cadeaus'){
                    echo 'categorie menu_active"';
                    echo 'aria-describedby="current"';
                  }else {
                    echo 'categorie';
                  }
                ?>">
            <a href="index.php?page=cadeaus">Cadeaus</a>
          </li> -->
          <li class="verticalLine"></li>
          <li class="<?php
                  if($currentPage == 'stoffen'){
                    echo 'categorie menu_active"';
                    echo 'aria-describedby="current"';
                  }else {
                    echo 'categorie';
                  }
                ?>">
            <a href="index.php?page=stoffen">Stoffen</a>
          </li>
          <li class="verticalLine"></li>
          <li class="<?php
                  if($currentPage == 'patronen'){
                    echo 'categorie menu_active"';
                    echo 'aria-describedby="current"';
                  }else {
                    echo 'categorie';
                  }
                ?>">
            <a href="index.php?page=patronen">Patronen</a>
          </li>
          <li class="verticalLine"></li>
          <li class="<?php
                  if($currentPage == 'fournituren'){
                    echo 'categorie menu_active"';
                    echo 'aria-describedby="current"';
                  }else {
                    echo 'categorie';
                  }
                ?>">
            <a href="index.php?page=fournituren">Fournituren</a>
          </li>
        </ul>
      </nav>
    </header>
    <main>
        <?php echo $content; ?>
    </main>
    <footer>
      <div>
        <h2 class="boldTitel">Social Media</h2>
        <p class="yellowLine"></p>
        <ul>
          <li>
            <a href="https://www.facebook.com/busybeeliz1/">
              <img src="./assets/img/logos/facebook.png" alt="" width="50" height="50">
            </a>
          </li>
          <li>
            <a href="https://www.instagram.com/busy_bee_liz/">
              <img src="./assets/img/logos/instagram.png" alt="" width="50" height="50">
            </a>
          </li>
          <li>
            <a href="https://www.etsy.com/nl/?ref=lgo">
              <img src="./assets/img/logos/etsy.png" alt="" width="50" height="50">
            </a>
          </li>
          <li>
            <a href="https://www.vinted.be/membres/21437354-busybeelizfashion">
              <img src="./assets/img/logos/vinted.png" alt="" width="50" height="50">
            </a>
          </li>
          <li>
            <a href="https://www.pinterest.com/busybeelizfashion/">
              <img src="./assets/img/logos/pinterest.png" alt="" width="50" height="50">
            </a>
          </li>
          <li>
            <a href="https://www.ravelry.com/">
              <img src="./assets/img/logos/ravelry.png" alt="" width="50" height="50">
            </a>
          </li>
        </ul>
      </div>
    </footer>
    <?php echo $js; ?>
  </body>
</html>
