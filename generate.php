<!doctype html>
<html lang="en">

<head>
    <title>Title</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS v5.2.1 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">

</head>

<body>

    <div class="container mt-5">

        <?php
require_once 'vendor/autoload.php';
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

if ($_SERVER["REQUEST_METHOD"] === "POST") {
 $tipoArchivo = $_POST["tipoArchivo"];
 $contenido   = $_POST["contenido"];

 switch ($tipoArchivo) {
  case "txt":
   $nombreArchivo = "archivo.txt";
   if (file_put_contents($nombreArchivo, $contenido) === false) {
    echo "Error al crear el archivo TXT.";
    exit();
   }
   break;
  case "json":
   $data          = array("texto" => $contenido);
   $json_data     = json_encode($data);
   $nombreArchivo = "archivo.json";
   if (file_put_contents($nombreArchivo, $json_data) === false) {
    echo "Error al crear el archivo JSON.";
    exit();
   }
   break;
  case "xml":
   $nombreArchivo = "archivo.xml";

   $xml = new SimpleXMLElement('<root></root>');
   $xml->addChild($nombreArchivo, $contenido);

   $nombreArchivo = "archivo.xml";
   $xml->asXML($nombreArchivo);
   break;
  case "word":

   $phpWord = new \PhpOffice\PhpWord\PhpWord();
   $section = $phpWord->addSection();
   $section->addText($contenido);
   $nombreArchivo = "archivo.docx";
   $phpWord->save($nombreArchivo);
   break;
  case "excel":
   $spreadsheet = new \PhpOffice\PhpSpreadsheet\Spreadsheet();
   $spreadsheet->getActiveSheet()->setCellValue('A1', $contenido);
   $nombreArchivo = "archivo.xlsx";
   $writer        = new \PhpOffice\PhpSpreadsheet\Writer\Xlsx($spreadsheet);
   $writer->save($nombreArchivo);
   break;

  case "sqlite":
   $nombreArchivo = "archivo.sqlite";

   $db = new SQLite3($nombreArchivo);

   if (!$db) {
    die("No se pudo abrir o crear la base de datos.");
   }

   $query = "CREATE TABLE IF NOT EXISTS datos (
            id INTEGER PRIMARY KEY,
            contenido TEXT
        )";

   $db->exec($query);

   $contenido = $_POST["contenido"];

   $query = "INSERT INTO datos (contenido) VALUES (:contenido)";
   $stmt  = $db->prepare($query);
   $stmt->bindParam(':contenido', $contenido, SQLITE3_TEXT);

   if ($stmt->execute()) {
    echo "Se ha creado el archivo SQLite y se ha agregado el contenido correctamente.";
   } else {
    echo "Error al crear el archivo SQLite o al agregar el contenido.";
   }
   $db->close();

   break;

  default:
   echo "Tipo de archivo no válido.";
   exit();
 }

 echo "Se ha creado el archivo: <a href='$nombreArchivo' download>Descargar $nombreArchivo</a>";

 echo "<h1>Archivo Generado</h1>";
 echo "<p>Nombre del archivo: $nombreArchivo</p>";
 echo "<p>Tipo de archivo: $tipoArchivo</p>";
 echo "<p>Contenido:</p>";
 echo "<pre>$contenido</pre>";
 echo '<a class="btn btn-primary" href="index.php">Volver al Inicio</a>';
}
?>
    </div>




    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"
        integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous">
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.min.js"
        integrity="sha384-7VPbUDkoPSGFnVtYi0QogXtr74QeVeeIs99Qfg5YCF+TidwNdjvaKZX19NZ/e6oz" crossorigin="anonymous">
    </script>
</body>

</html>