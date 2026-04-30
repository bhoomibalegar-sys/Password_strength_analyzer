<?php
$result = "";
$genResult = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // PASSWORD CHECK
    if (isset($_POST['check'])) {
        $password = $_POST['password'];
        $score = 0;

        if(strlen($password) >= 8) $score++;
        if(preg_match('/[A-Z]/', $password)) $score++;
        if(preg_match('/[a-z]/', $password)) $score++;
        if(preg_match('/[0-9]/', $password)) $score++;
        if(preg_match('/[!@#$%^&*]/', $password)) $score++;

        if($score <= 2) {
            $result = "<span style='color:red;'>Weak</span>";
        } elseif($score <= 4) {
            $result = "<span style='color:orange;'>Moderate</span>";
        } else {
            $result = "<span style='color:green;'>Strong</span>";
        }
    }

    // WORDLIST GENERATOR
    if (isset($_POST['generate'])) {
        $name = $_POST['name'];
        $dob = $_POST['dob'];
        $pet = $_POST['pet'];
        $company = $_POST['company'];

        $words = [];
        $base = [$name, $dob, $pet, $company];

        foreach($base as $w){
            if($w != ""){
                $words[] = $w;
                $words[] = strtolower($w);
                $words[] = strtoupper($w);
                $words[] = $w."123";
                $words[] = $w."@123";
            }
        }

        foreach($base as $w1){
            foreach($base as $w2){
                if($w1 != $w2 && $w1 != "" && $w2 != ""){
                    $words[] = $w1.$w2;
                }
            }
        }

        $file = fopen("wordlist.txt", "w");

        foreach(array_unique($words) as $word){
            fwrite($file, $word."\n");
        }

        fclose($file);

        $genResult = "<span style='color:green;'>Wordlist Generated!</span>";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Password Tool</title>
    <style>
        body {
            font-family: Arial;
            background: linear-gradient(135deg, #667eea, #764ba2);
            color: white;
            text-align: center;
        }

        .box {
            background: rgba(0,0,0,0.4);
            padding: 20px;
            margin: 20px auto;
            width: 300px;
            border-radius: 12px;
        }

        input {
            padding: 10px;
            margin: 8px;
            width: 90%;
            border-radius: 8px;
            border: none;
        }

        button {
            padding: 10px;
            border: none;
            border-radius: 8px;
            background: #ff7eb3;
            color: white;
            cursor: pointer;
        }

        button:hover {
            background: #ff4f91;
        }
    </style>
</head>

<body>

<h1>🔐 Password Strength Tool</h1>

<div class="box">
    <h2>Check Strength</h2>
    <form method="POST">
        <input type="password" name="password" placeholder="Enter password" required>
        <button type="submit" name="check">Check</button>
    </form>
    <p><?php echo $result; ?></p>
</div>

<div class="box">
    <h2>Generate Wordlist</h2>
    <form method="POST">
        <input type="text" name="name" placeholder="Name" required>
        <input type="text" name="dob" placeholder="DOB">
        <input type="text" name="pet" placeholder="Pet Name">
        <input type="text" name="company" placeholder="Company">
        <button type="submit" name="generate">Generate</button>
    </form>
    <p><?php echo $genResult; ?></p>
</div>

</body>
</html>
