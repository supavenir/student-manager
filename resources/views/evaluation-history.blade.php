@extends('dashboard-layout')

@section('content')
  <span class="text-lg font-semibold text-gray-400 ml-3">Historique d'évaluations de la compétence {{$rubrique->nom}} - {{$critere->libelle}}</span>
  <canvas id="myChart" width="400" height="100" class="mt-5"></canvas>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.6.0/chart.min.js" integrity="sha512-GMGzUEevhWh8Tc/njS0bDpwgxdCJLQBWG3Z2Ct+JGOpVnEmjvNx6ts4v6A2XJf1HOrtOsfhv3hBKpK9kE5z8AQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

  <script>

  function convertDate(inputFormat) {
    function pad(s) { return (s < 10) ? '0' + s : s; }
    var d = new Date(inputFormat)
    return [pad(d.getDate()), pad(d.getMonth()+1), d.getFullYear()].join('/')
  }

  const ctx = document.getElementById('myChart').getContext('2d');
  let url = '{{url('/')}}' + '/api/contrats/{{$idContrat}}/{{$critere->id}}/history';
  const result = []
  fetch(url)
    .then(data => data.json())
    .then((json) => {
      console.log(json)

      const dates = json.filter(e => e != null).map(e => convertDate(e.suivi.dateS))
      const evaluations = json.filter(e => e.evaluation != null).map(e => e.evaluation.idNiveau)
      console.log(evaluations)

      const myChart = new Chart(ctx, {
          type: 'line',
          data: {
              labels: dates,
              datasets: [{
                  label: 'Niveau',
                  data: evaluations,
                  backgroundColor: [
                      'rgba(255, 99, 132, 0.2)',
                      'rgba(54, 162, 235, 0.2)',
                      'rgba(255, 206, 86, 0.2)',
                      'rgba(75, 192, 192, 0.2)',
                      'rgba(153, 102, 255, 0.2)',
                      'rgba(255, 159, 64, 0.2)'
                  ],
                  borderColor: [
                      'rgba(255, 99, 132, 1)',
                      'rgba(54, 162, 235, 1)',
                      'rgba(255, 206, 86, 1)',
                      'rgba(75, 192, 192, 1)',
                      'rgba(153, 102, 255, 1)',
                      'rgba(255, 159, 64, 1)'
                  ],
                  borderWidth: 1
              }]
          },
          options: {
              scales: {
                  y: {
                      beginAtZero: true
                  }
              }
          }
      });

    }).catch(function (error) {
      console.log('request failed', error)
    });
  </script>

@stop