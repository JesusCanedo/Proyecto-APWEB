<header>
  <div class="container">
    <div class="header_logo">
      <a href="index.php">
        <img src="media/logo_stonks.png" alt>
      </a>
    </div>
    <nav>
      <a href="#">TIENDA</a>
      <a href="#">PERFIL</a>
      <a href="index.php?logout=true">BIBLIOTECA</a>
      <?php if(isset($_SESSION['userNickName'])) {
        echo ("<a href=\"#\">" . $_SESSION['userNickName'] . "</a>");
      }else {
        echo ("<a href=\"userLogin.php\">INGRESAR</a>");
      }
      if(isset($_SESSION['userNickName'])) {
        echo ("<a href=\"#\">logout</a>");
      }
       
       
       ?>

      
    </nav>
  </div>
</header>
