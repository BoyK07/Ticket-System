import './bootstrap';

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();

/////////////////////////////////////////////////////////////////
//        OWN CODE
/////////////////////////////////////////////////////////////////

document.addEventListener('DOMContentLoaded', () => {
    const ticketCountEl = document.getElementById('ticketCount');
    const totalPriceEl = document.getElementById('totalPrice');
    const ticketPrice = parseFloat(ticketCountEl.dataset.price);

    const updatePrice = () => {
        const totalPrice = (parseInt(ticketCountEl.value) * ticketPrice).toFixed(2);
        totalPriceEl.textContent = `$${totalPrice}`;
    };

    document.querySelectorAll('[data-action="increment"], [data-action="decrement"]').forEach(button => {
        button.addEventListener('click', (event) => {
            const isIncrement = event.currentTarget.dataset.action === 'increment';
            const currentCount = parseInt(ticketCountEl.value);
            ticketCountEl.value = isIncrement ? currentCount + 1 : Math.max(1, currentCount - 1);
            updatePrice();
        });
    });
});

document.addEventListener('DOMContentLoaded', () => {
    const buttons = document.querySelectorAll('[data-reservation-type]');
    const futureReservations = document.getElementById('future-reservations');
    const historicalReservations = document.getElementById('historical-reservations');
    const expiredReservations = document.getElementById('expired-reservations');

    buttons.forEach(button => {
        button.addEventListener('click', () => {
            const type = button.getAttribute('data-reservation-type');
            // Hide all sections
            futureReservations.classList.add('hidden');
            historicalReservations.classList.add('hidden');
            expiredReservations.classList.add('hidden');

            // Show the selected section
            if (type === 'future') {
                futureReservations.classList.remove('hidden');
            } else if (type === 'historical') {
                historicalReservations.classList.remove('hidden');
            } else if (type === 'expired') {
                expiredReservations.classList.remove('hidden');
            }
        });
    });
});
