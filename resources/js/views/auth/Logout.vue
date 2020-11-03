<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Come back soon! We are redirecting you...</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
    export default {
        mounted() {
            setTimeout(() => {
                this.$root.menu = [
                    {
                        name: 'Login',
                        url: '/login'
                    },
                    {
                        name: 'Register',
                        url: '/register'
                    }
                ];
                
                window.localStorage.removeItem('access_token');
                this.$router.push({ name: 'login' });
            }, 3000)
        }
    }
</script>