<?php
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Credentials: true");
header("Access-Control-Allow-Methods: GET, POST");
header("Access-Control-Allow-Origin: *");
include_once 'config/Database.php';

class api
{
  private $db = "";

  public function __construct()
  {
    $database = new Database();
    $this->db = $database->koneksi();
  }

  public function createNote($title, $description)
  {
    $getNotes = $this->db->prepare(
      "INSERT INTO note (title, description) VALUES (:title, :description)"
    );
    $getNotes->execute(['title' => $title, 'description' => $description]);

    $id = $this->db->lastInsertId();

    return json_encode(['status' => true, 'id' => $id, 'pesan' => 'data berhasil disimpan']);
  }


  public function deleteNote($id)
  {
    $deleteNotes = $this->db->prepare("DELETE FROM note WHERE id = :id");
    $deleteNotes->execute(['id' => $id]);

    return json_encode(['status' => true, 'id' => $id, 'pesan' => 'data berhasil dihapus']);
  }

  public function updateNote($id, $title, $description)
  {
    $getNotes = $this->db->prepare(
      "UPDATE note SET title = :title, description = :description WHERE id = :id"
    );
    $getNotes->execute([
      'id' => $id,
      'title' => $title,
      'description' => $description
    ]);

    return json_encode(['status' => true, 'id' => $id, 'pesan' => 'data berhasil diupdate']);
  }

  public function allNotes()
  {
    $getNotes = $this->db->prepare("SELECT * FROM note ORDER BY id DESC");
    $getNotes->execute();
    $notes = $getNotes->fetchAll(PDO::FETCH_ASSOC);

    return json_encode($notes);
  }

  public function getNote($id = false)
  {
    $getNotes = $this->db->prepare("SELECT * FROM note WHERE id = :id");
    $getNotes->execute(['id' => $id]);
    $notes = $getNotes->fetchAll(PDO::FETCH_ASSOC);

    if (!$notes) {
      $notes = ['status' => false, 'pesan' => 'data tidak ditemukan'];
    }

    return json_encode($notes);
  }
}

$api = new Api();
$f = $_GET["f"] ?? false;

if ($f == "CREATE") {
  echo $api->createNote($_POST['title'], $_POST['description']);
} elseif ($f == "UPDATE") {
  echo $api->updateNote($_POST['id'], $_POST['title'], $_POST['description']);
} elseif ($f == "DELETE") {
  echo $api->deleteNote($_POST['id']);
} else {
  if (isset($_GET['id'])) {
    echo $api->getNote($_GET['id']);
  } else {
    echo $api->allNotes();
  }
}
