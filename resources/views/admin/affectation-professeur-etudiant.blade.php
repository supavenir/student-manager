@extends('dashboard-layout')

@section('content')

<span class="text-lg font-semibold text-gray-400 ml-3">Admin</span>

  <section class="container mx-auto p-6">
        <div class="rounded overflow-hidden shadow-lg mb-5 p-5">
          <h3 class="text-xl font-bold">Affectation Professeur - Etudiant</h3>
          <!-- component -->
          <section class="container mx-auto p-6 font-mono">
            <div class="w-full mb-8 overflow-hidden rounded-lg">
              <div class="w-full overflow-x-auto">
                <form action="{{route('affectation-professeur-etudiant-post')}}" method="POST">
                  @csrf
                  <p>Choisissez un professeur dans la liste ci-dessous. La liste d'étudiants non rattachés à ce professeur et ayant un contrat
                     se mettra automatiquement à jour.
                  </p>
                
                  <select class="mt-2" name="select-professeur" id="select-professeur" value="" onchange="professorChange(this.value)">
                    @foreach($professeurs as $professeur)
                      <option value="{{$professeur->id}}">{{$professeur->fullName()}}</option>
                    @endforeach
                  </select>
                  
                  <h3 class="text-l font-bold mt-5 mb-2">Etudiants disponibles :</h3>
                  <table class="w-full mb-5">
                    <thead>
                      <tr class="text-md font-semibold tracking-wide text-left text-gray-900 bg-gray-100 uppercase border-b border-gray-600">
                        <th class="px-4 py-3"></th>
                        <th class="px-4 py-3">Nom</th>
                        <th class="px-4 py-3">Prénom</th>
                      </tr>
                    </thead>
                    <tbody class="bg-white" id="etudiants-table-content">
                      <tr class="text-gray-700">
                      </tr>
                    </tbody>
                  </table>

                  <input type="hidden" name="contrats-choosen" id="contrats-choosen" value=""/>
                  <button type="submit" class="bg-blue-500 hover:bg-blue-700 p-3 rounded-lg text-white">Envoyer</button>
                </form>
              </div>
            </div>
          </section>
        </div>
  </section>

  <script>
    window.onload = professorChange("{{$professeurs[0]->id}}")

    function studentChange(contratId, checked){
      const input = document.getElementById("contrats-choosen");
      let contrats = input.value.split("-");
      if(checked){
        contrats.push(contratId);
      }else{
        contrats = contrats.filter(e => e != contratId);
      }
      input.setAttribute("value", contrats.join("-"));
    }

    function professorChange(value){
      const url = `{{url('/')}}/api/admin/professeurs/${value}/contrats-not-linked`
      fetch(url)
        .then(function(response) {
          return response.json();
        })
        .then(function(myBlob) {
          updateEtudiantsTable(myBlob);
        });
    }

    function updateEtudiantsTable(data){
      let tableContent = document.getElementById('etudiants-table-content');
      //remove childs
      while (tableContent.firstChild) {
        tableContent.removeChild(tableContent.lastChild);
      }

      if(data.length > 0) {
        data.forEach(element => {
          const tr = document.createElement('tr');
          tr.classList.add("text-gray-700");
          tableContent.appendChild(tr);

          const tdCheckbox = document.createElement('td');
          tdCheckbox.classList = "px-4 py-3 text-sm border text-center";
          tr.appendChild(tdCheckbox);

          const input = document.createElement('input');
          input.setAttribute("type", "checkbox");
          input.setAttribute("id", element.etudiant.id);
          input.setAttribute("onchange", `studentChange(${element.contrat.id}, this.checked)`);
          tdCheckbox.appendChild(input);

          for(let i = 0; i<2;i++){
            const td = document.createElement('td');
            td.classList = "px-4 py-3 text-sm border";
            td.innerHTML = i == 0 ? element.etudiant.nom : element.etudiant.prenom;
            tr.appendChild(td);
          }
        });
      }else{
        const tr = document.createElement('tr');
        tr.classList.add("text-gray-700");
        tableContent.appendChild(tr);

        const td = document.createElement('td');
        td.classList = "px-4 py-3 text-sm border text-center";
        td.setAttribute("colspan", "3");
        td.innerHTML = "Aucun étudiant retourné ...";
        tr.appendChild(td);
      }

      clearContratsChoosenInput();
    }

    function clearContratsChoosenInput(){
      const input = document.getElementById("contrats-choosen");
      input.setAttribute("value", "");
    }
  </script>

@stop