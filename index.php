<?php
define("URL", str_replace("index.php", "", (isset($_SERVER['HTTPS']) ? "https" : "http") .
  "://$_SERVER[HTTP_HOST]$_SERVER[PHP_SELF]"));
require 'controllers/Book.php';

$book = new Book;

if (empty($_GET['page'])) {
  $book->view('home.view');
} else {
  $url = explode('/', filter_var($_GET['page']), FILTER_SANITIZE_URL);
  switch ($url[0]) {
    case 'home':
      $book->view('home.view');
      break;
    case 'books':
      if (empty($url[1])) {
        $book->showBooks();
      } else if ($url[1] == "add") {
        $book->addBook();
      } else if ($url[1] == "edit") {
        $book->editBook($url[2]);
      } else if ($url[1] == "remove") {
        $book->removeBook();
      } else {
        throw new Exception("page doesn't exist");
      }
      break;
    default:
      throw new Exception("page doesn't exist");
  }
}
