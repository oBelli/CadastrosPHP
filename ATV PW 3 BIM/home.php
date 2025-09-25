<?php
session_start();
if (!isset($_SESSION['usuario'])) {
  header("Location: index.html");
  exit;
}
$usuario = $_SESSION['usuario'];
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <title>Início</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    :root {
      --laranja: #FF6B35;
      --preto: #000000;
      --cinza: #f5f5f5;
    }
    
    body {
      font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif;
      background-color: var(--cinza);
      margin: 0;
      color: var(--preto);
    }

    .navbar {
      background-color: var(--preto);
      border-bottom: 3px solid var(--laranja);
    }

    .navbar-brand {
      color: white !important;
      font-weight: 600;
    }

    .nav-link {
      color: white !important;
    }

    .nav-link.active {
      color: var(--laranja) !important;
      font-weight: 500;
    }

    .container {
      max-width: 1200px;
      margin: 30px auto;
      padding: 0 20px;
    }

    .card {
      border: 1px solid #ddd;
      border-radius: 8px;
      margin-bottom: 20px;
      box-shadow: 0 2px 4px rgba(0,0,0,0.1);
    }

    .card-header {
      background-color: var(--preto);
      color: white;
      border-bottom: 2px solid var(--laranja);
      padding: 15px 20px;
      font-weight: 500;
    }

    .user-info {
      background: white;
      padding: 30px;
      text-align: center;
    }

    .info-item {
      display: flex;
      justify-content: space-between;
      padding: 10px 0;
      border-bottom: 1px solid #eee;
    }

    .info-item:last-child {
      border-bottom: none;
    }

    .label {
      font-weight: 500;
      color: var(--preto);
    }

    .value {
      color: #666;
    }
  </style>
</head>

<body>
  <nav class="navbar navbar-expand-lg">
    <div class="container-fluid">
      <a class="navbar-brand" href="home.php">SISTEMA DE CONTATOS</a>
      <div class="navbar-nav">
        <a class="nav-link active" href="home.php">Início</a>
        <a class="nav-link" href="contatos.php">Contatos</a>
        <a class="nav-link" href="logout.php">Sair</a>
      </div>
      <span class="navbar-text text-white">
        Usuário: <strong><?php echo htmlspecialchars($usuario['nome']); ?></strong>
      </span>
    </div>
  </nav>

  <div class="container">
    <div class="card">
      <div class="card-header">Informações do Usuário</div>
      <div class="user-info">
        <h4><?php echo htmlspecialchars($usuario['nome']); ?></h4>
        <p class="text-muted">Usuário do sistema</p>
        
        <div class="info-list">
          <div class="info-item">
            <span class="label">Login:</span>
            <span class="value"><?php echo htmlspecialchars($usuario['login']); ?></span>
          </div>
          <div class="info-item">
            <span class="label">Email:</span>
            <span class="value"><?php echo htmlspecialchars($usuario['email']); ?></span>
          </div>
          <div class="info-item">
            <span class="label">Telefone:</span>
            <span class="value"><?php echo htmlspecialchars($usuario['telefone']); ?></span>
          </div>
        </div>
      </div>
    </div>
  </div>
</body>
</html>