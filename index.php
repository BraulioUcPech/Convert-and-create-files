<!DOCTYPE html>
<html lang="en">

<head>
    <title>Título</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title></title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS v5.2.1 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <header>
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container">
                <a class="navbar-brand" href="#">Mi Sitio</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                    aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item">
                            <a class="nav-link" href="#">Inicio</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Acerca de</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Servicios</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Contacto</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>
    <main class="container mt-5">
        <div class="container mt-5">
            <h1>Crear Archivo</h1>
            <form action="generate.php" method="POST">
                <div class="mb-3">
                    <label for="tipoArchivo" class="form-label">Tipo de Archivo:</label>
                    <select class="form-select" name="tipoArchivo" id="tipoArchivo">
                        <option value="txt">Texto Plano</option>
                        <option value="json">JSON</option>
                        <option value="xml">XML</option>
                        <option value="word">Word</option>
                        <option value="excel">Excel</option>
                        <option value="sqlite">SQLite</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="contenido" class="form-label">Contenido:</label>
                    <textarea class="form-control" name="contenido" id="contenido" rows="4"></textarea>
                </div>
                <button type="submit" class="btn btn-primary">Crear Archivo</button>
            </form>
        </div>



        <div class="container mt-5">
            <h1>Leer y Mostrar Archivo</h1>

            <!-- Formulario para cargar el archivo -->
            <form action="leerymostrar.php" method="POST" enctype="multipart/form-data">
                <div class="mb-3">
                    <label for="archivo" class="form-label">Seleccionar archivo:</label>
                    <input type="file" class="form-control" id="archivo" name="archivo">
                </div>
                <button type="submit" class="btn btn-primary">Cargar Archivo</button>
            </form>

            <!-- Área para mostrar el contenido del archivo -->
            <div class="mt-4">
                <h2>Contenido del Archivo</h2>
                <pre id="contenido-archivo"></pre>
            </div>
        </div>
    </main>







    <footer class="bg-dark text-white text-center py-3">
        <div class="container">
            &copy; <?php echo date("Y"); ?> Uc Pech Braulio. Todos los derechos reservados.
            <a class="text-light" href="https://www.youtube.com/watch?v=nfWlot6h_JM" target="_blank"
                rel="noopener noreferrer">Muevete</a>
        </div>
    </footer>

    <!-- Bootstrap JavaScript Libraries -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"
        integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous">
    </script>
    <!-- Bootstrap JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-pzjw8f+ua7Kw1TIq0v8FqFjcJ6pajs/rfdfs3SO+kD4Ck5BdPtF+to8xMp9Mvc9l8Aj6s9"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.min.js"
        integrity="sha384-7VPbUDkoPSGFnVtYi0QogXtr74QeVeeIs99Qfg5YCF+TidwNdjvaKZX19NZ/e6oz" crossorigin="anonymous">
    </script>

    <script>
    const main = () => {
        console.log("Some JavaScript Code...");
    };

    // wait for five-server to connect
    const five = document.querySelector('[data-id="five-server"]');
    if (five) five.addEventListener("connected", main);
    else window.addEventListener("load", main);
    </script>
</body>

</html>