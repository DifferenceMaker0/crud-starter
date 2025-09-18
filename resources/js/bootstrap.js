import axios from 'axios';
window.axios = axios;

axios.defaults.withCredentials = true;
axios.defaults.withXSRFToken = true;

axios.get('/sanctum/csrf-cookie').then(response => {
    // Login...
});

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';
