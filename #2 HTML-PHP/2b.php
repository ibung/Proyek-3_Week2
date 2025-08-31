<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    
    <table border="1">
        <tr>
            <td>NIM</td>
            <td>NAMA</td>
            <td>UMUR</td>
        </tr>
        <?php
            $i = 1;
            while ($i <= 10) {
        ?>
        <tr>
            <td>241511777</td>
            <td>Muhammad Hisyam Ramadhan</td>
            <td>21</td>
        </tr>
        <?php
            $i=$i+1; 
        }
        ?>
    </table>
</body>
</html>