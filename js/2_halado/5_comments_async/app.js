// Oldal betöltése
$(document).ready(function () {
    // Kommentek gyűjtése
    collectComments();
    // Űrlap eseménykezelése
    initform();
});

// Kommentek gyűjtése
function collectComments() {
    $.get('api/index.php')
        .then(function (data) {
            $('#comments').empty();
            for (let comment of data.data) {
                renderComment(comment);
            }
        })
        .catch(function (error) {
            console.log(error.responseJson.data);
        });
}

// Komment megjelenítése
function renderComment(data) {
    // Div elem létrehozása
    let comment = $('<div></div>').html(`
        <p class="mb-1">${data.comment}</p>
        <div class="d-flex justify-content-between border-top pt-2 border-dark-subtle">
            <div class="d-flex flex-row align-items-center">
                <img src="profile.png" alt="avatar" width="25" height="25">
                <p class="small mb-0 ms-2 fst-italic">${data.author}</p>
            </div>
            <div class="d-flex flex-row align-items-center">
                <a href="#" class="small text-muted mb-0 me-2 upvote-btn">Upvote?</a>
                <p class="small text-muted mb-0 upvote-counter">${data.upvotes}</p>
            </div>
        </div>
    `)
    // Új komment gombjának kezelése, id tárolása
    comment.find('.upvote-btn').on('click', likeBtn_click).data('id', data.id);
    // Komment megjelenítése a DOM-ba
    $('#comments').append(comment);
}

// Upvote gomb kezelése
function likeBtn_click(event) {
    // Alapértelmezett viselkedés letiltása
    event.preventDefault();
    // Gomb elem
    let id = $(event.target).data('id');
    // Küldés szerverre
    upvoteComment(id);
}

// Kommentek kedvelése
function upvoteComment(id) {
    $.post('api/upvote.php', {id: id})
        .then(function (data) {
            collectComments();
        })
        .catch(function (error) {
            console.log(error.responseJson.data);
        });
}

// Komment form kezelése
function initform() {
    $('#newCommentForm').validate({
        rules: {
            author: {
                required: true,
                maxlength: 50
            },
            comment: {
                required: true,
            },
        },
        errorClass: 'is-invalid',
        errorPlacement: function (error, element) {
            error.addClass('invalid-feedback');
            error.insertAfter(element);
        },
        submitHandler: function (form) {
            removeErrors();
            let data = $(form).serialize();
            createComment(data);
        }
    });
}

// Új komment létrehozása
function createComment(data) {
    $.post('api/create.php', data)
        .then(function () {
            $('#newCommentForm').trigger('reset');
            collectComments();
        })
        .catch(function (error) {
            if(error.responseJSON.fields) {
                for (let key in error.responseJSON.fields) {
                    $(`[name="${key}"]`).addClass('is-invalid')
                        .after(`<div class="invalid-feedback">${error.responseJSON.fields[key]}</div>`);
                }
            }
        });
}

// Hibák törlése
function removeErrors() {
    $('.is-invalid').removeClass('is-invalid');
    $('.invalid-feedback').remove();
}