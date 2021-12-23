    <nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">

        <a class="navbar-brand" href="index.php">Restaurante Boa Comida</a>

        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault"
            aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarsExampleDefault">
            <ul class="navbar-nav mr-auto">

                <?php if (isset($_SESSION['usuario'])) : ?>

                <li class="nav-item dropdown active">
                    <a class="nav-link dropdown-toggle" href="index.php" id="dropdown01" data-toggle="dropdown"
                        aria-haspopup="true" aria-expanded="false">Administrativo</a>
                    <div class="dropdown-menu" aria-labelledby="dropdown01">
                        <a class="dropdown-item" class="active" href="index.php?modulo=cidades">Cidades</a>
                        <a class="dropdown-item" href="index.php?modulo=modalteste">Teste com Janelas Modais</a>
                        <a class="dropdown-item" href="index.php?modulo=clientes">Clientes</a>
                        <a class="dropdown-item" href="#">Fornecedores</a>
                        <a class="dropdown-item" href="index.php?modulo=unidades">Unidades</a>
                        <a class="dropdown-item" href="index.php?modulo=ingredientes">Ingredientes</a>
                        <a class="dropdown-item" href="index.php?modulo=categorias">Categorias</a>
                        <a class="dropdown-item" href="index.php?modulo=pratos">Pratos</a>
                        <a class="dropdown-item" href="#">Compras</a>
                        <a class="dropdown-item" href="index.php?modulo=encomendas">Encomendas</a>
                        <a class="dropdown-item" href="index.php?modulo=logout">Sair
                            (<?php echo $_SESSION['usuario']['login'] ?>)</a>
                    </div>
                </li>

                <?php endif; ?>

            </ul>


            &nbsp;&nbsp;&nbsp;

            <?php if (isset($_SESSION['usuario'])) : ?>

            <form class="form-inline my-2 my-lg-0">
                <a href="index.php?modulo=logout" class="btn btn-outline-success my-2 my-sm-0">Sair
                    (<?php echo $_SESSION['usuario']['login'] ?>)</a>
            </form>

            <?php endif; ?>

        </div>
    </nav>

    <!-- EXEMPLO ORIGINAL DO LINK (https://getbootstrap.com.br/docs/4.1/examples/jumbotron/)

    <nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
      <a class="navbar-brand" href="#">Navbar</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarsExampleDefault">
        <ul class="navbar-nav mr-auto">
          <li class="nav-item active">
            <a class="nav-link" href="#">Home <span class="sr-only">(atual)</span></a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">Link</a>
          </li>
          <li class="nav-item">
            <a class="nav-link disabled" href="#">Desativado</a>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="http://example.com" id="dropdown01" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Dropdown</a>
            <div class="dropdown-menu" aria-labelledby="dropdown01">
              <a class="dropdown-item" href="#">Item</a>
              <a class="dropdown-item" href="#">Outro item</a>
              <a class="dropdown-item" href="#">Algum outro item</a>
            </div>
          </li>
        </ul>
        <form class="form-inline my-2 my-lg-0">
          <input class="form-control mr-sm-2" type="text" placeholder="Pesquisa" aria-label="Search">
          <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Pesquisar</button>
        </form>
      </div>
    </nav>

-->