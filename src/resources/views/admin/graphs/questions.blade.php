@extends('layouts.panel')

@section('content')

<script>
    active = document.querySelector(".sidebar a:nth-child(6)");
    active.classList.add("active");
    activeSelector = document.querySelector("#dropdown a:nth-child(3)");
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

<script>
    function changeNotation() {
        let percentages = document.getElementById("percentages");
        let numbers = document.getElementById("numbers");
        if (percentages.style.display === "none") {
            percentages.style.display = "block";
            numbers.style.display = "none";
        } else {
            percentages.style.display = "none";
            numbers.style.display = "block";
        }
    }
</script>

<div class="flex flex-col mt-8">
    <h2 class="text-xl font-bold text-white mb-8">Right vs Wrong Answers per Question
    <button onClick=changeNotation() id="notation" class="border-2 border-solid p-2 mt-4">Change notation</button>
    </h2>

    <div class="mb-8" id="numbers">
        <canvas id="right_wrong_answers" style="width:800px;max-width:800px"></canvas>
    </div>

    <div class="mb-8" id="percentages" style="display:none">
        <canvas id="right_wrong_answers_percentages" style="width:800px;max-width:800px"></canvas>
    </div>
</div>

<div class="flex flex-col mt-8">
    <h2 class="text-xl font-bold text-white mb-8">Average Time per Question</h2>
    
<?php
    if (count($average_duration) > 0) {
        $average_time = array_sum(array_values($average_duration)) / count($average_duration);
        $average_time_formatted = number_format($average_time, 2, ".", "");
        echo "<p class='text-white mb-8'>Average Time per Question: {$average_time_formatted} seconds</p>";
        } else {
            echo "<p class='text-white mb-8'>No data available.</p>";
        }
        ?>

    <div class="mb-8">
        <canvas id="question_time_chart" style="width:800px;max-width:800px"></canvas>
    </div>
</div>

<script>
Chart.defaults.color = 'white';

var xValues = [@foreach ($finishedQuestions as $key=>$value) "{{ $key }}", @endforeach];
var correctAnswers = [@foreach ($finishedQuestions as $key=>$value) "{{ $value[0] }}", @endforeach];
var wrongAnswers = [@foreach ($finishedQuestions as $key=>$value) "{{ $value[1] }}", @endforeach];

new Chart("right_wrong_answers", {
    type: "bar",
    data: {
        labels: xValues,
        datasets: [
            {
                label: "Correct Answers",
                data: correctAnswers,
                backgroundColor: "rgba(0, 255, 0, 0.5)",
            },
            {
                label: "Wrong Answers",
                data: wrongAnswers,
                backgroundColor: "rgba(255, 0, 0, 0.5)",
            },
        ]
    },
    options : {
        plugins: {
            legend: {
                display: false,
            }
        },
        responsive: true,
        scales: {
            x: {
                stacked: true,
                title: {
                    display: true,
                    text: 'Question ID',
                    color: 'white',
                }
            },
            y: {
                stacked: true,
                min: -2*Math.ceil(Math.max(Math.abs(Math.min(...wrongAnswers) - 5), Math.max(...correctAnswers) + 5)/2),
                max: 2*Math.ceil(Math.max(Math.abs(Math.min(...wrongAnswers) - 5), Math.max(...correctAnswers) + 5)/2),
                title: {
                    display: true,
                    text: 'Number of Right and Wrong Answers',
                    color: 'white',
                }
            }
        },
        onClick: function(event, elements) {
          if (elements.length > 0) {
            var index = elements[0].index + 1;
            var url = '{{ route("question_details", ":index") }}';
            url = url.replace(':index', index);
            window.location.href = url;
          }
        },
        onHover: function(event, chartElement) {
          event.native.target.style.cursor = chartElement[0] ? 'pointer' : 'default';
        }
    }
});


var xValues = [@foreach ($finishedQuestions as $key=>$value) "{{ $key }}", @endforeach];
var correctAnswers = [
    @foreach ($finishedQuestions as $key=>$value)
        @if ($value[0] == 0 && $value[1] == 0)
            0,
        @else
            "{{ $value[0]/($value[0]+abs($value[1]))*100 }}",
        @endif
    @endforeach];
var wrongAnswers = [
    @foreach ($finishedQuestions as $key=>$value)
        @if ($value[0] == 0 && $value[1] == 0)
            0,
        @else
            "{{ $value[1]/($value[0]+abs($value[1]))*100 }}",
        @endif
    @endforeach];

new Chart("right_wrong_answers_percentages", {
  type: "bar",
  data: {
    labels: xValues,
    datasets: [
      {
        label: "Correct Answers",
        data: correctAnswers,
        backgroundColor: "rgba(0, 255, 0, 0.5)",
      },
      {
        label: "Wrong Answers",
        data: wrongAnswers,
        backgroundColor: "rgba(255, 0, 0, 0.5)",
      },
    ]
  },
  options: {
    plugins: {
      legend: {
        display: false,
      }
    },
    responsive: true,
    scales: {
      x: {
        stacked: true,
        title: {
          display: true,
          text: 'Question ID',
          color: 'white',
        }
      },
      y: {
        stacked: true,
        min: -100,
        max: 100,
        title: {
          display: true,
          text: 'Percentage of Right and Wrong Answers',
          color: 'white',
        }
      }
    },
    onClick: function(event, elements) {
      if (elements.length > 0) {
        var index = elements[0].index + 1;
        var url = '{{ route("question_details", ":id") }}';
        url = url.replace(':id', index);
        window.location.href = url;
      }
    },
    onHover: function(event, chartElement) {
      event.native.target.style.cursor = chartElement[0] ? 'pointer' : 'default';
    }
  }
});


var xValues = [@foreach ($question_durations_coords as $key=>$value) "{{ $key }}", @endforeach];
var yValues = [@foreach ($question_durations_coords as $key=>$value) {{ $value }}, @endforeach];

new Chart("question_time_chart", {
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
            max: @php echo round(max(array_values($question_durations_coords)), -1); @endphp + 10,
            title: {
                display: true,
                text: 'Average Time in Seconds',
                color: 'white',
            }
        }
    },
    onClick: function(event, elements) {
      if (elements.length > 0) {
        var index = elements[0].index + 1;
        var url = '{{ route("question_details", ":id") }}';
        url = url.replace(':id', index);
        window.location.href = url;
      }
    },
    onHover: function(event, chartElement) {
      event.native.target.style.cursor = chartElement[0] ? 'pointer' : 'default';
    }
  }
});

</script>

@endsection