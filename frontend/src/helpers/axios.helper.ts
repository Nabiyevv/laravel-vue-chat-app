import axios from "axios";

export const axiosClient = axios.create({
    baseURL:'http://localhost:8000/',//import.meta.env.VITE_API_BASE_URL this not work why????
    withCredentials:true,
    withXSRFToken:true,
    headers:{
        "Content-Type": "application/json",
        "Accept": "application/json",
        // "Authorization": "Bearer " + localStorage.getItem("TOKEN")
    }
})