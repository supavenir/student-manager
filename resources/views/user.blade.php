@extends('dashboard-layout')

@section('content')

  <!-- component -->
  <section class="container mx-auto p-6">
    <div class="p-1 flex flex-1 flex-col md:flex-row lg:flex-row justify-between md:mx-2 lg:mx-2">
        <div class="max-w-sm rounded overflow-hidden shadow-lg">
            <div class="px-6 py-4">
                <div class="font-bold text-xl mb-5">Fiche de {{$user->fullName()}}</div>
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
            {{-- <div class="px-6 py-4">
                <span class="inline-block bg-gray-200 rounded-full px-3 py-1 text-sm font-semibold text-gray-darker mr-2">#photography</span>
                <span class="inline-block bg-gray-200 rounded-full px-3 py-1 text-sm font-semibold text-gray-darker mr-2">#travel</span>
                <span class="inline-block bg-gray-200 rounded-full px-3 py-1 text-sm font-semibold text-gray-darker">#winter</span>
            </div> --}}
        </div>
    </div>
  </section>

@stop