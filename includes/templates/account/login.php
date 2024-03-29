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
            <p>Log in</p>
        </div>
        <div class="smalltaxt">
            <p>U moet inloggen voordat u een afspraak kan maken</p>
        </div>
    </div>
    <div class="formdiv">
        <form action="" method="post">

            <div class="veld">
                <div >
                    <div>
                        <label for="email">Email</label>
                    </div>
                    <div>
                        <input name="email" id="email" type="email" placeholder="Email" required>

                    </div>

                </div>
                <div >
                    <div>
                        <label for="password">Wachtwoord</label>
                    </div>
                    <div>
                        <input name="password" id="password" type="password" placeholder="Wachtwoord" required>
                    </div>

                </div>

                <div>
                    <button class="form-knop" type="submit" name="submit">
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