 // Add New Address Form Submission
 $('#addAddressForm').submit(function(event) {
     event.preventDefault();
     var formData = $(this).serialize();
     $.ajax({
         url: '/addresses/store',
         type: 'POST',
         data: formData,
         success: function(response) {
             $('#editAddressModal').modal('hide');
             alert('Address edited successfully');
             location.reload();
         },
         error: function(xhr, status, error) {
             // Handle error response (e.g., show error message)
             console.error(xhr.responseText);
         }
     });
 });