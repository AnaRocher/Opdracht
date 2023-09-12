<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pizza bestellen</title>
    <link rel="stylesheet" href="pizza-bestellen.css">
</head>

<body>

    <?php 

$foutmeldingen = [];
$success = false;

$toppings = [];

if ($_POST) {
    if (!isset($_POST['grootte'])) {
        $foutmeldingen['grootte'] = 'Grootte is verplicht';
    }
    if (!isset($_POST['bodem'])) {
        $foutmeldingen['bodem'] = 'Bodem is verplicht.';
    }
    if (!isset($_POST['korst'])) {
        $foutmeldingen['korst'] = 'Korst is verplicht';
    }
    if (!isset($_POST['saus'])) {
        $foutmeldingen['saus'] = 'Een saus is verplicht';
    }
    if (count($toppings) < 2) {
        $foutmeldingen['toppings2'] = 'Je moet minstens twee toppings kiezen'; 
    }
    if (count($toppings) > 5) {
        $foutmeldingen['toppings5'] = 'Je mag maar maximum 5 toppings aanduiden';
    }
    if (empty($_POST['naam'])) {
        $foutmeldingen['naam'] = 'Naam is verplicht';
    }
    if (empty($_POST['straat'])) {
        $foutmeldingen['straat'] = 'Straat+Huisnummer is verplicht';
    }
    if (empty($_POST['gemeente'])) {
        $foutmeldingen['gemeente'] = 'Postcode+Gemeente is verplicht';
    }
    if (empty($_POST['email'])) {
        $foutmeldingen['email'] = 'E-mailadres is verplicht';
    } elseif (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
        $foutmeldingen['email'] = 'Je moet een geldig e-mailadres invullen.';
    }
    if (!preg_match("/^\+32/", $_POST['tel'])) {
        $foutmelding['tel'] = 'het telefoonnummer moet beginnen met "+32"';
    }
    if (empty($foutmeldingen)) {
        $success = true;
    }
    if (empty($foutmeldingen)) {
        header('location: success.php');
        exit;
    }
}

