<template>
    <div>
        <canvas v-if="hasExpenses" id="monthly-expenses-type-category"></canvas>
        <div v-else>There is no expenses for this type category</div>
    </div>
</template>

<script>
    export default {
        props: ['typeCategory'],
        data() {
            return {
                hasExpenses: true,
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
                    .post('/monthly-expenses-type-category', {
                        type_category: this.typeCategory,
                        date_from: moment().subtract(11, 'M').format('Y-M-01'),
                        date_to: moment().format('Y-M-D')
                    })
                    .then(response => {
                        if (response.data.length) {
                            response.data.forEach(data => {
                                this.labels.push(moment(`${data.year} - ${data.month}`, 'Y-M').format('MM/Y'));
                                this.amounts.push(data.debit);
                            });
                            this.buildChart();
                        } else {
                            this.hasExpenses = false;
                        }
                    });
            },
            /*
             * Build the chart
             */
            buildChart() {
                var myBarChart = new Chart(document.getElementById("monthly-expenses-type-category"), {
                    type: 'line',
                    data: {
                        labels: this.labels,
                        datasets: [{
                            label: 'Expenses',
                            data: this.amounts,
                            fill: false,
                            backgroundColor: 'rgba(0, 191, 165, 1)'
                        }]
                    },
                    options: {
                        scales: {
                            yAxes: [{
                                ticks: {
                                    beginAtZero: true
                                }
                            }]
                        }
                    },
                });
            }
        }
    }
</script>
