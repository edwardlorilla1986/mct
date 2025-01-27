<div class="p-4 bg-light shadow rounded">
    <h1 class="h4 mb-4">Advanced Meeting Scheduler</h1>

    <div class="mb-4">
        <h2 class="h5">Add Participant</h2>
        <form id="participantForm" class="row g-3 align-items-center">
            <div class="col-md-5">
                <input 
                    type="text" 
                    id="participantName" 
                    placeholder="Name" 
                    class="form-control">
            </div>
            <div class="col-md-5">
                <select id="participantTimeZone" class="form-select">
                    <option value="">Select Time Zone</option>
                    <!-- Populate time zones dynamically -->
                    <script>
                        const timeZones = Intl.supportedValuesOf('timeZone');
                        timeZones.forEach((zone) => {
                            document.write(`<option value="${zone}">${zone}</option>`);
                        });
                    </script>
                </select>
            </div>
            <div class="col-md-2">
                <button type="submit" class="btn btn-primary w-100">Add</button>
            </div>
        </form>
    </div>

    <div class="mb-4">
        <h2 class="h5">Schedule Meeting</h2>
        <form id="meetingForm" class="row g-3 align-items-center">
            <div class="col-md-10">
                <input 
                    type="datetime-local" 
                    id="meetingTime" 
                    class="form-control">
            </div>
            <div class="col-md-2">
                <button type="submit" class="btn btn-success w-100">Schedule</button>
            </div>
        </form>
    </div>

    <h2 class="h5 mb-3">Scheduled Meetings</h2>
    <div id="meetingsContainer" class="mb-4">
        <p class="text-muted">No meetings scheduled yet. Start planning your meetings!</p>
    </div>
</div>

<script>
    // Store participants and meetings in local storage
    let participants = JSON.parse(localStorage.getItem('participants')) || [];
    let scheduledMeetings = JSON.parse(localStorage.getItem('scheduledMeetings')) || [];

    // Render participants and scheduled meetings
    function renderMeetings() {
        const container = document.getElementById('meetingsContainer');
        container.innerHTML = '';

        if (scheduledMeetings.length === 0) {
            container.innerHTML = '<p class="text-muted">No meetings scheduled yet. Start planning your meetings!</p>';
            return;
        }

        scheduledMeetings.forEach((meeting, index) => {
            const meetingDiv = document.createElement('div');
            meetingDiv.className = 'card mb-3';
            meetingDiv.innerHTML = `
                <div class="card-body">
                    <h3 class="h6">Meeting at (UTC): ${meeting.timeUTC}</h3>
                    <ul class="list-group mt-2">
                        ${meeting.participants.map(
                            (p) =>
                                `<li class="list-group-item small">${p.name} - ${p.time} (${p.timeZone})</li>`
                        ).join('')}
                    </ul>
                </div>
            `;
            container.appendChild(meetingDiv);
        });
    }

    // Add participant to local storage
    document.getElementById('participantForm').addEventListener('submit', (e) => {
        e.preventDefault();
        const name = document.getElementById('participantName').value;
        const timeZone = document.getElementById('participantTimeZone').value;

        if (!name || !timeZone) {
            alert('Please provide both name and time zone!');
            return;
        }

        participants.push({ name, timeZone });
        localStorage.setItem('participants', JSON.stringify(participants));

        document.getElementById('participantName').value = '';
        document.getElementById('participantTimeZone').value = '';
    });

    // Schedule a meeting and save it to local storage
    document.getElementById('meetingForm').addEventListener('submit', (e) => {
        e.preventDefault();
        const meetingTime = document.getElementById('meetingTime').value;

        if (!meetingTime || participants.length === 0) {
            alert('Please provide a meeting time and add participants!');
            return;
        }

        const timeUTC = new Date(meetingTime).toISOString();
        const meetingParticipants = participants.map((p) => {
            const participantTime = new Date(meetingTime).toLocaleString('en-US', {
                timeZone: p.timeZone,
                hour12: false,
                hour: '2-digit',
                minute: '2-digit',
            });
            return { name: p.name, time: participantTime, timeZone: p.timeZone };
        });

        scheduledMeetings.push({ timeUTC, participants: meetingParticipants });
        localStorage.setItem('scheduledMeetings', JSON.stringify(scheduledMeetings));

        document.getElementById('meetingTime').value = '';
        renderMeetings();
    });

    // Initialize the app
    document.addEventListener('DOMContentLoaded', renderMeetings);
</script>
