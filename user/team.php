<!DOCTYPE html>
<html lang="nl">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Team Aanmaken of Joinen</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      background-color: #f2f2f2;
      padding: 40px;
    }

    .form-container {
      max-width: 400px;
      background: white;
      padding: 20px;
      margin: 0 auto 30px;
      border-radius: 8px;
      box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
    }

    h2 {
      text-align: center;
      color: #333;
    }

    input, button {
      width: 100%;
      padding: 10px;
      margin-top: 12px;
      margin-bottom: 20px;
      border-radius: 5px;
      border: 1px solid #ccc;
      box-sizing: border-box;
    }

    button {
      background-color: #004080;
      color: white;
      border: none;
      cursor: pointer;
    }

    button:hover {
      background-color: #003366;
    }
  </style>
</head>
<body>

  
  <div class="form-container">
    <h2>Join een Team</h2>
    <form>
      <input type="text" name="team_naam" placeholder="Teamnaam" required />
      <input type="text" name="gebruikersnaam" placeholder="Gebruikersnaam" required />
      <button type="submit">Join Team</button>
    </form>
  <a href="new_team.php">Join Team</a>
  </div>

</body>
</html>
