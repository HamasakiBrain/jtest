<template>
    <div class="m-3">
        <div class="alert alert-danger" v-if="status === 'error'" role="alert">
            {{ message }}
        </div>
        <div class="alert alert-success" v-if="status === 'success'" role="alert">
            {{ message }}
        </div>
    </div>
</template>

<script>
export default {
    name: "AlertComponent",
    props: [
        'message', 'status'
    ]
}
</script>

<style scoped>

</style>
