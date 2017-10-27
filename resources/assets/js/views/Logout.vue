<template>
	
</template>
<script>
    
import router from '../routes';
import store from '../../store/store'

export default {
    name: 'logout',
    mounted () {
        localStorage.removeItem('api_token')
        localStorage.removeItem('user_id')
        store.commit('LOGOUT_USER')
        router.push('login')
    }
}
</script>