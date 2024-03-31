export interface IUserLogin {
    username: string;
    password: string;
}

export interface IUserRegister {
    name: String;
    username: String;
    email: String;
    password: String;
}

export interface IUser {
    id: number;
    name: String;
    username: String;
    avatar: string;
    email: string;
}

export interface IUserLoginResponse {
    data: {
        message: string;
        status: boolean;
        user: {
            id: number;
            name: String;
            username: String;
            avatar: string;
            email: string;
        };
    };
}
