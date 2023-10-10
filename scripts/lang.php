                         <?php

// Prvotni INIT
if(!isset($_GET['ja']))
{
    $_GET['ja'] = $u;
}

$jazyky = [
    "cz" => "cz",
    "en" => "en",
    "de" => "de",
    "pl" => "pl",
    "ru" => "ru",

];

    // jazyk
    if(isset($_GET['ja']) AND isset($jazyky[$_GET['ja']]))
    {
        $l = $jazyky[$_GET['ja']];
    }
    else
    {
        $_GET['ja'] = $l;
    }

    require_once dirname(__FILE__) . "/language/" . $l . ".php";       // skript s jazykovou mutaci