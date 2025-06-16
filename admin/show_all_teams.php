<!-- Op deze pagina zie je een overzicht van alle teams in een tabel.
     Bij elk team staan de teamnaam en de teamleden.
     Er staan knoppen bij om een team te bewerken of te verwijderen. 
      Deze pagina is alleen zichtbaar voor de admin. -->
<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crud</title>
    <link rel="stylesheet" href="../style.css">
</head>
<body>

    <?php
    // functie: Programma CRUD
    // auteur: ramon kieboom   

    // Initialisatie
    include '../funtions.php';

    // Main

    // Aanroep functie 
    crud_users();
    ?>

</body>
</html>



