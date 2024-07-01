import ListCreateEmployee from "./pages/employees/index.vue";

import { createApp } from 'vue';

const app = createApp({});

app.component('list-create-employee', ListCreateEmployee)

app.mount('#app');
