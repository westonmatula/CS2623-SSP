<?php

// Frosty Guessing Game - Functions

function frosty_guessing(
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
) {

    $guess_found = "N";

    $now = new DateTime("now", new DateTimeZone("America/Chicago"));
    $game_lastGuess = $now->format("Y-m-d H:i:s");

    // Case 1 - WHen Letter already guessed
    if (strpos($guess_tracked, $guess_letter) !== false) {

        $guess_count_wrong++;
        $guess_image++;

    // Case 2 - Winning condition
    } elseif (str_replace("_", "", $guess_secretWord) === $secretWord) {

        echo "<p><strong>Congratulations! You won! The word was: "
            . htmlspecialchars($secretWord, ENT_QUOTES, "UTF-8")
            . "</strong></p>";

    // Case 3 - Letter not in the secret word
    } elseif (strpos($secretWord, $guess_letter) === false) {

        $guess_tracked .= $guess_letter;
        $guess_count_wrong++;
        $guess_image++;

    // Case 4 - Correct letter
    } else {

        for ($i = 0; $i < $secretWord_len; $i++) {

            if ($secretWord_array[$i] === $guess_letter) {

                $guess_found = "Y";

                if ($i === 0) {

                    // First position
                    $guess_secretWord = $guess_letter
                        . substr($guess_secretWord, 1);

                } else {

                    // Middle or end position
                    $guess_secretWord =
                        substr($guess_secretWord, 0, $i)
                        . $guess_letter
                        . substr($guess_secretWord, $i + 1);
                }
            }
        }

        // Track correct guesses too
        $guess_tracked .= $guess_letter;
    }

    // Limit image number to available images
    if ($guess_image > 5) {
        $guess_image = 5;
    }

    $guess_count++;

    // Check for a win after revealing the letters
    if (strpos($guess_secretWord, "_") === false) {

        echo "<p><strong>Congratulations! You won! The word was: "
            . htmlspecialchars($secretWord, ENT_QUOTES, "UTF-8")
            . "</strong></p>";
    }

    // Update session variables
    $_SESSION["guess_secretWord"] = $guess_secretWord;
    $_SESSION["guess_count"] = $guess_count;
    $_SESSION["guess_count_wrong"] = $guess_count_wrong;
    $_SESSION["guess_tracked"] = $guess_tracked;
    $_SESSION["guess_image"] = $guess_image;
    $_SESSION["guess_letter"] = $guess_letter;
    $_SESSION["game_lastGuess"] = $game_lastGuess;

    // Display current game
    frosty_round(
        $game_started,
        $game_lastGuess,
        $secretWord_len,
        $secretWord_hint,
        $guess_count,
        $guess_count_wrong,
        $guess_tracked,
        $guess_image,
        $guess_secretWord
    );
}


// Frosty Guessing Game - Display Current Round

function frosty_round(
    $game_started,
    $game_lastGuess,
    $secretWord_len,
    $secretWord_hint,
    $guess_count,
    $guess_count_wrong,
    $guess_tracked,
    $guess_image,
    $guess_secretWord
) {

    // Calculate correct answers
    $right_count = strlen(
        str_replace("_", "", $guess_secretWord)
    );

    echo "<div class='game-status'>";

    echo "<p>Game started: "
        . htmlspecialchars($game_started, ENT_QUOTES, "UTF-8")
        . "</p>";

    echo "<p>Last guess: "
        . htmlspecialchars($game_lastGuess, ENT_QUOTES, "UTF-8")
        . "</p>";

    echo "<hr>";

    echo "<p><strong>Secret word hint:</strong> "
        . htmlspecialchars($secretWord_hint, ENT_QUOTES, "UTF-8")
        . "</p>";

    echo "<p><strong>Secret word length:</strong> "
        . $secretWord_len . "</p>";

    echo "<p><strong>Current word:</strong> "
        . htmlspecialchars($guess_secretWord, ENT_QUOTES, "UTF-8")
        . "</p>";

    echo "<p><strong>Total guesses:</strong> "
        . $guess_count . "</p>";

    echo "<p><strong>Wrong guesses:</strong> "
        . $guess_count_wrong . "</p>";

    echo "<p><strong>Right answers:</strong> "
        . $right_count . "</p>";

    echo "<p><strong>Guessed letters:</strong> "
        . htmlspecialchars($guess_tracked, ENT_QUOTES, "UTF-8")
        . "</p>";

    // Select Frosty image
    $img = "images/Frosty (" . ($guess_image + 1) . ").png";

    echo "<p><strong>Frosty is currently at:</strong></p>";

    echo "<img src='" . htmlspecialchars($img, ENT_QUOTES, "UTF-8")
        . "' alt='Frosty stage " . $guess_image . "'>";

    echo "</div>";
}

?>
