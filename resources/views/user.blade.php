@extends('dashboard-layout')

@section('content')

  <!-- component -->
  <section class="container mx-auto p-6">
    <div class="p-1 flex flex-1 flex-col md:flex-row lg:flex-row justify-between md:mx-2 lg:mx-2">
        <div class="rounded overflow-hidden shadow-lg">
            <div class="px-6 py-4 mb-5">
              <div class="font-bold text-xl mb-5"><i class="fas fa-id-card"></i> Fiche de {{$user->fullName()}}</div>
                <p class="text-gray-700 text-base">
                  <span class="font-bold">Email : </span>
                  @if($user->email) {{$user->email}} @else Aucune @endif
                </p>
                <p class="text-gray-700 text-base">
                  <span class="font-bold">Téléphone : </span>
                  @if($user->tel) {{$user->tel}} @else Aucun @endif
                </p>
                <p class="text-gray-700 text-base">
                  <span class="font-bold">Role : </span>
                  @if($user->role) {{$user->role->libelle}} @else Aucun @endif
                </p>
                <p class="text-gray-700 text-base">
                  <span class="font-bold">Entreprise : </span>
                  @if($user->entreprise)
                    @if($user->entreprise->raisonSociale)
                      {{$user->entreprise->raisonSociale}}
                    @else
                      Aucun nom renseigné
                    @endif
                  @else
                    Aucune
                  @endif
                </p>
            </div>

            <div class="px-6 py-4 mb-5">
              <div class="flex justify-between mb-5">
                <div class="font-bold text-xl mb-5"><i class="fas fa-file-signature"></i> Historique des contrats</div>
                <a href="#" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded"><i class="fas fa-plus-circle"></i> Ajouter</a>
              </div>
                <div class="w-full overflow-x-auto">
                  <table class="w-full">
                    <thead>
                      <tr class="text-md font-semibold tracking-wide text-left text-gray-900 bg-gray-100 uppercase border-b border-gray-600">
                        <th class="px-4 py-3">Entreprise</th>
                        <th class="px-4 py-3">Professeur référent</th>
                        <th class="px-4 py-3">Date de début</th>
                        <th class="px-4 py-3">Date de fin</th>
                        <th class="px-4 py-3">Actions</th>
                      </tr>
                    </thead>
                    <tbody class="bg-white">
                      @if($user->contrats)
                        @if(!$user->contrats->isEmpty())
                          @foreach($user->contrats as $contrat)
                            <tr class="text-gray-700">
                              <td class="px-4 py-3 text-sm border">{{$contrat->entreprise->raisonSociale}}</td>
                              <td class="px-4 py-3 text-sm border">{{$contrat->professeur->fullName()}}</td>
                              <td class="px-4 py-3 text-sm border">{{$contrat->dateD}}</td>
                              <td class="px-4 py-3 text-sm border">{{$contrat->dateF}}</td>
                              <td class="px-4 py-3 text-sm border">
                                <a href="{{route('contrats-details', ['id'=>$contrat->id])}}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded"><i class="far fa-eye"></i> Détails</a>
                              </td>
                            </tr>
                          @endforeach
                        @else
                          <tr>
                            <td>Aucun contrat n'est associé à cet élève...</td>
                          </tr>
                        @endif
                      @endif
                    </tbody>
                  </table>
                </div>
            </div>


            {{-- <div class="px-6 py-4">
                <span class="inline-block bg-gray-200 rounded-full px-3 py-1 text-sm font-semibold text-gray-darker mr-2">#photography</span>
                <span class="inline-block bg-gray-200 rounded-full px-3 py-1 text-sm font-semibold text-gray-darker mr-2">#travel</span>
                <span class="inline-block bg-gray-200 rounded-full px-3 py-1 text-sm font-semibold text-gray-darker">#winter</span>
            </div> --}}
        </div>
    </div>
  </section>

@stop