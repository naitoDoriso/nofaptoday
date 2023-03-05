<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://code.jquery.com/jquery-3.6.3.min.js"></script>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Roboto:wght@100&display=swap" rel="stylesheet">
    <link rel="icon" href="icon.png">
    <title>No fap today</title>
</head>
<body style="font-family: 'Roboto', sans-serif" class="relative bg-rose-800">
    <style>
        html, body {
            height: 100%;
            min-height: 100%;
            position: relative;
        }

        hr {
            border-color: #b7b7b7;
        }

        ul li {
            margin: 4px 0;
        }
    </style>
    <header class="bg-rose-900 h-32 text-rose-800 drop-shadow-md">
        <div class="mx-auto w-1/4" style="font-size: 50px">
            <div class="my-6 mx-auto w-1/4 absolute flex flex-row justify-between items-center">
                <h2 style="text-shadow: -2px 0 rgb(225 29 72)">N∅</h2>
                <img class="w-20" src="https://upload.wikimedia.org/wikipedia/commons/thumb/f/f0/Twemoji_1f346.svg/1200px-Twemoji_1f346.svg.png" alt="eggplant">
                <h2 style="text-shadow: -2px 0 rgb(225 29 72)">TODAY</h2>
            </div>
        </div>
    </header>
    <section class="bg-rose-800 my-4 w-1/2 mx-auto text-center">
        <?php
            $blocked = false;
            foreach (json_decode(fread(fopen("db.json", "r"), filesize("db.json")),true) as $i=>$v) {
                if (date("d/m/o", strtotime("yesterday")) == $v["date"]) {
                    $blocked = true;
                }
            }

            if ($blocked == false) { ?>
        <div class="bg-gray-500 p-3 mb-7">
            <h1 class="text-3xl">Sucedeu-se ontem?</h1>
            <div class="flex flex-row justify-center my-6">
                <button id="confirm" class="flex flex-row items-center mx-2 outline-0 hover:bg-gray-600">SIM <img src="https://em-content.zobj.net/source/skype/289/check-mark_2714-fe0f.png" alt="success" class="w-5 ml-2"></button>
                <button id="deny" class="flex flex-row items-center mx-2 outline-0 hover:bg-gray-600">NÃO <img src="https://em-content.zobj.net/source/skype/289/cross-mark_274c.png" alt="fail" class="w-5 ml-2"></button>
            </div>
        </div>
        <?php } ?>
        <hr>
        <ul class="text-white">
            <?php foreach (json_decode(fread(fopen("db.json", "r"), filesize("db.json")),true) as $i=>$v) { ?>
            <li>
                <?php echo "<span>$v[date] - <a style='color:".($v['value']=='success' ? '#16c60c' : '#f03a17')."'>".strtoupper($v["value"])."</a></span>"; ?>
                <hr>
            </li>
            <?php } ?>
        </ul>
    </section>
    <footer class="absolute right-0 bottom-0">
        <div class="border-2 text-white opacity-0 hover:opacity-100 transition border-sky-200 rounded-lg bg-transparent w-max text-center p-2 -my-16 mx-6">
            <h4 onclick="window.open('./db.json')">₢ Vinícius de Sá Ferreira</h4>
        </div>
    </footer>
    <script>
        $("#confirm").click( () => {
            $.post("./request.php?type=confirm", (data) => {
                location.reload();
            } );
        } );

        $("#deny").click( () => {
            $.post("./request.php?type=deny", (data) => {
                location.reload();
            } );
        } );
    </script>
</body>
</html>