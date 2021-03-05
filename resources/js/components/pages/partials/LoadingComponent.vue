<template>
    <div class="tab-content text-center d-none">
        <div class="tab-loading">
            <div>
                <h4 class="display-4">
                    Please Wait 
                    <i class="fa fa-sync fa-spin"></i>
                </h4>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    
}
</script>

<style scoped>
    .tab-content {
        position: fixed;
        width: 100%;
        height: 100%;
        background: rgb(red, green, blue);
    }
    .tab-loading {
        position: fixed;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
    }
</style>