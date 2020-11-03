<template>
  <div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header" v-if="id === null">Add a new Animal</div>
                <div class="card-header" v-if="id !== null">Edit an Animal</div>

                <div class="card-body">
                    <form method="POST" action="#">
                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">Name</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" v-model="name" required autocomplete="name" autofocus>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="age" class="col-md-4 col-form-label text-md-right">Age</label>

                            <div class="col-md-6">
                                <input id="age" type="number" class="form-control" v-model="age" required>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="photo" class="col-md-4 col-form-label text-md-right">Photo</label>

                            <div class="col-md-6">
                                <input id="photo" type="file" class="form-control" name="photo" required v-on:change="handleFileUpload()">
                            </div>
                        </div>

                        <div class="form-group row" v-show="photo_url != ''">
                            <label for="photo" class="col-md-4 col-form-label text-md-right">Current Photo</label>
                            <div class="col-md-6">
                                <img width="150px" v-bind:src="photo_url" />
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="type" class="col-md-4 col-form-label text-md-right">Type</label>
                            <div class="col-md-6">
                                <select id="type" class="form-control" v-model="type_id">
                                  <option value="">Select a type</option>
                                  <option v-for="t in types" v-bind:key="t.id" v-bind:value="t.id">{{ t.name }}</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="breed" class="col-md-4 col-form-label text-md-right">Breed</label>
                            <div class="col-md-6">
                                <select class="form-control" id="breed" v-model="breed_id">
                                  <option value="">Select a breed</option>
                                  <option v-for="b in breeds" v-bind:key="b.id" v-bind:value="b.id">{{ b.name }}</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="button" class="btn btn-primary" @click="save">
                                    Save
                                </button>
                                <router-link to="/animals" class="btn">Cancel</router-link>
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
    const AnimalRepository = Repository.get("animals");
    const BreedRepository = Repository.get("breeds");
    const TypeRepository = Repository.get("types");

    export default {
        data() {
            return {
                id: null,
                name: null,
                age: null,
                photo: null,
                photo_url: '',
                breed_id: null,
                type_id: null,
                breeds: [],
                types: []
            }
        },
        methods: {
            save: async function() {
                this.$loading(true);

                let formData = new FormData();
                formData.append('name', this.name);
                formData.append('age', this.age);
                formData.append('breed_id', this.breed_id);
                formData.append('type_id', this.type_id);
                formData.append('photo', this.photo);

                if(this.id) {
                    formData.append('_method', 'PUT');
                }
                
                let result;
                if(this.id) {
                    result = await AnimalRepository.update(formData, this.id).catch(error => {      
                        window.Vue.$toast.error(error.response.data.message);
                        this.$loading(false);
                    });
                } else {
                    result = await AnimalRepository.create(formData).catch(error => {      
                        window.Vue.$toast.error(error.response.data.message);
                        this.$loading(false);
                    });
                }

                if(result !== undefined) {
                    this.$loading(false);
                    this.$router.push({ name: 'animals' });
                    if(this.id) {
                        window.Vue.$toast.success('Animal created successfully.');
                    } else {
                        window.Vue.$toast.success('Animal updated successfully.');
                    }
                } else {
                    this.$loading(false);
                }
            },
            loadBreeds: async function() {
                this.$loading(true);
                return BreedRepository.get();
            },
            loadTypes: function() {
                return TypeRepository.get();
            },
            loadFormData: async function() {
                Promise.all([this.loadBreeds(), this.loadTypes()]).then(result => {
                    this.$loading(false);
                    const breeds = result[0];
                    const types = result[1];

                    if(breeds !== undefined) {
                        this.breeds = breeds.data.data;
                    }

                    if(types !== undefined) {
                        this.types = types.data.data;
                    }
                })
            },
            handleFileUpload() {
                const photoFile = document.querySelector('#photo');
                this.photo = photoFile.files[0];
            },
            getAnimal: async function(id) {
                this.$loading(true);
                const result = await AnimalRepository.getAnimal(id).catch(error => {      
                    window.Vue.$toast.error(error.response.data.message);
                    this.$loading(false);
                });

                if(result !== undefined) {
                    const { data } = result;
                    this.id = data.data.id;
                    this.name = data.data.name;
                    this.age = data.data.age;
                    this.breed_id = data.data.breed.id;
                    this.type_id = data.data.type.id;
                    this.photo_url = data.data.photo;

                    this.$loading(false);
                }
            }
        },
        mounted() {
            this.loadFormData();
            if(this.$route.params.id) {
                this.getAnimal(this.$route.params.id);
            }
        }
    }
</script>