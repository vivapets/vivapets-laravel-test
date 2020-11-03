<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Login</div>

                    <div class="card-body">
                        <form method="POST" action="#">
                            <div class="form-group row">
                                <label for="email" class="col-md-4 col-form-label text-md-right">E-Mail Address</label>

                                <div class="col-md-6">
                                    <!-- is-invalid -->
                                    <input id="email" type="email" class="form-control" v-model="email" required autocomplete="email" autofocus>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="password" class="col-md-4 col-form-label text-md-right">Password</label>

                                <div class="col-md-6">
                                    <input id="password" type="password" class="form-control" v-model="password" required autocomplete="current-password">
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-md-6 offset-md-4">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" v-model="remember" id="remember">
                                        <label class="form-check-label" for="remember">
                                            Remember Me
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group row mb-0">
                                <div class="col-md-8 offset-md-4">
                                    <button type="button" class="btn btn-primary" @click="login()">
                                        Login
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
    import Repository from "../../repositories/RepositoryFactory";
    const UserRepository = Repository.get("users");

    export default {
        data() {
            return {
                email: '',
                password: '',
                remember: 0
            }
        },
        methods: {
            login: async function() {
                this.$loading(true);

                const result = await UserRepository.login({
                    email: this.email,
                    password: this.password,
                    remember: this.remember
                }).catch(error => {      
                    if(error.response) {
                        this.$loading(false);
                        if(error.response.status == 401) {
                            window.Vue.$toast.error('Failed to login. Check email or password.');
                        } else {
                            window.Vue.$toast.error(error.response.data.message);
                        }

                        window.localStorage.removeItem('access_token');
                    }
                });

                if(result !== undefined) {
                    const { data } = result;
                    window.localStorage.setItem('access_token', data.access_token);
                    this.$loading(false);

                    this.$router.push({ name: 'home' });
                    this.$root.stateChanged++;
                }
                
            }
        }
        
    }
</script>