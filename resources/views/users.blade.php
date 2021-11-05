@extends('dashboard-layout')

@section('content')

  <!-- component -->
  <section class="container mx-auto p-6 font-mono">
    <div class="w-full mb-8 overflow-hidden rounded-lg shadow-lg">
      <div class="w-full overflow-x-auto">
        <table class="w-full">
          <thead>
            <tr class="text-md font-semibold tracking-wide text-left text-gray-900 bg-gray-100 uppercase border-b border-gray-600">
              <th class="px-4 py-3">Nom</th>
              <th class="px-4 py-3">Prénom</th>
              <th class="px-4 py-3">Mail</th>
              <th class="px-4 py-3">Rôle</th>
            </tr>
          </thead>
          <tbody class="bg-white">
            @foreach($users as $user)
              <tr class="text-gray-700">
                <td class="px-4 py-3 text-sm border">{{$user->nom}}</td>
                <td class="px-4 py-3 text-sm border">{{$user->prenom}}</td>
                <td class="px-4 py-3 text-sm border">{{$user->email}}</td>
                <td class="px-4 py-3 text-sm border">{{$user->role->libelle}}</td>
              </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>
  </section>

@stop