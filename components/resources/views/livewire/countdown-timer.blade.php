<div class="p-4 bg-light shadow rounded">
    <h1 class="h4 mb-4">Advanced Countdown Timer</h1>

    <div class="mb-4">
        <h2 class="h5">Add Event</h2>
        <form id="eventForm" class="row g-3 align-items-center">
            <div class="col-md-5">
                <input 
                    type="text" 
                    id="eventName" 
                    placeholder="Event Name" 
                    class="form-control">
            </div>
            <div class="col-md-5">
                <input 
                    type="datetime-local" 
                    id="eventDate" 
                    class="form-control">
            </div>
            <div class="col-md-2">
                <button type="submit" class="btn btn-primary w-100">Add</button>
            </div>
        </form>
    </div>

    <h2 class="h5 mb-3">Countdown Timers</h2>
    <div id="timersContainer" class="mb-4">
        <p class="text-muted">No events added yet. Start tracking your deadlines!</p>
    </div>
</div>

<script>
    // Utility to calculate time remaining
    function calculateTimeRemaining(eventDate) {
        const now = new Date();
        const targetDate = new Date(eventDate);
        const diff = targetDate - now;

        if (diff <= 0) return 'Event has passed!';

        const days = Math.floor(diff / (1000 * 60 * 60 * 24));
        const hours = Math.floor((diff % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
        const minutes = Math.floor((diff % (1000 * 60 * 60)) / (1000 * 60));
        const seconds = Math.floor((diff % (1000 * 60)) / 1000);

        return `${days}d ${hours}h ${minutes}m ${seconds}s`;
    }

    // Load events from local storage
    function loadEvents() {
        const events = JSON.parse(localStorage.getItem('events')) || [];
        const container = document.getElementById('timersContainer');
        container.innerHTML = '';

        if (events.length === 0) {
            container.innerHTML = '<p class="text-muted">No events added yet. Start tracking your deadlines!</p>';
            return;
        }

        events.forEach((event, index) => {
            const timerDiv = document.createElement('div');
            timerDiv.className = 'list-group-item';
            timerDiv.innerHTML = `
                <h3 class="h6 mb-2">${event.name}</h3>
                <p id="timer-${index}" class="${new Date(event.date) < new Date() ? 'text-danger' : 'text-success'} fw-bold">
                    ${calculateTimeRemaining(event.date)}
                </p>
            `;
            container.appendChild(timerDiv);
        });

        updateTimers();
    }

    // Update timers every second
    function updateTimers() {
        const events = JSON.parse(localStorage.getItem('events')) || [];
        events.forEach((event, index) => {
            const timerElement = document.getElementById(`timer-${index}`);
            if (timerElement) {
                timerElement.textContent = calculateTimeRemaining(event.date);
                timerElement.className = new Date(event.date) < new Date() ? 'text-danger fw-bold' : 'text-success fw-bold';
            }
        });

        setTimeout(updateTimers, 1000); // Call update every second
    }

    // Add event to local storage
    document.getElementById('eventForm').addEventListener('submit', (e) => {
        e.preventDefault();
        const eventName = document.getElementById('eventName').value;
        const eventDate = document.getElementById('eventDate').value;

        if (!eventName || !eventDate) {
            alert('Please provide both event name and date!');
            return;
        }

        const events = JSON.parse(localStorage.getItem('events')) || [];
        events.push({ name: eventName, date: eventDate });
        localStorage.setItem('events', JSON.stringify(events));

        document.getElementById('eventName').value = '';
        document.getElementById('eventDate').value = '';

        loadEvents();
    });

    // Initialize app
    document.addEventListener('DOMContentLoaded', loadEvents);
</script>
