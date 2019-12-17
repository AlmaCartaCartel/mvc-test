<?php
session_start();
include 'layout/header.php'; ?>
<div>
    <h1>Home page</h1>
    <div>
        <h3>Comments</h3>
<!--        <pre>-->
<!--          --><?php
//          var_dump($data[2]);
//          die();
//          ?>
<!--        </pre>-->

        <?php
            foreach ($data[0] as $comment): ?>
                <div class="comment">
                    <h3><?= $comment[3]?></h3>
                    <p><?= $comment[1]?></p>
                    <input type="hidden" class="_comment" value="<?= $comment[0]?>">
                    <a href="#form">ответить</a>
                </div>

                <?php foreach ($data[1] as $comment_child):
                    if ($comment[0] == $comment_child[6]):?>
                    <div class="comment_child_1">
                        <h4><?= $comment[3]?></h4>
                        <p><?= $comment_child[1]?></p>
                        <input type="hidden" class="_comment" value="<?= $comment_child[0]?>">
                        <a href="#form">ответить</a>
                    </div>

                        <?php foreach ($data[1] as $comment_child_two):
                            if ($comment_child[0] == $comment_child_two[6]):?>
                                <div class="comment_child_2">
                                    <h4><?= $comment[3]?></h4>
                                    <p><?= $comment_child_two[1]?></p>
                                </div>
                            <?php endif;
                        endforeach; ?>

                    <?php endif;
                 endforeach; ?>

            <?php endforeach; ?>
            <?php if ($_SESSION['auth']):?>
                <form action="/comments/add" method="post" class="comment" id="form">
                    <h4> Message </h4>


                    <input type="hidden" name="comment_id" value='null' class="comment_id">
                    <textarea name="message" id="" cols="30" rows="10" ></textarea><br>

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