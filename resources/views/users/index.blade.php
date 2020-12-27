<h1>Users</h1>
@forelse($users as $user)
    <p>{{ $user->username}}</p>
@empty
    <p>empty</p>
@endforelse