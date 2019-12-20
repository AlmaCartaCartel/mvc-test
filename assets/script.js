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
    const allComments = document.querySelectorAll('._comment');

    comment.then(
        res => {
            if (res.comment_id === null){
                document.getElementById('comments').appendChild(createComment(res))
            }else{
                for (let elem of allComments){
                    if (res.comment_id == elem.value){
                        elem.nextElementSibling.appendChild(createComment(res, +elem.dataset.margin + 30));
                        applyPostId();
                    }
                }
            }
        }
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
    const Comment = `
        <div class="comment" style="margin-left: ${margin}px" ">
            <h3 class="author">${comment.user_name}</h3>
            <p>${comment.massage}</p>
            <button class="answer" data-commentid ="${comment.id}">answer</button>
            <span>${comment.date}</span>
        </div>
        <input type="hidden" name="" class="_comment" value="${comment.id}" data-margin="${margin}">
        <ul class="answers" style="list-style: none">
<!--            answers-->
        </ul>`;

    li.innerHTML = Comment;
    li.classList.add('comment_container');
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