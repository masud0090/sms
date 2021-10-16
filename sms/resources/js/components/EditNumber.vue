<template>
    <div>
        <h3 class="text-center">Edit Number</h3>
        <div class="row">
            <div class="col-md-6">
                <form @submit.prevent="updateNumber">
                    <div class="form-group">
                        <label>Name</label>
                        <input type="text" class="form-control" v-model="phonebook.name">
                    </div>
                    <div class="form-group">
                        <label>Number</label>
                        <input type="text" class="form-control" v-model="phonebook.number">
                    </div>
                    <button type="submit" class="btn btn-success">Update Number</button>
                </form>
            </div>
        </div>
    </div>
</template>