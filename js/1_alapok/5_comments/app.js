// Oldal betöltése
window.onload = function () {

    // Form kezelése
    let form = document.getElementById('newCommentForm');
    form.addEventListener('submit', function (event) {
        // Megakadályozza, hogy a tényleges submit esemény lefusson
        event.preventDefault();
        // Form adatok kigyűjtése
        let data = Object.fromEntries(new FormData(event.target));
        // Komment létrehozása
        createComment(data);
    });

    // Alapértelmezett kommentek gombjainak lekezelése
    for (let btn of document.getElementsByClassName('upvote-btn')) {
        btn.addEventListener('click', likeBtn_click);
    }
};

// Új komment beszúrása
function createComment(data) {
    // Div elem létrehozása
    let comment = document.createElement('div');
    // Div elem belsejének beállítása string interpoláció segítségével
    comment.innerHTML = `
        <p class="mb-1">${data.text}</p>
        <div class="d-flex justify-content-between border-top pt-2 border-dark-subtle">
            <div class="d-flex flex-row align-items-center">
                <img src="profile.png" alt="avatar" width="25" height="25">
                <p class="small mb-0 ms-2 fst-italic">${data.author}</p>
            </div>
            <div class="d-flex flex-row align-items-center">
                <a href="#" class="small text-muted mb-0 me-2 upvote-btn">Upvote?</a>
                <p class="small text-muted mb-0 upvote-counter">0</p>
            </div>
        </div>
    `;
    // Új komment gombjának kezelése
    let btn = comment.querySelector('.upvote-btn');
    btn.addEventListener('click', likeBtn_click);
    // Komment megjelenítése a DOM-ba
    document.getElementById('comments').appendChild(comment);
}

// Upvote gomb kezelése
function likeBtn_click(event) {
    // Alapértelmezett viselkedés letiltása
    event.preventDefault();
    // Számláló megkeresése
    let likes = event.target.parentElement.querySelector('.upvote-counter');
    // Számlálló értékének növelése
    likes.innerText = parseInt(likes.innerText) + 1;
}
