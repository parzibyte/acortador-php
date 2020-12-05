<?php
/*

  ____          _____               _ _           _       
 |  _ \        |  __ \             (_) |         | |      
 | |_) |_   _  | |__) |_ _ _ __ _____| |__  _   _| |_ ___ 
 |  _ <| | | | |  ___/ _` | '__|_  / | '_ \| | | | __/ _ \
 | |_) | |_| | | |  | (_| | |   / /| | |_) | |_| | ||  __/
 |____/ \__, | |_|   \__,_|_|  /___|_|_.__/ \__, |\__\___|
         __/ |                               __/ |        
        |___/                               |___/         
    
____________________________________
/ Si necesitas ayuda, contáctame en \
\ https://parzibyte.me               /
 ------------------------------------
        \   ^__^
         \  (oo)\_______
            (__)\       )\/\
                ||----w |
                ||     ||
Creado por Parzibyte (https://parzibyte.me).
------------------------------------------------------------------------------------------------
Si el código es útil para ti, puedes agradecerme siguiéndome: https://parzibyte.me/blog/sigueme/
Y compartiendo mi blog con tus amigos
También tengo canal de YouTube: https://www.youtube.com/channel/UCroP4BTWjfM0CkGB6AFUoBg?sub_confirmation=1
------------------------------------------------------------------------------------------------
*/ ?>
<?php
include_once "session_check.php";
include_once "header.php";
include_once "nav.php";
?>
<div class="row" id="app">
    <div class="col-12">
        <h1>Statistics</h1>
    </div>
    <div class="col-12">
        <div class="form-inline">
            <label for="start">Start:</label>&nbsp;<input @change="onRangeChange()" v-model="start" type="date" id="start" class="form-control mr-2">
            <label for="end">End:</label>&nbsp;<input @change="onRangeChange()" v-model="end" type="date" id="end" class="form-control mr-2">
        </div>
    </div>
    <div class="col-12">
        <canvas id="chart" width="400" height="100"></canvas>
    </div>
    <div class="col-12 col-md-6">
        <h2 class="text-center">Most clicked links in range</h2>
        <ul class="list-group">
            <li v-for="link in mostClickedLinksInRange" class="list-group-item d-flex justify-content-between align-items-center">
                {{link.title}}
                <h3><span class="badge badge-primary badge-pill">{{link.clicks}}</span></h3>
            </li>
        </ul>
    </div>
    <div class="col-12 col-md-6">
        <h2 class="text-center">Most clicked links of all time</h2>
        <ul class="list-group">
            <li v-for="link in mostClickedLinksOfAllTime" class="list-group-item d-flex justify-content-between align-items-center">
                {{link.title}}
                <h3><span class="badge badge-primary badge-pill">{{link.clicks}}</span></h3>
            </li>
        </ul>
    </div>
</div>
<script src="js/vue.min.js"></script>
<script src="js/Chart.bundle.min.js"></script>
<script>
    new Vue({
        el: "#app",
        data: () => ({
            start: "",
            end: "",
            chart: null,
            mostClickedLinksInRange: [],
            mostClickedLinksOfAllTime: [],
        }),
        mounted() {
            this.start = this.getStartMonthDate();
            this.end = this.getEndMonthDate();
            this.onRangeChange();
        },
        methods: {
            async onRangeChange() {
                await this.getStatisticsBySelectedRange();
                await this.getMostClickedLinksInRange();
                await this.getMostClickedLinksOfAllTime();
            },
            async getMostClickedLinksInRange() {
                const r = await fetch(`./get_most_clicked_links_by_date.php?start=${this.start}&end=${this.end}`);
                this.mostClickedLinksInRange = await r.json();
            },
            async getMostClickedLinksOfAllTime() {
                const r = await fetch(`./get_most_clicked_links_of_all_time.php`);
                this.mostClickedLinksOfAllTime = await r.json();
            },
            async getStatisticsBySelectedRange() {
                const r = await fetch(`./get_statistics_by_date.php?start=${this.start}&end=${this.end}`);
                const statisticsData = await r.json();
                const labels = statisticsData.map(dateAndClicks => dateAndClicks.date);
                const data = statisticsData.map(dateAndClicks => dateAndClicks.clicks);
                this.refreshChart(labels, data);
            },
            refreshChart(labels, data) {
                if (this.chart) {
                    this.chart.destroy();
                }
                this.chart = new Chart(document.querySelector("#chart"), {
                    type: 'line',
                    data: {
                        labels: labels,
                        datasets: [{
                            label: 'Clicks',
                            data: data,
                            backgroundColor: [
                                'rgba(54, 162, 235, 0.2)',
                                'rgba(255, 206, 86, 0.2)',
                                'rgba(75, 192, 192, 0.2)',
                                'rgba(153, 102, 255, 0.2)',
                                'rgba(255, 159, 64, 0.2)'
                            ],
                            borderColor: [
                                'rgba(54, 162, 235, 1)',
                                'rgba(255, 206, 86, 1)',
                                'rgba(75, 192, 192, 1)',
                                'rgba(153, 102, 255, 1)',
                                'rgba(255, 159, 64, 1)'
                            ],
                            borderWidth: 1,
                        }]
                    },
                    options: {
                        scales: {
                            yAxes: [{
                                ticks: {
                                    beginAtZero: true
                                }
                            }],
                        },
                    }
                });
            },
            getStartMonthDate() {
                const d = new Date();
                return this.formatDate(new Date(d.getFullYear(), d.getMonth(), 1));
            },
            getEndMonthDate() {
                const d = new Date();
                return this.formatDate(new Date(d.getFullYear(), d.getMonth() + 1, 0));
            },
            formatDate(date) {
                const month = date.getMonth() + 1;
                const day = date.getDate();
                return `${date.getFullYear()}-${(month < 10 ? '0' : '').concat(month)}-${(day < 10 ? '0' : '').concat(day)}`;
            }

        }
    });
</script>
<?php
include_once "footer.php"; ?>