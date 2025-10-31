<?php
$polaczenie=mysqli_connect("localhost", "root", "", "mieszalnia");
?>

<!DOCTYPE html>
<html lang="pl">
<head>
<meta charset="UTF-8">
<title>Mieszalnia farb</title>
<link rel="stylesheet" href="style.css">
</head>
<body>

<header>
    <link rel="icon" type="image/png" href="fav.png" sizes="32x32">
    <img src="baner.png" alt="Mieszalnia farb">
</header>

<section id="formularz">
<form method="post">
    <label>data odbioru od:</label>
    <input type="date" name="od">
    <label>do:</label>
    <input type="date" name="do">
    <button type="submit">wyszukaj</button>
</form>
</section>

<main>
<table>
<tr>
    <th>nr zamowienia</th><th>nazwisko</th><th>imie</th>
    <th>kod koloru</th><th>pojemnosc [ml]</th><th>data odbioru</th>
</tr>

<?php
$od = $_POST['od'] ?? '';
$do = $_POST['do'] ?? '';

$zapytanie = "
    SELECT z.id, k.nazwisko, k.imie, z.kod_koloru, z.pojemnosc, z.data_odbioru
    FROM zamowienia z
    JOIN klienci k ON z.id_klienta = k.id
";

$wynik = $polaczenie->query($zapytanie);
if ($wynik && $wynik->num_rows > 0) {
    while($r = $wynik->fetch_assoc()) {
        echo "<tr>
            <td>{$r['id']}</td>
            <td>{$r['nazwisko']}</td>
            <td>{$r['imie']}</td>
            <td>{$r['kod_koloru']}</td>
            <td>{$r['pojemnosc']}</td>
            <td>{$r['data_odbioru']}</td>
        </tr>";
    }
} else {
    echo "<tr><td colspan='6'>brak wynikow</td></tr>";
}
$polaczenie->close();
?>

</table>
</main>

<footer>
    <h3>Egzamin INF.03</h3>
    <p>Autor: aleks wilkicki</p>
</footer>

</body>
</html>
