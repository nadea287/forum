// // (function(){
//     // Create a Stripe client
//     var stripe = Stripe('pk_test_51I4oAwB3HHVT8h0RLqvpgrnb2zQ5d7tDfgamf70f6o4cQhG9t96dpvafxtIFdX0usN27pzuYfdg69SnkSvwPwhT200tKqXZcWp');
//     // Create an instance of Elements
//     var elements = stripe.elements();
//     // Custom styling can be passed to options when creating an Element.
//     // (Note that this demo uses a wider set of styles than the guide below.)
//     var style = {
//         base: {
//             color: '#32325d',
//             lineHeight: '18px',
//             fontFamily: '"Roboto", Helvetica Neue", Helvetica, sans-serif',
//             fontSmoothing: 'antialiased',
//             fontSize: '16px',
//             '::placeholder': {
//                 color: '#aab7c4'
//             }
//         },
//         invalid: {
//             color: '#fa755a',
//             iconColor: '#fa755a'
//         }
//     };
//     // Create an instance of the card Element
//     var card = elements.create('card', {
//         style: style,
//         hidePostalCode: true
//     });
//     // Add an instance of the card Element into the `card-element` <div>
//     card.mount('#card-element');
//     // Handle real-time validation errors from the card Element.
//     card.addEventListener('change', function(event) {
//         var displayError = document.getElementById('card-errors');
//         if (event.error) {
//             displayError.textContent = event.error.message;
//         } else {
//             displayError.textContent = '';
//         }
//     });
//     // Handle form submission
//     var form = document.getElementById('payment-form');
//     form.addEventListener('submit', function(event) {
//         event.preventDefault();
//         // Disable the submit button to prevent repeated clicks
//         document.getElementById('complete-order').disabled = true;
//         var options = {
//             name: document.getElementById('name_on_card').value,
//             address_line1: document.getElementById('address').value,
//             address_city: document.getElementById('city').value,
//             address_state: document.getElementById('province').value,
//             address_zip: document.getElementById('postalcode').value
//         }
//         stripe.createToken(card, options).then(function(result) {
//             if (result.error) {
//                 // Inform the user if there was an error
//                 var errorElement = document.getElementById('card-errors');
//                 errorElement.textContent = result.error.message;
//                 // Enable the submit button
//                 document.getElementById('complete-order').disabled = false;
//             } else {
//                 // Send the token to your server
//                 stripeTokenHandler(result.token);
//             }
//         });
//     });
//     function stripeTokenHandler(token) {
//         // Insert the token ID into the form so it gets submitted to the server
//         var form = document.getElementById('payment-form');
//         var hiddenInput = document.createElement('input');
//         hiddenInput.setAttribute('type', 'hidden');
//         hiddenInput.setAttribute('name', 'stripeToken');
//         hiddenInput.setAttribute('value', token.id);
//         form.appendChild(hiddenInput);
//         // Submit the form
//         form.submit();
//     }
    // PayPal Stuff
    // var form = document.querySelector('#paypal-payment-form');
    // var client_token = "{{ '$paypalToken' }}";
    // braintree.dropin.create({
    //     authorization: client_token,
    //     selector: '#bt-dropin',
    //     paypal: {
    //         flow: 'vault'
    //     }
    // }, function (createErr, instance) {
    //     if (createErr) {
    //         console.log('Create Error', createErr);
    //         return;
    //     }
    //     // remove credit card option
    //     var elem = document.querySelector('.braintree-option__card');
    //     elem.parentNode.removeChild(elem);
    //     form.addEventListener('submit', function (event) {
    //         event.preventDefault();
    //         instance.requestPaymentMethod(function (err, payload) {
    //             if (err) {
    //                 console.log('Request Payment Method Error', err);
    //                 return;
    //             }
    //             // Add the nonce to the form and submit
    //             document.querySelector('#nonce').value = payload.nonce;
    //             form.submit();
    //         });
    //     });
    // }
    // );
