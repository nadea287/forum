$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

const quantityForms = document.querySelectorAll('.select-qty');
// const itemPrice = document.querySelectorAll('.cart-item-price');

for (let i = 0; i < quantityForms.length; i++) {

quantityForms[i].children[1].addEventListener('change', function (e) {
    let id = e.target.dataset.id;
    let selectedOption = e.target.value;
    // let selectesAttribute = selectQuantity.options[selectQuantity.options.selectedIndex].value;
        Array.from(e.target).forEach(function (element) {
            let innerValues = element.innerHTML;
            Array.from(innerValues).forEach(function (item) {
                if (item == selectedOption) {
                    e.target.options[e.target.options.selectedIndex].setAttribute("selected", "");
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
            quantityForms[i].children[0].innerHTML = price;
        }).fail(function (error) {
            console.log(error);
        });
    });
}

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


const inpFile = document.getElementById("inpFile");
const previewContainer = document.getElementById("imagePreview");

inpFile.addEventListener("change", function () {
    //this - refers to the input
    const file = this.files;
    console.log('file');

    if (file) {
        [].forEach.call(file, readAndPreview);
    }
    function readAndPreview(file) {
        if (!/\.(jpe?g|png|gif)$/i.test(file.name)) {
            return alert(file.name + " is not an image");
        } else {
            const reader = new FileReader();
            reader.addEventListener('load', function () {
                const image = new Image();
                image.height = 100;
                image.width = 100;
                image.title = file.name;
                image.src = this.result;
                previewContainer.appendChild(image);
            });
            reader.readAsDataURL(file);
        }
    }
});
