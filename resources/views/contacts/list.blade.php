@extends('layout')

@section('title', 'Contacts List')

@section('content')        
        <!-- Create an table to contacts where display the contacts - name, email, phone -->
        <div class="container d-flex justify-content-center">
            <div class="row">
                <div class="col-md-12">
                    <div class = "d-flex justify-content-between align-items-center">
                        <h1 class="display-4 mb-0">Contacts</h1>
                        <a href="{{ route('contacts.create') }}" class="btn btn-primary"><i class="fas fa-plus"></i> Add Contact</a>
                    </div>

                    <table class="table text-center" id="contacts_data_table">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($contacts as $contact)
                                <tr style="align-content: center">
                                    <td class=""><a style="color:blue;" href="{{ route('contacts.show', $contact->id) }}">{{ $contact->name }}</a></td>
                                    <td>{{ $contact->email }}</td>
                                    <td>{{ $contact->phone }}</td>
                                    <td>
                                        <a href="{{ route('contacts.edit', $contact->id) }}" class="btn btn-edit"><i class="fas fa-edit"></i></a>
                                        <!-- Ask for confirmation before deleting using sweetalert -->
                                        <form action="{{ route('contacts.destroy', $contact->id) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-trash" id="trash-btn"><i class="fas fa-trash"></i></button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
@endsection

