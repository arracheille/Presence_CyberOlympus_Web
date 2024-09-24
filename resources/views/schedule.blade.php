{{-- <x-app-layout>
@include('components.css-schedule')
    <div class="calendar-container">
        <header>
        <h2>Schedule Calendar</h2>
        </header>
        <div id="calendar"></div>
    </div>

    <div id="addscheduleModal" class="modal">
        <div class="modal-content">
            <div class="modal-title-close">
                <h2>Add New Board</h2>
                <span class="close" onclick="closeAddschedule()">&times;</span>
            </div>
            <form action="/schedule" method="POST">
                @csrf
                <label for="title">Title :</label>
                <input type="text" name="title" placeholder="Example : Meeting With Company A">
                <label for="description">Description :</label>
                <textarea name="description" placeholder="(optional)"></textarea>
                <div class="modal-footer">
                    <button class="cancel-btn" onclick="cancelAddschedule()">Cancel</button>
                    <button type="submit" class="submit-btn">Submit</button>
                </div>
            </form>
        </div>
    </div>
    
    <script>
        function openAddschedule() {
        document.getElementById('addscheduleModal').style.display = 'block';
        }
    
        function cancelAddschedule() {
        document.getElementById('addscheduleModal').style.display = 'none';
        }
    
        function closeAddschedule() {
        document.getElementById('addscheduleModal').style.display = 'none';
        }
    </script>  
</x-app-layout> --}}