<template>
    <div>
        <canvas id="sum-by-month"></canvas>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                dates: [],
                expenses: [],
                incomes: []
            };
        },
        mounted() {
            this.getEntries();
        },
        methods: {
            /**
             * Get entries
             */
            getEntries() {
                axios
                    .post('/macope/journal/sum-by-month', {
                        date_from: moment().subtract(11, 'M').format('Y-M-01'),
                        date_to: moment().format('Y-M-D')
                    })
                    .then(response => {
                        response.data.forEach(data => {
                            this.dates.push(moment(data.year + '-' + data.month, 'Y-M').format('MM/Y'));
                            this.expenses.push(data.debit);
                            this.incomes.push(data.credit);
                        });
                        this.buildChart();
                    })
                    .catch(error => {
                        document.getElementById("sum-by-month").parentNode.innerHTML  = 'Oups, an error occured.'
                    });
            },
            /*
             * Build the chart
             */
            buildChart() {
                var chart = new Chart(document.getElementById("sum-by-month"), {
                    type: 'bar',
                    data: {
                        labels: this.dates,
                        datasets: [{
                            label: 'Expenses',
                            data: this.expenses,
                            backgroundColor: 'rgba(27, 12, 232, 0.8)'
                        }, {
                            label: 'Incomes',
                            data: this.incomes,
                            backgroundColor: 'rgba(13, 255, 163, 0.8)'
                        }]
                    },
                });
            }
        }
    }
</script>
