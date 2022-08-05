<?php
require __DIR__ . '/vendor/autoload.php';

use ComposerIncludeFiles\NumberFactory;

    // Initialise display settings
    $outputValue = "&nbsp;";
    $outputClass = "secondary";

    $errorMessage = "";

    // Added commit to trigger GH actions
    // If the form was submitted, try to process it
    if (formWasSubmitted()) {
        try {
            // Read input (capturing each number separately so is may be echoed in UI)
            [$numberOneInput, $numberTwoInput, $numberThreeInput] = $numbers = readNumbersEntered();

            if ($_GET['debug'] == 'Y')
                echo var_export($numbers, true) . "<br><br>";

            // Validate input. Throw errors if something i wrong
            validateNumberEntered($numbers);

            // Compute output (and UI display hints)
            if (numbersMatch($numberOneInput, $numberTwoInput, $numberThreeInput)) {
                $outputValue = "True";
                $outputClass = "success";
            } else {
                $outputValue = "False";
                $outputClass = "danger";
            }
        } catch (\Exception $e) {
            $errorMessage = $e->getMessage();
        }
    }



?>
<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">

    <title>Number Checker</title>
</head>
<body class="">
    <div class="container">
        <div class="my-4 text-secondary fs-1 text-center">Number Checker</div>
        <hr>
        <form method="post">
            <div class="row">
                <div class="alert alert-primary fs-6" role="alert">
                    <p>
                        <strong>
                        Write a method which when given 3 numbers returns whether the first 2 numbers add up to the 3rd.
                        </strong>
                    </p>
                    <p>Here is a set of test values to confirm your method;</p>
                    <p>Example 1 – Input = (1, 2, 10) Output = False<br>Example 2 – Input = (2, 5, 7) Output = True</p>
                </div>
            </div>

            <?php
            if (!empty($errorMessage))
                echo '<div class="row"><div class="alert alert-danger" role="alert">'. $errorMessage . '</div></div>';
            ?>

            <div class="row">
            <div class="col-9">
                <div class="input-group">
                    <span class="input-group-text" id="basic-addon1">(</span>
                    <input
                            name="firstnumber"
                            id="firstnumber"
                            type="text"
                            class="form-control"
                            placeholder="First number"
                            aria-label="First number"
                            value="<?=$numberOneInput?>"
                    >
                    <span class="input-group-text" id="basic-addon1">,</span>
                    <input
                            name="secondnumber"
                            id="secondnumber"
                            type="text"
                            class="form-control"
                            placeholder="Second number"
                            aria-label="Second number"
                            value="<?=$numberTwoInput?>"
                    >
                    <span class="input-group-text" id="basic-addon1">,</span>
                    <input
                            name="thirdnumber"
                            id="thirdnumber"
                            type="text"
                            class="form-control"
                            placeholder="Third number"
                            aria-label="Third number"
                            value="<?=$numberThreeInput?>"
                    >
                    <span class="input-group-text" id="basic-addon1">)</span>
                </div>
            </div>
            <div class="col-3">
                <div class="alert-<?=$outputClass?> form-control"><?=$outputValue?></div>
            </div>
        </div>
            <div class="row">
                <div class="col my-4">
                    <button type="submit" class="btn btn-primary mb-3">Check Numbers</button>
                </div>
            </div>
        </form>
    </div>
</body>
</html>
<?php


// $collectionOfnumbers = [1, 2, 3, 9];
$collectionOfnumbers = [1,2,4,4];
$sum = 8;

echo
    "Input numbers: " . var_export($collectionOfnumbers, true)
    . ". Result: " . (compareSetOfNumbers($collectionOfnumbers, 8) ? 'True' : 'False');

function compareSetOfNumbers($numbers, $sum) {

    foreach ($numbers as $firstNumber) {
        foreach ($numbers as $secondNumber) {
            if ($result = numbersMatch($firstNumber, $secondNumber, $sum))
                return $result;
        }
    }

    return false;
}

function numbersMatch($numberOne, $numberTwo, $numberThree) {
    [$numberOne, $numberTwo, $numberThree] = convertInputToObjects($numberOne, $numberTwo, $numberThree);
    return $numberOne->add($numberTwo)->equals($numberThree);
}

function  convertInputToObjects($numberOneInput, $numberTwoInput, $numberThreeInput) {
    $numberOne = NumberFactory::createNumber($numberOneInput);
    $numberTwo = NumberFactory::createNumber($numberTwoInput);
    $numberThree = NumberFactory::createNumber($numberThreeInput);

    if (!(($numberOne->getType() === $numberTwo->getType()) && ($numberTwo->getType() === $numberThree->getType()))) {
        $numberOne = NumberFactory::convertToComplexNumber($numberOne);
        $numberTwo = NumberFactory::convertToComplexNumber($numberTwo);
        $numberThree = NumberFactory::convertToComplexNumber($numberThree);
    }

    return [$numberOne, $numberTwo, $numberThree];
}

function formWasSubmitted() {
    return !empty($_POST);
}

function readNumbersEntered() {
    return [$_POST['firstnumber'], $_POST['secondnumber'], $_POST['thirdnumber']];
}

function validateNumberEntered($numbers) {
    $numbers = array_walk($numbers, function($number, $index) {
        if (hasAValue(cleanNumberEntered($number)))
            return cleanNumberEntered($number);

        throw new \Exception('Number ' . ($index + 1) . ' has not been given a value');
    });

    return $numbers;
}

function hasAValue($no) {
    return $no !== "";
}

function cleanNumberEntered($no) {
    return str_replace(' ', '' ,trim($no));
}
