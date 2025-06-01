document.addEventListener("DOMContentLoaded", function () {
    const stripe = Stripe(stripePublicKey);
    const elements = stripe.elements();

    // Estilo de los elementos de Stripe
    const style = {
        base: {
            color: '#32325d',
            fontFamily: '"Inter", "Helvetica Neue", Arial, sans-serif',
            fontSmoothing: 'antialiased',
            fontSize: '16px',
            '::placeholder': {
                color: '#a0aec0'
            }
        },
        invalid: {
            color: '#fa755a',
            iconColor: '#fa755a'
        }
    };

    const cardNumber = elements.create('cardNumber', {
        style: style
    });
    cardNumber.mount('#card-number-element');

    const cardExpiry = elements.create('cardExpiry', {
        style: style
    });
    cardExpiry.mount('#card-expiry-element');

    const cardCvc = elements.create('cardCvc', {
        style: style
    });
    cardCvc.mount('#card-cvc-element');

    const form = document.querySelector('form');
    const cardHolderName = document.getElementById('card-holder-name');
    const cardButton = form.querySelector('button[type="submit"]');
    const cardErrors = document.getElementById('card-errors');
    const stripeTokenInput = document.getElementById('stripeToken');
    const postalCode = document.getElementById('postal_code');

    form.addEventListener('submit', async function (e) {
        e.preventDefault();
        cardButton.disabled = true;
        cardErrors.textContent = '';

        const {
            token,
            error
        } = await stripe.createToken(cardNumber, {
            name: cardHolderName.value,
            address_zip: postalCode.value
        });

        if (error) {
            cardErrors.textContent = error.message;
            cardButton.disabled = false;
        } else {
            stripeTokenInput.value = token.id;
            form.submit();
        }
    });
});