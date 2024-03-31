<script setup lang="ts">
import { RouterLink, RouterView, useRoute, useRouter } from 'vue-router'
import SideBar from './components/Sidebar.vue'
import { watch, ref, computed, onMounted, onUnmounted } from 'vue';
import { axiosClient } from './helpers/axios.helper';

const router = useRouter();
const route = useRoute();
const isAuth = ref<boolean>(true);

watch(router.currentRoute, (to, from) => {
  if(route.path === '/login' || route.path === '/register') 
    isAuth.value = true;
  else 
    isAuth.value = false;
});

const handelClick = () => { 
  axiosClient.get('/api/event')
  .then(response =>console.log(response))
  .catch(e => console.log(e));

  console.log(window.Echo.connector.pusher.connection.state)
};

onMounted(() => {
  console.log(window.Echo);
});

</script>

<template>

  <RouterView v-if="isAuth" />

  <button @click="handelClick">Click Me</button>

  <div v-if="!isAuth" class="flex h-screen overflow-hidden">
    <!-- SideBar -->
    <SideBar />

    <!-- Chat Area -->
    <RouterView />
  </div>

</template>

<style scoped>

</style>
