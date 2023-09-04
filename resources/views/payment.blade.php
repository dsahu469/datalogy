@extends('app')
@section('content')  
<style>
.container {
    max-width: 400px;
    margin: 0 auto;
    padding: 20px;
    background-color: #fff;
    border: 1px solid #ccc;
    border-radius: 5px;
    box-shadow: 0px 0px 5px 0px #ccc;
}

.form-group {
    margin-bottom: 15px;
}

label {
    font-weight: bold;
}

.card-fields {
    border: 1px solid #ccc;
    padding: 10px;
    border-radius: 5px;
    background-color: #fff;
}

.card-errors {
    color: #dc3545;
    font-size: 14px;
    margin-top: 5px;
}

#submit-button {
    background-color: #007bff;
    color: #fff;
    padding: 10px 20px;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    transition: background-color 0.3s ease;
}

#submit-button:hover {
    background-color: #0056b3;
}
</style>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://js.stripe.com/v3/"></script>  
<div class="container" style="margin-top: 5px">
    <h2>Payment Details</h2>
    <form id="payment-form" method="POST" enctype="multipart/form-data" action="{{ url('payment') }}">
        @csrf
        <div class="form-group">
            <label for="custom-input">Amount</label>
            <br>
            <input type="text" id="amount" name="amount" style="width: 95%" class="card-fields" placeholder="0.00">
        </div>
        <div class="form-group">
            <label for="card-element">Card Number</label>
            <div id="card-number-element" class="card-fields">
                <!-- A Stripe Element will be inserted here for card number. -->
            </div>
        </div>
        <div class="form-group">
            <label for="card-element">Expiration Date</label>
            <div id="card-expiry-element" class="card-fields">
                <!-- A Stripe Element will be inserted here for card expiration. -->
            </div>
        </div>
        <div class="form-group">
            <label for="card-element">CVC</label>
            <div id="card-cvc-element" class="card-fields">
                <!-- A Stripe Element will be inserted here for card CVC. -->
            </div>
        </div>
        <!-- Used to display form errors. -->
        <div id="card-errors" class="card-errors" role="alert"></div>
        <button id="submit-button">Submit Payment</button>
    </form>
</div>

<script>
    
    $(document).ready(function () {
        var stripe = Stripe('{{ env("STRIPE_KEY") }}');
        var elements = stripe.elements();
        
        // Create an instance of the card Element for each field.
        var cardNumber = elements.create('cardNumber', {
            style: {
                base: {
                    fontSize: '16px',
                    color: '#32325d',
                }
            }
        });
        cardNumber.mount('#card-number-element');
        
        var cardExpiry = elements.create('cardExpiry', {
            style: {
                base: {
                    fontSize: '16px',
                    color: '#32325d',
                }
            }
        });
        cardExpiry.mount('#card-expiry-element');
        
        var cardCvc = elements.create('cardCvc', {
            style: {
                base: {
                    fontSize: '16px',
                    color: '#32325d',
                }
            }
        });
        cardCvc.mount('#card-cvc-element');
        
        // Handle real-time validation errors from the card Elements.
        cardNumber.addEventListener('change', function (event) {
            // Display validation errors, if any.
            var displayError = document.getElementById('card-errors');
            if (event.error) {
                displayError.textContent = event.error.message;
            } else {
                displayError.textContent = '';
            }
        });
        
        var form = document.getElementById('payment-form');
        form.addEventListener('submit', function(event) {
            event.preventDefault();
            
            // Create a payment method for each card element
            Promise.all([
                stripe.createPaymentMethod('card', cardNumber),
                stripe.createPaymentMethod('card', cardExpiry),
                stripe.createPaymentMethod('card', cardCvc)
            ]).then(function(results) {
                stripe.confirmCardSetup(
                    "{{ $intent->client_secret }}",
                    {
                        payment_method: {
                            card: cardNumber,
                        }
                    }
                ).then(function (result) {
                    if (result.error) {
                        $('#card-errors').text(result.error.message)
                        $('button.pay').removeAttr('disabled');
                        return false;
                    } else {
                        paymentMethod = result.setupIntent.payment_method

                        var hiddenInput = document.createElement('input');
                        hiddenInput.setAttribute('type', 'hidden');
                        hiddenInput.setAttribute('name', 'payment-method');
                        hiddenInput.setAttribute('value', paymentMethod);
                        form.appendChild(hiddenInput);
                    }

                    form.submit();
                });

                return false;
            })
        });
    });
</script>
@endsection