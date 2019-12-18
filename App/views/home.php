<?php

include 'layout/header.php'; ?>
<div>
    <h1>Home page</h1>
    <div>
        <?php if($_SESSION['status']):?>
            <div class="alert alert-dark" role="alert">
                <?= $_SESSION['status'] ?>
            </div>
        <?php unset($_SESSION['status']);
            endif;
        ?>
        <h3>Comments</h3>
        <pre>
<!--        --><?php
//         var_dump($data);
//       die();
//         ?>
        </pre>
            <?php
            function renderComennts($data, $margin = 0){
                foreach ($data as $comment):
                ?>
                <div class="comment" style="margin-left: <?= $margin ?>px">
                    <h3 class="author"><?= $comment['user_name']?></h3>
                    <p><?= $comment['massage']?></p>
                    <span>
                        <input type="hidden" class="_comment" value="<?= $comment['id']?>">
                        <a href="#form" class="answer">ответить</a>
                    </span>
                    <span><?= $comment['date']?></span>
                </div>
                <?php
                if (!empty($comment['answers'])){
                    renderComennts($comment['answers'], $margin + 30);
                }
                endforeach;
                };
            ?>

        <?php renderComennts($data); ?>

            <?php if ($_SESSION['auth']):?>
                <form action="/comments/add" method="post" class="comment" id="form">
                    <h4> Message </h4>

                    <input type="hidden" name="comment_id" value='null' class="comment_id">
                    <textarea name="message" id="textarea" cols="30" rows="10"></textarea><br>

                    <button type="submit" class="btn btn-success"> Submit</button>
                </form>
            <?php else: ?>
                <div class="alert alert-dark" role="alert">
                    <a href="/auth">Авторизируйтесь</a>! или <a href="/register">зарагестрируйтесь</a>!
                </div>
            <?php endif; ?>
    </div>
</div>

<?php include 'layout/footer.php'; ?>