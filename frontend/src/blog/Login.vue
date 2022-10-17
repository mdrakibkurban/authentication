<template>
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                       User Login Form
                    </div>
                    <form action="" @submit.prevent="login">
                        <div class="card-body">
                            <div class="mb-3">
                            <label for="email" class="form-label">Email address</label>
                            <input type="email" class="form-control" v-model="loginForm.email" id="email" placeholder="Enter Email">
                            </div>

                            <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" class="form-control" v-model="loginForm.password" id="password" placeholder="Enter Password">
                            </div>
                        </div>

                        <div class="card-footer text-end">
                            <button type="submit" class="btn btn-primary">Login</button>
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
            loginForm:{
                'email'    : '',
                'password' : ''
            }
        }
    },
    methods:{
        login(){
            this.$store.dispatch('login', this.loginForm).then((response)=>{
                toastr.success(response.message);
                 this.$router.push({
                    name : 'home'
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