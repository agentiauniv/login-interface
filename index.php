<?php

$message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $email = $_POST["email"];
    $password = $_POST["password"];

    $url = "https://uhqqzlpabycxrepisgi.supabase.co/rest/v1/Login?email=eq.$email&password=eq.$password";

    $headers = [
        "Content-Type: application/json",
        "apikey: eyJh...COLLE_ICI_TA_ANON_KEY_COMPLETE",
        "Authorization: Bearer eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJpc3MiOiJzdXBhYmFzZSIsInJlZiI6InVocXF6bHBheWJjeXhyZXBpc2dpIiwicm9sZSI6ImFub24iLCJpYXQiOjE3NzA4NDAyNzgsImV4cCI6MjA4NjQxNjI3OH0.LNQMIQs7euI7-4MMJWU_maqT6WdXq6lWuueCtF3kE24"
    ];

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    $response = curl_exec($ch);
    curl_close($ch);

    $data = json_decode($response, true);

    if (!empty($data)) {
        $message = "Connexion réussie ✅";
    } else {
        $message = "Email ou mot de passe incorrect ❌";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
</head>
<body>

<h2>Connexion</h2>

<form method="POST">
    Email:<br>
    <input type="email" name="email" required><br><br>

    Mot de passe:<br>
    <input type="password" name="password" required><br><br>

    <button type="submit">Se connecter</button>
</form>

<br>
<strong><?php echo $message; ?></strong>

</body>
</html>
