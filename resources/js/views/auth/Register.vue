<template>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Register</div>

                <div class="card-body">
                    <form method="POST" action="#">
                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">Name</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" v-model="name" required autocomplete="name" autofocus>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">Email</label>

                            <div class="col-md-6">
                                <input id="email" type="text" class="form-control" v-model="email" required autocomplete="email" autofocus>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="Password" class="col-md-4 col-form-label text-md-right">Password</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control" v-model="password" required autocomplete="password" autofocus>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="Password_confirm" class="col-md-4 col-form-label text-md-right">Password Confirm</label>

                            <div class="col-md-6">
                                <input id="password_confirm" type="password" class="form-control" v-model="password_confirm" required autocomplete="password_confirm" autofocus>
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="button" class="btn btn-primary" @click="register()">
                                    Registrar
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
                name: '',
                email: '',
                password: '',
                password_confirm: ''
            }
        },
        methods: {
            register: async function() {
                this.$loading(true);

                const result = await UserRepository.create({
                    name: this.name,
                    email: this.email,
                    password: this.password,
                    password_confirmation: this.password_confirm
                }).catch(error => {      
                    if(error.response) {
                        this.$loading(false);
                        if(error.response.status == 401) {
                            window.Vue.$toast.error('Failed to register. Check your form data. All fields are mandatory.');
                        } else {
                            window.Vue.$toast.error(error.response.data.message);
                        }
                        
                    }
                });

                if(result !== undefined) {
                    this.$loading(false);
                    this.$router.push({ name: 'login' });
                    window.Vue.$toast.success('User created successfully. You can login now.');
                }
                
            }
        }
    }
</script>