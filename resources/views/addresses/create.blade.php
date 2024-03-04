<!-- Add New Address Modal -->
<form id="addAddressForm">
    @csrf
    <div class="form-group">
        <input type="hidden" name="user_id" id="user_id">
        <label for="street">Street:</label>
        <input type="text" class="form-control" id="street" name="street">
    </div>
    <div class="form-group">
        <label for="city">City:</label>
        <input type="text" class="form-control" id="city" name="city">
    </div>
    <div class="form-group">
        <label for="state">State:</label>
        <input type="text" class="form-control" id="state" name="state">
    </div>
    <div class="form-group">
        <label for="postal_code">Postal Code:</label>
        <input type="text" class="form-control" id="postal_code" name="postal_code">
    </div>
    <button type="submit" class="btn btn-primary">Add Address</button>
</form>
<script src="{{ asset('js/address/new-address.js') }}"></script>