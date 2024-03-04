<!-- Edit Address Modal -->
<form id="editAddressForm" data-address-id="{{ $address->id }}">
    @csrf
    <div class="form-group">
        <label for="street">Street:</label>
        <input type="text" class="form-control" id="street" name="street" value="{{ $address->street }}">
    </div>
    <div class="form-group">
        <label for="city">City:</label>
        <input type="text" class="form-control" id="city" name="city" value="{{ $address->city }}">
    </div>
    <div class="form-group">
        <label for="state">State:</label>
        <input type="text" class="form-control" id="state" name="state" value="{{ $address->state }}">
    </div>
    <div class="form-group">
        <label for="postal_code">Postal Code:</label>
        <input type="text" class="form-control" id="postal_code" name="postal_code" value="{{ $address->postal_code }}">
    </div>
    <button type="submit" class="btn btn-primary">Save Changes</button>
</form>
<script src="{{ asset('js/address/edit-address.js') }}"></script>
