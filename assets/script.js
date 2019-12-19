async function getComments() {
    let response = await fetch('/comments/getComments');

    if (!response.ok){
        throw new Error(
            `Не удалось запросить данные по адресу`
        );
    }
    return response.json();
}

let form = document.getElementById('form');
if (!form == null){

}
if (form !== null){
    form.addEventListener('submit', function (event) {
        document.getElementById('comments').innerHTML = '';

        let response = fetch('/comments/add',{
            method: 'POST',
            body: new FormData(this)
        });
        if (!response.ok){
            throw new Error(
                `Не удалось отправить данные по адресу`
            );
        }

        getComments()
            .then(
                res => renderComments(res))
            .then(
                () => applyPostId());
        event.preventDefault();

        document.getElementById('textarea').value = '';
    });
}


function createComment(arr, margin) {
    const div = document.createElement('div');
    div.classList.add('comment');
    div.style.marginLeft = margin +'px';

    const author = document.createElement('h3');
    author.innerHTML = arr.user_name;
    author.classList.add('author');

    const massage = document.createElement('p');
    massage.innerHTML = arr.massage;

    const inp = document.createElement('input');
    inp.type = 'hidden';
    inp.classList.add('_comment');
    inp.value = arr.id;

    const btn = document.createElement('button');
    btn.innerHTML = 'ответить';
    btn.classList.add( 'answer');

    const date = document.createElement('span');
    date.innerHTML = arr.date;

    div.appendChild(author);
    div.appendChild(massage);
    div.appendChild(inp);
    div.appendChild(btn);
    div.appendChild(date);

    return div;
}

function renderComments(arr, margin = 0){
    let container = document.getElementById('comments');
    for (let comment of arr){

        container.appendChild(createComment(comment, margin));
        if (comment.answers.length > 0){
            renderComments(comment.answers, margin + 30);
        }
    }
}

getComments().then(
    res => {
        renderComments(res);
    }
).then(() => applyPostId());

function applyPostId() {
    const form = document.querySelector('.comment_id');
    const answers = document.querySelectorAll('.answer');
    const hidens = document.querySelectorAll('._comment')
    for (let i = 0; i < answers.length; i++){
        answers[i].addEventListener('click', function () {
            form.value = hidens[i].value;
        })
    }
}

