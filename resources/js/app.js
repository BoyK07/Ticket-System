import './bootstrap';

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();

/////////////////////////////////////////////////////////////////
//        OWN CODE
/////////////////////////////////////////////////////////////////

////////////////////////////////
//  Event card
////////////////////////////////

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


//////////////////////
// Reservation type selector
//////////////////////

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

//////////////////////
// Reset gescand button
//////////////////////

document.addEventListener('DOMContentLoaded', () => {
    const buttons = document.querySelectorAll('.reset-scan-button');
    buttons.forEach(button => {
        button.addEventListener('click', function() {
            const reservationId = this.getAttribute('data-reservation-id');
            resetScan(reservationId);
        });
    });
});

function resetScan(reservationId) {
    fetch(`/admin/reservations/${reservationId}/reset-scan`, { // Corrected to use reservationId
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        },
        body: JSON.stringify({
            reservation_id: reservationId
        })
    })
    .then(response => {
        if (!response.ok) {
            throw new Error('Network response was not ok ' + response.statusText);
        }
        const button = document.querySelector(`.reset-scan-button[data-reservation-id="${reservationId}"]`);
            button.classList.remove('bg-blue-500');
            button.classList.add('bg-green-500');
        return response.json();
    })
    .then(data => {
        if (data.success) {
            console.log(data.success)
        }
    })
    .catch(error => {
        console.error('Error:', error);
    });
}

////////////////////////
// Search bar
////////////////////////

document.addEventListener('DOMContentLoaded', () => {
    const searchInput = document.getElementById('eventSearch');
    const eventCards = document.querySelectorAll('.event-card');

    searchInput.addEventListener('input', () => {
        const searchText = searchInput.value.toLowerCase();

        eventCards.forEach(card => {
            const title = card.querySelector('.event-title').textContent.toLowerCase();
            card.classList.toggle('hidden', !title.includes(searchText));
        });
    });
});