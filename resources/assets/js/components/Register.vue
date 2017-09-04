<template>
<div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Register</div>

                    <div class="panel-body">
                        <register-form></register-form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import RegisterForm from './RegisterForm.vue'

    export default {
        name: 'login',
        components: {
            RegisterForm
        }
    }
</script>
