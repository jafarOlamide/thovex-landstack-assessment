import './bootstrap';
import { createApp } from 'vue';
import Map from './components/Map.vue'


const app = createApp({});
app.component('map-component', Map);

app.mount('#app');