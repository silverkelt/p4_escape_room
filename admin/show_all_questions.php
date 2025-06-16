<!-- Op deze pagina zie je alle vragen in een tabel.
     Je ziet per vraag: de vraagtekst, het antwoord, de hint en bij welke room die hoort (roomID).
     Bij elke vraag staan knoppen om deze te bewerken of te verwijderen. 
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
    crud_questions();
    ?>

</body>
</html>
