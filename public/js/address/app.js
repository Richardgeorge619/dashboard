$(document).ready(function() {
    // CSRF token setup
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $('.new-address').click(function() {
        var userId = $(this).data('user-id');
        $.ajax({
            url: '/addresses/create',
            type: 'GET',
            success: function(response) {
                $('#editAddressModal .modal-body').html(response);
                $('#user_id').val(userId)
            }
        });
    });

    // Edit Address Button Click
    $('.edit-address').click(function() {
        var addressId = $(this).data('id');
        $.ajax({
            url: '/addresses/' + addressId + '/edit',
            type: 'GET',
            success: function(response) {
                $('#editAddressModal .modal-body').html(response);
            }
        });
    });

    // Delete Address Button Click
    $('.delete-address').click(function() {
        var addressId = $(this).data('id');
        if (confirm('Are you sure you want to delete this address?')) {
            $.ajax({
                url: '/addresses/' + addressId,
                type: 'DELETE',
                success: function(response) {
                    $('#address_' + addressId).remove();
                }
            });
        }
    });
});