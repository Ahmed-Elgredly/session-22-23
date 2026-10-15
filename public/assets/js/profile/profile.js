$(document).ready(function () {

    let type = new URLSearchParams(window.location.search).get('tab');

    if (type) {
        $(`#nav-${type}-tab`).get(0)?.click();
    }

});

$('#AddAuthorForm').submit(function (e) {
    e.preventDefault();

    let dataFOrm = new FormData(this);

    $.ajax({
        url: "profile/addAuthor",
        type: "POST",
        data: dataFOrm,
        processData: false,
        contentType: false,
        success: function (response) {

            let author = response.data;

            let modal = bootstrap.Modal.getInstance(
                document.getElementById('addAuthorModal')
            );

            modal.hide();

            $('#AddAuthorForm').get(0).reset();

            $(`#addAuthorModal p.alert[data-error-name]`).addClass("d-none");

            $('#nav-authors > .row').prepend(`<div class='col-lg-4 mb-3'>
                        <div class='item'>
                            <div class='card px-2 py-3 rounded-4 bg-primary-subtle text-primary-emphasis'>
                                <img src='${imagPath('author.png')}' style='width: 100px' class='card-img-top m-auto d-block' alt='...'>
                                <div class='card-body'>
                                    <h5 class='card-title mb-4 text-center'> ${author.name}</h5>
                                    <div class='row'>
                                        <div class='col-5'>
                                            <div class='item'>
                                                <h5 class='card-title'> BIO :</h5>
                                            </div>
                                        </div>
                                        <div class='col-7'>
                                            <div class='item'>
                                                <P>${author.bio.slice(0, 100)}...</P>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>`);

        },
        error: function (response) {
            let errors = response.responseJSON.data;

            showError(errors);
        }

    });

});

$('#BooksFilterForm').submit(function (e) {
    e.preventDefault();

    let dataForm = new FormData(this);

    $.ajax({
        url: "profile/filterBooks",
        type: "POST",
        data: dataForm,
        processData: false,
        contentType: false,
        success: function (response) {

            let books = response.data.data,
                currentPage = response.data.currentPage,
                total = response.data.total;

            $("#nav-books > .row").html("");

            $('#nav-books #nav-book-filter').remove();

            if (books.length != 0) {
                for (let i = 0; i < books.length; i++) {

                    let shortDesc = (books[i]['description'] ?? '').slice(0, 100);

                    $("#nav-books > .row").append(bookComponent(books[i], 'books'));

                }

                $(`#nav-books`).append(preparePagination(response.data));
            } else {
                $("#nav-books > .row").append(`<p class='alert alert-warning w-75 m-auto text-center'>There are no books</p>`)
            }

        },
        error: function (response) {
            console.log(response.responseText);
        }

    });

});

function preparePagination(data) {

    let books = data.data;

    if (books.length != 0) {

        let prepareLi = "",
            pagesNumber = Math.ceil(data.total / 10),
            prevPageNumber = (data.currentPage > 1) ? data.currentPage - 1 : 1,
            isPrevPageDisabled = (data.currentPage > 1) ? '' : 'disabled',
            nextPageNumber = (data.currentPage < pagesNumber) ? data.currentPage + 1 : pagesNumber,
            isNextPageDisabled = (data.currentPage < pagesNumber) ? '' : 'disabled';


        for (let i = 1; i <= pagesNumber; i++) {
            let isActive = (data.currentPage == i) ? 'active' : '';
            prepareLi += `<li class='page-item ${isActive}'><a class='page-link' onclick="changePage(${i})" data-page="${i}" >${i}</a></li>`;
        }

        return `
            <nav id = 'nav-book-filter' aria-label='Page navigation example' >
                <ul class='pagination'>
                    <li class='page-item'><a class='page-link ${isPrevPageDisabled}' onclick="changePage(${prevPageNumber})" data-page ="${prevPageNumber}">Previous</a></li>
                    ${prepareLi}
                    <li class='page-item'><a class='page-link ${isNextPageDisabled}' onclick="changePage(${nextPageNumber})" data-page ="${nextPageNumber}">Next</a></li>
                </ul>
            </nav>
        `;
    }

    return "";
}

