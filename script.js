function showTab(tab) {
    document.getElementById("analyzer").style.display = "none";
    document.getElementById("generator").style.display = "none";
    document.getElementById(tab).style.display = "block";
}

function checkStrength() {
    let password = document.getElementById("password").value;

    if (password === "") {
        alert("Enter password first");
        return;
    }

    fetch("http://localhost/password_tool/analyzer.php", {
        method: "POST",
        headers: {
            "Content-Type": "application/x-www-form-urlencoded"
        },
        body: "password=" + encodeURIComponent(password)
    })
    .then(response => response.text())
    .then(data => {
        console.log("Response:", data);   // DEBUG
        document.getElementById("result").innerHTML = data;
    })
    .catch(error => {
        console.error("Fetch Error:", error);
    });
}

function generateWordlist() {
    let name = document.getElementById("name").value;

    if (name === "") {
        alert("Enter name");
        return;
    }

    let data = new URLSearchParams();
    data.append("name", name);
    data.append("dob", document.getElementById("dob").value);
    data.append("pet", document.getElementById("pet").value);
    data.append("company", document.getElementById("company").value);

    fetch("http://localhost/password_tool/generator.php", {
        method: "POST",
        body: data
    })
    .then(response => response.text())
    .then(data => {
        console.log("Response:", data);   // DEBUG
        document.getElementById("genResult").innerHTML = data;
    })
    .catch(error => {
        console.error("Fetch Error:", error);
    });
}
