<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css"> 
    <link rel="stylesheet" href="../Assets/css/header.css"> <!-- Carregue primeiro o CSS do cabeçalho -->
    <script src="../Assets/js/header.js" defer></script>
    <title>CN Tech</title>
</head>
<header class="text-header">
    <h1 class="site-title">
      <a href="index.php">CN Tech</a>
  </h1> 


<p class="text-perfil"><a href="perfil.php">Meu Perfil</a></p>
<p class="text-logout"><a href="../pages/index.php">Logout</a></p>

    <!--Barra de pesquisa-->
    <form action="resultados.php" method="GET" class="search-tech">
    <input type="text" name="query" placeholder="Digite sua pesquisa..." required>
    <button type="submit"><i class="bi bi-search"></i></button>
  </form>

  
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