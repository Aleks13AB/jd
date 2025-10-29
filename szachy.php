<?php
$polaczenie = mysqli_connect('localhost', 'root', '', 'szachy');
if (!$polaczenie) {
    die("Błąd połączenia: " . mysqli_connect_error());
}

$wynik = mysqli_query($polaczenie, "SELECT * FROM zawodnicy ORDER BY ranking DESC LIMIT 10");

$wylosowana_para = "";
if(isset($_POST['losuj'])){
    $wszyscy = mysqli_query($polaczenie, "SELECT pseudonim FROM zawodnicy");
    $gracze = [];
    while($row = mysqli_fetch_assoc($wszyscy)){
        $gracze[] = $row['pseudonim'];
    }
    shuffle($gracze);
    $wylosowana_para = $gracze[0] . " vs " . $gracze[1];
}
?>
<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>KOŁO SZACHOWE</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <header>
        <h2><em>Koło szachowe gambit piona</em></h2>
    </header>

    <div class="container">
        <section class="left">
            <h4>Polecane linki</h4>
            <ul>
                <li><a href="kwerenda1.html">kwerenda1</a></li>
                <li><a href="kwerenda2.html">kwerenda2</a></li>
                <li><a href="kwerenda3.html">kwerenda3</a></li>
                <li><a href="kwerenda4.html">kwerenda4</a></li>
            </ul>
            <img src="logo.png" alt="Logo koła">
        </section>

        <section class="right">
            <h3>Najlepsi gracze naszego koła</h3>

            <table>
                <tr>
                    <th>Pozycja</th>
                    <th>Pseudonim</th>
                    <th>Tytuł</th>
                    <th>Ranking</th>
                    <th>Klasa</th>
                </tr>
                <?php
                $pozycja = 1;
                while($r = mysqli_fetch_assoc($wynik)){
                    echo "<tr>
                            <td>$pozycja</td>
                            <td>{$r['pseudonim']}</td>
                            <td>{$r['tytul']}</td>
                            <td>{$r['ranking']}</td>
                            <td>{$r['klasa']}</td>
                          </tr>";
                    $pozycja++;
                }
                ?>
            </table>

            <form method="post">
                <button type="submit" name="losuj">Losuj nową parę graczy</button>
            </form>

            <p>
                <?php if($wylosowana_para != "") echo "Wylosowana para: $wylosowana_para"; ?>
            </p>

            <p>
                <?php
                if(file_exists('legenda.txt')){
                    echo nl2br(file_get_contents('legenda.txt'));
                }
                ?>
            </p>
        </section>
    </div>

    <footer>
        <p>Stronę wykonał: dobrygosc2008</p>
    </footer>
</body>
</html>
