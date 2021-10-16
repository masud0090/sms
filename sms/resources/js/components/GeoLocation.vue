<template>
    <div class="location mt-5">
        <h2>Add Location</h2>
        <div class="row">

            <div class="col-md-6 geo-location p-5">

                <form @submit.prev.prevent.stop>
                    <div class="form-group" id="country" style="display:block">
                        <label>Country</label>
                        <div class="row">
                            <div class="col-md-10">
                                <select v-if="!toggles.country" class="form-control" v-model="selectedGeo.country_id">
                                    <option value="">Select Country</option>
                                    <option v-for="(country,index) in countries" :key="index" :value="country.id">
                                        {{country.country_name}}
                                    </option>
                                </select>

                                <input v-else class="form-control" type="text"
                                       v-model="geoForm.country_name">
                            </div>
                            <div class="col-md-2">
                                <button @click="getSetToggles('country')">{{toggles.country ? "show" : "add"}}</button>
                            </div>
                        </div>
                    </div>


                    <div v-if="selectedGeo.country_id" class="form-group">
                        <label>Division</label>
                        <div class="row" >
                            <div class="col-md-10">
                        <select v-if="!toggles.division" class="form-control" v-model="selectedGeo.division_id" >
                            <option value="">Select Division</option>
                            <option v-for="(division,index) in divisions" :key="index" :value="division.id">{{division.division_name}}</option>
                        </select>
                                <input v-else class="form-control" type="text"  v-model="geoForm.division_name">
                            </div>
                            <div class="col-md-2">
                                 <button @click="getSetToggles('division')">{{toggles.division ? "show" : "add"}}</button>
                            </div>
                     </div>
                    </div>

                    <div v-if="selectedGeo.division_id" class="form-group">
                        <label>District</label>
                        <div class="row" >
                            <div class="col-md-10">
                                <select v-if="!toggles.district" class="form-control" v-model="selectedGeo.district_id" >
                                    <option value="">Select District</option>

                                    <option v-for="(district,index) in districts" :key="index" :value="district.id">{{district.district_name}}</option>
                                </select>

                                <input v-else class="form-control" type="text" v-model="geoForm.district_name">

                            </div>
                            <div class="col-md-2">
                                <button @click="getSetToggles('district')">{{toggles.district ? "show" : "add"}}</button>
                            </div>
                        </div>
                    </div>


                    <div v-if="selectedGeo.district_id" class="form-group">
                        <label>Area</label>
                        <div class="row" >
                            <div class="col-md-10">
                                <select v-if="!toggles.area" class="form-control" v-model="selectedGeo.area_id" @select="">
                                    <option value="">Select Area</option>
                                    <option v-for="(area,index) in areas" :key="index" :value="area.id">{{area.area_name}}</option>
                                </select>

                                <input v-else class="form-control" type="text" v-model="geoForm.area_name">
                            </div>
                            <div class="col-md-2">
                                <button @click="getSetToggles('area')">{{toggles.area ? "show" : "add"}}</button>
                            </div>
                        </div>
                    </div>


                    <div v-if="selectedGeo.area_id" class="form-group">
                        <label>Sub Area</label>
                        <div class="row" >
                            <div class="col-md-10">
                                <select v-if="!toggles.sub_area" class="form-control" v-model="selectedGeo.sub_area_id" >
                                    <option value="">Select Sub Area</option>
                                    <option v-for="(sub_area,index) in sub_areas" :key="index" :value="sub_area.id">{{sub_area.sub_area_name}}</option>
                                </select>

                                <input v-else class="form-control" type="text" v-model="geoForm.sub_area_name">
                            </div>

                            <div class="col-md-2">
                                <button @click="getSetToggles('sub_area')">{{toggles.sub_area ? "show" : "add"}}</button>
                            </div>
                        </div>
                    </div>



                    <div v-if="selectedGeo.sub_area_id" class="form-group">
                        <label>Road</label>
                        <div class="row" >
                            <div class="col-md-10">
                                <select v-if="selectedGeo.road_id" class="form-group" v-model="selectedGeo.road_id" @select="">
                                    <option value="">Select Road</option>
                                    <option v-for="(road,index) in roads" :key="index" :value="road.id">{{road.road_name}}</option>
                                </select>

                                <input v-else class="form-control" type="text" v-model="geoForm.road_name">
                            </div>

                            <div class="col-md-2">
                                <button @click="getSetToggles('road')">{{toggles.road ? "show" : "add"}}</button>
                            </div>
                        </div>
                    </div>
                    <div class="button">
                        <button type="button" @click="storeLocations" class="btn btn-success">save</button>
                    </div>
                </form>
            </div>


            <div class="col-md-6 geo-location p-5">
                <div class="panel-heading">
                    <h4>Geo Locations</h4>
                </div>
                <div class="col-md-12" id="showLocations">
                    <ul class="countries tree">
                        <li>
                            <a>Bangladesh</a>
                            <ul class="divisions">
                                <li>
                                    <a>Dhaka</a>
                                    <ul class="districts">
                                        <li>
                                            <a>Dhaka</a>
                                            <ul class="areas">

                                                <li>
                                                    <a>Daulatpur</a>
                                                    <ul class="sub_areas">
                                                        <li>
                                                            <a>Boalia</a>
                                                            <ul class="roads">
                                                                <li><a>27</a></li>
                                                            </ul>
                                                        </li>
                                                    </ul>
                                                </li>
                                            </ul>
                                        </li>
                                    </ul>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

    </div>
