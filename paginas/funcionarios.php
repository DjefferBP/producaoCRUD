<?php
    session_start();
    if (!isset($_SESSION['usuario'])){
        header('Location: ../index.php');
    }
    $diretorioMeta = '../dadosProducao/meta.json';
    if (!isset($_SESSION['meta']) && file_exists($diretorioMeta)) {
        $meta = json_decode(file_get_contents($diretorioMeta), true);
        $_SESSION['meta'] = $meta;
    } elseif (!isset($_SESSION['meta'])) {
        $_SESSION['meta'] = [0]; 
    }
    if (!isset($_SESSION['nomesUser']) && file_exists('../dadosUserjson/emailUser.json')) {
        $nomesUser = json_decode(file_get_contents('../dadosUserjson/nomesUser.json'), true);
        $_SESSION['nomesUser'] = $nomesUser;
        $emailUser = json_decode(file_get_contents('../dadosUserjson/emailUser.json'), true);
        $_SESSION['emailUser'] = $emailUser;
    } elseif (!isset($_SESSION['nomesUser'])){
        $_SESSION['nomesUser'] = [];
        $_SESSION['emailUser'] = [];
    }
    if (!isset($_SESSION['nomeTrabalhador'])){
        $nomeTra = json_decode(file_get_contents('../jsons/nome.json'), true);
        $_SESSION['nomeTrabalhador'] = $nomeTra;
        $emailTra = json_decode(file_get_contents('../jsons/email.json'), true);
        $_SESSION['emailTrabalhador'] = $emailTra;
        $senhaTra = json_decode(file_get_contents('../jsons/senha.json'), true);
        $_SESSION['senhaTrabalhador'] = $senhaTra;
        $fotoTra = json_decode(file_get_contents('../jsons/foto.json'), true);
        $_SESSION['fotoTra'] = $fotoTra;
    }
    if (!isset($_SESSION['quantidades'])){
        $quantidade = json_decode(file_get_contents('../dadosUserjson/quantidades.json'), true);
        $_SESSION['quantidades'] = $quantidade;
        $prejuizo = json_decode(file_get_contents('../dadosUserjson/prejuizos.json'), true);
        $_SESSION['prejuizos'] = $prejuizo;
        $dataRegistro = json_decode(file_get_contents('../dadosUserjson/datasRegistros.json'), true);
        $_SESSION['datasRegistros'] = $dataRegistro;
        $horasRegistros = json_decode(file_get_contents('../dadosUserjson/horasRegistros.json'), true);
        $_SESSION['horasRegistros'] = $horasRegistros;
        $diasSemana = json_decode(file_get_contents('../dadosUserjson/diasSemanas.json'), true);
        $_SESSION['diasSemanas'] = $diasSemana;
        $cargasTrabalhos = json_decode(file_get_contents('../dadosUserjson/cargasTrabalhos.json'), true);
        $_SESSION['cargasTrabalhos'] = $cargasTrabalhos;
        $horas = json_decode(file_get_contents('../dadosUserjson/horas.json'), true);
        $_SESSION['horas'] = $horas;
    }
    $emailAdm = json_decode(file_get_contents('../jsons/emailadm.json'), true);
    $idxAdm = array_search($_SESSION['usuario'], $emailAdm);
    $diretorio = '../dadosProducao/tolerancia.json';
        if (!isset($_SESSION['tole']) && file_exists($diretorio)) {
        $tolerancia = json_decode(file_get_contents($diretorio), true);
        $_SESSION['tole'] = $tolerancia;
    } elseif (!isset($_SESSION['tole'])) {
        $_SESSION['tole'] = [2]; 
    }
    if (!isset($_SESSION['nomes'])) {
        if ($_SESSION['usuario'] == $emailAdm[$idxAdm]){ 
            $email = json_decode(file_get_contents("../jsons/emailadm.json"), true);
            $senha = json_decode(file_get_contents("../jsons/senhaadm.json"), true);
            $foto = json_decode(file_get_contents("../jsons/fotoadm.json"), true);
            $nome = json_decode(file_get_contents("../jsons/nomeadm.json"), true);
            $id = array_search($_SESSION['usuario'], $email); 
            $_SESSION['nomes'] = $nome;
            $_SESSION['emails'] = $email;
            $_SESSION['senhas'] = $senha;
            $_SESSION['fotos'] = $foto;
            $nomes = $nome;
            $emails = $email;
            $senhas = $senha;
            $fotos = $foto;
        }
        else {
            $emails = json_decode(file_get_contents("../jsons/email.json"), true);
            $senhas = json_decode(file_get_contents("../jsons/senha.json"), true);
            $fotos = json_decode(file_get_contents("../jsons/foto.json"), true);
            $nomes = json_decode(file_get_contents("../jsons/nome.json"), true);
            $id = array_search($_SESSION['usuario'], $emails);
            $_SESSION['nomes'] = $nomes;
            $_SESSION['emails'] = $emails;
            $_SESSION['senhas'] = $senhas;
            $_SESSION['fotos'] = $fotos;
        }
    } else {
        $emails = $_SESSION['emails'];
        $id = array_search($_SESSION['usuario'], $emails);
        $nomes = $_SESSION['nomes'];
        $fotos = $_SESSION['fotos'];
        $senhas = $_SESSION['senhas'];
    }
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="../img/ProdGraph.ico">
    <title>Dashboard da produção</title>
    <link rel="stylesheet" href="../styles/inicial.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</head>

