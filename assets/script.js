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
                        const com = createComment(res, true)
                        elem.appendChild(com);

                        com.scrollIntoView({
                            behavior: 'smooth',
                            block: 'start'
                        })
                    }
                }
            }
        }
    ).then(
        () => applyPostId()
    )
}
function createComment(comment, bool = false) {
    const li = document.createElement('li');
    let answer = `<button 
                        class="answer btn btn-secondary" 
                        data-parent="${comment.parent == null ? 1: +comment.parent}"
                        data-commentid ="${comment.id}">answer</button>`;
    if (+document.getElementById('comments').dataset.nesting == comment.parent){
        answer = '';
    }

    const isNewComment = `<span class="badge badge-success">New</span>`;
    const auth = document.getElementById('comments').dataset.auth;

    const Comment = `
        <div class="comment" >
            <h3 class="author">${comment.user_name} 
                ${bool ? isNewComment: ''}
            </h3>
            <pre>${comment.massage}</pre>
            <div class="d-flex justify-content-between">
                ${auth === '1'? answer: ''}
                <span>${comment.date}</span>   
            </div>
        </div>
        <ul class="answers " style="list-style: none; margin-left: 30px" data-commentid="${comment.id}" >
        </ul>`;

    li.innerHTML = Comment;
    return li;
}

function renderComments(arr, container = null){
    if (container === null){
        container = document.getElementById('comments');
    }
    for (let comment of arr){
        let com = createComment(comment);
        container.appendChild(com);
        if (comment.answers.length > 0){
            renderComments(comment.answers,  com.querySelector('ul'));
        }
    }
}

function applyPostId() {
    const comment_id = document.querySelector('.comment_id');
    const answers = document.querySelectorAll('.answer');
    for (let i = 0; i < answers.length; i++){
        answers[i].addEventListener('click', function () {
            comment_id.value = this.dataset.commentid;
            const blockID = 'form';
            document.getElementById(blockID).scrollIntoView({
                behavior: 'smooth',
                block: 'start'
            })
        })
    }
}
getComments().then(
    res => {
        renderComments(res);
    }
).then(() => applyPostId());


let form = document.getElementById('form');

if (form !== null){
    btn = document.getElementById('submit')
    form.addEventListener('submit',    async function (event) {
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
         await addComment(response.json());
        document.getElementById('textarea').value = '';

    });
}