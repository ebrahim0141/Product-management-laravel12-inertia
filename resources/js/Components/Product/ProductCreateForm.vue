
<template>
        <div class="container-fluid">
            <div class="row d-flex justify-content-center">
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <form @submit.prevent="submit">
                                <div class="card-body">
                                    <h4>Save Product</h4>
                                    <input id="id" name="id" v-model="form.id"  placeholder="Product ID" class="form-control" type="text"/>
                                    <br/>
                                    <input id="name" name="name" v-model="form.name"  placeholder="Product Name" class="form-control" type="text"/>
                                    <br/>
                                    <input id="name" name="name" v-model="form.price"  placeholder="Product Price" class="form-control" type="number"/>
                                    <br/>
                                    <input id="name" name="name" v-model="form.unit"  placeholder="Product Unit" class="form-control" type="number"/>
                                    <br/>
                                    <label>Select Categories</label>
                                    <select class="form-control mb-3" v-model="form.categories" multiple>
                                    <option v-for="cat in page.props.category_list" :key="cat.id" :value="cat.id">
                                        {{ cat.name }}
                                    </option>
                                    </select>
                                    <button type="submit"  class="btn w-100 btn-success">Save Change</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</template>


<script setup>
import { router, useForm, usePage } from '@inertiajs/vue3';
import { ref } from "vue";


const urlParams=new URLSearchParams(window.location.search)
let id=ref(parseInt(urlParams.get('id')))



const form = useForm({
  id: id,
  name: '',
  price: '',
  unit: '',
  categories: [] 
})

const page = usePage()

let URL="/create-product";
let list=page.props.list

if(id.value!==0 && list!==null){
    URL="/update-product";
    // fill the form with existing data
    form.name=list['name']
    form.price=list['price']
    form.unit=list['unit']
    form.id=list['id']
    form.categories = list.categories.map(cat => cat.id)
}

function submit(){
    if(form.name.length===0){
        alert("Product name Required")
    }else if (form.price.length===0) {
        alert("Product name Required")
    }else if (form.unit.length===0) {
        alert("Product name Required")
    }
    else  {
        console.log(form)
        form.post(URL,{
            onSuccess:()=>{
                if(page.props.flash.status===true){
                    router.get("/ProductPage")
                }
                else {
                    alert(page.props.flash.message)
                }
            }
        })
    }

}

</script>
