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
        <h1>Link statistics: {{link.title}}</h1>
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
            link: {},
        }),
        async mounted() {
            await this.getLinkInfo();
            this.start = this.getStartMonthDate();
            this.end = this.getEndMonthDate();
            this.onRangeChange();
        },
        methods: {
            async onRangeChange() {
                await this.getStatisticsBySelectedRange();
            },
            async getLinkInfo() {
                const urlSearchParams = new URLSearchParams(window.location.search);
                const linkId = urlSearchParams.get("id");
                const r = await fetch(`./get_link_info.php?link_id=${linkId}`);
                this.link = await r.json();
            },
            async getStatisticsBySelectedRange() {
                const r = await fetch(`./get_statistics_by_date_and_link.php?start=${this.start}&end=${this.end}&link_id=${this.link.id}`);
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