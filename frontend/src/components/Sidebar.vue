<script setup lang="ts">
import { onMounted, ref } from 'vue';
import { useRoute, useRouter } from 'vue-router';
import { axiosClient } from '../helpers/axios.helper';
import { type IConversation } from '../types/conversation.type';


const conversationUsers = ref<IConversation[]>([]);
const router = useRouter();
const route = useRoute();

onMounted(async() => {
    await axiosClient.get('/api/user/conversations')
        .then(response => {
            conversationUsers.value = response.data.data;
            localStorage.setItem('conversations',JSON.stringify(conversationUsers.value));
        })
        .catch(error => console.error(error));
});

const getConversation = (id:number) => {
    let user = conversationUsers.value.find(user => user.id == id);
    localStorage.setItem('current-conversation',JSON.stringify(user));
    router.push('/conversation/' + id);
} 

const toggleDropdown = () => {
    let menuDropdown = document.getElementById('menuDropdown');
    menuDropdown?.classList.toggle('hidden');
}



</script>

<template>
    <!-- Sidebar Header -->
    <div class="w-1/4 bg-white border-r border-gray-300">
        <header class="p-4 border-b border-gray-300 flex justify-between items-center bg-indigo-600 text-white">
            <h1 class="text-2xl font-semibold">Chat Web</h1>
            <div class="relative">
                <button
                @click="toggleDropdown"
                id="menuButton" class="focus:outline-none">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-100" viewBox="0 0 20 20"
                        fill="currentColor">
                        <path d="M10 12a2 2 0 100-4 2 2 0 000 4z" />
                        <path d="M2 10a2 2 0 012-2h12a2 2 0 012 2 2 2 0 01-2 2H4a2 2 0 01-2-2z" />
                    </svg>
                </button>
                <!-- Menu Dropdown -->
                <div id="menuDropdown"
                    class="absolute right-0 mt-2 w-48 bg-white border border-gray-300 rounded-md shadow-lg hidden ">
                    <ul class="py-2 px-3">
                        <li><a href="#" class="block px-4 py-2 text-gray-800 hover:text-gray-400">Option 1</a></li>
                        <li><a href="#" class="block px-4 py-2 text-gray-800 hover:text-gray-400">Option 2</a></li>
                        <!-- Add more menu options here -->
                    </ul>
                </div>
            </div>
        </header>

        <!-- Contact List -->
        <div class="overflow-y-auto h-screen p-3 mb-9 pb-20">

            <template v-for="conversation in conversationUsers">
                <div @click="getConversation(conversation.id)"
                 class="flex items-center mb-4 cursor-pointer hover:bg-gray-100 p-2 rounded-md"
                 :class="{'bg-blue-100': conversation.id.toString() == route.params.id}"
                 >
                    <div class="w-12 h-12 bg-gray-300 rounded-full mr-3">
                        <img :src="`https://placehold.co/200x/ffa8e4/ffffff.svg?text=${conversation?.other_user.name?.substring(0, 3)}`"
                            alt="User Avatar" class="w-12 h-12 rounded-full">
                    </div>
                    <div class="flex-1">
                        <h2 class="text-lg font-semibold text-black">{{ conversation.other_user.name }}</h2>
                        <p class="text-gray-600 text-sm pl-2">{{ conversation?.last_message?.message.substring(0,15) }}</p>
                    </div>
                </div>

            </template>

        </div>
    </div>
</template>


<style scoped></style>