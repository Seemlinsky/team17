<?php

?>
<!doctype html>


<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="login.css">
    <title>Login</title>
</head>


<body>

<header>
    <div class="navbar">

        <div class="navdiv">
            <div class="navknop">
                <a href="home">Home</a>
            </div>
        </div>

        <div class="titel">
            <p> Victoria schoonmaakbedrijf</p>
        </div>

        <div class="navdiv">
            <div class="navknop">
                <a href="uitloggen">Uitloggen</a>
            </div>

        </div>


    </div>


</header>
<section>
    <div class="bigtext">
        <div>
            <p>Log in</p>
        </div>
        <div class="smalltaxt">
            <p>U moet inloggen voordat u een afspraak kan maken</p>
        </div>
    </div>
    <div class="formdiv">
        <form action="post">

            <div class="veld">
                <div >
                    <div>
                        <label for="email">Email</label>
                    </div>
                    <div>
                        <input name="email" id="email" type="text" placeholder="Email bvb. naam@org.nl">

                    </div>

                </div>
                <div >
                    <div>
                        <label for="wachtwoord">Wachtwoord</label>
                    </div>
                    <div>
                        <input name="wachtwoord" id="wachtwoord"  type="text" placeholder="Wachtwoord">
                    </div>

                </div>

                <div>
                    <button class="form-knop">
                        Log in
                    </button>
                </div>

                <div  class="linkdiv">
                    <p>Nog geen account? <a href="registratie">Registreer</a> hier.</p>
                </div>
            </div>



        </form>

    </div>

</section>
</body>
<footer>
    <div class="footerdiv">
        <div>
            <div>
                www.viktoriaschoonmaakbedrijf.com
            </div>
            <div>
            Neem contact op: nummer
            </div>

        </div>

        <div>
            <div class="linkdiv">
                <p> Meer weten? <a href="over ons">Over ons</a></p>

            </div>
        </div>
    </div>

</footer>

</html>
