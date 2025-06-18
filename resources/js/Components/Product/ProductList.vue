<template>
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div>
                            <input placeholder="Search..." class="form-control mb-2 w-auto form-control-sm" type="text" v-model="searchValue">
                            <EasyDataTable buttons-pagination alternating :headers="Header" :items="Item" :rows-per-page="10" :search-field="searchField"  :search-value="searchValue">
                                <template #item-number="{ id,name }">
                                    <Link class="btn btn-success mx-3 btn-sm" :href="`/ProductSavePage?id=${id}`">Edit</Link>
                                    <button class="btn btn-danger btn-sm" @click="DeleteClick(id)">Delete</button>
                                </template>
                                <template #item-categories="{ categories }">
                                <span v-if="categories && categories.length">
                                    {{ categories.map(c => c.name).join(', ') }}
                                </span>
                                </template>
                            </EasyDataTable>
                        </div>
                        <Link class="btn btn-success my-2" href="/ProductSavePage?id=0">Create New</Link>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>


<script setup>
import { Link, router, usePage } from "@inertiajs/vue3";
import { createToaster } from "@meforma/vue-toaster";
import { ref } from "vue";
const toaster = createToaster();
let page=usePage()

const Header = [
    { text: "No", value: "id" },
    { text: "Name", value: "name"},
    { text: "Price", value: "price"},
    { text: "Unit", value: "unit"},
    { text: "Categories", value: "categories"},
    { text: "Action", value: "number"},
];


const Item = ref(page.props.list)

if(page.props.flash.status===true){
    toaster.success(page.props.flash.message);
}

if(page.props.flash.status===false){
    toaster.warning(page.props.flash.message);
}

const DeleteClick=(id)=>{
    let text = "Do you want to delete";
    if (confirm(text) === true) {
        router.get(`/delete-product/${id}`)
    } else {
        text = "You canceled!";
    }
}


</script>
