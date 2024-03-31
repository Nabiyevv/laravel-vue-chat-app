<script setup lang="ts">
import { onMounted, ref, type PropType } from 'vue';
import { type IUser } from '../types/auth.type';
import { useAuthStore } from '../stores/auth.store';

const authStore = useAuthStore();    
const conversationUser = localStorage.getItem('conversation-user');

type ConversationMessages = {
    id: number;
    sender_id: number;
    receiver_id: number;
    messages: {
        id: number;
        message: string;
        sender_id: number;
        receiver_id: number;
        conversation_id: number;
        type: string;
        is_read: boolean;
        is_delete: boolean;
        created_at: string;
        updated_at: string;
    }[];
}

onMounted(() => { 
    if(conversationUser)
        console.log("🚀 ~ file: ChatList.vue:31 ~ onMounted ~ conversationUser:", JSON.parse(conversationUser));
})

defineProps({
    conMessages: Object as PropType<ConversationMessages>
})

</script>



<template>
    <div id="messages"
        class="flex flex-col space-y-4 p-3 overflow-y-auto scrollbar-thumb-blue scrollbar-thumb-rounded scrollbar-track-blue-lighter scrollbar-w-2 scrolling-touch">
        <template v-for="conversation in conMessages?.messages">
            <!-- RIGHT SIDE -->
            <div v-if="conversation.sender_id == authStore.user.id" class="chat-message">
                <div class="flex items-end justify-end">
                    <div class="flex flex-col space-y-2 text-xs max-w-xs mx-2 order-1 items-end">
                        <div>
                            <span class="px-4 py-2 rounded-lg inline-block rounded-br-none bg-blue-600 text-white">{{
            conversation.message }}</span>
                        </div>
                    </div>
                    <img :src="`https://placehold.co/200x/00ffe4/ffffff.svg?text=MAQA`" alt="My profile"
                        class="w-6 h-6 rounded-full order-2" />
                </div>
            </div>
            <!-- LEFT SIDE -->
            <div v-if="conversation.sender_id != authStore.user.id" class="chat-message">
                <div class="flex items-end">
                    <div class="flex flex-col space-y-2 text-xs max-w-xs mx-2 order-2 items-start">
                        <div>
                            <span class="px-4 py-2 rounded-lg inline-block rounded-bl-none bg-gray-300 text-gray-600">
                                {{ conversation.message }}
                            </span>
                        </div>
                    </div>
                    <img :src="`https://placehold.co/200x/ffa8e4/ffffff.svg?text=MAR`" alt="My profile"
                        class="w-6 h-6 rounded-full order-1" />
                </div>
            </div>
        </template>
        <!-- Left Chat -->

    </div>

</template>


<style scoped></style>