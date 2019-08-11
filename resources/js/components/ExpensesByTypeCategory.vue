<template>
    <div>
        <canvas id="expenses-type-category"></canvas>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                labels: [],
                amounts: []
            };
        },
        mounted() {
            this.getExpenses();
        },
        methods: {
            /*
             * Generate random colors
             */
            getColors: function() {
                var colors = [];
                this.amounts.forEach(data => {
                    var r = Math.floor(Math.random() * 255);
                    var g = Math.floor(Math.random() * 255);
                    var b = Math.floor(Math.random() * 255);

                    colors.push('rgb(' + r + ',' + g + ',' + b + ')');
                });
                return colors;
            },
            /*
             * Get latest expenses
             */
            getExpenses() {
                axios
                    .post('/expenses-by-type-category', {
                        date_from: moment().subtract(11, 'M').format('Y-M-01'),
                        date_to: moment().format('Y-M-D')
                    })
                    .then(response => {
                        response.data.forEach(data => {
                            this.labels.push(data.name);
                            this.amounts.push(Math.round(data.debit / 12 * 20) / 20);
                        });
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
                        labels: this.labels,
                        datasets: [{
                            label: 'Expenses',
                            data: this.amounts,
                            backgroundColor: this.getColors()
                        }]
                    },
                });
            }
        }
    }
</script>
