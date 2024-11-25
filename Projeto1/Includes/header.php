<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css"> 
    <link rel="stylesheet" href="../Assets/css/header.css">
    <script src="../Assets/js/header.js" defer></script>

    <title>CN Tech</title>
</head>
<header>
    <h1>CN Tech</h1> 

    <!--Menu de login e cadastro-->
    <button class="slide-button" id="toggleMenuBtn"><i class="bi bi-person-fill"></i></button>

    <ul class="dropdown-menu" id="menuOptions">
        <li id="registerOption">Cadastrar</li>
        <li id="loginOption">Login</li>
    </ul>

    <!--Barra de pesquisa-->
    <form action="resultados.php" method="GET" class="search-tech">
    <input type="text" name="query" placeholder="Digite sua pesquisa..." required>
    <button type="submit"><i class="bi bi-search"></i></button>
  </form>

  <!--Carrinho de compra-->
  <div class="cart-container">
    <i class="bi bi-bag cart-icon"></i>
    <span class="item-count">2</span>
</div>

<!--Lista de informação-->
    <nav>
      <ul>
        <li><a href="#home">Início</a></li>
        <li><a href="#sobre">Sobre</a></li>
        <li><a href="#servicos">Serviços</a></li>
        <li><a href="#contato">Contato</a></li>
      </ul>
    </nav>
 </header>


</body>
</html>