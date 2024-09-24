<div id="editcardModal" class="modal">
    <div class="modal-content">
        <div class="modal-title-close">
          <h2>Edit Card</h2>
          <span class="close" id="close-editcard-modal">&times;</span>
        </div>
        <form>
          <label for="card-edit-name">Card Name:</label>
          <input type="text" name="card-edit-name" id="card-edit-name" placeholder="Example: Team Project" />
          <div class="modal-footer">
            <button type="button" class="cancel-btn" id="cancel-editcard-modal">Cancel</button>
            <button type="submit" class="submit-btn" id="modal-submit-btn">Submit</button>
          </div>
        </form>
    </div>
</div>

<script>
  var editcardmodal = document.getElementById("editcardModal");
  var editcardopen = document.querySelectorAll("#edit-card-open");
  var editcardexit = document.getElementById("close-editcard-modal");
  var editcardcancel = document.getElementById("cancel-editcard-modal");
  editcardopen.forEach(function (button) {
    button.onclick = function () {
      editcardmodal.style.display = "block";
    };
  });
  editcardexit.onclick = function () {
    editcardmodal.style.display = "none";
  };
  editcardcancel.onclick = function () {
    editcardmodal.style.display = "none";
  };
  window.onclick = function (event) {
    if (event.target == editcardmodal) {
      editcardmodal.style.display = "none";
    }
  };
</script>