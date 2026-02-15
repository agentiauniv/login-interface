<?php

$message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Sécuriser les entrées
    $email = urlencode(trim($_POST["email"]));
    $password = urlencode(trim($_POST["password"]));

    // URL Supabase
    $url = "https://uhqqzlpabycxrepisgi.supabase.co/rest/v1/Login?email=eq.$email&password=eq.$password";

    // ⚠️ Mets ici ta vraie ANON KEY complète
    $anon_key = "eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJpc3MiOiJzdXBhYmFzZSIsInJlZiI6InVocXF6bHBheWJjeXhyZXBpc2dpIiwicm9sZSI6ImFub24iLCJpYXQiOjE3NzA4NDAyNzgsImV4cCI6MjA4NjQxNjI3OH0.LNQMIQs7euI7-4MMJWU_maqT6WdXq6lWuueCtF3kE24";

    $headers = [
        "Content-Type: application/json",
        "apikey: $anon_key",
        "Authorization: Bearer $anon_key"
    ];

    $ch = curl_init();

    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    $response = curl_exec($ch);

    // Vérifier erreur curl
    if(curl_errno($ch)){
        $message = "Erreur cURL : " . curl_error($ch);
    }

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
