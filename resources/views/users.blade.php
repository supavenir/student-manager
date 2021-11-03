@foreach($users as $user)
    {{ $user->role->libelle }}
@endforeach