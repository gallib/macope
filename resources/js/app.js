
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

Vue.component(
    'entries-sum-by-month',
    require('./components/EntriesSumByMonth.vue').default
);

Vue.component(
    'expenses-by-type-category',
    require('./components/ExpensesByTypeCategory.vue').default
);

Vue.component(
    'monthly-expenses-by-type-category',
    require('./components/MonthlyExpensesByTypeCategory.vue').default
);

Vue.component(
    'monthly-expenses-by-category',
    require('./components/MonthlyExpensesByCategory.vue').default
);

Vue.component(
    'flash',
    require('./components/Flash.vue').default
);

const app = new Vue({
    el: '#app'
});
