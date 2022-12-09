<header>
  <div class="container">
    <div class="header_logo">
      <a href="index.php">
        <img src="media/logo_stonks.png" alt>
      </a>
    </div>
    <nav>
      <a href="#">TIENDA</a>
      <?php if(isset($_SESSION['userNickName'])) {
        echo ("<a href=\"infoUser.php\">" . $_SESSION['userNickName'] . "</a>");
        echo ("<a href=\"#\">Biblioteca</a>");
        echo ("<a href=\"index.php?logout=true\">Logout</a>");
      }else {
        echo ("<a href=\"userLogin.php\">INGRESAR</a>");
      }
      
       
       
       ?>

      
    </nav>
  </div>
</header>
