<template>
    <div>
        <canvas id="expenses-type-category"></canvas>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                expenses: []
            };
        },
        mounted() {
            this.getExpenses();
            this.buildChart();
        },
        computed: {
            getLabels: function () {
                var labels = [];
                this.expenses.forEach(function (data) {
                    labels.push(data.name);
                });
                return labels;
            },
            getAmounts: function () {
                var amounts = [];
                this.expenses.forEach(function (data) {
                    amounts.push(Math.round(data.debit / 12 * 20) / 20);
                });
                return amounts;
            },
            getColors: function() {
                var colors = [];
                this.expenses.forEach(function (data) {
                    var r = Math.floor(Math.random() * 255);
                    var g = Math.floor(Math.random() * 255);
                    var b = Math.floor(Math.random() * 255);

                    colors.push('rgb(' + r + ',' + g + ',' + b + ')');
                });
                return colors;
            }
        },
        methods: {
            /**
             * Get latest expenses
             */
            getExpenses() {
                axios
                    .post('/macope/expenses-by-type-category')
                    .then(response => {
                        this.expenses = response.data;
                        this.buildChart();
                    });
            },
            /*
             * Build the chart
             */
            buildChart() {
                var myBarChart = new Chart(document.getElementById("expenses-type-category"), {
                    type: 'pie',
                    data: {
                        labels: this.getLabels,
                        datasets: [{
                            label: 'Expenses',
                            data: this.getAmounts,
                            backgroundColor: this.getColors
                        }]
                    },
                });
            }
        }
    }
</script>
