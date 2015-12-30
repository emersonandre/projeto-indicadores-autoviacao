<!DOCTYPE html>
<html lang='PT-BR'>
<head>
    <meta charset="UTF-8" /> 
    <title>
        Projeto Indicadores
    </title>
    <link rel="stylesheet" type="text/css" href="bootstrap/css/style.css" />
</head>
<body>
<div class="divcenter">
<form method="post" action="valida.php">
  <h1>B E M - V I N D O</h1>
  <div class="inset">
  <p>
    <label for="email">Email ou Usuario</label>
    <input type="text" name="usuario" id="email">
  </p>
  <p>
    <label for="password">Senha</label>
    <input type="password" name="senha" id="password">
  </p>
  <p>
    <input type="checkbox" name="remember" id="remember">
    <label for="remember">lembrar meu usuario!</label>
  </p>
  </div>
  <p class="p-container">
    <span>Esqueceu sua Senha?</span>
    <input type="submit" name="go" id="go" value="Entrar">
  </p>
</form>
</div>
</body>
</html>