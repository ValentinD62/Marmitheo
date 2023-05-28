
<header>
  <div id="a">
    <nav id="primary_nav_wrap">

      <ul>

        <li id="MainMenu"><a href="#"></a>
          <p id="menu"> Menu</p>
          <ul>
            <li><a href="acceuil.php">Accueil</a></li>
            <li><a href="recherche_avancee.php">Recherche avancée</a></li>
            <li><a href="#">??</a></li>
            <li><a href="#">??</a>


            <li><a href="#">??</a></li>
          </ul>
        </li>
      </ul>
    </nav>
  </div>



  <div id="marmitheo">
      <a href = "acceuil.php">MarmiThéo</a>
  </div>
  <div id="hand">
    <img src="../img/hand21.png">
  </div>
    
  <form method='post' action = 'recherche.php' id="form-rech" >
        <input type="text" id="rech" name="recherche" placeholder="Cherchez une recette avec un nom, un tag...">
  </form>

    <?php
    if (isset($_SESSION['name'])) :?>
        <a href = "logout.php" id="header-a-log">
            <button id="Login">
                Logout
            </button>
        </a>
    <?php else :?>
        <a href = "login.php" id="header-a-log">
            <button id="Login">
                Login
            </button>
        </a>
    <?php
    endif;
    ?>

</header>

