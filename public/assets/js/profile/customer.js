function addToCart(bookId, that) {
    let $quantityInput = $(that).prev(),
        quantity = $quantityInput.val();

    if (quantity == 0) {
        return;
    }

    let dataForm = {
        bookId: bookId,
        quantity: quantity,
    };

    $.ajax({
        url: "profile/addToCart",
        type: "POST",
        data: dataForm,
        success: function (response) {
            let totalItems = response.data.totalItems;

            $("#totalItems").text(totalItems);

            $quantityInput.val();
        },
        error: function (response) {

        }
    });

}

function getItemsIntoCart(orderId = null , status = 'cart') {
    

    $.ajax({
        url: "profile/getItemsIntoCart",
        type: "POST",
        data: dataForm,
        success: function (response) {

            let books = response.data

            if (books.length == 0) {
                $(`#CartModal .modal-body`).html(`<p class="alert alert-warning text-center">You Cart Is Empty</p>`)
            } else {

                $(`#CartModal .modal-body`).html(`
                        <h5 class="text-center mb-4" >Total Order Price : <span class="text-success" fw-bolder id="CartTotalPrice">${books[0].total_price}</span> </h5>
                        <div class="row"></div>
                        ${(status == 'cart') ? `<button class='btn btn-success w-100' onclick='fireOrder(${book[0]['order_id']}, this) '>Order Now</button> ` : ''};
                    `)

                for (let book of books) {
                    $(`#CartModal .modal-body > .row`).append(bookComponent(book, status))
                }

            }

            openModel("cart")
        },
        error: function (response) {

        }
    });
}

function increaseOrderItem(orderItemId, btn) {
    let cartEle = $(btn).parents(".card"),
        buttons = cartEle.find('button');

    buttons.prop('disabled', true);

    let dataForm = {
        orderItemId: orderItemId
    };

    $.ajax({
        url: "profile/increaseOrderItem",
        type: "POST",
        data: dataForm,
        success: function (response) {

            // let orderItemId = response.data.orderItem.id;
            let orderItem = response.data.orderItem;
            bookId = response.data.orderItem.book_id;

            $(`#cardModel .card[data-book-id="${bookId}"].subtotal`).text(orderItem.subtotal);
            $(`#cardModel .card[data-book-id="${bookId}"] input`).val(orderItem.quantity);
            $("#cardModel #CartTotalPrice").text(response.data.totalPrice)

            buttons.prop('disabled', false);

        },
        error: function (response) {

        }
    });
}

function decreaseOrderItem(orderItemId, btn) {
    let cartEle = $(btn).parents(".card"),
        buttons = cartEle.find('button');

    buttons.prop('disabled', true);

    let dataForm = {
        orderItemId: orderItemId
    };

    $.ajax({
        url: "profile/decreaseOrderItem",
        type: "POST",
        data: dataForm,
        success: function (response) {

            // let orderItemId = response.data.orderItem.id;
            let orderItem = response.data.orderItem;
            bookId = response.data.orderItem.book_id;

            if (orderItem.quantity == 0) {
                $(`#cardModel .card[data-book-id="${bookId}"]`).parent().parent().remove();
                if ($(`#cardModel .card`).length == 0) {
                    $(`#CartModal .modal-body`).html(`<p class="alert alert-warning text-center">You Cart Is Empty</p>`)
                }
            }

            $(`#cardModel .card[data-book-id="${bookId}"].subtotal`).text(orderItem.subtotal);
            $(`#cardModel .card[data-book-id="${bookId}"] input`).val(orderItem.quantity);
            $("#cardModel #CartTotalPrice").text(response.data.totalPrice);

            buttons.prop('disabled', false);

        },
        error: function (response) {

        }
    });
}

function deleteOrderItem(orderItemId, btn) {
    let cartEle = $(btn).parents(".card"),
        buttons = cartEle.find('button');

    buttons.prop('disabled', true);

    let dataForm = {
        orderItemId: orderItemId
    };

    $.ajax({
        url: "profile/deleteOrderItem",
        type: "POST",
        data: dataForm,
        success: function (response) {

            cartEle.parent().parent().remove();

            if ($(`#cardModel .card`).length == 0) {
                $(`#CartModal .modal-body`).html(`<p class="alert alert-warning text-center">You Cart Is Empty</p>`)
            } else {
                $(`#cardModel .card[data-book-id="${bookId}"].subtotal`).text(orderItem.subtotal);
                buttons.prop('disabled', false);
            }

        },
        error: function (response) {

        }
    });
}

function fireOrder(orderId) {

    let dataForm = {
        orderId: orderId
    };

    $.ajax({
        url: "profile/fireOrder",
        type: "POST",
        data: dataForm,
        success: function (response) {

            $("#Cart .btn-close").get(0).click();

            $("#TotalItems").text(0);

            Swal.fire({
                title: 'ordered',
                text: "your order has been sent",
                icon: "success"
            })

        },
        error: function (response) {

        }
    });
}

