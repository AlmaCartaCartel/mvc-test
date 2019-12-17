var comment = document.querySelectorAll('._comment');
for (let i = 0; i < comment.length; i++){

    comment[i].nextElementSibling.addEventListener('click', function (e) {
        document.querySelector('.comment_id').value = comment[i].value;
    })
}