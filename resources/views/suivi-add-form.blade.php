@extends('dashboard-layout')

@section('content')
  <span class="text-lg font-semibold text-gray-400 ml-3">Suivi pour l'étudiant <b>{{$eleve->nom}} {{$eleve->prenom}}</b></span>
  <!-- component -->
  <section class="container mx-auto p-6">
    <form action="{{route('add-suivi-post', ["idContrat"=>$idContrat])}}" method="POST">
      @csrf
      @foreach ($rubriques as $rubrique)
        <div class="rounded overflow-hidden shadow-lg mb-5 p-5">
          <h3 class="text-xl font-bold">{{$rubrique->nom}}</h3>
          <!-- component -->
          <section class="container mx-auto p-6 font-mono">
            @foreach($rubrique->criteres as $critere)
              <div class="flex justify-around">
                <div>
                  <p>
                    Ancienne évaluation : <br>
                    <span class="text-gray-400">
                      @if($lastSuivi->getEvaluation($critere->id) != null)
                        {{ $lastSuivi->getEvaluation($critere->id)->niveau()->first()->libelle }}
                        @if($lastSuivi->getEvaluation($critere->id)->sens != 0 || $lastSuivi->getEvaluation($critere->id)->sens != null)
                          ({{$lastSuivi->getEvaluation($critere->id)->sens}})
                        @endif
                      @else
                        Aucune
                      @endif
                    </span>
                  </p>
                </div>
                <div class="flex items-center justify-center">
                  <div class="flex-2 flex items-center justify-between">
                    <span id="evaluator-{{$rubrique->id}}-{{$critere->id}}-minus-minus" class="bg-blue-500 hover:bg-blue-700 p-3 m-1 rounded-lg text-white cursor-pointer" onclick="eval({{$rubrique->id}}, {{$critere->id}}, '--')">--</span>
                    <span id="evaluator-{{$rubrique->id}}-{{$critere->id}}-minus" class="bg-blue-500 hover:bg-blue-700 p-3 m-1 rounded-lg text-white cursor-pointer" onclick="eval({{$rubrique->id}}, {{$critere->id}}, '-')">-</span>
                  </div>
                  <div class="ml-3 mr-3">
                    <select name="{{$rubrique->id}}-{{$critere->id}}-selection">
                      <option value="" selected disabled>Choisissez un niveau ...</option>
                      @foreach($niveaux as $niveau)
                        @if($lastSuivi->getEvaluation($critere->id) != null)
                          @if($lastSuivi->getEvaluation($critere->id)->niveau()->first()->id === $niveau->id)
                            <option selected value="{{$niveau->id}}">{{$niveau->libelle}}</option>
                          @else
                            <option value="{{$niveau->id}}">{{$niveau->libelle}}</option>
                          @endif
                        @else
                          <option value="{{$niveau->id}}">{{$niveau->libelle}}</option>
                        @endif
                      @endforeach
                    </select>
                  </div>
                  <div class="flex-2 flex items-center justify-between">
                    <span id="evaluator-{{$rubrique->id}}-{{$critere->id}}-plus" class="bg-blue-500 hover:bg-blue-700 p-3 m-1 rounded-lg text-white cursor-pointer" onclick="eval({{$rubrique->id}}, {{$critere->id}}, '+')">+</span>
                    <span id="evaluator-{{$rubrique->id}}-{{$critere->id}}-plus-plus" class="bg-blue-500 hover:bg-blue-700 p-3 m-1 rounded-lg text-white cursor-pointer" onclick="eval({{$rubrique->id}}, {{$critere->id}}, '++')">++</span>
                  </div>
                </div>
                <input type="hidden" name="{{$rubrique->id}}-{{$critere->id}}" id="{{$rubrique->id}}-{{$critere->id}}" value="" disabled/>
              </div>
            @endforeach
          </section>
        </div>
      @endforeach
      <div class="flex items-center wrap justify-between">
        <textarea class="rounded-lg mr-3" name="suivi-comment" cols="30" rows="1" placeholder="Commentaire global ..."></textarea>
        <button type="submit" class="bg-blue-500 hover:bg-blue-700 p-3 rounded-lg text-white">Envoyer</button>
      </div>
    </form>
  </section>
  <script>
    function eval(rubriqueId, critereId, mark){
      let map = new Map();
      map.set('--', 'minus-minus')
      map.set('-', 'minus')
      map.set('+', 'plus')
      map.set('++', 'plus-plus')
      const hiddenInput = document.getElementById(`${rubriqueId}-${critereId}`)
      const spanClicked = document.getElementById(`evaluator-${rubriqueId}-${critereId}-${map.get(mark)}`)
      const minusDiv = spanClicked.parentNode.parentNode.childNodes[1];
      const plusDiv = spanClicked.parentNode.parentNode.childNodes[5];

      minusDiv.childNodes.forEach(element => {
        if(element.tagName == "SPAN"){
          element.classList.replace("bg-green-500", "bg-blue-500");
          element.classList.replace("hover:bg-green-700", "hover:bg-blue-700");
        }
      });
      plusDiv.childNodes.forEach(element => {
        if(element.tagName == "SPAN"){
          element.classList.replace("bg-green-500", "bg-blue-500");
          element.classList.replace("hover:bg-green-700", "hover:bg-blue-700");
        }
      });

      spanClicked.classList.replace("bg-blue-500", "bg-green-500");
      spanClicked.classList.replace("hover:bg-blue-700", "hover:bg-green-700");

      if(hiddenInput.hasAttribute("disabled")) hiddenInput.removeAttribute("disabled");
      hiddenInput.value = mark;
    }
  </script>
@stop
