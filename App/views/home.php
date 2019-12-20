<?php
include 'layout/header.php';
?>
<div>
    <h1>Home page</h1>
    <div>
        <?php if(isset($_SESSION['status'])):?>
            <div class="alert alert-dark" role="alert">
                <?php echo $_SESSION['status'] ?>
            </div>
        <?php unset($_SESSION['status']);
            endif;
        ?>
        <h3>Comments</h3>
            <div>
                <ul id="comments" style="list-style: none" data-auth="<?php echo isset($_SESSION['auth'])?>">

                </ul>
            </div>

            <?php if (isset($_SESSION['auth'])):?>
                <form action="" method="post" class="comment" id="form">
                    <h4> Message </h4>

                    <input type="hidden" name="comment_id" value='null' class="comment_id" >
                    <textarea name="message" id="textarea" class="form-control" cols="30" rows="3" placeholder="Введите комментарий"></textarea><br>

                    <button id="submit"  class="btn btn-success submit"> Submit</button>
                </form>
            <?php else: ?>
                <div class="alert alert-dark" role="alert">
                    <a href="/auth">Авторизируйтесь</a>! или <a href="/register">зарагестрируйтесь</a>!
                </div>
            <?php endif; ?>
    </div>
</div>

<?php include 'layout/footer.php'; ?>