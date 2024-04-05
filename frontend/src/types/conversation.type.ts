export interface IConversation {
    id: number;
    sender_id: number;
    receiver_id: number;
    is_deleted: boolean | null;
    created_at: string;
    updated_at: string;
    other_user: {
        id: number;
        name: string;
        email: string;
        username: string;
        avatar: string | null;
    };
    last_message: {
        id: number;
        message: string;
    };
}