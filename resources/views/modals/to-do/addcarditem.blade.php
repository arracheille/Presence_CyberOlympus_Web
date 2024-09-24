<div id="addcarditemModal" class="modal">
    <div class="modal-content">
        <div class="modal-title-close">
            <h2>Add Card Item</h2>
            <span class="close" id="close-carditem-modal">&times;</span>
        </div>
        <form>
            <label for="card-item-name">Card Item Name:</label>
            <input type="text" name="card-item-name" id="card-item-name" placeholder="Example: Team Project" />
            <label for="editor">Card Description:</label>
            <textarea name="description-textarea" id="editor"></textarea>
            <div class="modal-footer">
            <button type="button" class="cancel-btn" id="cancel-carditem-modal">Cancel</button>
            <button type="submit" class="submit-btn" id="modal-submit-btn">Submit</button>
            </div>
        </form>
    </div>
</div>

<script src="https://cdn.ckeditor.com/ckeditor5/39.0.0/classic/ckeditor.js"></script>
<script>
  ClassicEditor
    .create( document.querySelector( '#editor' ) )
    .catch( error => {
      console.error( error );
    } );
</script>

<script>
    var carditemmodal = document.getElementById("addcarditemModal");
    var opencarditems = document.querySelectorAll("#add-card-item");
    var carditemexit = document.getElementById("close-carditem-modal");
    var carditemcancel = document.getElementById("cancel-carditem-modal");
    opencarditems.forEach(function (button) {
        button.onclick = function () {
            carditemmodal.style.display = "block";
        };
    });
    carditemexit.onclick = function () {
        carditemmodal.style.display = "none";
    };
    carditemcancel.onclick = function () {
        carditemmodal.style.display = "none";
    };
    window.onclick = function (event) {
        if (event.target == carditemmodal) {
            carditemmodal.style.display = "none";
        }
    };
</script>