</template>


<script>


</script>

<script>
export default {
    name: "GeoLocation",
    data() {
        return {
            geoForm: {
                country_name: '',
                division_name: '',
                district_name: '',
                area_name: '',
                sub_area_name: '',
                road_name: '',
            },
            selectedGeo: {
                country_id: null,
                division_id: null,
                district_id: null,
                area_id: null,
                sub_area_id: null,
                road_id: null
            },
            countries: [],
            divisions: [],
            districts: [],
            areas: [],
            sub_areas: [],
            roads: [],
            toggles: {
                country: false,
                division: false,
                district: false,
                area: false,
                sub_area: false,
                road: false,
            }
        }
    },
    created() {
        this.getGeoLocations();


    },
    methods: {
        storeLocations(){
            let data = {
                'formData' : this.geoForm,
                'selectedData' : this.selectedGeo
            };
            if(!this.toggles.country){
                axios.post('/api/store-locations', data && data.selectedData ,',',null).then((response) => {
                    console.log(response)
                    this.getGeoLocations();
                    this.toggles.country = true
                });
            }
             else if (!this.toggles.division){
                axios.post('/api/store-locations', data  ).then((response) => {
                    console.log(response)
this.selectedGeo.country_id=null;
                    this.getGeoLocations();

                    this.toggles.division = true
                });

            }

            else if (!this.toggles.district){
                axios.post('/api/store-locations', data).then((response) => {
                    console.log(response)
                    this.getGeoLocations();
                    this.toggles.district = true
                });

            }

            else if (!this.toggles.area){
                axios.post('/api/store-locations', data).then((response) => {
                    console.log(response)
                    this.getGeoLocations();
                    this.toggles.area = true
                });

            }

            else if (!this.toggles.sub_area){
                axios.post('/api/store-locations', data).then((response) => {
                    console.log(response)
                    this.getGeoLocations();
                    this.toggles.sub_area = true
                });

            }

            else if (!this.toggles.road){
                axios.post('/api/store-locations', data).then((response) => {
                    console.log(response)
                    this.getGeoLocations();
                    this.toggles.road = true
                });

            }

        },



        getSetToggles(name) {
            console.log(name)
            if (name === 'country') {
                this.toggles.country = !this.toggles.country;null
                this.selectedGeo.country_id = null;
            } else if (name === 'division') {
                this.toggles.division = !this.toggles.division;null
                this.selectedGeo.division_id = null;
            } else if (name === 'district') {
                this.toggles.district = !this.toggles.district;
                this.selectedGeo.district_id = null;
            } else if (name === 'area') {
                this.toggles.area = !this.toggles.area;
                this.selectedGeo.area_id = null;
            } else if (name === 'sub_area') {
                this.toggles.sub_area = !this.toggles.sub_area;
                this.selectedGeo.sub_area_id = null;
            } else if (name === 'road') {
                this.toggles.road = !this.toggles.road;
                this.selectedGeo.road_id=null;
            }
        },




        getGeoLocations() {
            axios.get('/api/get-locations').then((response) => {
                // console.log(response.data);
                this.countries = response.data.countries;
                this.divisions = response.data.divisions;
                this.districts = response.data.districts;
                this.areas = response.data.areas;
                this.sub_areas = response.data.sub_areas;
                this.roads = response.data.roads;
            });
        }


    }


}


</script>

<style scoped>
.tree li:before {
    content: "";
    display: block;
    width: 10px;
    height: 0;
    border-top: 1px solid #acacac;
    margin-top: -1px;
    position: absolute;
    top: 1em;
    left: 0;
}
.form-group button {
    height: 29px;
    background: #2196F3;
    color: white;
    font-size: 17px;
    border: 1px solid grey;
    border-left: none;
    cursor: pointer;
}

.form-control {
    height: 29px;
    font-size: 11px !important;
}


.tree li {
    margin: 0;
    padding: 0 1.5em;
    line-height: 2em;
    font-weight: bold;
    position: relative;
}

.geo-location ul {
    margin-left: 20px;
}

.tree, .tree ul {
    margin: 0 0 0 1em;
    padding: 0;
    list-style: none;
    color: #369;
    position: relative;
    border-left: 1px dashed #acacac;
}

ul {
    display: block;
    list-style-type: disc;
    margin-block-start: 1em;
    margin-block-end: 1em;
    margin-inline-start: 0px;
    margin-inline-end: 0px;
    padding-inline-start: 40px;
}

label {
    display: inline-block;
    max-width: 100%;
    margin-bottom: 5px;
    font-weight: bold;
}
</style>
