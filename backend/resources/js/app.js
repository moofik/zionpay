import './bootstrap';
import Router from '@/router'
import store from '@/store'
import {createApp} from 'vue/dist/vue.esm-bundler';

const app = createApp({

})
app.use(Router)
app.use(store)
app.mount('#app')