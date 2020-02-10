import axios from "axios";
let token = window.localStorage.getItem("token") || "";
const http = axios.create({
    baseURL: "/api",
    timeout: 5000,
    headers: { Authorization: "Bearer " + token }
});
export default http;