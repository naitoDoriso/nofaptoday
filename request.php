<?php
    if (!empty($_GET)) {
        if ($_GET["type"] == "confirm") {
            $db = fopen("db.json", "r") or die("Unable to open file!");
            $json = json_decode(fread($db, filesize("db.json")), true);
            array_push($json, ["date" => date("d/m/o", strtotime("yesterday")), "value" => "success"]);
            fclose($db);
            $db = fopen("db.json", "w") or die("Unable to open file!");
            fwrite($db, json_encode($json, JSON_PRETTY_PRINT|JSON_UNESCAPED_SLASHES));
            fclose($db);
        } else {
            $db = fopen("db.json", "r") or die("Unable to open file!");
            $json = json_decode(fread($db, filesize("db.json")), true);
            array_push($json, ["date" => date("d/m/o", strtotime("yesterday")), "value" => "failed"]);
            fclose($db);
            $db = fopen("db.json", "w") or die("Unable to open file!");
            fwrite($db, json_encode($json, JSON_PRETTY_PRINT|JSON_UNESCAPED_SLASHES));
            fclose($db);
        }
    }
?>