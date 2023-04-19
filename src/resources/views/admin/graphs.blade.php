@extends('layouts.panel')

@section('content')
<script>
    activeSelector = document.querySelector(".sidebar a:nth-child(6)");
    activeSelector.classList.add("active");
    console.log(activeSelector)

    window.addEventListener('DOMContentLoaded', ()=> {
        const menuBtn = document.querySelector('#menu-btn')
        const dropdown = document.querySelector('#dropdown')
            
        menuBtn.addEventListener('click', () => {
            dropdown.classList.toggle('hidden')
            dropdown.classList.toggle('flex')
        })

    })

    function toggleDisplay(selected) {
        var year = document.getElementById("login_counts_chart_select_year");
        var month = document.getElementById("login_counts_chart_select_month");

        if (selected == "month") {
            year.style.display = "inline-block";
            month.style.display = "inline-block";
        } else if (selected == "year") {
            year.style.display = "inline-block";
            month.style.display = "none";
        } else if (selected == "week") {
            year.style.display = "none";
            month.style.display = "none";
        }
    }
    
    function isDateInThisWeek(date) {
        const todayObj = new Date();
        const todayDate = todayObj.getDate();
        const todayDay = todayObj.getDay();

        // get first date of week
        const firstDayOfWeek = new Date(todayObj.setDate(todayDate - todayDay));

        // get last date of week
        const lastDayOfWeek = new Date(firstDayOfWeek);
        lastDayOfWeek.setDate(lastDayOfWeek.getDate() + 6);

        // if date is equal or within the first and last dates of the week
        return date >= firstDayOfWeek && date <= lastDayOfWeek;
    }

    function getDataFromMonthAndYear(xValues, yValues, month="none", year) {
        var newXValues = [];
        var newYValues = [];
        if (month == "none") {
            for (var i = 0; i < xValues.length; i++) {
                var date = new Date(parseInt(xValues[i].substring(0,4)), parseInt(xValues[i].substring(5,7)) - 1, parseInt(xValues[i].substring(8,10)));
                if (date.getFullYear() == parseInt(year)) {
                    newXValues.push(xValues[i]);
                    newYValues.push(yValues[i]);
                }
            }
        }
        else {
            for (var i = 0; i < xValues.length; i++) {
                var date = new Date(parseInt(xValues[i].substring(0,4)), parseInt(xValues[i].substring(5,7)) - 1, parseInt(xValues[i].substring(8,10)));
                if (date.getMonth() == parseInt(month) && date.getFullYear() == parseInt(year)) {
                    newXValues.push(xValues[i]);
                    newYValues.push(yValues[i]);
                }
            }
        }
        return [newXValues, newYValues];
    }

    function updateChart(chart, xValues, yValues) {
        chart.data.labels = xValues;
        chart.data.datasets[0].data = yValues;
        chart.options.scales.y.max = Math.max(...yValues) + 5;
        chart.update('none');
    }

    function assignMonths(xValues, yValues) {
        var newXValues = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];
        var newYValues = [0,0,0,0,0,0,0,0,0,0,0,0];
        for (var i = 0; i < xValues.length; i++) {
            var date = new Date(parseInt(xValues[i].substring(0,4)), parseInt(xValues[i].substring(5,7)) - 1, parseInt(xValues[i].substring(8,10)));
            newYValues[date.getMonth()] += yValues[i];
        }
        return [newXValues, newYValues];
    }
</script>

<script src="
https://cdn.jsdelivr.net/npm/chart.js@4.2.1/dist/chart.umd.min.js
"></script>

<h2 class="font-extrabold text-xl mt-16 mb-8">
    Gráficos
</h2>

<div class="flex flex-col mt-8">
    <h2 class="text-xl font-bold text-white mb-8">
        Daily Login Counts
        <select id="login_counts_chart_select" class="ml-4 text-black text-sm">
            <option value="week" class="text-black" selected>This Week</option>
            <option value="month" class="text-black">Per Month</option>
            <option value="year" class="text-black">Per Year</option>
        </select>
        <select id="login_counts_chart_select_year" class="ml-4 text-black text-sm hidden">
            @foreach (array_reverse($years) as $year)
                <option value="{{ $year }}" class="text-black">{{ $year }}</option>
            @endforeach
        </select>
        <select id="login_counts_chart_select_month" class="ml-4 text-black text-sm hidden">
            <option value="0" class="text-black">January</option>
            <option value="1" class="text-black">February</option>
            <option value="2" class="text-black">March</option>
            <option value="3" class="text-black">April</option>
            <option value="4" class="text-black">May</option>
            <option value="5" class="text-black">June</option>
            <option value="6" class="text-black">July</option>
            <option value="7" class="text-black">August</option>
            <option value="8" class="text-black">September</option>
            <option value="9" class="text-black">October</option>
            <option value="10" class="text-black">November</option>
            <option value="11" class="text-black">December</option>
        </select>
    </h2>

    <div class="mb-8">
        <canvas id="login_counts_chart" style="width:800px;max-width:800px"></canvas>
    </div>
