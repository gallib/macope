<template>
    <div>
        <canvas id="expenses-sum-by-month"></canvas>
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
            getDates: function () {
                var dates = [];
                this.expenses.forEach(function (data) {
                    dates.push(data.year + '-' + data.month);
                });
                return dates;
            },
            getAmounts: function () {
                var amounts = [];
                this.expenses.forEach(function (data) {
                    amounts.push(data.debit);
                });
                return amounts;
            }
        },
        methods: {
            /**
             * Get latest expenses
             */
            getExpenses() {
                axios
                    .post('/macope/expenses-sum-by-month', {
                        date_from: moment().subtract(12, 'M').format('Y-M-01'),
                        date_to: moment().format('Y-M-D')
                    })
                    .then(response => {
                        this.expenses = response.data;
                        this.buildChart();
                    })
                    .catch(error => {
                        document.getElementById("expenses-sum-by-month").parentNode.innerHTML  = 'Oups, an error occured.';
                    });
            },
            /*
             * Build the chart
             */
            buildChart() {
                var myBarChart = new Chart(document.getElementById("expenses-sum-by-month"), {
                    type: 'bar',
                    data: {
                        labels: this.getDates,
                        datasets: [{
                            label: 'Expenses',
                            data: this.getAmounts
                            backgroundColor: 'rgba(0, 54, 48, 1)',
                            borderWidth: 1
                        }]
                    }
                });
            }
        }
    }
</script>
