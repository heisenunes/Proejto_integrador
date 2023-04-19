@extends('layouts.panel')

@section('content')

<script>
    active = document.querySelector(".sidebar a:nth-child(6)");
    active.classList.add("active");
    activeSelector = document.querySelector("#dropdown a:nth-child(1)");
    activeSelector.classList.add("active");

    window.addEventListener('DOMContentLoaded', ()=> {
        const menuBtn = document.querySelector('#menu-btn')
        const dropdown = document.querySelector('#dropdown')
        
        menuBtn.addEventListener('click', () => {
            dropdown.classList.toggle('hidden')
            dropdown.classList.toggle('flex')
        })

    })

    function toggleDisplay(selected) {
        var year = document.getElementById("average_durations_chart_select_year");
        var month = document.getElementById("average_durations_chart_select_month");

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
        var newYValues = [[], [], [], [], [], [], [], [], [], [], [], []];
        for (var i = 0; i < xValues.length; i++) {
            var date = new Date(parseInt(xValues[i].substring(0,4)), parseInt(xValues[i].substring(5,7)) - 1, parseInt(xValues[i].substring(8,10)));
            newYValues[date.getMonth()].push(yValues[i]);
        }
        for (var i = 0; i < newYValues.length; i++) {
            var sum = 0;
            for (var j = 0; j < newYValues[i].length; j++) {
                sum += newYValues[i][j];
            }
            newYValues[i] = sum/newYValues[i].length || 0;
        }
        return [newXValues, newYValues];
    }
</script>

<script src="
https://cdn.jsdelivr.net/npm/chart.js@4.2.1/dist/chart.umd.min.js
"></script>

<div class="flex flex-col mt-8">
    <h2 class="text-xl font-bold text-white mb-8">
        Average Session Durations
        <select id="average_durations_chart_select" class="ml-4 text-black text-sm">
            <option value="week" class="text-black" selected>This Week</option>
            <option value="month" class="text-black">Per Month</option>
            <option value="year" class="text-black">Per Year</option>
        </select>
        <select id="average_durations_chart_select_year" class="ml-4 text-black text-sm hidden">
            @foreach ($years as $year)
                <option value="{{ $year }}" class="text-black">{{ $year }}</option>
            @endforeach
        </select>
        <select id="average_durations_chart_select_month" class="ml-4 text-black text-sm hidden">
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
        <canvas id="session_duration_chart" style="width:800px;max-width:800px"></canvas>
    </div>
</div>

<script>
var xValues = [@foreach ($graph_coords as $key=>$value) "{{ substr($key, 0, 10) }}", @endforeach];
var yValues = [@foreach ($graph_coords as $key=>$value) {{ $value }}, @endforeach];
var newXValues = [];
var newYValues = [];

var average_durations_chart_select_year = document.getElementById("average_durations_chart_select_year");
var average_durations_chart_select_month = document.getElementById("average_durations_chart_select_month");
average_durations_chart_select_month.addEventListener("change", myFunction => {
    var data = getDataFromMonthAndYear(xValues, yValues, average_durations_chart_select_month.value, average_durations_chart_select_year.value);
    updateChart(session_duration_chart, data[0], data[1]);
});
average_durations_chart_select_year.addEventListener("change", myFunction => {
    if (average_durations_chart_select_month.style.display == "none") {
        var data = getDataFromMonthAndYear(xValues, yValues, "none", average_durations_chart_select_year.value);
        var newValues = assignMonths(data[0], data[1]);
        updateChart(session_duration_chart, newValues[0], newValues[1]);
    }
    else {
        var data = getDataFromMonthAndYear(xValues, yValues, average_durations_chart_select_month.value, average_durations_chart_select_year.value);
        updateChart(session_duration_chart, data[0], data[1]);
    }
});
var average_durations_chart_select = document.getElementById("average_durations_chart_select");
average_durations_chart_select.addEventListener("change", myFunction => {
    if (average_durations_chart_select.value == "week") {
        toggleDisplay("week");
        newXValues.length = 0;
        newYValues.length = 0;
        for (var i = 0; i < xValues.length; i++) {
            if (isDateInThisWeek(new Date(parseInt(xValues[i].substring(0,4)), parseInt(xValues[i].substring(5,7)) - 1, parseInt(xValues[i].substring(8,10))))) {
                newXValues.push(xValues[i]);
                newYValues.push(yValues[i]);
            }
        }
        updateChart(session_duration_chart, newXValues, newYValues);
    }
    else if (average_durations_chart_select.value == "month") {
        toggleDisplay("month");
        newXValues.length = 0;
        newYValues.length = 0;
        for (var i = 0; i < xValues.length; i++) {
            if (new Date(parseInt(xValues[i].substring(0,4)), parseInt(xValues[i].substring(5,7)) - 1, parseInt(xValues[i].substring(8,10))).getMonth() == new Date().getMonth()) {
                newXValues.push(xValues[i]);
                newYValues.push(yValues[i]);
            }
        }
        updateChart(session_duration_chart, newXValues, newYValues);
    }
    else if (average_durations_chart_select.value == "year") {
        toggleDisplay("year");
        newXValues.length = 0;
        newYValues.length = 0;
        for (var i = 0; i < xValues.length; i++) {
            if (new Date(parseInt(xValues[i].substring(0,4)), parseInt(xValues[i].substring(5,7)) - 1, parseInt(xValues[i].substring(8,10))).getFullYear() == new Date().getFullYear()) {
                newXValues.push(xValues[i]);
                newYValues.push(yValues[i]);
            }
        }
        if (average_durations_chart_select_month.style.display == "none") {
            var newValues = assignMonths(newXValues, newYValues);
            updateChart(session_duration_chart, newValues[0], newValues[1]);
        }
        else {
            updateChart(session_duration_chart, newXValues, newYValues);
        }
    }
    else {
        newXValues = xValues;
        newYValues = yValues;
    }
})


Chart.defaults.color = 'white';

var session_duration_chart = new Chart("session_duration_chart", {
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
                    text: 'Average Session Duration (seconds)',
                    color: 'white',
                }
            }
        }
    }
});
</script>

@endsection