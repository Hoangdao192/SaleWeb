<?php

use Core\HTML;
?>

<style>
    .chart {
        width: 100%;
        height: 500px;
    }

    #myChart {
        width: 200px;
        height: 200px;
    }
</style>

<script src="https://cdn.jsdelivr.net/npm/chart.js@3.7.1/dist/chart.min.js"></script>
<link rel="stylesheet" href="<?php echo HTML::style("analytic.css") ?>">
<div class="admin-content-right">
    <div class="stastitic-type">
        <p>Thống kê theo </p>
        <select name="stastitic-type" id="stastitic-type" onchange="changeStastiticType(this)">
            <option value="0">Năm</option>
            <option value="1">Tháng</option>
        </select>
        <p style="margin-left: 30px;">Năm</p>
        <select name="year" id="year">
            <option value="2022">2022</option>
            <option value="2023">2023</option>
        </select>
        <div class="month-selector" style="display: none;">
            <p style="margin-left: 30px;">Tháng</p>
            <select name="month" id="month" onchange="changeMonth()">
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
                <option value="4">4</option>
                <option value="5">5</option>
                <option value="6">6</option>
                <option value="7">7</option>
                <option value="8">8</option>
                <option value="9">9</option>
                <option value="10">10</option>
                <option value="11">11</option>
                <option value="12">12</option>
            </select>
        </div>
    </div>
    <div class="chart">
        <canvas id="myChart" width="100" height="30"></canvas>
    </div>
    <div class="chart">
        <canvas id="myChart2" width="100" height="30"></canvas>
    </div>
</div>
<script>
    var firstChart = null;
    var secondChart = null;

    function createChart(id, lables, data, title, xAxis, yAxis) {
        const ctx = document.getElementById(id).getContext('2d');
        const myChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: labels,
                datasets: [{
                    label: title,
                    data: data,
                    backgroundColor: [
                        'rgba(0,0,0, 1)'
                    ],
                    borderColor: [
                        'rgba(0,0,0, 1)'
                    ],
                    borderWidth: 2
                }]
            },
            options: {
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: true,
                        title: {
                            display: true,
                            text: yAxis
                        }
                    },
                    x: {
                        title: {
                            display: true,
                            text: xAxis
                        }
                    }
                }
            }
        });
        return myChart;
    }

    loadStasticticByYear();
    function changeStastiticType(selector) {
        console.log(selector.value);
        if (selector.value == 1) {
            document.querySelector(".month-selector").style.display = "inline-block";
            loadStasticticByMonth();
        } else {
            loadStasticticByYear();
            document.querySelector(".month-selector").style.display = "none";
        }
    }

    function changeMonth(selector) {
        loadStasticticByMonth();
    }

    function loadStasticticByYear() {
        let yearSelector = document.getElementById("year");
        let selectedYear = yearSelector.value;

        var request = new XMLHttpRequest();
        request.open("POST", `${getDomainUrl()}/admin/getanalytic`);
        request.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
        request.onload = function() {
            let ret = JSON.parse(this.response);
            let data = new Array(12).fill(0);
            console.log(ret);
            let i = 0;
            Object.entries(ret).forEach(entry => {
                const [key, value] = entry;
                data[key - 1] = parseInt(value);
            });
            labels = ['1', '2', '3', '4', '5', '6', '7', '8', '9', '10', '11', '12']
            if (firstChart != null) firstChart.destroy();
            firstChart = createChart('myChart', labels, data, 'Thống kê đơn hàng', 'Tháng', 'Số đơn hàng');
        }
        request.send(`year=${selectedYear}`);

        var request2 = new XMLHttpRequest();
        request2.open("POST", `${getDomainUrl()}/admin/getproductanalytic`);
        request2.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
        request2.onload = function() {
            let ret = JSON.parse(this.response);
            let data = new Array(12).fill(0);
            console.log(ret);
            let i = 0;
            Object.entries(ret).forEach(entry => {
                const [key, value] = entry;
                data[key - 1] = parseInt(value);
            });
            labels = ['1', '2', '3', '4', '5', '6', '7', '8', '9', '10', '11', '12']
            if (secondChart != null) secondChart.destroy();
            secondChart = createChart('myChart2', labels, data, 'Doanh số sản phẩm', 'Tháng', 'Số sản phẩm');
        }
        request2.send(`year=${selectedYear}`);
    }

    function loadStasticticByMonth() {
        let yearSelector = document.getElementById("year");
        let selectedYear = yearSelector.value;

        let monthSelector = document.getElementById("month");
        let selectedMonth = monthSelector.value;

        var request = new XMLHttpRequest();
        request.open("POST", `${getDomainUrl()}/admin/getanalyticbymonth`);
        request.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
        request.onload = function() {
            let ret = JSON.parse(this.response);
            let data = new Array(31).fill(0);
            console.log(ret);
            let i = 0;
            Object.entries(ret).forEach(entry => {
                const [key, value] = entry;
                data[key - 1] = parseInt(value);
            });
            labels = new Array(12);
            for (let i = 1; i <= 31; ++i) {
                labels[i-1] = i;
            }
            if (firstChart != null) firstChart.destroy();
            firstChart = createChart('myChart', labels, data, 'Thống kê đơn hàng', 'Ngày', 'Số đơn hàng');
        }
        request.send(`year=${selectedYear}&month=${selectedMonth}`);

        var request2 = new XMLHttpRequest();
        request2.open("POST", `${getDomainUrl()}/admin/getmonthproductanalytic`);
        request2.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
        request2.onload = function() {
            let ret = JSON.parse(this.response);
            let data = new Array(31).fill(0);
            console.log(ret);
            let i = 0;
            Object.entries(ret).forEach(entry => {
                const [key, value] = entry;
                data[key - 1] = parseInt(value);
            });
            labels = new Array(12);
            for (let i = 1; i <= 31; ++i) {
                labels[i-1] = i;
            }
            if (secondChart != null) secondChart.destroy();
            secondChart = createChart('myChart2', labels, data, 'Doanh số sản phẩm', 'Tháng', 'Số sản phẩm');
        }
        request2.send(`year=${selectedYear}&month=${selectedMonth}`);
    }
</script>