<?php

session_start();

// Session Initialization

if (!isset($_SESSION["secretWord"])) {

    $_SESSION["secretWord"] = "BLIZZARD";
    $_SESSION["secretWord_hint"] = "Winter weather category";

    $_SESSION["secretWord_array"] = str_split(strtoupper($_SESSION["secretWord"]));
    $_SESSION["secretWord_len"] = strlen($_SESSION["secretWord"]);

    $_SESSION["guess_secretWord"] = str_repeat("_", $_SESSION["secretWord_len"]);

    $_SESSION["guess_count"] = 0;
    $_SESSION["guess_count_wrong"] = 0;
    $_SESSION["guess_tracked"] = "";
    $_SESSION["guess_image"] = 0;
    $_SESSION["guess_letter"] = "";

    $now = new DateTime("now", new DateTimeZone("America/Chicago"));

    $_SESSION["game_lastGuess"] = $now->format("Y-m-d H:i:s");
    $_SESSION["game_started"] = $now->format("Y-m-d H:i:s");
}


// Load session variables into local variables


$secretWord = $_SESSION["secretWord"];
$secretWord_hint = $_SESSION["secretWord_hint"];
$secretWord_array = $_SESSION["secretWord_array"];
$secretWord_len = $_SESSION["secretWord_len"];
$guess_secretWord = $_SESSION["guess_secretWord"];
$guess_count = $_SESSION["guess_count"];
$guess_count_wrong = $_SESSION["guess_count_wrong"];
$guess_tracked = $_SESSION["guess_tracked"];
$guess_image = $_SESSION["guess_image"];
$guess_letter = $_SESSION["guess_letter"];
$game_lastGuess = $_SESSION["game_lastGuess"];
$game_started = $_SESSION["game_started"];

//Form Processing

if (filter_input(INPUT_SERVER, "REQUEST_METHOD") === "POST") {

    $raw = filter_input(INPUT_POST, "frosty_letter_guess",
        FILTER_SANITIZE_SPECIAL_CHARS);

    if ($raw === false || $raw === null) {
        $raw = "";
    }

    $guess_letter = strtoupper(trim($raw));

    if (ctype_alpha($guess_letter) && strlen($guess_letter) === 1) {

        require_once "functions/functions_SSP09.php";

        frosty_guessing(
            $secretWord,
            $secretWord_hint,
            $guess_secretWord,
            $guess_letter,
            $guess_tracked,
            $guess_count,
            $guess_count_wrong,
            $game_started,
            $game_lastGuess,
            $secretWord_len,
            $secretWord_array,
            $guess_image
        );
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Frosty Word Guessing Game</title>
</head>

<body>

    <h1>Frosty Word Guessing Game</h1>

    <form method="post" action="SSP09.php">

        <label for="frosty_letter_guess">
            Guess a letter:
        </label>

        <input
            type="text"
            id="frosty_letter_guess"
            name="frosty_letter_guess"
            maxlength="1"
            required
            autocomplete="off"
        >

        <button type="submit">Guess</button>

    </form>

</body>
</html>
