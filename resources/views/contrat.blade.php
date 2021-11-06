@extends('dashboard-layout')

@section('content')

  <!-- component -->
  <section class="container mx-auto p-6">
    <div class="p-1 flex flex-1 flex-col md:flex-row lg:flex-row justify-between md:mx-2 lg:mx-2">
        <div class="rounded overflow-hidden shadow-lg">
            <div class="px-6 py-4 mb-5">
              <div class="font-bold text-xl mb-5"><i class="fas fa-id-card"></i> Contrat n°{{$contrat->id}}</div>
                <p class="text-gray-700 text-base">
                  <span class="font-bold">Date de début : </span>
                  @if($contrat->dateD) {{$contrat->dateD}} @else Aucune @endif
                </p>
                <p class="text-gray-700 text-base">
                  <span class="font-bold">Date de fin : </span>
                  @if($contrat->dateF) {{$contrat->dateF}} @else Aucune @endif
                </p>
                <p class="text-gray-700 text-base">
                  <span class="font-bold">Etudiant : </span>
                  @if($contrat->etudiant)
                    <a href="{{route('etudiants-details', ['id'=>$contrat->etudiant->id])}}">{{$contrat->etudiant->fullName()}}</a>
                  @else Aucun 
                  @endif
                </p>
                <p class="text-gray-700 text-base">
                  <span class="font-bold">Professeur référent : </span>
                  @if($contrat->professeur) {{$contrat->professeur->fullName()}} @else Aucun @endif
                </p>
                <p class="text-gray-700 text-base">
                  <span class="font-bold">Entreprise : </span>
                  @if($contrat->entreprise)
                    @if($contrat->entreprise->raisonSociale)
                      {{$contrat->entreprise->raisonSociale}}
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
                <div class="font-bold text-xl mb-5"><i class="fas fa-file-signature"></i> Historique des suivis</div>
                <a href="{{route('add-suivi', ['id'=>$contrat->id])}}" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded"><i class="fas fa-plus-circle"></i> Ajouter</a>
              </div>
                <div class="w-full overflow-x-auto">
                  <table class="w-full">
                    <thead>
                      <tr class="text-md font-semibold tracking-wide text-left text-gray-900 bg-gray-100 uppercase border-b border-gray-600">
                        <th class="px-4 py-3">Date</th>
                        <th class="px-4 py-3">Commentaire</th>
                        <th class="px-4 py-3">Statut</th>
                        <th class="px-4 py-3">Actions</th>
                      </tr>
                    </thead>
                    <tbody class="bg-white">
                      @if($contrat->suivis)
                        @if(!$contrat->suivis->isEmpty())
                          @foreach($contrat->suivis as $suivi)
                            <tr class="text-gray-700">
                              <td class="px-4 py-3 text-sm border">{{$suivi->dateS}}</td>
                              <td class="px-4 py-3 text-sm border">@if($suivi->commentaire) {{$suivi->commentaire}} @else Aucun @endif</td>
                              <td class="px-4 py-3 text-xs border">
                                @if($suivi->statut === 'ok')
                                  <span class="px-2 py-1 font-semibold leading-tight text-green-700 bg-green-100 rounded-sm"> Complet </span>
                                @else
                                  <span class="px-2 py-1 font-semibold leading-tight text-orange-700 bg-red-100 rounded-sm"> En attente </span>
                                @endif
                              </td>
                              <td class="px-4 py-3 text-sm border">
                                <a href="#" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded"><i class="far fa-eye"></i></a>
                                <a href="#" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded"><i class="fas fa-edit"></i></a>
                              </td>
                            </tr>
                          @endforeach
                        @else
                          <tr>
                            <td>Aucun suivi n'a été saisi pour ce contrat ...</td>
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