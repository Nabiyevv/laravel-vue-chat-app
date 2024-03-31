<script setup lang="ts">
import { onMounted, watch, ref, computed } from 'vue';
import { useRoute, useRouter } from 'vue-router';
import ChatFooter from '../components/ChatFooter.vue';
import ChatHeader from '../components/ChatHeader.vue';
import ChatList from '../components/ChatList.vue';
import { axiosClient } from '../helpers/axios.helper';
import { useAuthStore } from '../stores/auth.store';
const router = useRouter();
const route = useRoute();

const conMessages = ref<ConversationMessages>();
interface ConversationMessages {
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
    console.log("object");
    sendRequest();
})

watch(() => route.params.id, (id) => {
    // console.log(id);
    sendRequest();
})


window.Echo.channel('chat')
  .listen('.chat.message',async (e: any) => {
    console.log('Received message:', e.message);
    conMessages.value?.messages.push(e.message);
    console.log(conMessages,"SASDASDS");
    await scrollToBottom();
    // scrollToBottom(scrollableDiv);
  })
  .error((error: any) => {
    console.error('Error connecting to channel:', error);
  });


const otherUser = ref();
const authStore = useAuthStore();

async function scrollToBottom() {
    let scrollableDiv:any = document.getElementById('messages');
    scrollableDiv.scrollTop = await scrollableDiv.scrollHeight + 10;
}

const sendRequest = async () => { 
    await axiosClient.get(`/api/user/conversations/${route.params.id}/messages`)
        .then(response => {
            conMessages.value = response.data.data;

            // console.log("🚀 ~ file: ChatView.vue:45 ~ sendRequest ~ conMessages.value:", conMessages.value)

            // console.log(conMessages.value);
        })
        .catch(error => console.error(error));
    
    if(conMessages.value?.receiver_id === authStore.user.id)
        otherUser.value = conMessages.value?.sender_id
    else
        otherUser.value = conMessages.value?.receiver_id;
    await scrollToBottom();
}


</script>


<template>
    <main class="flex-1">
        <!-- component -->
        <div class="flex-1 flex flex-col p:2 sm:px-6 sm:py-3 justify-between  h-screen">
            <!-- Header -->
            <ChatHeader />

            <!-- Conversation Messages -->
            <ChatList :conMessages />

            <!-- footer -->
           <ChatFooter @messageSended="sendRequest" :otherUser/>
        </div>
    </main>

</template>


<style scoped></style>