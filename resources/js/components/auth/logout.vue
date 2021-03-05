<template>
    <div>
        
    </div>
</template>

<script>
export default {
    created() {
        this.$Progress.start()
        localStorage.removeItem('token');
        localStorage.removeItem('user');
        this.$router.push({ name: '/' });
        this.$Progress.finish();
        this.$snotify.success('Successfully Logout', 'Success')
        
    }
}
</script>