// })();


// // Create a Stripe client.
var stripe = Stripe('pk_test_51I4oAwB3HHVT8h0RLqvpgrnb2zQ5d7tDfgamf70f6o4cQhG9t96dpvafxtIFdX0usN27pzuYfdg69SnkSvwPwhT200tKqXZcWp');
console.log(stripe);
// Create an instance of Elements.
var elements = stripe.elements();

// Custom styling can be passed to options when creating an Element.
// (Note that this demo uses a wider set of styles than the guide below.)
var style = {
    base: {
        color: '#32325d',
        fontFamily: '"Helvetica Neue", Helvetica, sans-serif',
        fontSmoothing: 'antialiased',
        fontSize: '16px',
        '::placeholder': {
            color: '#aab7c4'
        }
    },
    invalid: {
        color: '#fa755a',
        iconColor: '#fa755a'
    }
};

// Create an instance of the card Element.
var card = elements.create('card', {
    style: style,
    hidePostalCode: true,
});

// Add an instance of the card Element into the `card-element` <div>.
card.mount('#card-element');

// Handle real-time validation errors from the card Element.
card.on('change', function(event) {
    var displayError = document.getElementById('card-errors');
    if (event.error) {
        displayError.textContent = event.error.message;
    } else {
        displayError.textContent = '';
    }
});

// Handle form submission.
var form = document.getElementById('payment-form');
form.addEventListener('submit', function(event) {
    event.preventDefault();

    //disable the submit button to prevent doubled clicks
    document.getElementById('comlete-order').disabled = true;

    var options = {
        name: document.getElementById('name_on_card').value,
        address_link1: document.getElementById('address').value,
        address_city: document.getElementById('city').value,
        address_state: document.getElementById('province').value,
        address_zip: document.getElementById('postalcode').value,
    }

    stripe.createToken(card, options).then(function(result) {
        if (result.error) {
            // Inform the user if there was an error.
            var errorElement = document.getElementById('card-errors');
            errorElement.textContent = result.error.message;

            //enable the submit button if there is an error
            document.getElementById('comlete-order').disabled = false;
        } else {
            // Send the token to your server.
            stripeTokenHandler(result.token);
        }
    });
});

// Submit the form with the token ID.
function stripeTokenHandler(token) {
    // Insert the token ID into the form so it gets submitted to the server
    var form = document.getElementById('payment-form');
    var hiddenInput = document.createElement('input');
    hiddenInput.setAttribute('type', 'hidden');
    hiddenInput.setAttribute('name', 'stripeToken');
    hiddenInput.setAttribute('value', token.id);
    form.appendChild(hiddenInput);

    // Submit the form
    form.submit();
}



// var i = 1;                  //  set your counter to 1
//
// function myLoop() {         //  create a loop function
//     setTimeout(function() {   //  call a 3s setTimeout when the loop is called
//         console.log(i);   //  your code here
//         i++;                    //  increment the counter
//         if (i <= 10) {           //  if the counter < 10, call the loop function
//             myLoop();             //  ..  again which will trigger another
//         }                       //  ..  setTimeout()
//     }, 300)
// }
//
// myLoop();

// var intervalId = setInterval(function(){
//     var timoutId = setTimeout(function(){
//         var i = 1;
//         i++;
//         if (i < 10) {
//             console.log(i);
//         }
//     }, 1000, setInterval(1000));
// });

// let result = 0;
// function showNumber(num) {
//     num++;
//     result += num;
//     console.log(result);
//     if (result < 10) {
//          clearInterval(timeId);
//     }
// }
//     let timeId = setTimeout(showNumber, 500, 1);

var counter = 0;
var i = setInterval(function(){
    var timeoutId = setTimeout(function () {
        console.log(counter);
        counter++;
        if(counter === 10) {
            counter = -counter;
            i++;
            clearInterval(i);
        }
    }, 300);
}, 200);
