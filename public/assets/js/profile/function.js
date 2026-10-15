function isError(alert) {
    if (alert != null) {
        Swal.mixin({
            toast: true,
            position: "top-end",
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true,
            didOpen: (toast) => {
                toast.onmouseenter = Swal.stopTimer;
                toast.onmouseleave = Swal.resumeTimer;
            }
        }).fire({
            icon: alert[0],
            title: alert[1],
        });
    }
}

function imagPath(imageName) {
    return window.location.origin + "/bookstore/public/assets/images/" + imageName;
}


function showError(errors) {
    for (let error in errors) {
        $(`p.alert[data-error-name="${error}"]`).text(errors[error]).removeClass("d-none");
    }
}

function openModel(modelId) {
    const modalElement = document.getElementById(`#${modelId}`);
    const myModal = new bootstrap.Modal(modalElement);

    myModal.show();
}

function bookComponent(book, status) {
    let shortDesc = (book['description'] ?? '').slice(0, 100);

    let additionalRow = "";

    if(status == 'books'){

        additionalRow = `
            <div class='row'>
                <div class='col-5'>
                    <div class='item'>
                        <h5 class='card-title'>Stock :</h5>
                    </div>
                </div>
                <div class='col-7'>
                    <div class='item'>
                        <P>${book['stock']}</P>
                    </div>
                </div>
            </div>

            <div class='input-group'>
                <input type='number' min='1' class='form-control' placeholder='Quantity' id='input_quantity_${book['id']}' >
                <button class='btn btn-outline-success' type='button' onclick= 'addToCart(${book['id']}, this)' >Added To Cart</button>
            </div>
        `;

    }else if(status == 'cart'){

        additionalRow = `
            <div class='row'>
                <div class='col-5'>
                    <div class='item'>
                        <h5 class='card-title'>Subtotal :</h5>
                    </div>
                </div>
                <div class='col-7'>
                    <div class='item'>
                        <P class="subtotal">${book['subtotal']}</P>
                    </div>
                </div>
            </div>

            <div class="input-group mb-3 w-50 m-auto ">
                <button class="btn btn-outline-dander" onclick="decreaseOrderItem(${book['order_item_id']})"" id="button-addon1"><i class="fa-solid fa-minus"></i></button>
                <input type="text" class="form-control text-center" placeholder="" aria-label="Example text with button addon" aria-describedby="button-addon1" value="${book['quantity']}" disabled>
                <button class="btn btn-outline-success" onclick="increaseOrderItem(${book['order_item_id']})"" id="button-addon1"><i class="fa-solid fa-plus"></i></button>
            </div>
        `;

    }else if(status == 'show'){
        additionalRow = '' ;
    }

    return`
        <div class='col-lg-4 mb-3'>
            <div class='item'>
                <div class='card px-2 py-3 rounded-4 bg-primary-subtle text-primary-emphasis position-relative' data-book-id="${book['book_id']}">
                    ${(status == 'cart')? `<i class="fa-solid fa-trash-can text-danger position-absolute" style="top:20px; right:20px;" onclick="deleteOrderItem(${book['order_item_id']}, this)"></i>` : ''}
                    <img src='${imagPath(book.image == null ? 'book.png' : `uploads/${book.image}`)}' style='width: 100px' class='card-img-top m-auto d-block' alt='...'>
                    <div class='card-body'>
                        <h5 class='card-title mb-4 text-center'> ${book['title']}</h5>
                        <div class='row'>
                            <div class='col-5'>
                                <div class='item'>
                                    <h5 class='card-title'> Author :</h5>
                                </div>
                            </div>
                            <div class='col-7'>
                                <div class='item'>
                                    <P>${book['author_name']}</P>
                                </div>
                            </div>
                        </div>
                        <div class='row'>
                            <div class='col-5'>
                                <div class='item'>
                                    <h5 class='card-title'> Description :</h5>
                                </div>
                            </div>
                            <div class='col-7'>
                                <div class='item'>
                                    <P>${shortDesc}...</P>
                                </div>
                            </div>
                        </div>
                        <div class='row'>
                            <div class='col-5'>
                                <div class='item'>
                                    <h5 class='card-title'> price :</h5>
                                </div>
                            </div>
                            <div class='col-7'>
                                <div class='item'>
                                    <P>${book['price']}</P>
                                </div>
                            </div>
                        </div>
                        ${additionalRow}
                    </div>
                </div>
            </div>
        </div>
    `;
}