import { axiosClient } from "@/helpers/axios.helper";
import AuthService from "@/services/auth.service";
import type { IUserLogin, IUserRegister } from "@/types/auth.type";
import axios from "axios";
import { defineStore } from "pinia";
import { computed, ref } from "vue";
import { useRouter } from "vue-router";

export const useAuthStore = defineStore("auth", () => {
    const user = ref();
    const isAuth = ref(false);
    const authService = AuthService;

    const getAuthUser = async () => {
		await authService.getAuthUser();
    };

    const checkIsAuth = async () => {
        try{
            const responseData = await axiosClient.get("/api/user");
            const data = await responseData.data;
            return true;
        }
        catch(e)
        {
            return false;
        }
        
    };

    const login = async (credentials: IUserLogin) => {
       return await authService.login(credentials);
    };

    const register = async (credentials: IUserRegister) => {
        await authService.register(credentials);
    };

	const logout = async () =>{
		await authService.logout();
	}

    return { user, getAuthUser, login, register, logout, isAuth, checkIsAuth };
},
{
    persist:true,
    
});
