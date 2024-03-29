// Edit Address Form Submission
$('#editAddressForm').submit(function(event) {
    event.preventDefault();
    var formData = $(this).serialize();
    var addressId = $(this).data('address-id');
    $.ajax({
        url: '/addresses/' + addressId,
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