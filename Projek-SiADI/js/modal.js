// Get the modal
var modal = document.getElementById("modalKodeKlasifikasi");

// Get the button that opens the modal
var btn = document.getElementById("openModalBtn");

// Get the <span> element that closes the modal
var span = document.getElementsByClassName("close")[0];

// Get the Kode Klasifikasi dropdown
var kodeKlasifikasiSelect = document.getElementById("kode-klasifikasi");

// When the user clicks on the button, open the modal
btn.onclick = function () {
  modal.style.display = "block";
};

// When the user clicks on <span> (x), close the modal
span.onclick = function () {
  modal.style.display = "none";
};

// When the user clicks anywhere outside of the modal, close it
window.onclick = function (event) {
  if (event.target == modal) {
    modal.style.display = "none";
  }
};

// Function to add new Kode Klasifikasi
function addKodeKlasifikasi() {
  var newKode = document.getElementById("newKodeKlasifikasi").value;

  if (newKode.trim() === "") {
    alert("Kode Klasifikasi tidak boleh kosong.");
    return;
  }

  // Create a new option element
  var newOption = document.createElement("option");
  newOption.value = newKode;
  newOption.text = newKode;

  // Add the new option to the select element
  kodeKlasifikasiSelect.add(newOption);

  // Clear the input field and close the modal
  document.getElementById("newKodeKlasifikasi").value = "";
  modal.style.display = "none";
}
