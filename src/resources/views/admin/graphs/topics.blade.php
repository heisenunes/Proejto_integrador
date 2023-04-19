@extends('layouts.panel')

@section('content')

<script>
    active = document.querySelector(".sidebar a:nth-child(6)");
    active.classList.add("active");
    activeSelector = document.querySelector("#dropdown a:nth-child(2)");
    activeSelector.classList.add("active");

    window.addEventListener('DOMContentLoaded', ()=> {
            const menuBtn = document.querySelector('#menu-btn')
            const dropdown = document.querySelector('#dropdown')
            
            menuBtn.addEventListener('click', () => {
                dropdown.classList.toggle('hidden')
                dropdown.classList.toggle('flex')
            })

        })
</script>

<script src="
https://cdn.jsdelivr.net/npm/chart.js@4.2.1/dist/chart.umd.min.js
"></script>

<div class="flex flex-col mt-8">
    <h2 class="text-xl font-bold text-white mb-8">Total Topics Finished</h2>

    <div class="mb-8">
        <canvas id="answered_topics_chart" style="width:800px;max-width:800px"></canvas>
    </div>

    <h2 class="text-xl font-bold text-white mb-8">Topic Visits</h2>

    <div class="mb-8">
        <canvas id="topic_visits_count" style="width:800px;max-width:800px"></canvas>
    </div>
</div>

<script>
Chart.defaults.color = 'white';

var xValues = [@foreach ($finished_topics as $key=>$value) "{{ $key }}", @endforeach];
var yValues = [@foreach ($finished_topics as $key=>$value) {{ $value }}, @endforeach];

new Chart("answered_topics_chart", {
  type: "bar",
  data: {
    labels: xValues,
    datasets: [{
      backgroundColor: "rgb(255,255,255)",
      data: yValues,
    }]
  },
  options : {
    plugins: {
        legend: {
            display: false,
        }
    },
    scales: {
        y: {
            min: 0,
            max: Math.max(...yValues) + 5, // add 5 to highest number of logins
            title: {
                display: true,
                text: 'Number of People Finished',
                color: 'white',
            }
        }
    }
  }
});

var visitsXValues = [@foreach ($topic_visits_coords as $key=>$value) "{{ $key }}", @endforeach];
var visitsYValues = [@foreach ($topic_visits_coords as $key=>$value) {{ $value }}, @endforeach];

new Chart("topic_visits_count", {
  type: "bar",
  data: {
    labels: visitsXValues,
    datasets: [{
      backgroundColor: "rgb(255,255,255)",
      data: visitsYValues,
    }]
  },
  options : {
    plugins: {
        legend: {
            display: false,
        }
    },
    scales: {
        y: {
            min: 0,
            max: Math.max(...visitsYValues) + 5, // add 5 to highest number of logins
            title: {
                display: true,
                text: 'Number of Visits',
                color: 'white',
            }
        }
    }
  }
});
</script>

@endsection