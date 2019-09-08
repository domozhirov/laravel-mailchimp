@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">User List</div>

                <div class="card-body">
                    <table class="table">
                        <thead class="thead-dark">
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">First name</th>
                                <th scope="col">Last name</th>
                                <th scope="col">Email</th>
                                <th scope="col">Signed</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if ($user_list->total())
                                @foreach($user_list as $user)
                                    <tr>
                                        <th scope="row">{{ $user->id }}</th>
                                        <td>{{ $user->name }}</td>
                                        <td>{{ $user->lastname }}</td>
                                        <td>{{ $user->email }}</td>
                                        <td>@if ($user->signed) + @else - @endif</td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="5" class="text-center">User list is empty</td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                    <a href="{{ route('userList.showAddForm') }}" class="btn btn-success btn-sm float-right">Add</a>

                    {{ $user_list->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
