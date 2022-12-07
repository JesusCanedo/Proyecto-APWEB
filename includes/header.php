<<<<<<< HEAD
<header>
  <div class="container">
    <div class="header_logo">
      <a href="/index.php">
        <img src="media/logo_stonks.png" alt>
      </a>
    </div>
    <nav>
      <a href="#">TIENDA</a>
      <a href="#">PERFIL</a>
      <a href="#">BIBLIOTECA</a>
      <?php if(isset($_SESSION['userNickName'])) {
        echo ("<a href=\"#\">" . $_SESSION['userNickName'] . "</a>");
      }else {
        echo ("<a href=\"#\">INGRESAR</a>");
      } ?>
      
    </nav>
  </div>
</header>
=======
        <header>
        <div class="container">
          <div class="header_logo">
            <a href="index.php">
              <img src="media/logo_stonks.png" alt>
            </a>
          </div>
          <nav>
            <a href="#nuestro-catalago">TIENDA</a>
            <a href="#Instalar">PERFIL</a>
            <a href="#final">BIBLIOTECA</a>
            
          </nav>
        </div>
        </header>
>>>>>>> 46979f6fb2d587302fa4304e48d5aae06b8683cd
