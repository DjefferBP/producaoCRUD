<!DOCTYPE html>
<html lang="pt-br">

<head>

    <style>
        @media (min-width: 1280px) {

            div.imagem {
                background-image: url(http://placecage.com/201/80);
                width: 200px;
                height: 80px;
            }

            p.centro {
                position: relative;
                z-index: 3;
                text-align: center;
                color: #fff;
                font-family: 'Anonymous Pro', monospace;
            }

            .line {
                position: relative;
                left: 100%;
                top: 25%;
                width: 0px;
                margin: auto;
                border-right: 2px solid transparent;
                font-size: 1.5em !important;
                text-align: center;
                white-space: nowrap;
                justify-content: center;
                overflow: hidden;
            }

            .anim-typewriter {
                animation: typewriter 4000ms steps(22) 100ms forwards,
                    /* aqui vc controlo o tempo do efeito escrita mais 1 steps(X) para cada caracter  */
                    blinkTextCursor 500ms steps(22) 22 backwards;
                /* aqui vc controlo o tempo da linha mais 1 steps(X) para cada caracter e ela repete 12x500ms = 6000ms */
            }

            @keyframes typewriter {
                0% {
                    width: 0px;
                }

                10% {
                    width: 0px;
                }

                25% {
                    width: 270px;
                }

                75% {
                    width: 270px;
                }

                90% {
                    width: 0px;
                }

                91% {
                    width: 0px;
                    display: none;
                }
            }

            @keyframes blinkTextCursor {
                from {
                    border-right-color: transparent;
                }

                to {
                    border-right-color: rgba(255, 255, 255, 0.75);
                }
            }

            div.bg {
                position: absolute;
                overflow: hidden;
                z-index: 2;
                width: 100%;
                height: 100%;
                background-color: #000000;
                top: 0;
                left: 0;
                opacity: 1;
                animation: fade 4250ms forwards;
                /* aqui vc controlo o tempo que a tela preta demora para sumir XXXms */
            }

            @keyframes fade {
                0% {
                    opacity: 1;
                    height: 100%;
                }

                80% {
                    opacity: 1;
                    height: 100%;
                }

                99% {
                    opacity: 0;
                    height: 100%;
                }

                100% {
                    opacity: 0;
                    height: 0;
                }
            }
        }
    </style>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <title>Painel</title>
    <link rel="icon" href="img/ProdGraph.ico">
    <!-- Font Awesome icons (free version)-->
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
    <!-- Google fonts-->
    <link rel="preconnect" href="https://fonts.gstatic.com" />
    <link href="https://fonts.googleapis.com/css2?family=Tinos:ital,wght@0,400;0,700;1,400;1,700&amp;display=swap" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:ital,wght@0,400;0,500;0,700;1,400;1,500;1,700&amp;display=swap" rel="stylesheet" />
    <!-- Core theme CSS (includes Bootstrap)-->
    <link href="styles/index.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</head>
<div class="bg"></div>

<body>

    <!-- Background Video-->

    <video class="bg-video" playsinline="playsinline" autoplay="autoplay" muted="muted" loop="loop">
        <source src="mp4/videoBusiness.mp4" type="video/mp4" />
    </video>

    <!-- Masthead-->
    <div class="masthead">
        <div class="bg"></div>
        <div class="masthead-content text-black">

            <div class="container-fluid px-4 px-lg-0">

                <a href="index.php"><img src="img/logo.svg" alt="Logo da empresa" class="logo mb-4"></a>

                <h1 class="fst-italic lh-1 mb-4">Seja bem-vindo ao painel de controle!</h1>
                <p class="mb-5">Entre e acesse a sua plataforma para acessar os dados da sua produção</p>
                <p class="centro line anim-typewriter">
                    <img src="img/ProdGraph.svg" alt="Logo" class="logo-animada" style="vertical-align: right; height: 1.2em; margin-right: 0.1em;">
                    Prodgraph
                </p>
                <form class="form" method="post" action="login.php">
                    <p class="form-title text-purple">Entre na sua conta!</p>
                    <div class="input-container">
                        <input type="email" required name="email" id="nome" placeholder=" ">
                        <label for="nome">E-mail</label>
                    </div>

                    <div class="input-container">
                        <input type="password"required name="senha" id="senha" placeholder=" ">
                        <label for="senha">Senha</label>
                    </div>
                    <input type="submit" value="Entrar" class="submit">

                </form>


            </div>
        </div>
    </div>



    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.startbootstrap.com/sb-forms-latest.js"></script>
</body>

</html>