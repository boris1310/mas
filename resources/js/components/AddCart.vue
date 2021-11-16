<template>

<div class="mx-auto w-75 card p-3">


    <form action="/orders" class="row">
        <div class="col-6">
            <label for="name" class="form-label">Client Name</label>
            <input class="form-control my-1  px-3" id="name" type="text" name="name" placeholder="Client name">
        </div>

        <div class="col-6">
            <label for="phone" class="form-label">Phone Number</label>
            <input class="form-control my-1  px-3" id="phone" type="phone" name="phone" placeholder="Phone Number">
        </div>

        <div class="col-12 my-1">
            <label for="name" class="form-label">Services</label>
            <select name="services" class="form-control" @change="addCurrentService($event)" id="services">
                <option v-for="service in services" :value="service.id">{{ service.service_name }}</option>
            </select>
        </div>
    </form>

            <div class="col-12 my-3"  v-if="choicedServices.length">
                <div class="card-header bg-success">
                    Выбранные услуги
                </div>
                <ul class="list-group list-group-flush">
                    <li v-for="service in choicedServices" class="list-group-item d-flex justify-content-between">

                        <span class="p-2 bd-highlight">{{ service.service_name }}</span>

                        <div class="p-2 bd-highlight">

                            <button class="btn btn-primary" @click="changeEditType(service.service_name)" type="button"  data-bs-toggle="modal" data-bs-target="#edit">
                                <img width="20px" src="https://img.icons8.com/ios-filled/50/000000/edit--v2.png"/>
                            </button>

                            <button class="btn btn-danger" @click="deleteService(service.id)" type="button">
                                &#x2715
                            </button>
                        </div>

                    </li>

                    <li v-show="showErrorFlag" class="list-group-item bg-danger text-light">Такая услуга уже добавлена</li>
                </ul>
            </div>

        <div class="row">
            <div class="col-9"></div>
            <div class="my-3 col-3">
                <button type="button" class="btn btn-success w-100" @click="addService">Add service</button>
            </div>
        </div>
    <edit-modal :edit-type="editType"></edit-modal>
    <label for="description">Примечание</label>
    <textarea name="description" id="description" class="form-control" cols="30" rows="10"></textarea>
    <div class="mx-auto my-5">
        <button :disabled="flag!==0"  class="btn btn-primary">Добавить заказ</button>
    </div>
</div>

</template>

<script>
import editModal from "./editModal";
export default {
    name: "AddCart",
    components:{ editModal },
    props:{
      flag:Number
    },
    data:()=>({
        services:[],
        currentService:1,
        choicedServices:[],
        showErrorFlag:false,
        editType:'',
    }),
    methods:{
        async fetchServices(){
            const response = await fetch('/services');
            this.services = await response.json();
        },
        addCurrentService(event){
            this.$root.flag = false;
            this.currentService = event.target.value;
        },
         showError(){
              this.showErrorFlag = true;
             setTimeout(()=>{
                 this.showErrorFlag = false;
             },1500) ;
        },
        addService(){
            this.services.map(i=>{
               if(i.id==this.currentService){

                   let a = this.choicedServices.filter(id=>id.id == i.id);

                   if(a.length==0){
                       this.$root.flagRequired++;
                       this.choicedServices.push({
                           id:i.id,
                           service_name:i.service_name
                       });
                   }else{
                           this.showError();
                   }

               }
            });

        },
        deleteService(id){
            this.choicedServices.map(service=>{
               if(service.id == id){
                   this.$root.flagRequired--;
                   this.choicedServices.splice(service,1);
               }
            });
        },
        changeEditType(service){
                this.editType = service;
        }
    },
    mounted(){
        this.fetchServices();
    }
}
</script>

<style scoped>

</style>
