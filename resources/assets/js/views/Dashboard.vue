<template>
	
	<div id="app">
		<nav class="navbar navbar-dark bg-primary">
		  <button @click = "logout" class="btn btn-dark">Logout</button>
		</nav>
		
		
	    <div class="row justify-content-center">
	        <div class="col-sm-8">

	            <h1> My Notes </h1>
	            <ul class= "list-group">
	                <li v-for='note in notes' class="list-group-item"> 
	                	<div class="row">
	                		<div class="col-sm-4">
	                			<h3>{{note.title}}</h3>
	                		</div>
    						
    						<div class="col-sm-4">
    							<span class="badge badge-primary badge-pill">Created by {{name}}, {{note.created_at}}</span>
    						</div>
    						
    						<div class="col-sm-2">
	    						<button @click="prepareForEdit(note)" class="btn btn-dark" data-toggle="modal" data-target="#modalEdit">Edit</button>
	    						<button @click="deleteNote(note)" class="btn btn-dark">Delete</button>
    						</div>

    					
							  <!-- Modal -->
								<div class="modal fade" id="modalEdit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
								  <div class="modal-dialog" role="document">
								    <div class="modal-content">
								      <div class="modal-header">
								        <input name ="title" v-model="title" class="form-control" id="title" placeholder="Note Title" required></textarea>
								      </div>
								      <div class="modal-body">
								       <textarea class="form-control" name="body" v-model="body" id="body" rows="3" placeholder="Note Body" required></textarea>
								      </div>
								      <div class="modal-footer">
								        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
								        <button @click="editNote(note)" type="button" data-dismiss="modal" class="btn btn-primary">Save changes</button>
								      </div>
								    </div>
								  </div>
								</div>
    						
	                	</div>
	                    
	                    
	                    <p>{{note.body}}</p>
	                </li>
	            </ul>


	            <h3> Add a new note</h3>

		        <form @submit.prevent="addNote" method="POST">
		            
		            <div class="form-group">
		                <input name ="title" v-model="title" class="form-control" id="title" placeholder="Note Title" required></textarea>
		            </div>
		            <div class="form-group">
		                <textarea class="form-control" name="body" v-model="body" id="body" rows="3" placeholder="Note Body" required></textarea>
		            </div>
		            <div class="form-group">
		                <button class = "btn btn-primary" type="submit"> Add Note </button>
		            </div>
		        </form>

	        </div>
	    </div>
</div>
	</div>
</template>

<script>

import router from '../routes';
import store from '../../store/store'

export default {

	data() {

		return {

			notes: [],
			title : '',
        	body: '',
        	name: '',
        	note_identifier: ''
		}
        
    }, 


    methods: {

        addNote: function() {

            axios.post('/store', {

	            	"title": this.title,
	            	"body": this.body
	            }, 
	            {
					headers: { "api_token": localStorage.getItem('api_token'),
								'Content-Type': 'application/json',
							}
					      
				})

				.then(response => this.notes.push(response.data))
				.catch(error => { console.log(error);}

			);

            
            this.title = '';
            this.body = '' ;
                
        },

        deleteNote: function(note) {

       
        	axios.delete('/'.concat(note.id), 
	            {
					headers: { "api_token": localStorage.getItem('api_token'),
		
					}
					      
				})

				.then(response => {

					for(var i = this.notes.length - 1; i >= 0; i--) {
						if(this.notes[i].id === note.id){
							console.log(i);
							this.notes.splice(i, 1);
						}
					}
				})
				.catch(error => { console.log(error);}

			);

        },

    

        prepareForEdit: function(note) {

        	console.log(note.id);

        	this.title = note.title;
        	this.body = note.body;

        	this.note_identifier = note.id;
        },

        editNote: function(note){

        	
          	
        	axios.put('/'.concat(this.note_identifier), {

	            	"title": this.title,
	            	"body": this.body
	            }, 
	            {
					headers: { "api_token": localStorage.getItem('api_token'),
								'Content-Type': 'application/json',
							}
					      
				})

				.then(response => {

					for(var i = this.notes.length - 1; i >= 0; i--) {
						if(this.notes[i].id === this.note_identifier){
							
							this.notes.splice(i, 1);
						}
					}

					this.notes.push(response.data)

				})
				.catch(error => { console.log(error);}

			);

            
            this.title = '';
            this.body = '' ;
        	
        },


        logout: function() {

        	router.push('logout');

        }

	},

	beforeCreate() {

        if (!store.state.isLogged){
            router.push('/login')
        }

    },

   	created(){
	        
	        var user_id = localStorage.getItem('user_id');

	        axios.get('/notes/'.concat(user_id), {
				      headers: { "api_token": localStorage.getItem('api_token') }
				    })

	        			// .then(response => console.log(response.data.name))
				      .then(response => {
				      	this.notes = response.data.notes, 
				      	this.name = response.data.name
				      } )
				      .catch(error => {
				        console.log(error);
			});
    }


	
       
}
</script>