<template>
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                       User Register Form
                    </div>
                    <form action="" @submit.prevent="register">
                        <div class="card-body">

                            <div class="mb-3">
                            <label for="name" class="form-label">Name</label>
                            <input type="name" class="form-control" v-model="registerForm.name" id="name" placeholder="Enter Name">
                            </div>

                            <div class="mb-3">
                            <label for="email" class="form-label">Email address</label>
                            <input type="email" class="form-control" v-model="registerForm.email" id="email" placeholder="Enter Email">
                            </div>

                            <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" class="form-control" v-model="registerForm.password" id="password" placeholder="Enter Password">
                            </div>
                        </div>

                        <div class="card-footer text-end">
                            <button type="submit" class="btn btn-primary">Register</button>
                        </div>
                    </form>
              </div>
            </div>
        </div>
    </div>
</template>


<script>
export default {

    data() {
        return {
            registerForm:{
                'name'    : '',
                'email'    : '',
                'password' : ''
            }
        }
    },
    methods:{
        register(){
            this.$store.dispatch('register', this.registerForm).then((response)=>{
                toastr.success(response.message);
                 this.$router.push({
                    name : 'login'
                 })
            }).catch((error)=>{
                for (let [k, v] of Object.entries(error.response.data.errors)) {
                    toastr.error(v);  
                }
            });
        }
    }
}
</script>