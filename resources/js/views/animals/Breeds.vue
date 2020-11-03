<template>
    <div class="container">
        <div class="row page-title">
            <div class="col-4">
                <h3>Breeds</h3>
            </div>
            <div class="col-8 text-right">
                <router-link class="btn btn-primary" to="/breeds/create">Add new breed</router-link>
            </div>
        </div>
        <div class="row">
            <table class="table table-striped table-bordered table-hover">
                <thead>
                    <tr>
                        <th scope="col" width="10%">#</th>
                        <th scope="col" width="70%">Breed Name</th>
                        <th scope="col" width="20%">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="b in breeds" v-bind:key="b.id">
                        <th scope="row">{{ b.id }}</th>
                        <td>{{ b.name }}</td>
                        <td>
                            <router-link v-bind:to="'/breeds/'+ b.id">Edit</router-link> 
                            <button class="btn delete" @click="deleteBreed(b)">Delete</button>
                        </td>
                    </tr>
                   
                </tbody>
            </table>
        </div>
    </div>
</template>
<script>
    import Repository from "../../repositories/RepositoryFactory";
    const BreedRepository = Repository.get("breeds");

    export default {
        data() {
            return {
                breeds: []
            }
        },
        methods: {
            getData: async function(message) {
                this.$loading(true);

                const result = await BreedRepository.get().catch(error => {      
                    window.Vue.$toast.error(error.response.data.message);
                    this.$loading(false);
                });

                if(result !== undefined) {
                    const { data } = result;
                    this.breeds = data.data;
                    if(message) {
                        window.Vue.$toast.success(message);
                    }
                    this.$loading(false);
                }
            },
            deleteBreed: async function(breed) {
                if(confirm('Do you really want to delete this breed? This operation cannot be undone.')) {
                    this.$loading(true);
                    const result = await BreedRepository.delete(breed.id).catch(error => {      
                        window.Vue.$toast.error(error.response.data.message);
                        this.$loading(false);
                    });

                    this.getData('Breed deleted successfully.');
                    
                }
            }
        },
        mounted() {
            this.getData();
        }
    }
</script>