-- Maak de tabel aan
CREATE TABLE questions_room_one (
    id INT AUTO_INCREMENT PRIMARY KEY,
    question VARCHAR(255) NOT NULL,
    answer VARCHAR(100) NOT NULL
);

-- Voeg voorbeeldvragen toe
INSERT INTO questions_room_one (question, answer)
VALUES
    ('Welke kleur krijg je als je blauw en geel mengt?', 'Groen'),
    ('Wat is het eerste getal in pi?', '3'),
    ('Wat is de hoofdstad van Nederland?', 'Amsterdam'),
    ('Welke maand heeft 28 dagen?', 'Allemaal')