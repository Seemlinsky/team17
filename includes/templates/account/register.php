<?php if (!empty($errors)): ?>
    <section class="content">
        <ul class="notification is-danger">
            <?php foreach ($errors as $error): ?>
                <li><?= $error; ?></li>
            <?php endforeach; ?>
        </ul>
    </section>
<?php endif; ?>

<section>
    <div class="bigtext">
        <div>
            <p>Registratie</p>
        </div>
    </div>
    <div class="bigtext">
        <div>
            <p>NOG NIET AF!!!</p>
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