<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
        
    </title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        
        body {
            display: flex;
            text-align: center;
        }
        #menu {
            width: 220px;
            background: linear-gradient(135deg, #0a3d62, #079992);
            height: 100vh;
            color: #ecf0f1;
            padding-top: 20px;
            position: fixed;
        }
        #menu a {
            display: block;
            padding: 15px 20px;
            color: #ecf0f1;
            text-decoration: none;
        }
        h1{
            text-align: center;
        }
    </style>
</head>
<body>
    <div id='menu'>
            <a href='./'>Kezdőlap</a>
            <a href='./?p=felh'>Felhasználók</a>
    </div>
    <div id='tartalom'>
            <?php
                if(isset($_GET['p']))
                {
                    $p=$_GET['p'];
                }
                else
                {
                    $p="";
                }

                if($p == "")
                {
                    print "<h1>nemtom hogy működik e</h1>";
                }
                elseif($p == "felh")
                {
                    print "<H1>felhasz</h1>";
                }
           ?>
    </div>
</body>
</html