@extends('dashboard-layout')

@section('content')

  <!-- component -->
  <section class="container mx-auto p-6">
    <form action="{{route('add-suivi-post', ["idContrat"=>$idContrat])}}" method="POST">
      @csrf
      @foreach ($rubriques as $rubrique)
        <div class="rounded overflow-hidden shadow-lg mb-5 p-5">
          <h3 class="text-xl font-bold">{{$rubrique->nom}}</h3>
          <!-- component -->
          <section class="container mx-auto p-6 font-mono">
            <div class="w-full mb-8 overflow-hidden rounded-lg">
              <div class="w-full overflow-x-auto">
                <table class="w-full">
                  <thead>
                    <tr class="text-md font-semibold tracking-wide text-left text-gray-900 bg-gray-100 uppercase border-b border-gray-600">
                      <th class="px-4 py-3"></th>
                      @foreach($niveaux as $niveau)
                        <th class="px-4 py-3">{{$niveau->libelle}}</th>
                      @endforeach
                    </tr>
                  </thead>
                  <tbody class="bg-white">
                    @foreach($rubrique->criteres as $critere)
                      <tr class="text-gray-700">
                        <td class="px-4 py-3 text-sm border">{{$critere->libelle}}</td>
                        @foreach($niveaux as $niveau)
                          <td class="px-4 py-3 text-sm border"><input type="checkbox" name="{{$rubrique->id}}-{{$critere->id}}-{{$niveau->id}}" id="{{$rubrique->id}}-{{$critere->id}}-{{$niveau->id}}"></td>
                        @endforeach
                      </tr>
                    @endforeach
                  </tbody>
                </table>
              </div>
            </div>
          </section>
        </div>
      @endforeach
      <button type="submit" class="bg-blue-500 hover:bg-blue-700 p-3 rounded-lg">Envoyer</button>
    </form>
  </section>

@stop