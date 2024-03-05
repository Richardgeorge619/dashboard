@extends('layouts.app')

@section('content')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <div class="container">
        <h5>Edit User</h5><hr>
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <form method="POST" action="{{ route('profile.update') }}">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="name">Name:</label>
                <input type="text" class="form-control" id="name" name="name" value="{{ $user->name }}">
            </div>
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" class="form-control" id="email" name="email" value="{{ $user->email }}">
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
        <hr>
        <div class="row">
            <div class="col-md-8">
             <h5>Addresses</h5>
            </div>
            <div class="col-md-4 text-right">
               <button class="btn btn-primary btn-sm new-address" data-toggle="modal" data-target="#editAddressModal" data-user-id="{{ $user->id }}">Add New</button>
            </div>
            <div class="col-md-12">
                @if($user->addresses->isNotEmpty())
                    <table class="table table-borderd">
                        @foreach ($user->addresses as $address)
                            <tr id="address_{{ $address->id }}">
                                <td>
                                    * {{ $address->street }}, {{ $address->city }}, {{ $address->state }} - {{ $address->postal_code }}
                                </td>
                                <td>
                                    <button class="btn btn-primary btn-sm edit-address" data-id="{{ $address->id }}" data-toggle="modal" data-target="#editAddressModal">Edit</button>
                                    <button class="btn btn-danger btn-sm delete-address" data-id="{{ $address->id }}">Delete</button>
                                </td>
                            </tr>
                        @endforeach
                    </table>
                @else
                    <h6 class="text-center text-danger"><small>**No addresses found.</small></h6>
                @endif
            </div>
        </div>
    </div>

    <div class="modal fade" id="editAddressModal" tabindex="-1" role="dialog" aria-labelledby="editAddressModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editAddressModalLabel">Edit Address</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                </div>
            </div>
        </div>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="{{ asset('js/address/app.js') }}"></script>

@endsection
