<div id="addcardModal" class="modal">
    <div class="modal-content">
        <div class="modal-title-close">
            <h2>Add New List</h2>
            <span class="close" id="close-card-modal">&times;</span>
        </div>
        <form>
            <label for="card-name">List Name:</label>
            <input type="text" name="card-name" id="card-name" placeholder="Example: Back-End" />            <div class="modal-footer">
            <button type="button" class="cancel-btn" id="cancel-card-modal">Cancel</button>
            <button type="submit" class="submit-btn" id="modal-submit-btn">Submit</button>
            </div>
        </form>
    </div>
</div>

<script>
    var cardmodal = document.getElementById("addcardModal");
    var opencard = document.getElementById("add-card");
    var cardexit = document.getElementById("close-card-modal");
    var cardcancel = document.getElementById("cancel-card-modal");
    opencard.onclick = function () {
        cardmodal.style.display = "block";
    };
    cardexit.onclick = function () {
        cardmodal.style.display = "none";
    };
    cardcancel.onclick = function () {
        cardmodal.style.display = "none";
    };
    window.onclick = function (event) {
        if (event.target == cardmodal) {
            cardmodal.style.display = "none";
        }
    };
</script>