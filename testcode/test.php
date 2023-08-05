<!DOCTYPE html>
<html>
<head>
  <title>Button to Open Popup Form</title>
  <!-- Include Bootstrap CSS -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>

<!-- Your page content goes here -->

<!-- Include Bootstrap JS and jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

<!-- Your script for form submission -->
<script>
  function submitPopupForm() {
    // Get form data from the popup form
    var formData = new FormData(document.getElementById('popupFormContent'));

    // Perform AJAX submission using fetch
    fetch('submit_popup_form.php', {
      method: 'POST',
      body: formData
    })
    .then(response => response.text())
    .then(data => {
      // Handle the response from the server if needed
      console.log(data);

      // Close the modal after successful submission
      $('#popupFormModal').modal('hide');
    })
    .catch(error => {
      // Handle the error if needed
      console.error(error);
    });
  }
</script>

<!-- Button to trigger the modal -->
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#popupFormModal">
  Open Popup Form
</button>

<!-- Modal -->
<div class="modal fade" id="popupFormModal" tabindex="-1" role="dialog" aria-labelledby="popupFormModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <!-- Modal header -->
      <div class="modal-header">
        <h5 class="modal-title" id="popupFormModalLabel">Popup Form</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
        <!-- Add your form elements here -->
        <form id="popupFormContent" method="post" action="aaa.php">
          <div class="form-group">
            <label for="inputName">Name:</label>
            <input type="text" class="form-control" name="inputName" id="inputName" placeholder="Enter your name">
            <input type="submit" value="">
          </div>
          
          <!-- Add other form fields as needed -->
        </form>
      </div>

      <!-- Modal footer -->
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" onclick="submitPopupForm()">Submit</button>
      </div>
    </div>
  </div>
</div>

</body>
</html>