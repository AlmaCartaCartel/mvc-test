var answers = document.querySelectorAll('a.answer');
var hidens = document.querySelectorAll('input._comment');

for (let i = 0; i < answers.length; i++){
    answers[i].addEventListener('click', function () {
        document.querySelector('.comment_id').value = hidens[i].value;
    })
}