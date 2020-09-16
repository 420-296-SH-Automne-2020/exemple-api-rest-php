<?php

/*
Exemple de code PHP pour implanter les routes d'API suivantes:
GET /students
GET /students/{id}
POST /students
*/

function sendResponse($code, $body = null) {
  $statusCodes = array(
    200 => "200 OK",
    401 => "401 Unauthorized",
    403 => "403 Forbidden",
    404 => "404 Not found",
    500 => "500 Internal Server Error"
  );

  header('HTTP/1.1 '. $statusCodes[$code]);
  header('Content-Type: application/json; charset=utf-8');
  if ($body) {
    $jsonBody = json_encode($body);
    echo $jsonBody;
  }

  exit();
}

// Récupère la route utilisée et la sépare selon les '/'
$url = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$url = explode( '/', $url );

// Vérifie que la première partie de la route est "students". Sinon, retourne une erreur 404.
if ($url[1] !== 'students' && $url[1] !== 'students.php') {
  sendResponse(404);
}

// Récupère le paramètre facultatif "id"
$studentId = null;
if (isset($url[2])) {
  $studentId = (int) $url[2];
}

// S'assure qu'il n'y a pas autre chose après le paramètre "id"
if (count($url) > 3) {
  sendResponse(404);
}

// Récupère la méthode HTTP utilisée (GET, POST, etc)
$method = $_SERVER['REQUEST_METHOD'];

if ($method == 'GET') {
  if ($studentId) {
    // Ici, on devrait récupérer un étudiant spécifique depuis la base de données
    // On devrait aussi gérer le cas où l'étudiant demandé n'existe pas (erreur 404)
    // Pour les fins de l'exemple, retournons un objet statique
    sendResponse(200, array(
      "id" => "1842421",
      "firstName" => "Lisa",
      "lastName" => "Simpson",
      "program" => "420.B0",
      "semesterPaid" => true,
      "classes" => array(
        "420-103-SH",
        "420-146-SH",
        "420-123-SH",
        "350-153-SH",
        "420-135-SH",
        "601-101-04",
        "340-103-04",
        "109-101-MQ"
      ),
    ));
  }
  // Ici, on devrait récupérer tous les étudiants depuis la base de données
  // Pour les fins de l'exemple, retournons un tableau statique
  sendResponse(200, array(
    array(
      "id" => "1842421",
      "firstName" => "Lisa",
      "lastName" => "Simpson",
      "program" => "420.B0",
      "semesterPaid" => true,
      "classes" => array(
        "420-103-SH",
        "420-146-SH",
        "420-123-SH",
        "350-153-SH",
        "420-135-SH",
        "601-101-04",
        "340-103-04",
        "109-101-MQ"
      ),
    ),
    array(
      "id" => "1812345",
      "firstName" => "William",
      "lastName" => "Byers",
      "program" => "420.B0",
      "semesterPaid" => false,
      "classes" => array(
        "420-103-SH",
        "420-146-SH",
        "420-123-SH",
        "350-153-SH",
        "420-135-SH",
        "601-101-04",
        "340-103-04",
        "109-101-MQ"
      ),
    )    
  ));
}

if ($method == 'POST') {
  $jsonBody = file_get_contents('php://input');
  $body = json_decode($jsonBody);

  // Ici, on devrait valider le contenu de $body et insérer un nouvel étudiant dans la BD.

  sendResponse(200);
}

// Cas par défaut
sendResponse(404);

?>
