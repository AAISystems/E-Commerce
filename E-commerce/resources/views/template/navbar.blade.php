<nav class="navbar navbar-expand-sm navbar-light bg-purple shadow">
    <div class="container">
        <a class="navbar-brand" href="#">
            <img src="" class="img-fluid w-25 p-3" alt="logoAAISystems" />
            AAISystems</a>
        <button class="navbar-toggler d-lg-none" type="button" data-bs-toggle="collapse" data-bs-target="#collapsibleNavId" aria-controls="collapsibleNavId" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="collapsibleNavId">
            <ul class="navbar-nav me-auto mt-2 mt-lg-0">
                <li class="nav-item">
                    <a class="nav-link" href="#" aria-current="page"><img src="resources/shop-svgrepo-com.svg" class="img-fluid rounded-top" alt="" />

                    </a>
                </li>

                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="dropdownId" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><img src="" class="img-fluid rounded-top" alt="logoCategorias" />
                    </a>
                    <div class="dropdown-menu bg-light-purple" aria-labelledby="dropdownId">
                        <a class="dropdown-item" href="#">Sistemas operativos</a>
                        <a class="dropdown-item" href="#">Ofimática</a>
                        <a class="dropdown-item" href="#">Edición de vídeo</a>
                        <a class="dropdown-item" href="#">Edición de fotografía</a>
                        <a class="dropdown-item" href="#">Edición de audio</a>
                        <a class="dropdown-item" href="#">Sistemas de gestión de personal</a>
                        <a class="dropdown-item" href="#">Sistemas de gestión empresarial</a>

                    </div>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" href="#"><img src="" class="img-fluid rounded-top" alt="logoContact" />
                    </a>
                </li>
            </ul>
            <form class="d-flex my-2 my-lg-0">
                <input class="form-control me-sm-2 shadow-sm rounded-5" type="text" placeholder="Buscar..." />
                <button class="btn text-light my-2 my-sm-0" type="submit">
                    <img src="" class="img-fluid rounded-top" alt="logoLupa" />

                </button>
            </form>
            <div class="container mt-3">
    <a href="{{ route('login') }}" class="btn btn-primary me-3">Login</a>
    <a href="{{ route('register') }}" class="btn btn-success">Register</a>
</div>
        </div>
    </div>
</nav>
