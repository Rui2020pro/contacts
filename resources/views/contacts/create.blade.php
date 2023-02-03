@extends('layout')

@if (isset($contact_show))
    @section('title', 'Contact Details')
@else
    @if (isset($contact_edit))
        @section('title', 'Edit Contact')
    @else
        @section('title', 'Create Contact')
    @endif
@endif

@section('content') 

    <!-- Create an form to contacts - name, email, phone -->
    <div class="container d-flex justify-content-center">
        <div class="row">
            <div class="col-md-12">
                @if (isset($contact_show))
                    <div class="d-flex justify-content-between align-items-center">
                        <h1 class="text-center">Contact Details</h1>
                        <a
                            href="{{ route('contacts.index') }}">
                            <i class="fas fa-arrow-left"></i>
                        </a>
                    </div>
                @else
                    @if (isset($contact_edit))
                        <h1 class="text-center">Edit Contact</h1>
                    @else
                    <h1 class="text-center">Create Contact</h1>
                    @endif
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
                <!-- Check if we get an array named contacts -->
                @if (isset($contact_show))
                    <p>Contact Name : {{ $contact_show['name'] }}</p>
                    <p>Contact Email : {{ $contact_show['email'] }}</p>
                    <p>Contact Phone : {{ $contact_show['phone'] }}</p>
                @else
                @if (isset($contact_edit))
                    <form action="{{ route('contacts.update', $contact_edit->id)}}" method="POST">
                    @method('PUT')
                    
                @else
                <form action="{{ route('contacts.store')}}" method="POST">
                @endif
                    @csrf
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" name="name" class="form-control" id="name" value= "{{ isset($contact_edit) ? $contact_edit->name : old('name') }}" placeholder="Name" required>
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" name="email" class="form-control" id="email" value="{{ isset($contact_edit) ? $contact_edit->email : old('email') }}" placeholder="Email" required>
                    </div>
                    <div class="form-group">
                        <label for="phone">Phone</label>
                        <input type="text" name="phone" class="form-control" id="phone" value="{{ isset($contact_edit) ? $contact_edit->phone : old('phone') }}" placeholder="Phone" required>
                    </div>
                    <div class="text-center">
                        <button type="submit" class="btn btn-primary mt-2">Submit</button>
                    </div>
                </form>
                @endif
            </div>
        </div>
    </div>
@endsection