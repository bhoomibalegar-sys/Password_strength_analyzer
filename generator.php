<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Show current directory (IMPORTANT DEBUG)
echo "<br>Current Directory: " . __DIR__ . "<br>";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $name = $_POST['name'] ?? '';
    $dob = $_POST['dob'] ?? '';
    $pet = $_POST['pet'] ?? '';
    $company = $_POST['company'] ?? '';

    if ($name == "") {
        echo "❌ Name is required";
        exit();
    }

    $words = [];
    $base = [$name, $dob, $pet, $company];

    foreach ($base as $w) {
        if (!empty($w)) {
            $words[] = $w;
            $words[] = strtolower($w);
            $words[] = strtoupper($w);
            $words[] = $w . "123";
        }
    }

    // 🔥 FORCE FILE PATH (ABSOLUTE)
    $file_path = __DIR__ . "/wordlist.txt";

    $result = file_put_contents($file_path, implode("\n", $words));

    if ($result !== false) {
        echo "✅ FILE CREATED SUCCESSFULLY<br>";
        echo "📄 Location: " . $file_path;
    } else {
        echo "❌ FAILED TO CREATE FILE";
    }

} else {
    echo "⚠️ Not a POST request";
}
?>