<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="icon" href="img/ProdGraph.ico">
    <link rel='stylesheet' href='styles/index.css'>
</head>
<body>
    <!-- Sistema de login -->
    <div class="container">
        <img src="img/logo.svg" alt="ProdGraph Logo" class="logo" style="position: absolute; left: 50%; transform: translateX(-50%); top: 2%;">
        <p class="subtitle">
            
    <form class="form" method="post" action="login.php">
       <p class="form-title">Entre na sua conta!</p>
        <div class="input-container">
          <input type="email" placeholder="Digite o E-mail" required name="email">
      </div>
      <div class="input-container">
          <input type="password" placeholder="Digite a senha" required name="senha" id="pwd">
      </div>
      <input type="submit" value="Entrar" class="submit">
   </form>

</body>
</html>