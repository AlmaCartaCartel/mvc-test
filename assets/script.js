async function getComments() {
    let response = await fetch('/comments/getComments');

    if (!response.ok){
        throw new Error(
            `Не удалось запросить данные по адресу`
        );
    }
    return response.json();
}

function addComment(comment){
    const allAnswers = document.querySelectorAll('.answers');

    comment.then(
        res => {
            if (res.comment_id === null){
                document.getElementById('comments').appendChild(createComment(res))
            }else{
                for (let elem of allAnswers){
                    if (res.comment_id === elem.dataset.commentid){
                        elem.appendChild(createComment(res, +elem.dataset.margin + 30));
                    }
                }
            }
        }
    ).then(
        () => applyPostId()
    )
}

let form = document.getElementById('form');

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
        await addComment(response.json())
    });
}


function createComment(comment, margin) {

    const li = document.createElement('li');
    const answer = `<button class="answer" data-commentid ="${comment.id}">answer</button>`;
    const bollean = document.getElementById('comments').dataset.auth;
    const Comment = `
        <div class="comment" style="margin-left: ${margin}px" ">
            <h3 class="author">${comment.user_name}</h3>
            <p>${comment.massage}</p>
            ${bollean === '1'? answer: ''}
            <span>${comment.date}</span>
        </div>
        <ul class="answers" style="list-style: none" data-margin="${margin}" data-commentid="${comment.id}">
        </ul>`;

    li.innerHTML = Comment;
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
            renderComments(comment.answers, margin + 30, com.querySelector('ul'));
        }
    }
}

function applyPostId() {
    const form = document.querySelector('.comment_id');
    const answers = document.querySelectorAll('.answer');
    for (let i = 0; i < answers.length; i++){
        answers[i].addEventListener('click', function () {
            form.value = this.dataset.commentid;
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