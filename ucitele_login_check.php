<?php
// Připojení k databázi
include("db_connect.php");

// Získání dat z formuláře
$username = $_POST['username'] ?? '';
$password = $_POST['password'] ?? '';

// Připravený dotaz (bezpečné proti SQL injection)
$stmt = $conn->prepare("SELECT id FROM ucitele WHERE username = ? AND password = ?");
$stmt->bind_param("ss", $username, $password);
$stmt->execute();
$result = $stmt->get_result();

if ($row = $result->fetch_assoc()) {
    //Uživatel existuje – přihlášení úspěšné
    session_start();
    $_SESSION['ucitel_id'] = $row['id'];
    $_SESSION['ucitel_jmeno'] = $username;

    echo "<h2>Přihlášení bylo úspěšné!</h2>";
    echo "<p>Budete přesměrován na hlavní stránku...</p>";
    echo "<meta http-equiv='refresh' content='2;url=teacher_dashboard.php'>";
} else {
    //Neplatné přihlašovací údaje
    echo "<h2>Nesprávné jméno nebo heslo!</h2>";
    echo "<p><a href='ucitele_login_ai.php'>Zkusit znovu</a></p>";
}

// Zavření připojení
$stmt->close();
$conn->close();
?>
