<!-- Op deze pagina maak je een team aan.
     Voeg een veld toe voor de teamnaam en minstens twee velden voor de namen van de teamleden. -->
     <?php
     //include the functions file
     include '../funtions.php';
          $teamcode = generate_teamcode();
          
if (isset($_POST['insert_button'])) {
    if (empty($_POST['team_naam'])) {
        echo "Please enter a team name.";
    } elseif (teamname_exists($_POST['team_naam'])) {
        echo '<script>alert("Team name already in use. Please choose another.")';
            } else {
               // Register the team
               $_POST['team_code'] = $teamcode; // Add the generated team code to the POST data
            }
        register_team($_POST);
        echo '<script>alert("new team registered")</script>';
    }
?>
     <!DOCTYPE html>
     <html lang="en">
     <head>
          <meta charset="UTF-8">
          <meta name="viewport" content="width=device-width, initial-scale=1.0">
          <link rel="stylesheet" href="../style.css">
          <title>create team</title>
     </head>
     <body>
          <h1>Create a new team</h1>
          <form method="post" action="add_team.php">
               <label for="team_naam">Team Name:</label>
               <input type="text" id="team_naam" name="team_naam" required><br><br>
               <?php
               // Display the generated team code
               echo '<label for="team_code">Team Code:</label>';
               echo $teamcode;
               ?>
               <input type="hidden" id="teamcode" name="teamcode" value="<?php echo $teamcode; ?>" required>
               <br>
               please copy your teamcode before submitting.<br>
               <br>
               <br>
               <button type="submit" name="insert_button">Create Team</button>
          </form>
     </body>
     </html>'
     