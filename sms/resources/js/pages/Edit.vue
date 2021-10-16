<template>
    <div>
        <h3 class="mt-5">Edit Name & Number</h3>
        <div class="row">
            <div class="col-md-6">
                <form @submit.prevent="updateNumbers">
                    <div class="form-group">
                        <label>Name</label>
                        <input type="text" class="form-control" v-model="phonebook.name">
                    </div>
                    <div class="form-group">
                        <label>Number</label>
                        <input type="text" class="form-control" v-model="phonebook.number">
                    </div>
                    <button type="submit" class="btn btn-primary">Update</button>
                </form>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: "Edit",
    data() {
        return {
            phonebook: {
                'name' : '',
                'number' : ''

            }
        }
    },
    created() {
        this.getNumber();
    },


    methods:{
        getNumber() {
             axios
            .get("/api/phonenumbers/"+this.$route.params.id+"/edit")
            .then((response) => {
                 this.phonebook = response.data.phonebook;
            });
    },

        updateNumbers(){
            axios.put("/api/phonenumbers/"+this.$route.params.id, this.phonebook).then((response) => {
                alert(response.data.message);
            }).catch((error) => {
                console.log(error);
            })

        }
    }

}
</script>

<style scoped>

</style>



