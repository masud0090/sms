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
                                <select v-if="!toggles.country" class="form-control"  v-model="selectedGeo.country_id">
                                    <option value="">Select Country</option>
                                    <option v-for="(country,index) in countries" :key="index" :value="country.id">
                                        {{country.country_name}}
                                    </option>
                                </select>

                                <input v-else class="form-control" type="text"
                                       v-model="geoForm.country_name">
                            </div>
                            <div class="col-md-2">
                                <button @click="getSetToggles('country')">{{toggles.country ? "Show" : "Add"}}</button>
                            </div>
                        </div>
                    </div>


                    <div v-if="selectedGeo.country_id" class="form-group">
                        <label>State</label>
                        <div class="row" >
                            <div class="col-md-10">
                        <select v-if="!toggles.division" class="form-control" v-model="selectedGeo.division_id" >
                            <option value="">Select State</option>
                            <option v-for="(division,index) in divisions" :key="index" :value="division.id">{{division.division_name}}</option>
                        </select>
                                <input v-else class="form-control" type="text"  v-model="geoForm.division_name">
                            </div>
                            <div class="col-md-2">
                                 <button @click="getSetToggles('division')">{{toggles.division ? "Show" : "Add"}}</button>
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
                                <button @click="getSetToggles('district')">{{toggles.district ? "Show" : "Add"}}</button>
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
                                <button @click="getSetToggles('area')">{{toggles.area ? "Show" : "Add"}}</button>
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
                                <button @click="getSetToggles('sub_area')">{{toggles.sub_area ? "Show" : "Add"}}</button>
                            </div>
                        </div>
                    </div>



                    <div v-if="selectedGeo.sub_area_id" class="form-group">
                        <label>Road</label>
                        <div class="row" >
                            <div class="col-md-10">
                                <select v-if="!toggles.road" class="form-control" v-model="selectedGeo.road_id" @select="">
                                    <option value="">Select Road</option>
                                    <option v-for="(road,index) in roads" :key="index" :value="road.id">{{road.road_name}}</option>
                                </select>

                                <input v-else class="form-control" type="text" v-model="geoForm.road_name">
                            </div>

                            <div class="col-md-2">
                                <button @click="getSetToggles('road')">{{toggles.road ? "Show" : "Add"}}</button>
                            </div>
                        </div>
                    </div>
                    <div class="button">
                        <button type="button" @click="storeLocations" class="btn btn-success">Save</button>
                    </div>
                </form>
<!--                <button class="btn btn-danger btn-sm m-1" @click="deleteCountry(countries.id)">Delete</button>-->
            </div>


            <div class="col-md-6 geo-location p-5">
                <div class="panel-heading">
<!--                    <h4>Geo Locations</h4>-->
                </div>
                <div v-if="ready" class="col-md-12" id="showLocations" style="overflow-y:scroll;height:450px;">


                    <vue-tree :option="option" ></vue-tree>

                </div>
            </div>
        </div>

    </div>
</template>