<body>
    <!-- Sidebar do site -->
    <!-- Verificando se é o Adm ou o trabalhador que está logado -->
    <main class=main-container>
        <?php
            if ($_SESSION['usuario'] == $emailAdm[$idxAdm]){        
                echo '
                <div class="usuarioDiv">
                    <div class="cards-container">
                        <div class="profile-card">
                            <p>Bem vindo!</p>
                            <div class="profile-info">
                                <div class="profile-image profile-image-placeholder">
                                    <img ';

                if ($id !== false && isset($fotos[$id])) {
                    echo "src='../usuarios/" . $fotos[$id] . "'";
                }
                 else {
                    echo "src='../img/default.png'";
                }

                echo ' alt="Imagem do usuário">
                                </div>
                                <div class="nomeEDisplay">
                                    <div class="profile-title usuarioTitulo">Usuário</div>
                                    <p class="profile-name">' . (isset($nomes[$id]) ? $nomes[$id] : "Usuário não identificado") . '</p>
                                    <a href="../sair.php"><button class="btn-danger sair">Sair</button></a>
                                </div>
                            </div>
                        </div>

                        <div class="profile-card menu-card">
                            <div class="menu-options">
                                <div class="profile-title">Menu</div>
                                <hr>
                                <a href="../inicial.php">Produção</a>
                                <hr>
                                <a href="funcionarios.php">Funcionários</a>
                                <hr>
                                <a href="partidas.php">Partidas</a>
                            </div>
                        </div>

                        <div class="profile-card sobre-card">
                            <div class="sobre-options">
                                <div class="profile-title"><b>ⓘ</b> Sobre</div>
                                <hr>
                                <p>Dashboard da sua produção com indicativos gráficos, mostrando dados da sua produção, trabalhadores, retrabalho, defeitos e produção.</p>
                            </div>
                        </div>

                        <!-- Conteúdo principal do site -->
                        <div class="info">
                ';

                echo "<br/>";
                    echo "<br/>";
                    echo "<div class='card1'>
                            <div class='card_content'>
                                <span class='profile-title' style='font-size: 24px; font-weight: bold;'>Funcionários</span>";

                        echo "
                        <br>
                            <div class='pesquisarUsuario'>
                                <div class='formProcurar'>
                                    <form action='funcionarios.php' method='POST' style='display: flex; gap: 10px; align-items: center;'>
                                        <input class='form-control' type='text' name='pesquisar' placeholder='Insira o nome do trabalhador que deseja encontrar' value='" . (isset($_POST['pesquisar']) ? htmlspecialchars($_POST['pesquisar']) : "") . "' />
                                        <input type='submit' class='btn btn-primary' value='Buscar'/>
                                        ";
                                        if ( isset($_POST['pesquisar']) && $_POST['pesquisar'] !== "" && !isset($_POST['limpar'])) {
                                            echo "<button type='submit' name='limpar' value='1' class='btn btn-secondary' title='Limpar pesquisa' style='font-weight:bold;'>X</button>";
                                        }
                                    echo "
                                    </form>
                                </div>
                            </div>
                            ";
                            echo "<br>";
                            
                            echo "<form method='GET' action='funcionarios.php' style='display: flex; gap: 10px; align-items: center; '>";
                                echo "<select class='form-select' name='ordenar' style='width: 9.2em;'>";
                                    echo "<option value=''>Ordenar</option>";
                                    echo "<option value='nome'>Por Nome</option>";
                                    echo "<option value='email'>Por E-mail</option>";
                                echo "</select>";
                                echo "<input type='submit' class='btn btn-primary' value='Ordenar'/>";
                            
                            
                            echo"
                                <button type='button' class='btn btn-primary btncadastro' data-bs-toggle='modal' data-bs-target='#exampleModal'>
                                    Cadastrar novo trabalhador
                                </button>
                                <br>
                               ";
                               echo "</form>";
                            
                            echo "<table class='table table-hover text-center'>";
                                echo "<tr>
                                    <th>ID</th>
                                    <th>NOME</th>
                                    <th>E-MAIL</th>
                                    <th>AÇÕES</th>
                                </tr>";
                               $email = $_SESSION['emailTrabalhador'];
                               $nome = $_SESSION['nomeTrabalhador'];
                               $contagem = count($email);
                                $senhas = json_decode(file_get_contents('../jsons/senha.json'), true);
                                $senha = $senhas;
                                $usuarios = [];
                                $usuariosFiltrados = [];
                                for ($i = 0; $i < $contagem; $i++) {
                                    $usuariosFiltrados[] = [
                                        'id' => $i,
                                        'nome' => isset($nome[$i]) ? $nome[$i] : 'N/A',
                                        'email' => isset($email[$i]) ? $email[$i] : 'N/A',
                                    ];
                                }
                                $pesquisa = '';
                                if (isset($_POST['limpar'])) {
                                    for ($i = 0; $i < $contagem; $i++) {
                                        $usuarios[] = $i;
                                    }
                                } if (isset($_POST['pesquisar']) && $_POST['pesquisar'] !== "") {
                                    $pesquisa = $_POST['pesquisar'];
                                } elseif (isset($_GET['pesquisar']) && $_GET['pesquisar'] !== "") {
                                    $pesquisa = $_GET['pesquisar'];
                                }
                                if ($pesquisa !== '') {
                                    for ($i = 0; $i < $contagem; $i++) {
                                        if (stripos($nome[$i], $pesquisa) !== false) {
                                            $usuarios[] = $i;
                                            $usuariosFiltrados[] = [
                                                'id' => $i,
                                                'nome' => isset($nome[$i]) ? $nome[$i] : 'N/A',
                                                'email' => isset($email[$i]) ? $email[$i] : 'N/A',
                                            ];
                                        }
                                    }
                                }
                                elseif (isset($_GET['ordenar']) && $_GET['ordenar']) {
                                    $ordenar = $_GET['ordenar'];
                                    if ($ordenar == '') {
                                        for ($i = 0; $i < $contagem; $i++) {
                                            $usuarios[] = $i;
                                        }
                                    } elseif ($ordenar == 'nome') {
                                        usort($usuariosFiltrados, function($a, $b) {
                                            return strcmp($a['nome'], $b['nome']);
                                        });
                                    } elseif ($ordenar == 'email'){
                                        usort($usuariosFiltrados, function($a, $b) {
                                            return strcmp($a['email'], $b['email']);
                                        });
                                    }
                                }
                                else{
                                    for ($i = 0; $i < $contagem; $i++) {
                                        $usuarios[] = $i;
                                    }
                                }
                                $usuariosExibidos = [];
                                $porPagina = 12;
                                $paginaAtual = isset($_GET['pagina']) ? max(1, intval($_GET['pagina'])) : 1;
                                $inicio = ($paginaAtual - 1) * $porPagina;
                                if ((isset($_GET['ordenar']) && !empty($usuariosFiltrados))) {
                                    $usuariosPagina = array_slice($usuariosFiltrados, $inicio, $porPagina);
                                    $totalPaginas = ceil(count($usuariosFiltrados) / $porPagina);
                                } else {
                                    $usuariosPagina = array_slice($usuarios, $inicio, $porPagina);
                                    $totalPaginas = ceil(count($usuarios) / $porPagina);
                                }
                                if ( (isset($_GET['ordenar']) && empty($usuariosFiltrados)) || (!isset($_GET['ordenar']) && empty($usuarios))) {
                                echo "<tr><td colspan='4'>Nenhum trabalhador encontrado.</td></tr>";
                                }elseif (isset($_GET['ordenar']) && !empty($usuariosFiltrados)) {
                                    foreach ($usuariosPagina as $usuario) {
                                        $idx = $usuario['id']; 
                                        array_push($usuariosExibidos, $idx);
                                        echo "<tr>";
                                        echo "<td>$idx</td>";
                                        echo "<td>" . (isset($usuario['nome']) ? htmlspecialchars($usuario['nome']) : 'N/A') . "</td>";
                                        echo "<td>" . (isset($usuario['email']) ? htmlspecialchars($usuario['email']) : 'N/A') . "</td>";
                                        echo "<td><a href='#' data-bs-toggle='modal' data-bs-target='#exampleModal$idx'><svg xmlns='http://www.w3.org/2000/svg' width='22' height='22' fill='blue' class='bi bi-pencil-square' viewBox='0 0 16 16'>
        <path d='M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z'/>
        <path fill-rule='evenodd' d='M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5z'/>
        </svg></a> | <a href='excluir.php?pos=$idx'> <svg xmlns='http://www.w3.org/2000/svg' width='22' height='22' fill='red' class='bi bi-trash-fill' viewBox='0 0 16 16'>
                                            <path d='M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5M8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5m3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0'/>
                                            </svg></td>";
                                        echo "</tr>";
                                        echo "</tr>";   
                                        
                                    }
                                    echo "<nav><ul class='pagination justify-content-center'>";
                                    for ($p = 1; $p <= $totalPaginas; $p++) {
                                        $active = ($p == $paginaAtual) ? "active" : "";
                                        $params = "pagina=$p";
                                        if (isset($_GET['ordenar']) && $_GET['ordenar'] !== "") {
                                            $params .= "&ordenar=" . urlencode($_GET['ordenar']);
                                        }
                                        if (isset($_POST['pesquisar']) && $_POST['pesquisar'] !== "") {
                                            $params .= "&pesquisar=" . urlencode($_POST['pesquisar']);
                                        } elseif (isset($_GET['pesquisar']) && $_GET['pesquisar'] !== "") {
                                            $params .= "&pesquisar=" . urlencode($_GET['pesquisar']);
                                        }
                                        $style = ($active === "active") ? "style='background-color: #b95afd; color: black; border-color: black;'" : "style='color: black; border-color: black;'";
                                        echo "<li class='page-item $active'><a class='page-link' href='?{$params}' $style>$p</a></li>";
                                    }
                                    echo "</ul></nav>";
                                }  else {
                                    for ($i = 0; $i < count($usuariosPagina); $i++) {
                                        $idx = $usuariosPagina[$i];
                                        array_push($usuariosExibidos, $idx);
                                        echo "<tr>";
                                            echo "<td>$idx</td>";
  
                                            echo "<td>" . (isset($nome[$idx]) ? htmlspecialchars($nome[$idx]) : 'N/A') . "</td>";
                                            echo "<td>" . (isset($email[$idx]) ? htmlspecialchars($email[$idx]) : 'N/A') . "</td>";
                                            echo "<td><a href='#' data-bs-toggle='modal' data-bs-target='#exampleModal$idx'><svg xmlns='http://www.w3.org/2000/svg' width='22' height='22' fill='blue' class='bi bi-pencil-square' viewBox='0 0 16 16'>
            <path d='M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z'/>
            <path fill-rule='evenodd' d='M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5z'/>
            </svg></a> | <a href='excluir.php?pos=$idx'> <svg xmlns='http://www.w3.org/2000/svg' width='22' height='22' fill='red' class='bi bi-trash-fill' viewBox='0 0 16 16'>
                                                <path d='M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5M8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5m3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0'/>
                                                </svg></td>";
                                        echo "</tr>";
                                        
                                    }
                                    echo "<nav><ul class='pagination justify-content-center'>";
                                    for ($p = 1; $p <= $totalPaginas; $p++) {
                                        $active = ($p == $paginaAtual) ? "active" : "";
                                        $params = "pagina=$p";
                                        if (isset($_GET['ordenar']) && $_GET['ordenar'] !== "") {
                                            $params .= "&ordenar=" . urlencode($_GET['ordenar']);
                                        }
                                        if (isset($_POST['pesquisar']) && $_POST['pesquisar'] !== "") {
                                            $params .= "&pesquisar=" . urlencode($_POST['pesquisar']);
                                        } elseif (isset($_GET['pesquisar']) && $_GET['pesquisar'] !== "") {
                                            $params .= "&pesquisar=" . urlencode($_GET['pesquisar']);
                                        }
                                        $style = ($active === "active") ? "style='background-color: rgb(214, 156, 255); color: white; border-color: #b95afd;'" : "style='color: black; border-color: rgb(214, 156, 255);'";
                                        echo "<li class='page-item $active'><a class='page-link' href='?{$params}' $style>$p</a></li>";
                                    }
                                    echo "</ul></nav>";
                                }
                                
                                
                            echo "</table>";
                        echo "</div>"; 
                        
                    echo "</div>";
                    foreach ($usuariosExibidos as $idx) {
                                echo "
                                <div class='modal fade' id='exampleModal$idx' tabindex='-1' aria-labelledby='exampleModalLabel$idx' aria-hidden='true'>
                                    <div class='modal-dialog'>
                                        <div class='modal-content'>
                                            <div class='modal-header'>
                                                <h5 class='modal-title' id='exampleModalLabel$idx'>Editar Usuário</h5>
                                                <button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close'></button>
                                            </div>
                                            <div class='modal-body'>
                                                <form action='../editar.php' method='post' enctype='multipart/form-data'>
                                                    <input type='hidden' name='id' value='$idx'/>
                                                    <label class='form-label'>Nome</label>
                                                    <input value='" . (isset($nome[$idx]) ? htmlspecialchars($nome[$idx]) : '') . "' class='form-control' type='text' name='nome' required/>
                                                    <br/>
                                                    <label class='form-label'>E-mail</label>
                                                    <input value='" . (isset($email[$idx]) ? htmlspecialchars($email[$idx]) : '') . "' class='form-control' type='email' name='email' required/>
                                                    <br/>
                                                    <label class='form-label'>Senha</label>
                                                    <input value='" . (isset($senha[$idx]) ? htmlspecialchars($senha[$idx]) : '') . "' class='form-control' minlength='3' type='password' name='senha' required/>
                                                    <br/>
                                                    <label class='form-label'>Foto do trabalhador</label>
                                                    <input class='form-control' type='file' name='fotoTra' accept='.png,.jpg'/>
                                                    <br/>
                                                    <input type='submit' class='btn btn-primary' value='SALVAR'/>
                                                </form>
                                            </div>
                                            <div class='modal-footer'>
                                                <button type='button' class='btn btn-danger' data-bs-dismiss='modal'>FECHAR</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>";
                            }
                            echo "
                                <div class='modal fade' id='exampleModal' tabindex='-1' aria-labelledby='exampleModalLabe' aria-hidden='true'>
                                    <div class='modal-dialog'>
                                        <div class='modal-content'>
                                            <div class='modal-header'>
                                                <h5 class='modal-title' id='exampleModalLabel'>CADASTRAR TRABALHADOR</h5>
                                                <button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close'></button>
                                            </div>
                                        <div class='modal-body text-start'>
                                            <form action='../cadastro.php' method='post' enctype='multipart/form-data'>
                                                <label class='form-label'>Nome</label>
                                                <input class='form-control' type='text' name='nome' required placeholder='Digite o nome'/>
                                                <br/>
                                                <label class='form-label'>E-mail</label>
                                                <input class='form-control' type='email' name='email' required placeholder='Digite o e-mail'/>
                                                <br/>
                                                <label class='form-label'>Senha</label>
                                                <input class='form-control' type='password' name='senha' required placeholder='Digite a senha'/>
                                                <br/>
                                                <label class='form-label'>Foto do trabalhador</label>
                                                <input class='form-control' type='file' name='foto' accept='.png,.jpg,' />
                                                <br/>
                                                <input type='submit' class='btn btn-primary' value='CADASTRAR'/>
                                            </form>
                                        </div>
                                        <div class='modal-footer'>
                                            <button type='button' class='btn btn-danger' data-bs-dismiss='modal'>FECHAR</button>
                                        </div>
                                    </div>
                                </div>
                            ";
                echo "</div>";
            }
            else {
                echo '
                <div class="usuarioDiv">
                    <div class="cards-container">
                        <div class="profile-card">
                            <p>Bem vindo!</p>
                            <div class="profile-info">
                                <div class="profile-image profile-image-placeholder">
                                    <img ';

                if ($id !== false && isset($fotos[$id])) {
                    echo "src='../usuarios/" . $fotos[$id] . "'";
                } else {
                    echo "src='../img/default.png'";
                }

                echo ' alt="Imagem do usuário">
                                </div>
                                <div class="nomeEDisplay">
                                    <div class="profile-title">Usuário</div>
                                    <p class="profile-name">' . (isset($nomes[$id]) ? $nomes[$id] : "Usuário não identificado") . '</p>
                                    <a href="../sair.php"><button class="btn-danger sair">Sair</button></a>
                                </div>
                            </div>
                        </div>

                        <div class="profile-card menu-card">
                            <div class="menu-options">
                                <div class="profile-title">Menu</div>
                                <hr>
                                <a href="../inicial.php">Produção</a>
                                <hr>
                                <a href="../inicial.php?diaria">Registro Diário</a>
                            </div>
                        </div>

                        <div class="profile-card sobre-card">
                            <div class="sobre-options">
                                <div class="profile-title"><b>ⓘ</b> Sobre</div>
                                <hr>
                                <p>Dashboard da sua produção com indicativos gráficos, mostrando dados da sua produção, trabalhadores, retrabalho, defeitos e produção.</p>
                            </div>
                        </div>

                        <!-- Conteúdo principal do site -->
                        <div class="info">
                ';

                if (isset($_GET['diaria'])) {
                    echo "<div class='card'>
                            <div class='card_content'>
                                <h2 class='profile-title' style='font-size: 28px;'>Registro</h2>
                                <div class='profile-forms'>
                                     <form method='POST' action='receber-dados.php'>
                                        <div class='mb-3'>
                                            <label for='exampleInputEmail1' class='form-label'>Quantidade Produzida</label>
                                            <input type='number' name='quantidade' min='0' class='form-control' id='seunumero' aria-describedby='numero' required>
                                            <div id='seunumero' class='form-text'>Insira a quantidade de sapatos produzido por você hoje</div>
                                        </div>
                                        <div class='mb-3'>
                                            <label for='preju' class='form-label'>Quantidade de retrabalho</label>
                                            <input type='number' name='prejuizo' class='form-control' min='0' id='prejuizo' required>
                                            <div id='prejuizo' class='form-text'>Insira a quantidade de sapatos perdidos hoje</div>
                                        </div>
                                        <button type='submit' class='btn btn-primary'>Enviar</button>
                                        </form>
                                </div>
                            </div>
                        </div>";
                } else {
                    echo "<br/>";
                    echo "<br/>";
                    echo "<div class='card'>
                            <div class='card_content'>
                                <span class='profile-title' style='font-size: 24px; font-weight: bold;'>Produção</span>";
                                echo "<form class='dataForm' method='post' action='../inicial.php'>";
                                    echo "<span class='profile-title'><b>Escolha a data inicial</b></span>";
                                    echo "<input type='date' class='data' name='dataInicial'/>";
                                    echo "<span class='profile-title'><b>Escolha a data final</b></span>";
                                    echo "<input type='date' class='data' name='dataFinal' />";
                                    echo "<input class='btn btn-primary' type='submit' value='FILTRAR'/>";
                                echo "</form>";
                                echo "<div>";
                                echo "<br/>";
                                echo "<h2 class='profile-title' style='font-size: 18px; font-weight: bold'>Dados:</h2>";
                            echo "</div>";
                        echo "</div>";
                    echo "</div>";

                    echo "<div class='subcard'>";
                        echo "<div class='tools'>";
                            echo "<div class='circle'><span class='red box'></span></div>";
                            echo "<div class='circle'><span class='yellow box'></span></div>";
                            echo "<div class='circle'><span class='green box'></span></div>";
                        echo "</div>";
                        echo "<div class='card__content'>";
                            include "../dadosProducao/prodgraphs.php";
                        echo "</div>";
                    echo "</div>";

                    echo "<div class='subcard2'>";
                        echo "<div class='tools'>";
                            echo "<div class='circle'><span class='red box'></span></div>";
                            echo "<div class='circle'><span class='yellow box'></span></div>";
                            echo "<div class='circle'><span class='green box'></span></div>";
                        echo "</div>";
                        echo "<div class='card__content'>";
                            echo "<h2 class='profile-title' style='font-size: 14px;'>Retrabalho</h2>";
                            include "../dadosProducao/retrabalho.php";
                        echo "</div>";
                    echo "</div>";

                    echo "<div class='subcard3'>";
                        echo "<div class='tools'>";
                            echo "<div class='circle'><span class='red box'></span></div>";
                            echo "<div class='circle'><span class='yellow box'></span></div>";
                            echo "<div class='circle'><span class='green box'></span></div>";
                        echo "</div>";
                        echo "<div class='card__content'>";
                            echo "<h2 class='profile-title' style='font-size: 14px;'>Tolerância</h2>";
                            include "../dadosProducao/tolerancia.php";
                        echo "</div>";
                    echo "</div>";

                    echo "<div class='subcard4'>";
                        echo "<div class='tools'>";
                            echo "<div class='circle'><span class='red box'></span></div>";
                            echo "<div class='circle'><span class='yellow box'></span></div>";
                            echo "<div class='circle'><span class='green box'></span></div>";
                        echo "</div>";
                        echo "<div class='card__content'>";
                            echo "<h2 class='profile-title' style='font-size: 14px;'>Prejuízo</h2>";
                            include "../dadosProducao/prejuizo.php";
                        echo "</div>";
                    echo "</div>";

                    echo "<div class='subcard5'>";
                        echo "<div class='tools'>";
                            echo "<div class='circle'><span class='red box'></span></div>";
                            echo "<div class='circle'><span class='yellow box'></span></div>";
                            echo "<div class='circle'><span class='green box'></span></div>";
                        echo "</div>";
                        echo "<div class='card__content'>";
                            echo "<h2 class='profile-title' style='font-size: 14px;'>Trabalhadores</h2>";
                            include "../dadosProducao/trabalhadores.php";
                        echo "</div>";
                    echo "</div>";

                    echo "<div class='subcard6'>";
                        echo "<div class='tools'>";
                            echo "<div class='circle'><span class='red box'></span></div>";
                            echo "<div class='circle'><span class='yellow box'></span></div>";
                            echo "<div class='circle'><span class='green box'></span></div>";
                        echo "</div>";
                        echo "<div class='card__content'>";
                            echo "<h2 class='profile-title' style='font-size: 14px;'>Produção total (com prejuízos)</h2>";
                            include "../dadosProducao/producao.php";
                        echo "</div>";
                    echo "</div>";
                    
                }
                echo '
                        <div>

                        <a href="inicial.php">
                            <img src="../img/logo.svg" class="logo" alt="Logo da empresa">
                        </a>
                    </div>
                ';

            }
        ?>
    </main>
</body>

</html>
