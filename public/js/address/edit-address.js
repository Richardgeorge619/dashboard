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
            $('#editAddressModal').modal('hide');
            alert('Address added successfully');
            location.reload();
        },
        error: function(xhr, status, error) {
            // Handle error response (e.g., show error message)
            console.error(xhr.responseText);
        }
    });
});