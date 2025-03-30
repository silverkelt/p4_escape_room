-- Maak de tabel aan
CREATE TABLE questions (
    id INT AUTO_INCREMENT PRIMARY KEY,
    question VARCHAR(255) NOT NULL,
    answer VARCHAR(100) NOT NULL
    roomId INT(50) NOT NULL
);

-- Voeg voorbeeldvragen toe
INSERT INTO questions_room_one (question, answer)
VALUES
    ('Welke kleur krijg je als je blauw en geel mengt?', 'Groen', 1),
    ('Wat is het eerste getal in pi?', '3', 1),
    ('Wat is de hoofdstad van Nederland?', 'Amsterdam', 1),
    ('Welke maand heeft 28 dagen?', 'Allemaal', 2)