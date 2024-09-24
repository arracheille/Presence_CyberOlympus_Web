<div id="editcarditemModal" class="modal">
    <div class="modal-content">
        <div class="modal-title-close">
            <h2>Edit Card Item</h2>
            <span class="close" id="close-editcarditem-modal">&times;</span>
        </div>
        <form>
            <label for="card-item-name">Card Item Name:</label>
            <input type="text" name="card-item-name" id="card-item-name" placeholder="Example: Team Project" />
            <label for="editor">Card Description:</label>
            <textarea name="description-textarea" id="editcardeditor"></textarea>
            <div class="modal-footer">
            <button type="button" class="cancel-btn" id="cancel-editcarditem-modal">Cancel</button>
            <button type="submit" class="submit-btn" id="modal-submit-btn">Submit</button>
            </div>
        </form>
    </div>
</div>

<script src="https://cdn.ckeditor.com/ckeditor5/39.0.0/classic/ckeditor.js"></script>
<script>
  ClassicEditor
    .create( document.querySelector( '#editcardeditor' ) )
    .catch( error => {
      console.error( error );
    } );
</script>

<script>
    var editcarditemmodal = document.getElementById("editcarditemModal");
    var openeditcarditems = document.querySelectorAll("#edit-card-item");
    var editcarditemexit = document.getElementById("close-editcarditem-modal");
    var editcarditemcancel = document.getElementById("cancel-editcarditem-modal");
    openeditcarditems.forEach(function (button) {
        button.onclick = function () {
            editcarditemmodal.style.display = "block";
        };
    });
    editcarditemexit.onclick = function () {
        editcarditemmodal.style.display = "none";
    };
    editcarditemcancel.onclick = function () {
        editcarditemmodal.style.display = "none";
    };
    window.onclick = function (event) {
        if (event.target == editcarditemmodal) {
            editcarditemmodal.style.display = "none";
        }
    };
</script>