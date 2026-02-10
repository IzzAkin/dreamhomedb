<?php

include "dbconfig.php"; 

$con = mysqli_connect($hostname, $username, $password, $dbname);
if (!$con) {
    die("<p>Cannot connect to DB</p>");
}

$sql = "SELECT * FROM dreamhome.Staff";
$result = mysqli_query($con, $sql);
if (!$result) {
    die("<p>Query failed: " . htmlspecialchars(mysqli_error($con)) . "</p>");
}

$fields = mysqli_fetch_fields($result);
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>DreamHome Staff</title>
<style>
table { border-collapse: collapse; margin: 20px 0; width: 100%; max-width: 1000px; }
th, td { border: 1px solid #333; padding: 8px 10px; text-align: left; }
th { background: #f2f2f2; }
.male { color: blue; font-weight: bold; }
.female { color: red; font-weight: bold; }
</style>
</head>
<body>

<h2>DreamHome Staff</h2>

<table>
<tr>
<?php
foreach ($fields as $f) {
    echo "<th>" . htmlspecialchars($f->name) . "</th>";
}
?>
</tr>

<?php
while ($row = mysqli_fetch_assoc($result)) {
    echo "<tr>";
    foreach ($fields as $f) {
        $col = $f->name;
        $val = $row[$col];

        if (strtolower($col) === "sex") {
            if ($val === "M") {
                echo "<td class='male'>" . htmlspecialchars($val) . "</td>";
            } elseif ($val === "F") {
                echo "<td class='female'>" . htmlspecialchars($val) . "</td>";
            } else {
                echo "<td>" . htmlspecialchars($val) . "</td>";
            }
        } else {
            echo "<td>" . htmlspecialchars((string)$val) . "</td>";
        }
    }
    echo "</tr>";
}
?>
</table>

</body>
</html>

<?php
mysqli_free_result($result);
mysqli_close($con);
?>

