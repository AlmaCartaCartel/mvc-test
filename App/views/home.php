
<?php use core\DataBase;

include 'layout/header.php'; ?>
<?php
    $db = DataBase::db_comments();
    $res = mysqli_query($db, "SELECT * FROM `comments` DESC");
    $rows = mysqli_fetch_array($res, MYSQLI_ASSOC);
    var_dump($rows);

?>
<div>
    <h1>Home page</h1>
    <div>
        <h3>Comments</h3>

        <p><?php echo $rows['message'] ; ?></p>

        <form action="/comments/add" method="post">
            <h4>Message</h4>

            <textarea name="message" id="" cols="30" rows="10">

            </textarea>
            <button type="submit"> Submit</button>
        </form>
    </div>
</div>

<?php include 'layout/footer.php'; ?>