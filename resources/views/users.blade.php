<table class="table-auto">
  <thead>
    <tr>
      <th>Utilisateur</th>
      <th>Role</th>
    </tr>
  </thead>
  <tbody>
    @foreach($users as $user)
    <tr>
        <td>{{ $user->nom }} {{ $user->prenom }}</td>
        <td>{{ $user->role->libelle }}</td>
    </tr>
    @endforeach
  </tbody>
</table>