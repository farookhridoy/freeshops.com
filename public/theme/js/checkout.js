// Get API Key
let STRIPE_PUBLISHABLE_KEY = document.currentScript.getAttribute('STRIPE_PUBLISHABLE_KEY');
let CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');

// Create an instance of the Stripe object and set your publishable API key
const stripe = Stripe(STRIPE_PUBLISHABLE_KEY);

let elements; // Define card elements
const paymentForm = document.querySelector('#payment-form'); // Select payment form element

// Get payment_intent_client_secret param from URL
const clientSecretParam = new URLSearchParams(window.location.search).get(
    "payment_intent_client_secret"
);

// Check whether the payment_intent_client_secret is already exist in the URL
// setProcessing(true);
if (!clientSecretParam) {
    // setProcessing(false);

    // Create an instance of the Elements UI library and attach the client secret
    initialize();
}

// Check the PaymentIntent creation status
checkStatus();

// Attach an event handler to payment form
paymentForm.addEventListener("submit", handleSubmit);

// Fetch a payment intent and capture the client secret
let payment_intent_id;
async function initialize() {
    const { id, clientSecret } = await fetch("/stripe-init", {
        method: "POST",
        headers: { "content-Type": "application/json", "X-CSRF-Token": CSRF_TOKEN },
        body: JSON.stringify({ request_type: 'create_payment_intent' }),
    }).then((r) => r.json());

    const appearance = {
        theme: 'stripe',
        rules: {
            // '.Label': {
            //     fontFamily: 'Poppins,Helvetica,sans-serif',
            //     fontWeight: '600',
            //     fontSize: '14px',
            //     color: '#181C32',
            //     marginTop: '2rem',
            //     marginBottom: '0.5rem',
            // },
            '.Input': {
                borderColor: '#dee2e6',
                color: '#5e6278',
                boxShadow: 'none',
                padding: '12px 15px',
                fontSize: '1rem',
                fontWeight: '500',
                borderRadius: '.25rem',
                minHeight: '40px',
                heeight: '43px',
            }
        }
    };

    elements = stripe.elements({ clientSecret, appearance });

    const paymentElement = elements.create("payment");
    paymentElement.mount("#stripe-element");

    payment_intent_id = id;
}

// Card form submit handler
async function handleSubmit(e) {
    e.preventDefault();
    setLoading(true);

    let customer_name = document.getElementById("c_name").value;
    let customer_email = document.getElementById("c_email").value;

    const { id, customer_id } = await fetch("/stripe-init", {
        method: "POST",
        headers: { "X-CSRF-Token": CSRF_TOKEN, "content-Type": "application/json" },
        body: JSON.stringify({ request_type: 'create_customer', payment_intent_id: payment_intent_id, name: customer_name, email: customer_email }),
    }).then((r) => r.json());

    const { error } = await stripe.confirmPayment({
        elements,
        confirmParams: {
            return_url: window.location.href+'?customer_id='+customer_id,
        },
    });

    // This point will only be reached if there is an immediate error when
    // confirming the payment. Otherwise, your customer will be redirected to
    // your `return_url`. For some payment methods like iDEAL, your customer will
    // be redirected to an intermediate site first to authorize the payment, then
    // redirected to the `return_url`.

    if (error.type === "card_error" || error.type === "validation_error") {
        showMessage(error.message);
        setTimeout(function () {
            location.reload = true
        }, 5000);
    } else {
        showMessage("An unexpected error occured.");
        setTimeout(function () {
            location.reload = true
        }, 5000);
    }

    setLoading(false);
}

// Fetch the PaymentIntent status after payment submission
async function checkStatus() {
    const clientSecret = new URLSearchParams(window.location.search).get(
        "payment_intent_client_secret"
    );

    const customerID = new URLSearchParams(window.location.search).get(
        "customer_id"
    );

    if (!clientSecret) {
        return;
    }

    const { paymentIntent } = await stripe.retrievePaymentIntent(clientSecret);

    if (paymentIntent) {
        switch (paymentIntent.status) {
            case "succeeded":
                //showMessage("Payment succeeded!");

                // Post the transaction info to the server-side script and redirect to the payment status page
                fetch("/stripe-init", {
                    method: "POST",
                    headers: { "X-CSRF-Token": CSRF_TOKEN, "Content-Type": "application/json" },
                    body: JSON.stringify({ request_type:'payment_insert', payment_intent: paymentIntent, customer_id: customerID }),
                })
                .then(response => response.json())
                .then(data => {
                    if (data.payment_id) {
                        transErr = 0;
                        window.location.href = 'payment-success';
                    } else {
                        showMessage(data.error);
                        // setReinit();
                    }
                })
                .catch(console.error);

                break;
            case "requires_payment_method":
                $("#processing-heading").text('Please try again');
                $("#processing-text").text('Your payment was not successful');
                setTimeout(function () {
                    location.href = 'user/dashboard'
                }, 5000);

                break;
            default:
                $("#processing-heading").text('Please try again');
                $("#processing-text").text('Something went wrong.');
                setTimeout(function () {
                    location.href = 'user/dashboard'
                }, 5000);

                break;
        }
    } else {
        $("#processing-heading").text('Please try again');
        $("#processing-text").text('Something went wrong.');
        setTimeout(function () {
            location.href = 'user/dashboard'
        }, 5000);
        // setReinit();
    }
}

// Display message
function showMessage(messageText) {
    toastr.error(messageText)
}

// Show a spinner on payment submission
function setLoading(isLoading) {
    if (isLoading) {
        // Disable the button and show a spinner
        document.querySelector("#purchase-btn").disabled = true;
        document.querySelector("#spinner").classList.remove("d-none");
        document.querySelector("#button-text").classList.add("d-none");
    } else {
        // Enable the button and hide spinner
        document.querySelector("#purchase-btn").disabled = false;
        document.querySelector("#spinner").classList.add("d-none");
        document.querySelector("#button-text").classList.remove("d-none");
    }
}