function changePage(page) {
    $("#BooksFilterForm #StartPage").val(page);
    $("#BooksFilterForm").trigger("submit");
}

function openAddBookPopup(authorId, authorName) {

    $("#AuthorId").val(authorId);
    $("#AuthorName").val(authorName);

    openModel("addBookModal")
}

$("#AddBookForm").submit(function (e) {
    e.preventDefault();

    let dataForm = new FormData(this);

    $.ajax({
        url: "profile/addBook",
        type: "POST",
        data: dataForm,
        processData: false,
        contentType: false,

        success: function (response) {

            let book = response.data;

            let shortDesc = (book.description ?? '').slice(0, 100);

            $('#AddBookForm')[0].reset();

            $('#addBookModal p.alert[data-error-name]')
                .addClass("d-none")
                .text("");

            bootstrap.Modal
                .getOrCreateInstance(
                    document.getElementById("addBookModal")
                )
                .hide();

            let image = book.image
                ? imagPath(`uploads/${book.image}`)
                : imagPath("book.png");

            $("#nav-books > .row").prepend(bookComponent(book ,show));
        },

        error: function (response) {

            let errors = response.responseJSON?.data ?? {};

            showError(errors);
        }
    });
});

function banUser(userId, text) {

    swalWithBootstrapButtons.fire({
        title: "Are you sure?",
        text: "You won't be able to revert this!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonText: `yes, ${text} it`,
        cancelButtoncolor: "#3085d6",
        cancelButtoncolor: "#d33"
    }).then((result) => {
        if (result.isConfirmed) {

            let dataForm = {
                'userId': userId,
            };

            $.ajax({
                url: "profile/banUSer",
                type: "POST",
                data: dataForm,
                processData: false,
                contentType: false,

                success: function (response) {

                    let user = response.data;

                    let isBageBaned = (user['is_banned'] == 1) ? "<span class='badge text-bg-danger position-absolute' style='top: 10px; right: 10px;'>Baned</span>" : '';

                    let isButtonBaned = (user['is_banned'] == 1) ? `<button class='btn btn-danger w-100' onclick='banUser(${user['id']}, "Unban")'>UNBAN</button>`
                                                                :
                                                                   `<button class='btn btn-danger w-100' onclick='banUser(${user['id']}, "Ban")'>BAN</button>`;


                    $(`.card[data-user-id='${userId}']`).html(`
                        |${isBageBaned}
                                <img src='${imagPath(`${user.role}.png`)}' style='width: 100px' class='card-img-top m-auto d-block' alt='...'>
                                <div class='card-body'>
                                    <h5 class='card-title mb-4 text-center'> ${admin['name']}</h5>
                                    <div class='row'>
                                        <div class='col-5'>
                                            <div class='item'>
                                                <h5 class='card-title'> Email :</h5>
                                            </div>
                                        </div>
                                        <div class='col-7'>
                                            <div class='item'>
                                                <P>${admin['email']}</P>
                                            </div>
                                        </div>
                                    </div>
                                    <div class='row'>
                                        <div class='col-5'>
                                            <div class='item'>
                                                <h5 class='card-title'> Gender :</h5>
                                            </div>
                                        </div>
                                        <div class='col-7'>
                                            <div class='item'>
                                                <P>${admin['gender']}</P>
                                            </div>
                                        </div>
                                    </div>
                                    <div class='row'>
                                        <div class='col-5'>
                                            <div class='item'>
                                                <h5 class='card-title'> Phone :</h5>
                                            </div>
                                        </div>
                                        <div class='col-7'>
                                            <div class='item'>
                                                <P>${admin['phone']}</P>
                                            </div>
                                        </div>
                                    </div>
                                    ${isButtonBaned}
                                </div>
                        `);

                    swal.fire({
                        title: `${user.is_banned ? 'Banned' : 'Unbanned'}`,
                        text: "user has been updated.",
                        icon: "success"
                    });

                },

                error: function (response) {

                    if (response.status == 422) {

                        let errorMsg = response.responseJSON.data.userId[0];

                        isError(['error', errorMsg]);
                    }
                }
            });
        }

    });
}

