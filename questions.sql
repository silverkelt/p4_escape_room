-- Maak de tabel aan
CREATE TABLE questions (
    id INT AUTO_INCREMENT PRIMARY KEY,
    question VARCHAR(255) NOT NULL,
    answer VARCHAR(100) NOT NULL
    roomId INT NOT NULL
);

-- Pas de onderstaande voorbeeld vragen aan naar jullie eigen vragen.
INSERT INTO questions (question, answer, roomId)
VALUES
    ('Welke kleur krijg je als je blauw en geel mengt?', 'Groen', 1),
    ('Wat is het eerste getal in pi?', '3', 1),
    ('Wat is de hoofdstad van Nederland?', 'Amsterdam', 1),
    ('Welke maand heeft 28 dagen?', 'Allemaal', 2),
    ('In welke programmeertaal gebruik je "print()" om iets weer te geven?', 'Python', 2),
    ('Wat is de afkorting van de veelgebruikte term die betekent: “Herhaal jezelf niet”?', 'DRY', 2),
    ('Welke waarde heeft een boolean variabele standaard in veel talen zoals JavaScript als je niets toewijst?', 'undefined', 3),
    ('Wat is de naam van de fout in code die pas bij het uitvoeren ontstaat?', 'Runtime error', 3),
    ('Hoe noem je een blok code dat je kunt aanroepen met een naam, vaak met parameters?', 'Functie', 3);
