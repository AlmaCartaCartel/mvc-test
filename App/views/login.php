<?php
session_start();
include 'layout/header.php'; ?>

    <form method="post" action="/auth/login" class="form">
        <?php if($_SESSION['status']):?>
            <div class="alert alert-dark" role="alert">
                <?= $_SESSION['status'] ?>
            </div>
            <?php unset($_SESSION['status']);
        endif;
        ?>
        <div class="form-group">
            <label for="exampleInputEmail1">Login</label>
            <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="login">
        </div>
        <div class="form-group">
            <label for="exampleInputPassword1">Password</label>
            <input type="password" class="form-control" id="exampleInputPassword1" name="password">
        </div>

        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
<?php include 'layout/footer.php'; ?>