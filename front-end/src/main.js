import { createApp } from 'vue';
import App from './App.vue';
import router from './router';
const app = createApp(App);
import 'bootstrap/dist/css/bootstrap.min.css'

app.use(router);

app.mount('#app');
