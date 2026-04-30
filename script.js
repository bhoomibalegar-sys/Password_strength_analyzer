function checkStrength() {
    fetch("analyzer.php", {
        method: "POST",
        headers: {
            "Content-Type": "application/x-www-form-urlencoded"
        },
        body: "password=test123"
    })
    .then(res => res.text())
    .then(data => {
        alert("Response: " + data);
    })
    .catch(err => {
        alert("Error: " + err);
    });
}