<script>
require('../utils/vue-tree');

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
            ready:false,
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
            },
            option: {
                root: {
                    name: 'Geo Location',
                    isParent: true,
                    isOpen: true,
                    openedIcon: 'fa fa-folder-open-o',
                    closedIcon: 'fa fa-folder-o',
                    children: []
                }
            }
        }
    },
    created() {
        this.getGeoLocations();
        this.getTree();
        this.deleteCountries()


    },
    computed :{
        treeData (){
            return [];
        }
    },


    methods: {

        storeLocations(){
            let data = {
                'formData' : this.geoForm,
                'selectedData' : this.selectedGeo
            };



            axios.post('/api/store-locations', data).then((response) => {
                console.log(response)
                this.getGeoLocations();
                this.getTree();

                this.toggles.country = false;
                this.toggles.division = false;
                this.toggles.district = false;
                this.toggles.area = false;
                this.toggles.sub_area = false;
                this.toggles.road = false;

                if(this.selectedGeo.country_id){
                    this.getDivisions(this.selectedGeo.country_id)
                }
                if(this.selectedGeo.division_id){
                    this.getDistricts(this.selectedGeo.division_id)
                }
                if(this.selectedGeo.district_id){
                    this.getAreas(this.selectedGeo.district_id)
                }
                if(this.selectedGeo.area_id){
                    this.getSubAreas(this.selectedGeo.area_id)
                }
                if(this.selectedGeo.sub_area_id){
                    this.getRoads(this.selectedGeo.sub_area_id)
                }

            });


        },

        getSetToggles(name) {
            console.log(name)
            if (name === 'country') {
                this.toggles.country = !this.toggles.country;
                this.selectedGeo.country_id = null;
            } else if (name === 'division') {
                this.toggles.division = !this.toggles.division;
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

        getTree(){
            this.option.root.children = [];
            axios.get('/api/get-tree').then((response) => {
               // console.log(response.data);
                this.countries = response.data.countries;
                for(let i =0; i<this.countries.length; i++){
                    this.option.root.children.push(
                        {
                            name: this.countries[i].country_name,
                            isParent: this.countries[i].divisions.length > 0 ? true : false,
                            isOpen : this.countries[i].divisions.length > 0 ? true : false,
                            openedIcon: 'fa fa-folder-open-o',
                            closedIcon: 'fa fa-folder-o',
                            children: [],
                            buttons: [
                                {
                                    title: 'Delete',
                                    icon: 'fa fa-trash',
                                    //click:this.deleteCountries(this.countries[i].id),

                                }
                            ]
                        }
                    );
                    for(let j=0; j<this.countries[i].divisions.length; j++){
                        this.option.root.children[i].children.push(
                            {
                                name: this.countries[i].divisions[j].division_name,
                                isParent: this.countries[i].divisions[j].districts.length > 0 ? true : false,
                                isOpen : this.countries[i].divisions[j].districts.length ? true : false,
                                openedIcon: 'fa fa-folder-open-o',
                                closedIcon: 'fa fa-folder-o',
                                children: []
                            }
                        );
                        for(let k=0; k<this.countries[i].divisions[j].districts.length; k++){
                            this.option.root.children[i].children[j].children.push(
                                {
                                    name: this.countries[i].divisions[j].districts[k].district_name,
                                    isParent: this.countries[i].divisions[j].districts[k].areas.length > 0 ? true : false,
                                    isOpen : this.countries[i].divisions[j].districts[k].areas.length ? true : false,
                                    openedIcon: 'fa fa-folder-open-o',
                                    closedIcon: 'fa fa-folder-o',
                                    children: []
                                }
                            );
                            for(let l=0; l<this.countries[i].divisions[j].districts[k].areas.length; l++){
                                this.option.root.children[i].children[j].children[k].children.push(
                                    {
                                        name: this.countries[i].divisions[j].districts[k].areas[l].area_name,
                                        isParent: this.countries[i].divisions[j].districts[k].areas[l].sub_areas.length > 0 ? true : false,
                                        isOpen : this.countries[i].divisions[j].districts[k].areas[l].sub_areas.length ? true : false,
                                        openedIcon: 'fa fa-folder-open-o',
                                        closedIcon: 'fa fa-folder-o',
                                        children: []
                                    }
                                );
                                for(let m=0; m<this.countries[i].divisions[j].districts[k].areas[l].sub_areas.length; m++){
                                    this.option.root.children[i].children[j].children[k].children[l].children.push(
                                        {
                                            name: this.countries[i].divisions[j].districts[k].areas[l].sub_areas[m].sub_area_name,
                                            isParent: this.countries[i].divisions[j].districts[k].areas[l].sub_areas[m].roads.length > 0 ? true : false,
                                            isOpen : this.countries[i].divisions[j].districts[k].areas[l].sub_areas[m].roads.length ? true : false,
                                            openedIcon: 'fa fa-folder-open-o',
                                            closedIcon: 'fa fa-folder-o',
                                            children: []
                                        }
                                    );
                                    for(let n=0; n<this.countries[i].divisions[j].districts[k].areas[l].sub_areas[m].roads.length; n++){
                                        this.option.root.children[i].children[j].children[k].children[l].children[m].children.push(
                                            {
                                                name: this.countries[i].divisions[j].districts[k].areas[l].sub_areas[m].roads[n].road_name,
                                                isParent: this.countries[i].divisions[j].districts[k].areas[l].sub_areas[m].roads[n] > 0 ? true : false,
                                                isOpen : this.countries[i].divisions[j].districts[k].areas[l].sub_areas[m].roads[n] ? true : false,
                                                openedIcon:'fa fa-folder-open-o',
                                                closedIcon: 'fa fa-folder-o',
                                                children: []
                                            }
                                        )
                                    }
                                }
                            }

                        }

                    }
                }
                this.ready = true;

            })
        },

        getGeoLocations() {
            axios.get('/api/get-locations').then((response) => {
                // console.log(response.data);
                this.countries = response.data.countries;

            });
        },

        getDivisions(countryId){
            axios.get('/api/get-divisions', { params : {'country_id' : countryId}}).then((response) => {
                this.divisions = response.data.divisions;
            });
        },

        getDistricts(divisionId){
            axios.get('/api/get-districts', { params : {'division_id' : divisionId}}).then((response) => {
                this.districts = response.data.districts;
            });
        },

        getAreas(districtId){
            axios.get('/api/get-areas', { params : {'district_id' : districtId}}).then((response) => {
                this.areas = response.data.areas;
            });
        },

        getSubAreas(areaId){
            axios.get('/api/get-sub_areas', { params : {'area_id' : areaId}}).then((response) => {
                this.sub_areas = response.data.sub_areas;
            });
        },

        getRoads(subAreaId){
            axios.get('/api/get-roads', { params : {'sub_area_id' : subAreaId}}).then((response) => {
                this.roads = response.data.roads;
            });
        },




        deleteCountries(id){
                axios.delete(`api/delete-countries/${id}`).then(response=>{
                    this.countries;

                }).catch(error=>{
                    console.log(error)
                })

        }


    },
    watch: {
        'selectedGeo.country_id' : function (newVal, oldVal) {
            if(newVal){
                this.getDivisions(newVal);
            }
        },

        'selectedGeo.division_id' : function (newVal, oldVal) {
            if(newVal){
                this.getDistricts(newVal);
            }
        },

        'selectedGeo.district_id' : function (newVal, oldVal) {
            if(newVal){
                this.getAreas(newVal);
            }
        },

        'selectedGeo.area_id' : function (newVal, oldVal) {
            if(newVal){
                this.getSubAreas(newVal);
            }
        },

        'selectedGeo.sub_area_id' : function (newVal, oldVal) {
            if(newVal){
                this.getRoads(newVal);
            }
        },

    }


}


</script>

<style scoped>
@import '../utils/vue-tree/style.css';


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




.geo-location ul {
    margin-left: 20px;
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
    font-size: 16px;
    font-weight: bold;
}
</style>
