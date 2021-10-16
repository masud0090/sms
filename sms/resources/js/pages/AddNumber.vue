<template>

    <div>
        <h3 class=" mt-5">Add Phone Number</h3><br>
        <div class="row">
            <div class="col-md-6">
                <form @submit.prevent="addNumbers">
                    <div class="form-group">
                        <label>Name</label>
                        <input type="text" class="form-control" v-model="phonebook.name">
                    </div>
                    <div class="form-group">
                        <label>Number</label>
                        <input type="text" class="form-control" v-model="phonebook.number">
                    </div>
                    <button type="submit" class="btn btn-primary">Add Number</button>
                </form>
            </div>
        </div>

    </div>

</template>

<script>

export default {
    name: "AddNumber",
    data(){
        return{
            phonebook : {
                'name' : '',
                'number' : ''
            }
        }
    },
    methods:{
        addNumbers(){
            axios.post('api/phonenumbers', this.phonebook).then((response) => {
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
