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

function addComment() {
    const comment = document.createElement('li');
    comment.classList.add('comment')

    const author = document.createElement('h3');
    author.innerHTML = 'Author';
    author.classList.add('author');

    const massage = document.createElement('p');
    massage.innerHTML = document.getElementById('textarea').value;

    const hiden = document.querySelector('.comment_id');
    let id = document.querySelector('.com'+hiden.value );

    comment.appendChild(author);
    comment.appendChild(massage);

    id = id.lastChild;
    id.appendChild(comment);
    console.log(comment, id, hiden.value);
}

if (form !== null){
    btn = document.getElementById('submit')
    form.addEventListener('submit',  async function (event) {
        event.preventDefault();
        let response = await fetch('/comments/add',{
            method: 'POST',
            body: new FormData(this)
        });
        if (!response.ok){
            throw new Error(
                `Не удалось запросить данные по адресу`
            );
        }
        await console.log(response.json());
    });
}


function createComment(arr, margin) {
    const li = document.createElement('li');
    li.classList.add( 'com' + arr.id);
    const ul = document.createElement('ul');
    ul.style.listStyle = 'none';
    ul.classList.add('answers');

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

    li.appendChild(div);
    li.appendChild(ul);

    console.log(li.lastChild);
    return li;
}



function renderComments(arr, margin = 0, container = null){
    if (container === null){
        container = document.getElementById('comments');
    }
    for (let comment of arr){
        let com = createComment(comment, margin);
        container.appendChild(com);
        if (comment.answers.length > 0){
            renderComments(comment.answers, margin + 30, com.lastChild);
        }
    }
}

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
let arr;
getComments().then(
    res => {
        arr = res;
        renderComments(res);
    }
).then(() => applyPostId());