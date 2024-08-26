@include('layouts.partial.head')

<div class="container mt-5">
    <h2 class="text-center mb-4">Stripe Payment</h2>
    <div class="row justify-content-center">
        <div class="col-md-6">
            <form id="payment-form">
                <div id="payment-request-button" class="mb-3">
                    <!-- Payment Request Button will be inserted here -->
                </div>

                <div id="card-element-container" class="mb-3">
                    <label for="cardholder-name" class="form-label">Cardholder Name</label>
                    <input type="text" id="cardholder-name" class="form-control" required>
                    <label for="card-element" class="form-label">Credit or Debit Card</label>
                    <div id="card-element" class="form-control">
                        <!-- Stripe's Card Element will be inserted here -->
                    </div>
                </div>

                <button id="submit-button" class="btn btn-primary w-100 mt-3">Pay</button>
            </form>
            <div id="payment-result" class="mt-3"></div>
        </div>
    </div>
</div>

<script src="https://js.stripe.com/v3/"></script>

<script>
    document.addEventListener('DOMContentLoaded', async function () {
        const stripe = Stripe('{{ config('stripe.key') }}');
        const elements = stripe.elements();

        // Setup Card Element
        const cardElement = elements.create('card');
        cardElement.mount('#card-element');

        // Setup Payment Request Button
        const paymentRequest = stripe.paymentRequest({
            country: 'US',
            currency: 'usd',
            total: {
                label: 'Total',
                amount: 5000, // example amount in cents
            },
            requestPayerName: true,
            requestPayerEmail: true,
        });

        const paymentRequestButton = elements.create('paymentRequestButton', {
            paymentRequest,
        });

        // Check the availability of the Payment Request Button
        paymentRequest.canMakePayment().then(function (result) {
            if (result) {
                document.getElementById('payment-request-button').style.display = 'block';
                paymentRequestButton.mount('#payment-request-button');
                document.getElementById('card-element-container').style.display = 'none';
            } else {
                document.getElementById('payment-request-button').style.display = 'none';
            }
        });

        // Handle the form submission
        const form = document.getElementById('payment-form');
        const resultElement = document.getElementById('payment-result');

        async function fetchClientSecret() {
            try {
                const response = await fetch('/create-payment-intent', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    },
                });

                if (!response.ok) {
                    throw new Error('Failed to fetch client secret');
                }

                const data = await response.json();
                return data.clientSecret;  // Ensure this returns a string
            } catch (error) {
                console.error('Error fetching client secret:', error);
                resultElement.textContent = `Error: ${error.message}`;
            }
        }

        form.addEventListener('submit', async (event) => {
            event.preventDefault();

            try {
                const clientSecret = await fetchClientSecret();

                if (!clientSecret) {
                    throw new Error('Client secret not retrieved');
                }

                const cardholderName = document.getElementById('cardholder-name').value;

                const {paymentIntent, error} = await stripe.confirmCardPayment(clientSecret, {
                    payment_method: {
                        card: cardElement,
                        billing_details: {
                            name: cardholderName,
                        },
                    }
                });

                if (error) {
                    resultElement.textContent = `Error: ${error.message}`;
                } else if (paymentIntent && paymentIntent.status === 'succeeded') {
                    resultElement.textContent = 'Payment Successful!';
                }
            } catch (error) {
                console.error('Error during payment:', error);
                resultElement.textContent = `Error: ${error.message}`;
            }
        });
    });
</script>
</body>
</html>
