import { axiosClient } from "@/helpers/axios.helper";
import type { IUserLogin, IUserLoginResponse, IUserRegister } from "@/types/auth.type";
import axios, { AxiosError } from "axios";
import { useAuthStore } from "../stores/auth.store";
import { useRouter } from "vue-router";

class AuthService {
    // private authStore = useAuthStore();
	// private authStore;
	// public constructor( store:any)
	// {
	// 	this.authStore = store;
	// }


    async login(credentials: IUserLogin) {
		const authStore = useAuthStore();
        await this.setCookies();
        let returnData = null;
        await axiosClient
            .post("/api/login", credentials)
            .then((response :IUserLoginResponse) => {
                localStorage.setItem("USER",JSON.stringify(response.data.user));
                authStore.user = response.data.user;
                authStore.isAuth = true;
                returnData = response;
            })
            .catch((error) => {
                authStore.isAuth = false;
                authStore.user = null;
                console.log(error)
                returnData = error;
            });

        return returnData;
    }

    public async register(credentials: IUserRegister) {
        await axiosClient
            .post("/api/register", credentials)
            .then((response) => {
                console.log(response.data);
            })
            .catch((error) => console.log(error));
    }

	public async logout()
	{
        const authStore = useAuthStore();
		await axiosClient.post('/api/logout')
			.then(response =>{
				localStorage.removeItem('USER');
				authStore.user = null;
				authStore.isAuth = false;
			})
			.catch(error =>{
				console.log("🚀 ~ file: auth.service.ts:52 ~ AuthService ~ error:", error)
			})
	}

    private async setCookies() {
        await axiosClient.get("/sanctum/csrf-cookie");
    }

	public async getAuthUser()
	{
        const authStore = useAuthStore();
		await axiosClient.get("/api/user")
            .then((response) => {
				authStore.user = response.data;
		        authStore.isAuth = true;
            })
            .catch((error) => {
                console.log("🚀 ~ getUser ~ error:", error);
                authStore.user = null;
                authStore.isAuth = false;
            });
	}
}

export default new AuthService();
