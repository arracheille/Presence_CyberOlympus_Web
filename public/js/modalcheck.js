var checkinmodal = document.getElementById("checkinModal");
var opencheckinbutton = document.getElementById("open-checkin-modal");
var spanexit = document.getElementById("close-modal");
opencheckinbutton.onclick = function () {
    checkinmodal.style.display = "block";
};
spanexit.onclick = function () {
    checkinmodal.style.display = "none";
};
window.onclick = function (event) {
    if (event.target == checkinmodal) {
        checkinmodal.style.display = "none";
    }
};
const checkInSelect = document.getElementById('check_in');
const messageTextarea = document.getElementById('check_in_message');
const messageLabel = document.getElementById('check_in_message_label');
function toggleMessageField() {
  const selectedValue = checkInSelect.value;
  if (selectedValue === 'Sick' || selectedValue === 'Absent') {
    messageTextarea.style.display = 'block';
    messageLabel.style.display = 'block';
  } else {
    messageTextarea.style.display = 'none';
    messageLabel.style.display = 'none';
  }
}
toggleMessageField();
checkInSelect.addEventListener('change', toggleMessageField);