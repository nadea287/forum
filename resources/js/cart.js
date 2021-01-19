$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

const selectQuantity = document.querySelector('.quantity');
const itemPrice = document.querySelector('.cart-item-price');
selectQuantity.addEventListener('change', function (e) {
    let id = e.target.dataset.id;
    let selectedOption = selectQuantity.value;
    let selectesAttribute = selectQuantity.options[selectQuantity.options.selectedIndex].value;
        Array.from(selectQuantity).forEach(function (element) {
            let innerValues = element.innerHTML;
            Array.from(innerValues).forEach(function (item) {
                if (item == selectedOption) {
                    selectQuantity.options[selectQuantity.options.selectedIndex].setAttribute("selected", "");
                } else {
                    element.removeAttribute("selected");
                }
            })
        });
        $.ajax({
            url: `cart/${id}`,
            method: 'PUT',
            data: {
            'quantity': selectedOption,
            }
        }).done(function (result) {
            let dataResult = JSON.parse(result);
            let price = dataResult.price;
            itemPrice.innerHTML = price;
        }).fail(function (error) {
            console.log(error);
        });
    });

    // const classname = document.querySelectorAll('.cart-items .quantity');
    // const classname = document.querySelectorAll('.quantity');
    // Array.from(classname).forEach(function (element) {
    //     element.addEventListener('change', function (e) {
    //         let id = element.dataset.id;
    //         let btn = e.target;
    //         let closestTarget = $(e.target);
    //         let qtyDetails = closestTarget.closest('.select-qty');
    //
    //         $.ajax({
    //             url: `cart/${id}`,
    //             method: 'PUT',
    //             // data: {
    //             // 'quantity': this.value,
    //             // 'price': 2
    //             // }
    //             data: qtyDetails.serialize()
    //
    //         }).done(function (result) {
    //             console.log(result);
    //             // $(btn).replaceWith(result);
    //             // $(btn).html(result);
    //
    //             closestTarget.closest('.wrap-select').html(result)
    //
    //             // change.replaceWith(result);
    //             // window.location.href = "{{ route('cart.index') }}"
    //             // window.location.href = "/cart"
    //         }).fail(function (error) {
    //             // window.location.href = '{{ route(cart.index) }}'
    //             console.log(error);
    //         });
    //     })
    // });

