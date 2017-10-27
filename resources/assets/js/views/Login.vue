<template>

	<div class="login container-fluid h-100">

        <div class= "row justify-content-center align-items-center h-100">
            <form @submit.prevent="AttemptLogin" class= "form-login col-sm-4" method="POST">

                <div class="alert alert-warning" id = "error" v-if="err">
                    Invalid Credentials.
                </div>

                <div class="form-group">
                    <input type="email" class="form-control" v-model="email" aria-describedby="emailHelp" placeholder="Enter email" required>
                </div>
                <div class="form-group">
                    <input type="password" class="form-control" v-model="password" placeholder="Password" required>
                </div>

                <button name= "btn-login" class="btn btn-primary btn-block">Sign In</button>
                
            </form>
        </div>
           
	</div>
</template>

<script>

import router from '../routes';
import store from '../../store/store'

export default {

	data() {

		return {
			email : '',
        	password: '',
            err: false,
		}
        
    },

    beforeCreate() {

        if (store.state.isLogged){
            router.push('/')
        }

    },

    router,


    methods: {

        AttemptLogin: function() {
            // Make a request for a user with a given ID
            
            axios.post('/login', {
                email: this.email,
                password: this.password
            })
            .then(response => {
                localStorage.setItem('api_token', response.data.data.api_token)
                localStorage.setItem('user_id', response.data.data.id);
           
                axios.get('/dashboard', {
				      headers: { "api_token": response.data.data.api_token }
				    })
				      .then(response => {
				        router.push('/dashboard')
                        store.commit('LOGIN_USER')
                
				      })
				      .catch(error => {
                        console.log('error', error);
				        
				      });
				  
            }).catch(error => {
                        console.log('error', error);
                        this.err = true
                      });
                
                
        }

	}
       
}

</script>

<style> 
    .login {
        margin-top: 3rem;
        height: 100%;
    }
</style>