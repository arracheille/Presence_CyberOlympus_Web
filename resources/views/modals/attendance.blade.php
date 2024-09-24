<div id="checkinModal" class="modal">
    <div class="modal-content">
        <div class="modal-title-close">
            <h2>Check-In Attendance</h2>    
            <span class="close" id="close-modal">&times;</span>
        </div>
        <h4>Name: <span>{{ Auth::user()->name }}</span></h4>
        <form>
            @csrf
            <label for="attendance">Attendance:</label>
            <select id="attendance" name="attendance">
                <option value="present">Present</option>
                <option value="absent">Absent</option>
                <option value="sick">Sick</option>
            </select>
            <label for="message" id="message-label">Message:</label>
            <textarea id="message" name="message"></textarea>
            <div class="modal-footer">
            <button type="button" class="cancel-btn" id="cancel-modal">Cancel</button>
            <button type="submit" class="submit-btn" id="modal-submit-btn">Submit</button>
            </div>
        </form>
    </div>
</div>
<script src="{{ asset('js/modalcheck.js') }}"></script>