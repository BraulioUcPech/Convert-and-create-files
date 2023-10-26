<!doctype html>
<html lang="en">

<head>
    <title>Title</title>
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

</head>

<body>
    <?php
require_once 'vendor/autoload.php';
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

if ($_SERVER["REQUEST_METHOD"] === "POST") {
 if (isset($_FILES["archivo"]) && $_FILES["archivo"]["error"] === UPLOAD_ERR_OK) {
  $nombreArchivo = $_FILES["archivo"]["name"];
  $tipoArchivo   = $_FILES["archivo"]["type"];
  $contenido     = file_get_contents($_FILES["archivo"]["tmp_name"]);

  $extension = pathinfo($nombreArchivo, PATHINFO_EXTENSION);

  echo '<div class="container mt-5">';

  if ($extension === "txt" || $tipoArchivo === "text/plain") {
   echo "<h2>Archivo de Texto Plano</h2>";
   echo "<pre>$contenido</pre>";
  } elseif ($extension === "json" || $tipoArchivo === "application/json") {
   echo "<h2>Archivo JSON</h2>";
   $data = json_decode($contenido, true);
   if (json_last_error() === JSON_ERROR_NONE) {
    echo "<pre>" . json_encode($data, JSON_PRETTY_PRINT) . "</pre>";

   } else {
    echo "El archivo JSON es inválido.";

   }
  } elseif ($extension === "xml" || $tipoArchivo === "application/xml") {

   echo "<h2>Archivo XML</h2>";
   $xml = simplexml_load_string($contenido);
   if ($xml !== false) {
    echo "<pre>" . htmlspecialchars($contenido, ENT_QUOTES, 'UTF-8') . "</pre>";
   } else {
    echo "El archivo XML es inválido.";
   }
  } elseif (in_array($extension, ["docx", "doc"])) {
   echo "<h2>Archivo Word</h2>";
   require_once 'vendor/autoload.php';

   $phpWord = new \PhpOffice\PhpWord\PhpWord();
   $section = $phpWord->addSection();
   $section->addText($contenido);
   $nombreArchivo = "archivo.docx";
   $phpWord->save($nombreArchivo);

   echo "<h3>Contenido del archivo Word:</h3>";

   echo "<pre>$contenido</pre>";

  } elseif (in_array($extension, ["xlsx", "xls"])) {

   echo "<h2>Archivo Excel</h2>";
   require_once 'vendor/autoload.php';
   $spreadsheet = new \PhpOffice\PhpSpreadsheet\Spreadsheet();
   $spreadsheet->getActiveSheet()->setCellValue('A1', $contenido);
   $nombreArchivo = "archivo.xlsx";
   $writer        = new \PhpOffice\PhpSpreadsheet\Writer\Xlsx($spreadsheet);
   echo "<h3>Contenido del archivo Excel:</h3>";
   echo "<pre>$contenido</pre>";

  } elseif ($extension === "sqlite" || $tipoArchivo === "application/x-sqlite3") {
   echo "<h2>Archivo SQLite</h2>";
   $nombreArchivo = "archivo.sqlite";
   echo "<pre>$contenido</pre>";
   $db = new SQLite3($nombreArchivo);

   if (!$db) {
    die("No se pudo abrir o crear la base de datos.");
   }
  } else {
   echo "Tipo de archivo no válido.";
  }

  echo '</div>';
 } else {
  echo "No se ha seleccionado un archivo válido.";
 }
}
?>


    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"
        integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous">
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.min.js"
        integrity="sha384-7VPbUDkoPSGFnVtYi0QogXtr74QeVeeIs99Qfg5YCF+TidwNdjvaKZX19NZ/e6oz" crossorigin="anonymous">
    </script>
</body>

</html>