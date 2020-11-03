<template>
    <div class="container">
        <div class="row">
            <div class="col-4">
                <h3>Users</h3>
            </div>
            
        </div>
        <div class="row">
            <table class="table table-striped table-bordered table-hover">
                <thead>
                    <tr>
                        <th scope="col" width="10%">#</th>
                        <th scope="col" width="35%">Name</th>
                        <th scope="col" width="35%">E-mail</th>
                        <th scope="col" width="20%">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="u in users" v-bind:key="u.id">
                        <th scope="row">{{ u.id }}</th>
                        <td>{{ u.name }}</td>
                        <td>{{ u.email }}</td>
                        <td>
                            <router-link v-bind:to="'/users/'+ u.id + '/animals'">See Animals</router-link> 
                            <button class="btn delete" @click="banUser(u)" v-if="u.is_banned == 0">Ban</button>
                            <button class="btn delete" @click="banUser(u)" v-if="u.is_banned == 1">Unban</button>
                        </td>
                    </tr>
                   
                </tbody>
            </table>
        </div>
    </div>
</template>
<script>
    import Repository from "../../repositories/RepositoryFactory";
    const UserRepository = Repository.get("users");

    export default {
        data() {
            return {
                users: []
            }
        },
        methods: {
            getData: async function(message) {
                this.$loading(true);

                const result = await UserRepository.get().catch(error => {      
                    window.Vue.$toast.error(error.response.data.message);
                    this.$loading(false);
                });

                if(result !== undefined) {
                    const { data } = result;
                    this.users = data.data;
                    if(message) {
                        window.Vue.$toast.success(message);
                    }
                    this.$loading(false);
                }
            },
            banUser: async function(user) {
                if(confirm('Do you really want to ban this user? The user will not be able to login.')) {
                    this.$loading(true);
                    const result = await UserRepository.ban(user.id).catch(error => {      
                        window.Vue.$toast.error(error.response.data.message);
                        this.$loading(false);
                    });

                    this.getData('User banned successfully.');
                    
                }
            }
        },
        mounted() {
            this.getData();
        }
    }
</script>