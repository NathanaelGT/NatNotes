import Vue from 'vue'
import App from './App.vue'

Vue.config.productionTip = true

Vue.prototype.$$webAPI = "http://localhost/api";

new Vue({
  render: h => h(App),
}).$mount('#app')