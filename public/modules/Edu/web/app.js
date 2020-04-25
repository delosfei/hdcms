import Vue from 'vue'
import router from './router/index'
import store from './store/index'
import './plugins/bootstrap'
import './plugins/axios'
import './plugins/ant.js'
import './plugins/scrollTo.js'
import './services/filter'
import './assets/css/common.scss'
import 'animate.css'
const app = new Vue({
  router,
  store,
  el: '#app'
})
console.log(`
  _  _  ___  _   _ ___  _   _ _  _ ___ ___ _  _   ___ ___  __  __
 | || |/ _ \\| | | |   \\| | | | \\| | _ | __| \\| | / __/ _ \\|  \\/  |
 | __ | (_) | |_| | |) | |_| | .\` |   | _|| .\` || (_| (_) | |\\/| |
 |_||_|\\___/ \\___/|___/ \\___/|_|\\_|_|_|___|_|\\_(_\\___\\___/|_|  |_|
                                                                  `)
