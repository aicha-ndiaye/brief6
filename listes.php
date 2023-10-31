<?php      
require("bd.php");
$Database1=new database;
$abib=$Database1->affiche_liste();
// var_dump($leye);H
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="style2.css">
        <title>Document</title>
    </head>
    <body>
    <table class= "tableau-style">
        <thead>
         
            <tr classe="tr">
                <th>nom</th>
                <th>prenom</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($abib as $diouf):  ?>
            <tr>
                <td><?php echo $diouf['nom']; ?></td>
                <td><?php echo $diouf['prenom']; ?></td>
            </tr>
            <?php endforeach;  ?>
        </tbody>
    </table>
    </body>
</html>
