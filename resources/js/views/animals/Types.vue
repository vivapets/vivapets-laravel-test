<template>
    <div class="container">
        <div class="row page-title">
            <div class="col-4">
                <h3>Animals Types</h3>
            </div>
            <div class="col-8 text-right">
                <router-link class="btn btn-primary" to="/types/create">Add new Type</router-link>
            </div>
        </div>
        <div class="row">
            <table class="table table-striped table-bordered table-hover">
                <thead>
                    <tr>
                        <th scope="col" width="10%">#</th>
                        <th scope="col" width="70%">Type Name</th>
                        <th scope="col" width="20%">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="t in types" v-bind:key="t.id">
                        <th scope="row">{{ t.id }}</th>
                        <td>{{ t.name }}</td>
                        <td>
                            <router-link v-bind:to="'/types/'+ t.id">Edit</router-link> 
                            <button class="btn" @click="deleteType(t)">Delete</button>
                        </td>
                    </tr>
                   
                </tbody>
            </table>
        </div>
    </div>
</template>
<script>
    import Repository from "../../repositories/RepositoryFactory";
    const TypeRepository = Repository.get("types");

    export default {
        data() {
            return {
                types: []
            }
        },
        methods: {
            getData: async function(message) {
                this.$loading(true);

                const result = await TypeRepository.get().catch(error => {      
                    window.Vue.$toast.error(error.response.data.message);
                    this.$loading(false);
                });

                if(result !== undefined) {
                    const { data } = result;
                    this.types = data.data;
                    if(message) {
                        window.Vue.$toast.success(message);
                    }
                    this.$loading(false);
                }
            },
            deleteType: async function(breed) {
                if(confirm('Do you really want to delete this type? This operation cannot be undone.')) {
                    this.$loading(true);
                    const result = await TypeRepository.delete(breed.id).catch(error => {      
                        window.Vue.$toast.error(error.response.data.message);
                        this.$loading(false);
                    });

                    this.getData('Type deleted successfully.');
                    
                }
            }
        },
        mounted() {
            this.getData();
        }
    }
</script>