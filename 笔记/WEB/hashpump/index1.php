<?php
$flag = "XXXXXXXXXXXXXXXXXXXXXXX";
$secret = "tinmin123456789"; // This secret is 15 characters long for security!

$username = $_POST["username"];
$password = $_POST["password"];
echo md5($secret . urldecode($username . $password));
if (!empty($_COOKIE["getmein"])) {
    if (urldecode($username) === "admin" && urldecode($password) != "admin") {
        if ($_COOKIE["getmein"] === md5($secret . urldecode($username . $password))) {
            echo "Congratulations! You are a registered user.\n";
            die ("The flag is ". $flag);
        }
        else {
            die ("Your cookies don't match up! STOP HACKING THIS SITE.");
        }
    }
    else {
        die ("You are not an admin! LEAVE.");
    }
}

setcookie("sample-hash", md5($secret . urldecode("admin" . "admin")), time() + (60 * 60 * 24 * 7));

if (empty($_COOKIE["source"])) {
    setcookie("source", 0, time() + (60 * 60 * 24 * 7));
}
else {
    if ($_COOKIE["source"] != 0) {
        echo ""; // This source code is outputted here
    }
}
?>
    </pre>
<h1>Admins Only!</h1>
<p>If you have the correct credentials, log in below. If not, please LEAVE.</p>
<form method="POST">
    Username: <input type="text" name="username"> <br>
    Password: <input type="password" name="password"> <br>
    <button type="submit">Submit</button>
</form>

</body>
</html>

<!--curl --data "username=admin&password=admin%80%00%00%00%00%00%00%00%00%00%00%00%00%00%00%00%00%00%00%00%00%00%00%00%00%00%00%00%00%00%00%C8%00%00%00%00%00%00%00pcat" --cookie "getmein=6dd1396a4a4981203afdad0478b6fd29;" http://localhost:7000 -v -->