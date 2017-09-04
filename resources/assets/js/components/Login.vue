<template>
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Login</div>
                    <div class="panel-body">
                        <login-form></login-form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import LoginForm from './LoginForm.vue'

    export default {
        name: 'login',
        components: {
            LoginForm
        }
    }
</script>
