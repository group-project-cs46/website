document.addEventListener('DOMContentLoaded', function() {
    // Clone initial cards
    const template = document.querySelector('.event-card');
    for (let i = 0; i < 2; i++) {
        const clone = template.cloneNode(true);
        document.querySelector('.events-grid').appendChild(clone);
    }

    // Search functionality
    const searchInput = document.getElementById('search');
    searchInput.addEventListener('input', function(e) {
        const searchTerm = e.target.value.toLowerCase();
        const cards = document.querySelectorAll('.event-card');
        
        cards.forEach(card => {
            const title = card.querySelector('h3').textContent.toLowerCase();
            card.style.display = title.includes(searchTerm) ? 'block' : 'none';
        });
    });

    // New button functionality
    const newBtn = document.querySelector('.new-btn');
    newBtn.addEventListener('click', function() {
        const newCard = template.cloneNode(true);
        newCard.querySelector('h3').textContent = 'NEW EVENT';
        document.querySelector('.events-grid').appendChild(newCard);
        addCardListeners(newCard);
    });

    // Add event listeners to all cards
    document.querySelectorAll('.event-card').forEach(addCardListeners);

    function addCardListeners(card) {
        const editBtn = card.querySelector('.edit');
        const viewBtn = card.querySelector('.view');
        const deleteBtn = card.querySelector('.delete');

        editBtn.addEventListener('click', function() {
            alert('Edit event');
        });

        viewBtn.addEventListener('click', function() {
            alert('View event');
        });

        deleteBtn.addEventListener('click', function() {
            if (confirm('Are you sure you want to delete this event?')) {
                card.remove();
            }
        });
    }
});