</div>

<script>
var xValues = [@foreach ($login_counts as $count) "{{ substr($count->day, 0, 10) }}", @endforeach];
var yValues = [@foreach ($login_counts as $count) {{ $count->count }}, @endforeach];
var newXValues = [];
var newYValues = [];

var login_counts_chart_select_year = document.getElementById("login_counts_chart_select_year");
var login_counts_chart_select_month = document.getElementById("login_counts_chart_select_month");
login_counts_chart_select_month.addEventListener("change", myFunction => {
    var data = getDataFromMonthAndYear(xValues, yValues, login_counts_chart_select_month.value, login_counts_chart_select_year.value);
    updateChart(login_counts_chart, data[0], data[1]);
});
login_counts_chart_select_year.addEventListener("change", myFunction => {
    if (login_counts_chart_select_month.style.display == "none") {
        var data = getDataFromMonthAndYear(xValues, yValues, "none", login_counts_chart_select_year.value);
        var newValues = assignMonths(data[0], data[1]);
        updateChart(login_counts_chart, newValues[0], newValues[1]);
    }
    else {
        var data = getDataFromMonthAndYear(xValues, yValues, login_counts_chart_select_month.value, login_counts_chart_select_year.value);
        updateChart(login_counts_chart, data[0], data[1]);    
    }
});

var login_counts_chart_select = document.getElementById("login_counts_chart_select");
login_counts_chart_select.addEventListener("change", myFunction => {
    if (login_counts_chart_select.value == "week") {
        toggleDisplay("week");
        newXValues.length = 0;
        newYValues.length = 0;
        for (var i = 0; i < xValues.length; i++) {
            if (isDateInThisWeek(new Date(parseInt(xValues[i].substring(0,4)), parseInt(xValues[i].substring(5,7)) - 1, parseInt(xValues[i].substring(8,10))))) {
                newXValues.push(xValues[i]);
                newYValues.push(yValues[i]);
            }
        }
        updateChart(login_counts_chart, newXValues, newYValues);
    }
    else if (login_counts_chart_select.value == "month") {
        toggleDisplay("month");
        newXValues.length = 0;
        newYValues.length = 0;
        for (var i = 0; i < xValues.length; i++) {
            if (new Date(parseInt(xValues[i].substring(0,4)), parseInt(xValues[i].substring(5,7)) - 1, parseInt(xValues[i].substring(8,10))).getMonth() == new Date().getMonth()) {
                newXValues.push(xValues[i]);
                newYValues.push(yValues[i]);
            }
        }
        updateChart(login_counts_chart, newXValues, newYValues);
    }
    else if (login_counts_chart_select.value == "year") {
        toggleDisplay("year");
        newXValues.length = 0;
        newYValues.length = 0;
        for (var i = 0; i < xValues.length; i++) {
            if (new Date(parseInt(xValues[i].substring(0,4)), parseInt(xValues[i].substring(5,7)) - 1, parseInt(xValues[i].substring(8,10))).getFullYear() == new Date().getFullYear()) {
                newXValues.push(xValues[i]);
                newYValues.push(yValues[i]);
            }
        }
        if (login_counts_chart_select_month.style.display == "none") {
            var newValues = assignMonths(newXValues, newYValues);
            updateChart(login_counts_chart, newValues[0], newValues[1]);
        }
        else {
            updateChart(login_counts_chart, newXValues, newYValues);
        }
    }
    else {
        newXValues = xValues;
        newYValues = yValues;
    }
});

Chart.defaults.color = 'white';

for (var i = 0; i < xValues.length; i++) {
    if (isDateInThisWeek(new Date(parseInt(xValues[i].substring(0,4)), parseInt(xValues[i].substring(5,7)) - 1, parseInt(xValues[i].substring(8,10))))) {
        newXValues.push(xValues[i]);
        newYValues.push(yValues[i]);
    }
}

var login_counts_chart = new Chart("login_counts_chart", {
  type: "bar",
  data: {
    labels: newXValues,
    datasets: [{
      backgroundColor: "rgb(255,255,255)",
      data: newYValues,
    }]
  },
  options : {
    plugins: {
        legend: {
            display: false,
        }
    },
    scales: {
        x: {
            title: {
                display: true,
                text: 'Day',
                color: 'white',
            }
        },
        y: {
            min: 0,
            max: Math.max(...newYValues) + 5, // add 5 to highest number of logins
            title: {
                display: true,
                text: 'Number of Logins',
                color: 'white',
            }
        }
    }
  }
});

</script>

@endsection