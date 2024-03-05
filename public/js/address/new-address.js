 // Add New Address Form Submission
 $('#addAddressForm').submit(function(event) {
     event.preventDefault();
     var formData = $(this).serialize();
     $.ajax({
         url: '/addresses/store',
         type: 'POST',
         data: formData,
         success: function(response) {
             alert(response.message);
             if (response.success == true) {
                 $('#editAddressModal').modal('hide');
                 location.reload();
             }
         },
         error: function(xhr, status, error) {
             // Handle error response (e.g., show error message)
             var response = JSON.parse(xhr.responseText);
             alert(response.message);
         }
     });
 });