?>
    <div>
        <pre><?php print_r($_POST) ?></pre>
    </div>

    <div class="container">
        <header>
            <h1>Stel je eigen pizza samen</h1>
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Quaerat cupiditate iure vero, soluta ipsum
                voluptate non aliquid dicta voluptatem eum?</p>
        </header>

        <?php if ($success) : ?>
        <?php else : ?>
        <form method="post">
            <fieldset class="has_error">
                <legend>Basis</legend>
                <div class="has_error">
                    <label>
                        <span class="label">Grootte:</span>
                        <select name="grootte" id="">
                            <option <?php if(!isset($_POST['grootte'])) {echo 'selected'; } ?> disabled selected>Maak
                                een keuze</option>
                            <option
                                <?php if(isset($_POST['grootte']) && $_POST['grootte'] == 's') {echo 'selected'; } ?>
                                value="s"> Small (€5 - 10cm)</option>
                            <option
                                <?php if(isset($_POST['grootte']) && $_POST['grootte'] == 'm') {echo 'selected'; } ?>
                                value="m"> Medium (€7 - 15cm)</option>
                            <option
                                <?php if(isset($_POST['grootte']) && $_POST['grootte'] == 'l') {echo 'selected'; } ?>
                                value="l">Large (€10 - 20cm)</option>
                            <option
                                <?php if(isset($_POST['grootte']) && $_POST['grootte'] == 'xl') {echo 'selected'; } ?>
                                value="xl">Xtra Large (€15 - 30cm)</option>
                        </select>
                    </label>
                    <?php if (isset($foutmeldingen['grootte'])) : ?>
                    <span class="error"><?php echo $foutmeldingen['grootte'] ?></span>
                    <?php endif ?>
                </div>
                <div>
                    <label>
                        <span class="label">Bodem:</span>
                        <select name="bodem" id="">
                            <option <?php if(!isset($_POST['bodem'])) {echo 'selected'; } ?> disabled selected>Maak een
                                keuze</option>
                            <option <?php if(isset($_POST['bodem']) && $_POST['bodem'] == 'dik') {echo 'selected'; } ?>
                                value="dik">Dik</option>
                            <option <?php if(isset($_POST['bodem']) && $_POST['bodem'] == 'dun') {echo 'selected'; } ?>
                                value="dun">Dun</option>
                        </select>
                    </label>
                    <?php if (isset($foutmeldingen['bodem'])) : ?>
                    <span class="error"><?php echo $foutmeldingen['bodem'] ?></span>
                    <?php endif ?>
                </div>
                <div>
                    <label>
                        <span class="label">Korst:</span>
                        <select name="korst" id="">
                            <option <?php if(!isset($_POST['korst'])) {echo 'selected'; } ?> disabled selected>Maak een
                                keuze</option>
                            <option
                                <?php if(isset($_POST['korst']) && $_POST['korst'] == 'normaal') {echo 'selected'; } ?>
                                value="normaal">Normaal</option>
                            <option
                                <?php if(isset($_POST['korst']) && $_POST['korst'] == 'cheesy') {echo 'selected'; } ?>
                                value="cheesy">Cheesy (€2)</option>
                        </select>
                    </label>
                    <?php if (isset($foutmeldingen['korst'])) : ?>
                    <span class="error"><?php echo $foutmeldingen['korst'] ?></span>
                    <?php endif ?>
                </div>
                <div>
                    <span class="label">Saus:</span>
                    <label>
                        <input type="radio" name="saus"
                            <?php if(isset($_POST['saus']) && $_POST['saus'] == 'rood') {echo 'checked';} ?>
                            value="rood"> Rode saus
                    </label>
                    <label>
                        <input type="radio" name="saus"
                            <?php if(isset($_POST['saus']) && $_POST['saus'] == 'wit') {echo 'checked';} ?>value="wit">
                        Witte saus
                    </label>
                    <?php if (isset($foutmeldingen['saus'])) : ?>
                    <span class="error"><?php echo $foutmeldingen['saus'] ?></span>
                    <?php endif ?>
                </div>
            </fieldset>
            <fieldset>
                <legend>Toppings</legend>
                <div>
                    <p class="label">Kaas</p>
                    <ul>
                        <li>
                            <label>
                                <input type="checkbox" name="toppings[]"
                                    <?php if(isset($_POST['toppings[]']) && in_array('kaas', $_POST['toppings'])) {echo 'checked'; } ?>
                                    value="kaas"> Geraspte Kaas (€1)
                            </label>
                        </li>
                        <li>
                            <label>
                                <input type="checkbox" name="toppings[]"
                                    <?php if(isset($_POST['toppings[]']) && in_array('mozzarella', $_POST['toppings'])) {echo 'checked'; } ?>
                                    value="mozzarella"> Mozzarella (€1)
                            </label>
                        </li>
                        <li>
                            <label>
                                <input type="checkbox" name="toppings[]"
                                    <?php if(isset($_POST['toppings[]']) && in_array('feta', $_POST['toppings'])) {echo 'checked'; } ?>
                                    value="feta"> Feta (€1)
                            </label>
                        </li>
                        <li>
                            <label>
                                <input type="checkbox" name="toppings[]"
                                    <?php if(isset($_POST['toppings[]']) && in_array('gorgonzola', $_POST['toppings'])) {echo 'checked'; } ?>
                                    value="gorgonzola"> Gorgonzola (€2)
                            </label>
                        </li>
                    </ul>
                </div>
                <div>
                    <p class="label">Vlees & Vis</p>
                    <ul>
                        <li>
                            <label>
                                <input type="checkbox" name="toppings[]"
                                    <?php if(isset($_POST['toppings[]']) && in_array('kip', $_POST['toppings'])) {echo 'checked'; } ?>
                                    value="kip"> Kip (€2)
                            </label>
                        </li>
                        <li>
                            <label>
                                <input type="checkbox" name="toppings[]"
                                    <?php if(isset($_POST['toppings[]']) && in_array('salami', $_POST['toppings'])) {echo 'checked'; } ?>
                                    value="salami"> Salami (€2)
                            </label>
                        </li>
                        <li>
                            <label>
                                <input type="checkbox" name="toppings[]"
                                    <?php if(isset($_POST['toppings[]']) && in_array('kebap', $_POST['toppings'])) {echo 'checked'; } ?>
                                    value="kebap"> Kebap (€2)
                            </label>
                        </li>
                        <li>
                            <label>
                                <input type="checkbox" name="toppings[]"
                                    <?php if(isset($_POST['toppings[]']) && in_array('tonijn', $_POST['toppings'])) {echo 'checked'; } ?>
                                    value="tonijn"> Tonijn (€2)
                            </label>
                        </li>
                        <li>
                            <label>
                                <input type="checkbox" name="toppings[]"
                                    <?php if(isset($_POST['toppings[]']) && in_array('zalm', $_POST['toppings'])) {echo 'checked'; } ?>
                                    value="zalm"> Zalm (€2)
                            </label>
                        </li>
                    </ul>
                </div>
                <div>
                    <p class="label">Extra</p>
                    <ul>
                        <li>
                            <label>
                                <input type="checkbox" name="toppings[]"
                                    <?php if(isset($_POST['toppings[]']) && in_array('olijven', $_POST['toppings'])) {echo 'checked'; } ?>
                                    value="olijven"> Olijven (€1)
                            </label>
                        </li>
                        <li>
                            <label>
                                <input type="checkbox" name="toppings[]"
                                    <?php if(isset($_POST['toppings[]']) && in_array('pepers', $_POST['toppings'])) {echo 'checked'; } ?>
                                    value="pepers"> Pepers (€1)
                            </label>
                        </li>
                        <li>
                            <label>
                                <input type="checkbox" name="toppings[]"
                                    <?php if(isset($_POST['toppings[]']) && in_array('champignons', $_POST['toppings'])) {echo 'checked'; } ?>
                                    value="champignons"> Champignons (€1)
                            </label>
                        </li>
                        <li>
                            <label>
                                <input type="checkbox" name="toppings[]"
                                    <?php if(isset($_POST['toppings[]']) && in_array('ajuin', $_POST['toppings'])) {echo 'checked'; } ?>
                                    value="ajuin"> Ajuin (€1)
                            </label>
                        </li>
                    </ul>
                    <?php if (isset($foutmeldingen['toppings2'])) : ?>
                    <span class="error"><?php echo $foutmeldingen['toppings2'] ?></span>
                    <?php endif ?>
                    <?php if (isset($foutmeldingen['toppings5'])) : ?>
                    <span class="error"><?php echo $foutmeldingen['toppings5'] ?></span>
                    <?php endif ?>
                </div>
            </fieldset>
            <fieldset>
                <legend>Pikant</legend>
                <div>
                    <div class="pikant">
                        <input type="range" name="pikant" min="0" max="10">
                        <div>
                            <span>Niet pikant</span>
                            <span>Heel pikant</span>
                        </div>
                    </div>
                </div>
            </fieldset>
            <fieldset>
                <legend>Jouw gegevens</legend>
                <div>
                    <label for="naam">Naam</label>
                    <input type="text" name="naam" value="<?php echo $_POST['naam'] ?? '' ?>" id="naam">
                </div>
                <?php if (isset($foutmeldingen['naam'])) : ?>
                <span class="error"><?php echo $foutmeldingen['naam'] ?></span>
                <?php endif ?>
                <div>
                    <label for="straat">Straat + Huisnummer</label>
                    <input type="text" name="straat" value="<?php echo $_POST['straat'] ?? '' ?>" id="straat">
                </div>
                <?php if (isset($foutmeldingen['straat'])) : ?>
                <span class="error"><?php echo $foutmeldingen['straat'] ?></span>
                <?php endif ?>
                <div>
                    <label for="gemeente">Postcode + Gemeente</label>
                    <input type="text" name="gemeente" value="<?php echo $_POST['gemeente'] ?? '' ?>" id="gemeente">
                </div>
                <?php if (isset($foutmeldingen['gemeente'])) : ?>
                <span class="error"><?php echo $foutmeldingen['gemeente'] ?></span>
                <?php endif ?>
                <div>
                    <label for="email">E-mailadres</label>
                    <input type="text" name="email" value="<?php echo $_POST['email'] ?? '' ?>" id="email">
                </div>
                <?php if (isset($foutmeldingen['email'])) : ?>
                <span class="error"><?php echo $foutmeldingen['email'] ?></span>
                <?php endif ?>
                <div>
                    <label for="tel">Telefoonnummer</label>
                    <input type="text" name="tel" value="<?php echo $_POST['tel'] ?? '' ?>" id="tel">
                </div>
                <?php if (isset($foutmeldingen['tel'])) : ?>
                <span class="error"><?php echo $foutmeldingen['tel'] ?></span>
                <?php endif ?>
            </fieldset>

            <input type="submit" value="Bestelling plaatsen" class="submit">
        </form>

        <footer class="footer">
            Met het plaatsen van een bestelling ga je akkoord met de algemene voorwaarden.
        </footer>
        <?php endif ?>
    </div>

</body>

</html>