<template>
    <div>


            <div class="container">

            <div class="text-center ">
                <h3>PHONEBOOK</h3>
                <!-- <button class="btn btn-primary ml-10">ADD NUMBER</button> -->
            </div>


            <div>
                <table id="datatable" class="table table-bordered">
            <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Number</th>
                <th>Created At</th>
                <th>Updated At</th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody>
            <tr v-for="phonebook in phonebooks" :key="phonebook.id">
                <td>{{ phonebook.id }}</td>
                <td>{{ phonebook.name }}</td>
                <td>{{ phonebook.number }}</td>
                <td>{{ phonebook.created_at }}</td>
                <td>{{ phonebook.updated_at }}</td>

                <td>
                    <div class="btn-group" role="group">
                        <router-link :to="{name:'edit', params:{id:phonebook.id }}" class="btn btn-secondary">Edit</router-link>
                        <button class="btn btn-danger" @click="deletenumber(phonebook.id)">Delete</button>
                    </div>

                </td>

            </tr>
            </tbody>


        </table>


            </div>


            </div>
        </div>
<!--    "phonebook.id+'/edit'"-->
</template>

<script>

    export default {
        data() {
            return {
                'phonebooks' : {}
            }
        },
        created(){
            this.getPhonebooks();


        },

        methods : {


            getPhonebooks(){
                axios.get('api/phonenumbers').then((res) => {
                    if(res.data.phonebooks){
                    this.phonebooks = res.data.phonebooks;
                    console.log(this);
                    }
                })

            },

            deletenumber(id){
                if(confirm("Are you sure to delete this category ?")){
                axios.delete(`api/phonenumbers/${id}`).then(response=>{
                    this.getPhonebooks()
                }).catch(error=>{
                    console.log(error)
                })


                }


        }


    }



    }



</script>
