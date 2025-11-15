import axios from 'axios';
window.axios = axios;

window.axios.defaults.withCredentials = true;
window.axios.defaults.baseURL = '/'; // base for both web & api
// call this once on app load:
axios.get('/sanctum/csrf-cookie');
window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';
