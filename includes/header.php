<header>
  <div class="container">
    <div class="header_logo">
      <a href="index.php">
        <img src="media/logo_stonks.png" alt>
      </a>
    </div>
    <nav>
      <a href="listaJuegos.php">TIENDA</a>
      <a href="#">PERFIL</a>
      <a href="#">BIBLIOTECA</a>
      <?php if(isset($_SESSION['userNickName'])) {
        echo ("<a href=\"#\">" . $_SESSION['userNickName'] . "</a>");
      }else {
        echo ("<a href=\"userLogin.php\">INGRESAR</a>");
      } ?>
      
    </nav>
  </div>
</header>
