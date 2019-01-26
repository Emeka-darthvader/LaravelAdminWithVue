<template>
    <div class="container">
        <div class="row mt-5" v-if="$barrier.isAdminOrBusiness()">
          <div class="col-md-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">List of Users</h3>

                <div class="card-tools">
                    <button class="btn btn-success" @click="newModal">
                        <i class="fas fa-user-plus"></i>
                    </button>                  
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body table-responsive p-0">
                <table class="table table-hover">
                  <tbody><tr>
                    <th>ID</th>
                    <th>User</th>
                    <th>Email</th>
                    <th>Role (Add active later)</th>
                    <th>Date Registered</th>
                    <th> </th>
                  </tr>
                  <tr v-for="user in users.data" :key="user.id">
                    <td>{{user.id}}</td>
                    <td>{{user.name |upText}}</td>
                    <td>{{user.email}}</td>
                    <td>{{user.role|upText}}</td>
                    <td>{{user.created_at|myDate}}</td>
                    <td>
                        <a href="#" >
                            <i class="fas fa-folder-open green"></i>
                        </a>
                        /
                        <a href="#" @click="editModal(user)">
                            <i class="fa fa-edit"></i>
                        </a>
                        /
                        <a href="#" @click="deleteUser(user.id)">
                            <i class="fa fa-trash red"></i>
                        </a>
                    </td>
                  </tr>

                  
                </tbody></table>
              </div>
              <!-- /.card-body -->
              <div class="card-footer">
                  <pagination :data="users" @pagination-change-page="getResults">
                      	<span slot="prev-nav">&lt; Previous</span>
	                    <span slot="next-nav">Next &gt;</span>
                  </pagination>
              </div>
            </div>
            <!-- /.card -->
          </div>
        </div>

        <div v-if="!$barrier.isAdminOrBusiness()">
            <not-found></not-found>
        </div>

        <div class="modal fade" id="addNewUser" tabindex="-1" role="dialog" aria-labelledby="addNewUserLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addNewUserLabel" v-show="!editMode" >Add New User</h5>
                        <h5 class="modal-title" id="addNewUserLabel" v-show="editMode">Update User Info</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form @submit.prevent="editMode ? updateUser() :createUser()">
                    <div class="modal-body">
                        <div class="form-group">
                            
                            <input v-model="form.name" type="text" name="name"
                                placeholder="Name"
                                class="form-control" :class="{ 'is-invalid': form.errors.has('name') }">
                            <has-error :form="form" field="name"></has-error>
                        </div>
                        <div class="form-group">
                            
                            <input v-model="form.email" type="email" name="email"
                                placeholder="Email Address"
                                class="form-control" :class="{ 'is-invalid': form.errors.has('email') }">
                            <has-error :form="form" field="email"></has-error>
                        </div>
                        <div class="form-group">
                            
                            <input v-model="form.password" type="password" name="password"
                                placeholder="Password"
                                class="form-control" :class="{ 'is-invalid': form.errors.has('password') }">
                            <has-error :form="form" field="password"></has-error>
                        </div>
                        <div class="form-group">
                            
                            <select v-model="form.role"  name="role"
                                class="form-control" :class="{ 'is-invalid': form.errors.has('role') }">
                                
                                <option value=""> Select User Role</option>
                                <option value="admin">Admin</option>
                                <option value="business">Business Person</option>
                                <option value="regular">Regular User</option>
                                <option value="acquaintance">Acquaintance</option>
                            </select>    
                            <has-error :form="form" field="role"></has-error>
                        </div>
                        <div class="form-group">
                            
                            <textarea v-model="form.bio" name="bio"
                                placeholder="Enter a short description (Optional)"
                                class="form-control" :class="{ 'is-invalid': form.errors.has('bio') }"></textarea>    
                            <has-error :form="form" field="bio"></has-error>
                        </div>
                        <!-- <div class="form-group">
                            
                            <input v-model="form.name" type="text" name="name"
                                placeholder="Profile Photo"
                                class="form-control" :class="{ 'is-invalid': form.errors.has('name') }">
                            <has-error :form="form" field="name"></has-error>
                        </div> -->
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                        <button v-show="editMode" type="submit" class="btn btn-success">Update</button>
                        <button v-show="!editMode" type="submit" class="btn btn-primary">Create</button>
                    </div>
                    </form>
                    </div>
                </div>
        </div>
    </div>

</template>

<script>
    export default {
        data(){
            return{
                editMode:false,
                users:{},
                form: new Form({
                    id:'',
                    name:'',
                    email:'',
                    password:'',
                    role:'',
                    bio:'',
                    photo:''
                })
            }
        },
        methods:{
              getResults(page = 1){
                  axios.get('api/user?page=' + page)
				    .then(response => {
					this.users = response.data;
				});
              },
              updateUser(){
                this.$Progress.start();  
                this.form.put('api/user/'+this.form.id)

                .then(()=>{
                    //successful update
                    Fire.$emit('AfterCreated');
                    $("#addNewUser").modal('hide');
                        
                                    
                    swal(
                         'Updated!',
                         'User '+this.form.name+' information updated successfully.',
                        'success'
                       )
                    this.$Progress.finish();   

                })
                .catch(()=>{
                    //unsuccessful update
                    this.$Progress.fail();

                });
                
              },
              editModal(user){
                this.editMode = true;  
                this.form.clear();  
                this.form.reset();
                
                $('#addNewUser').modal('show');
                this.form.fill(user);
            },
            newModal(){
                this.editMode = false; 
                this.form.clear();
                this.form.reset();
                
                $('#addNewUser').modal('show');
            },
            deleteUser(id){
                swal({
                        title: 'Are you sure?',
                        text: "You won't be able to revert this!",
                        type: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Yes, delete it!'
                        }).then((result) => {

                        //send request to the server to process it on the server
                        if(result.value){
                                this.form.delete('api/user/' + id)
                                .then(()=>{
                                    Fire.$emit('AfterCreated');
                        
                                    
                                    swal(
                                    'Deleted!',
                                    'Your file has been deleted.',
                                    'success'
                                    )

                                        
                                })
                                .catch(()=>{
                                    swal('Failed','Something went wrong 😢','warning')
                                });
                        }
                })
            },
            loadUsers(){
                if(this.$barrier.isAdminOrBusiness()){

                    axios.get("api/user").then(({data}) => (this.users = data));
                }
            },
            createUser(){
                this.$Progress.start();
                this.form.post('api/user')
                .then(()=>{
                    Fire.$emit('AfterCreated');
                
                     $("#addNewUser").modal('hide');
                    toast({
                    type: 'success',
                    title: 'User Account Created Successfully!!! 🎉🎉🎉'
                    })

                
                    this.$Progress.finish();
                })
                .catch(()=>{
                    this.$Progress.fail();
                });
                
                               
            }
        },
        mounted() {
            Fire.$on('Searching',()=>{
                let query =this.$parent.search;
                axios.get('api/findUser?q='+query)
                .then((data)=>{
                    this.users = data.data;
                })
                .catch(()=>{

                });
            });
            this.loadUsers();
            //setInterval(()=>this.loadUsers(),3000);
            Fire.$on('AfterCreated',()=>{
                this.loadUsers();
            });
        }
    }
</script>
