<?php
session_start();
if (!isset($_SESSION['usuario'])) {
  header("Location: index.html");
  exit;
}
$usuario = $_SESSION['usuario'];

function listarContatos()
{
  include "conecta.php";

  $stmt = $conn->query("SELECT * FROM tb_contato");

  if ($stmt && $stmt->rowCount() > 0) {
    echo "<div class='table-responsive'>";
    echo "<table class='table table-striped'>";
    echo "<thead>
            <tr>
              <th>Nome</th>
              <th>Login</th>
              <th>Email</th>
              <th>Telefone</th>
              <th>Ações</th>
            </tr>
          </thead>";
    echo "<tbody>";
    
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
      echo "<tr>";
      echo "<td>" . htmlspecialchars($row['nome']) . "</td>";
      echo "<td>" . htmlspecialchars($row['login']) . "</td>";
      echo "<td>" . htmlspecialchars($row['email']) . "</td>";
      echo "<td>" . htmlspecialchars($row['telefone']) . "</td>";
      echo "<td>
              <button class='btn btn-sm btn-warning botao-editar' 
                      data-id='" . htmlspecialchars($row['id']) . "' 
                      data-nome='" . htmlspecialchars($row['nome']) . "' 
                      data-login='" . htmlspecialchars($row['login']) . "' 
                      data-email='" . htmlspecialchars($row['email']) . "' 
                      data-telefone='" . htmlspecialchars($row['telefone']) . "' 
                      data-senha='" . htmlspecialchars($row['senha']) . "'>
                Editar
              </button>
              <button class='btn btn-sm btn-danger botao-excluir' data-id='" . htmlspecialchars($row['id']) . "'>
                Excluir
              </button>
            </td>";
      echo "</tr>";
    }
    
    echo "</tbody></table></div>";
  } else {
    echo "<p class='text-center'>Nenhum contato encontrado.</p>";
  }
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <title>Contatos</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
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
      max-width: 1400px;
      margin: 30px auto;
      padding: 0 20px;
    }

    .page-header {
      display: flex;
      justify-content: space-between;
      align-items: center;
      margin-bottom: 30px;
      padding-bottom: 15px;
      border-bottom: 2px solid var(--laranja);
    }

    .btn-primary {
      background-color: var(--laranja);
      border: none;
    }

    .btn-primary:hover {
      background-color: #E55A2B;
    }

    .table th {
      background-color: var(--preto);
      color: white;
      border-bottom: 2px solid var(--laranja);
    }

    .modal-header {
      background-color: var(--preto);
      color: white;
      border-bottom: 2px solid var(--laranja);
    }

    .btn-close {
      filter: invert(1);
    }
  </style>
</head>

