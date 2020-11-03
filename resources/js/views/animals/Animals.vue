<template>
    <div class="container">
        <div class="row page-title">
            <div class="col-4">
                <h3>Animals</h3>
            </div>
            <div class="col-8 text-right" v-show="$route.params.user !== undefined">
                <router-link to="/users">Go Back</router-link>
            </div>
        </div>
        
        <div class="row">
            <div class="col-md-3" v-for="a in animals" v-bind:key="a.id"> 
                <div class="card text-center">
                    <img class="card-img-top" v-bind:src="a.photo" v-bind:alt="a.name">
                    <div class="card-body">
                        <h5 class="card-title">{{ a.name }}</h5>
                    </div>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">Age: {{ a.age }} year(s)</li>
                        <li class="list-group-item">Breed: {{ a.breed.name }}</li>
                    </ul>
                    <div class="card-body footer">
                        <router-link class="card-link" v-bind:to="'/animals/' + a.id" v-show="$route.params.user === undefined">Edit</router-link>
                        <button class="btn card-link card-link-delete" @click="deleteAnimal(a)">Delete</button>
                    </div>
                    
                </div>
            </div>

            <h3 v-show="animals.length == 0 && $route.params.user !== undefined">No animals found. <router-link to="/users">Go Back</router-link></h3>

            <div class="col-md-3" v-show="$route.params.user === undefined">
                <div class="card text-center">
                    <div class="card-header">Animals</div>
                    <div class="card-body">
                        <button class="btn btn-primary" @click="addAnimal()">Add an Animal</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
    import Repository from "../../repositories/RepositoryFactory";
    const AnimalRepository = Repository.get("animals");
    const UserRepository = Repository.get("users");

    export default {
        data() {
            return {
                animals: []
            }
        },
        methods: {
            getData: async function(message) {
                this.$loading(true);
                let result;
                
                if(this.$route.params.user) {
                    result = await UserRepository.animals(this.$route.params.user).catch(error => {      
                    }).finally(() => {
                        this.$loading(false);
                    });
                } else {
                    result = await AnimalRepository.get().catch(error => {
                    }).finally(() => {
                        this.$loading(false);
                    });
                }
                    
                if(result !== undefined) {
                    const { data } = result;
                    this.animals = data.data;

                    if(message) {
                        window.Vue.$toast.success(message);
                    }

                    this.$loading(false);
                }
            },
            addAnimal() {
                this.$router.push({ name: 'create_animal' })
            },
            deleteAnimal: async function(animal) {
                if(confirm('Do you really want to delete this animal? This operation cannot be undone.')) {
                    this.$loading(true);
                    const result = await AnimalRepository.delete(animal.id).catch(error => {      
                        window.Vue.$toast.error(error.response.data.message);
                        this.$loading(false);
                    });

                    this.getData('Animal deleted successfully.');
                }
            }
        },
        mounted() {
            this.getData();
        }
    }
</script>