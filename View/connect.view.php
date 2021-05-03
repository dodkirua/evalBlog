<div>
    <h1>Bienvenue sur EvalBlog</h1>
    <h3>Veuillez vous connecter</h3>

    <div>
        <form action="/index.php?controller=form&action=connect" id="connect" method="post" class="form">
            <label for="username">Username</label>
            <input type="text" id="username" name="username">
            <label for="pass">Password</label>
            <input type="password" id="pass" name="pass">
            <input type="submit" value="Valider">
        </form>
        <div>
            <a href="/index.php?controller=passForgot">mot de passe oublié?</a>
        </div>
    </div>
</div>