<body>
  <nav class="navbar navbar-expand-lg">
    <div class="container-fluid">
      <a class="navbar-brand" href="home.php">SISTEMA DE CONTATOS</a>
      <div class="navbar-nav">
        <a class="nav-link" href="home.php">Início</a>
        <a class="nav-link active" href="contatos.php">Contatos</a>
        <a class="nav-link" href="logout.php">Sair</a>
      </div>
      <span class="navbar-text text-white">
        Usuário: <strong><?php echo htmlspecialchars($usuario['nome']); ?></strong>
      </span>
    </div>
  </nav>

  <div class="container">
    <div class="page-header">
      <div>
        <h1>Contatos</h1>
        <p class="text-muted">Gerencie seus contatos cadastrados</p>
      </div>
      <button class="btn btn-primary" id="botaoAdicionar">Adicionar Contato</button>
    </div>

    <?php listarContatos(); ?>
  </div>

  <!-- Modal -->
  <div class="modal fade" id="modalContato" tabindex="-1">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Adicionar Contato</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>
        <div class="modal-body">
          <form id="formContato">
            <div class="mb-3">
              <label class="form-label">Nome</label>
              <input type="text" class="form-control" id="nome">
              <div class="invalid-feedback" id="erroNome"></div>
            </div>
            <div class="mb-3">
              <label class="form-label">Login</label>
              <input type="text" class="form-control" id="login">
              <div class="invalid-feedback" id="erroLogin"></div>
            </div>
            <div class="mb-3">
              <label class="form-label">Email</label>
              <input type="email" class="form-control" id="email">
              <div class="invalid-feedback" id="erroEmail"></div>
            </div>
            <div class="mb-3">
              <label class="form-label">Telefone</label>
              <input type="text" class="form-control" id="telefone">
              <div class="invalid-feedback" id="erroTelefone"></div>
            </div>
            <div class="mb-3">
              <label class="form-label">Senha</label>
              <input type="password" class="form-control" id="senha">
              <div class="invalid-feedback" id="erroSenha"></div>
            </div>
            <div class="mb-3">
              <label class="form-label">Confirmar Senha</label>
              <input type="password" class="form-control" id="confirmarSenha">
              <div class="invalid-feedback" id="erroConfirmarSenha"></div>
            </div>
          </form>
        </div>
        <div class="modal-footer">
          <button class="btn btn-primary" id="botaoSalvar">Salvar</button>
          <button class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
        </div>
      </div>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
  <script>
    $(document).ready(function () {
      let editandoId = null;
      const modal = new bootstrap.Modal(document.getElementById('modalContato'));

      $("#botaoAdicionar").click(function () {
        editandoId = null;
        $("#formContato")[0].reset();
        $(".modal-title").text("Adicionar Contato");
        modal.show();
      });

      $(document).on('click', '.botao-editar', function () {
        editandoId = $(this).data('id');
        $(".modal-title").text("Editar Contato");
        $("#nome").val($(this).data('nome'));
        $("#login").val($(this).data('login'));
        $("#email").val($(this).data('email'));
        $("#telefone").val($(this).data('telefone'));
        $("#senha").val($(this).data('senha'));
        $("#confirmarSenha").val($(this).data('senha'));
        modal.show();
      });

      $(document).on('click', '.botao-excluir', function () {
        const id = $(this).data('id');
        if (confirm("Deseja realmente excluir este contato?")) {
          $.post("excluir.php", { id: id }, function () { 
            location.reload(); 
          });
        }
      });

      $("#telefone").on("input", function () {
        let v = $(this).val().replace(/\D/g, '');
        if (v.length > 2) v = `(${v.substring(0, 2)}) ${v.substring(2)}`;
        if (v.length > 10) v = `${v.substring(0, 10)}-${v.substring(10, 14)}`;
        $(this).val(v);
      });

      function validarFormulario() {
        let valido = true;
        $(".form-control").removeClass("is-invalid");

        const nome = $("#nome").val().trim();
        if (!nome) { $("#nome").addClass("is-invalid"); $("#erroNome").text("Por favor, insira o nome."); valido = false; }

        const login = $("#login").val().trim();
        if (!login) { $("#login").addClass("is-invalid"); $("#erroLogin").text("Por favor, insira o login."); valido = false; }

        const email = $("#email").val().trim();
        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        if (!emailRegex.test(email)) { $("#email").addClass("is-invalid"); $("#erroEmail").text("E-mail inválido."); valido = false; }

        const telefone = $("#telefone").val().replace(/\D/g, '');
        if (telefone.length < 10) { $("#telefone").addClass("is-invalid"); $("#erroTelefone").text("Telefone inválido."); valido = false; }

        const senha = $("#senha").val();
        const confirmar = $("#confirmarSenha").val();
        if (senha !== confirmar || senha.length === 0) {
          $("#senha,#confirmarSenha").addClass("is-invalid");
          $("#erroSenha").text("As senhas não coincidem ou estão vazias.");
          valido = false;
        }

        return valido;
      }

      $("#botaoSalvar").click(function (e) {
        e.preventDefault();
        if (validarFormulario()) {
          const formData = new FormData();
          formData.append("campo0", editandoId);
          formData.append("campo1", $("#nome").val());
          formData.append("campo2", $("#login").val());
          formData.append("campo3", $("#senha").val());
          formData.append("campo4", $("#email").val());
          formData.append("campo5", $("#telefone").val());

          $.ajax({
            url: editandoId ? "editar.php" : "cadastro.php",
            type: "POST",
            data: formData,
            processData: false,
            contentType: false,
            success: function () { 
              modal.hide(); 
              location.reload(); 
            },
            error: function () { 
              alert("Erro ao salvar o contato."); 
            }
          });
        }
      });
    });
  </script>
</body>
</html>