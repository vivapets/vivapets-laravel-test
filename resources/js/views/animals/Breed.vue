<template>
  <div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Add a new Breed</div>

                <div class="card-body">
                    <form method="POST" action="#">
                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">Name</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" v-model="name" required autocomplete="name" autofocus>
                            </div>
                        </div>
                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="button" class="btn btn-primary" @click="save">
                                    Save
                                </button>
                                <router-link to="/breeds" class="btn">Cancel</router-link>
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
    const BreedRepository = Repository.get("breeds");
    

    export default {
        data() {
            return {
                id: null,
                name: null
            }
        },
        methods: {
            save: async function() {
                this.$loading(true);

                let result;

                if(this.id) {
                    result = await BreedRepository.update({
                        breed_name: this.name
                    }, this.id).catch(error => {      
                        window.Vue.$toast.error(error.response.data.message);
                        this.$loading(false);
                    });
                } else {
                    result = await BreedRepository.create({
                        breed_name: this.name
                    }).catch(error => {      
                        window.Vue.$toast.error(error.response.data.message);
                        this.$loading(false);
                    });
                }

                if(result !== undefined) {
                    this.$loading(false);
                    if(this.id) {
                        window.Vue.$toast.success('Breed updated successfully.');
                    } else {
                        window.Vue.$toast.success('Breed created successfully.');
                    }

                    this.$router.push({ name: 'breeds' });
                } else {
                    this.$loading(false);
                }
            },
            
            getBreed: async function(id) {
                this.$loading(true);
                const result = await BreedRepository.getBreed(id).catch(error => {      
                    window.Vue.$toast.error(error.response.data.message);
                    this.$loading(false);
                });

                if(result !== undefined) {
                    const { data } = result;
                    this.name = data.data.name,
                    this.id = data.data.id
                    this.$loading(false);
                }
            }
            
        },
        mounted() {
            if(this.$route.params.id) {
                this.getBreed(this.$route.params.id);
            }
        }
    }
</script>