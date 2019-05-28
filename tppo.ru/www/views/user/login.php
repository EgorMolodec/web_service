<?php include ROOT . '/views/layouts/header.php'; ?>

<section>
    <div class="container">
        <div class="row">
            <div class="col-sm-4 col-sm-offset-4 padding-right">
                <?php if (isset($errors) && is_array($errors)): ?>
                    <ul>
                        <?php foreach ($errors as $error): ?>
                            <li> - <?php echo $error; ?></li>
                        <?php endforeach; ?>
                    </ul>
                <?php endif; ?>
                <div class="signup-form">
                    <h2 align="center">Добро пожаловать!</h2>
                    <form action="#" method="post">
                        <input type="text" class="form-control" name="login" placeholder="Login"/>
                        <input type="password" name="password" class="form-control" placeholder="Password" value="<?php echo $password; ?>"/>
                        <input type="submit" name="submit" class="btn btn-default btn-block btn-signin"  value="Вход" />
                    </form>
                </div>
                <br/>
                <br/>
            </div>
        </div>
    </div>
</section>

<?php include ROOT . '/views/layouts/footer.php'; ?>