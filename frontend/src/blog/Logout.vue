<template>
</template>

<script>
export default {
    created(){
        this.$store.dispatch('logout').then((response)=>{
            toastr.success(response.message);
            this.$router.push({
                name : 'login'
            })
        });
       
    }
}
</script>