<?php

include 'layout/header.php'; ?>
    <form method="post" action="/register/add" class="form">
        <?php if(isset($_SESSION['status'])):?>
            <div class="alert alert-dark" role="alert">
                <?php echo $_SESSION['status'] ?>
            </div>
            <?php unset($_SESSION['status']);
        endif;
        ?>
        <div class="form-group">
            <label for="exampleInputEmail1">Full Name</label>
            <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="name">
        </div>
        <div class="form-group">
            <label for="exampleInputEmail1">Login</label>
            <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="login">
        </div>
        <div class="form-group">
            <label for="exampleInputEmail1">Email address</label>
            <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="email">
        </div>
        <div class="form-group">
            <label for="exampleInputPassword1">Password</label>
            <input type="password" class="form-control" id="exampleInputPassword1" name="password">
        </div>

        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
<?php include 'layout/footer.php'; ?>