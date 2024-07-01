<template>
    <div class="flex justify-end space-x-2 mb-2">
        <button
        type="button" 
        class="action-button" 
        title="Edit Details"
        >
            <img src="/icons/edit-svgrepo-com.svg" class="h-4">
            <span>Edit</span>
        </button>
        <button
        type="button" 
        class="action-button" 
        title="Save Details"
        v-show="state.isButtonSave"
        @click="saveEmployee()"
        >
            <img src="/icons/save-svgrepo-com.svg" class="h-4">
            <span>Save</span>
        </button>
        <button
        type="button" 
        class="action-button" 
        title="Update Details"
        v-show="state.isDisabledButton"
        @click="updateEmployee()"
        >
            <img src="/icons/save-svgrepo-com.svg" class="h-4">
            <span>Update</span>
        </button>
        <div class="">
            <input
            type="file"
            ref="fileInput"
            class="hidden"
            @change="handleFileUpload"
            />
            <button
            class="action-button"
            @click="triggerFileUpload"
            >
                <img src="/icons/import-content-svgrepo-com.svg" class="h-4">
                <span>Upload</span>
            </button>
        </div>
    </div>
    <div class="body-content space-y-5 mb-5">
        <section class="space-y-5">
            <div class="flex flex-col md:flex-row">
                <div class="flex-grow">
                    <div class="grid grid-cols-3 gap-3 mb-3">
                        <div>
                            <label for="lastname" class="block">Last Name</label>
                            <input
                            type="text"
                            name="lastname"
                            id="lastname"
                            class="input-text"
                            v-model="state.employees.lastname"
                            >
                            <p class="text-red-500 text-sm" v-if="state.errors?.[0]?.lastname">{{ state.errors[0].lastname[0] }}</p>
                        </div>
                        <div>
                            <label for="firstname" class="block">First Name</label>
                            <input
                            type="text"
                            name="firstname"
                            id="firstname"
                            class="input-text"
                            v-model="state.employees.firstname"
                            >
                            <p class="text-red-500 text-sm" v-if="state.errors?.[0]?.firstname">{{ state.errors[0].firstname[0] }}</p>
                        </div> 
                        <div>
                            <label for="middlename" class="block">Middle Name</label>
                            <input
                            type="text"
                            name="middlename"
                            id="middlename"
                            class="input-text"
                            v-model="state.employees.middlename"
                            >
                            <p class="text-red-500 text-sm" v-if="state.errors?.[0]?.middlename">{{ state.errors[0].middlename[0] }}</p>
                        </div> 
                    </div>
                    <div class="grid grid-cols-1">
                        <div>
                            <label for="address" class="block">Address</label>
                            <input
                            type="text"
                            name="address"
                            id="address"
                            class="input-text"
                            v-model="state.employees.address"
                            >
                            <p class="text-red-500 text-sm" v-if="state.errors?.[0]?.address">{{ state.errors[0].address[0] }}</p>
                        </div>
                    </div>
                    <div class="grid grid-cols-3 gap-3">
                        <div>
                            <label for="age" class="block">Age</label>
                            <input
                            type="text"
                            name="age"
                            id="age"
                            class="input-text"
                            v-model="state.employees.age"
                            >
                            <p class="text-red-500 text-sm" v-if="state.errors?.[0]?.age">{{ state.errors[0].age[0] }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
    <div class="body-content">
        <table class="min-w-full">
            <thead>
                <tr>
                    <th class="table-header" scope="col">Last Name</th>
                    <th class="table-header" scope="col">First Name</th>
                    <th class="table-header" scope="col">Middle Name</th>
                    <th class="table-header" scope="col">Age</th>
                    <th class="table-header" scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="(item, index) in props.data.employee" class="table-body">
                    <td class="table-body-td">{{ item.lastname }}</td>
                    <td class="table-body-td">{{ item.firstname }}</td>
                    <td class="table-body-td">{{ item.middlename }}</td>
                    <td class="table-body-td">{{ item.age }}</td>
                    <td>
                        <div class="flex space-x-1">
                            <button
                            type="button"
                            title="View Employee Details"
                            class="action-button"
                            @click="viewEmployee(item)"
                            >
                                <img src="/icons/view-svgrepo-com.svg" class="h-4">
                                <span>View</span>
                            </button>
                            <button
                            type="button"
                            title="Delete Employee Details"
                            class="action-button"
                            @click="deleteEmployee(item)"
                            >
                                <img src="/icons/delete-svgrepo-com.svg" class="h-4">
                                <span>Delete</span>
                            </button>
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</template>

<script setup>
import { reactive, defineProps, ref } from 'vue';
import http_request from '../../http_request';
import axios from 'axios';

const props = defineProps({
    data: {
        type: Object
    }
})

const state = reactive({
    employees: {
        firstname: null,
        middlename: null,
        lastname: null,
        age: null,
        address: null,
        id: null,
    },
    errors: [],
    isDisabledButton: false,
    isButtonSave: true,
})

const selectedFile = ref(null);
const fileInput = ref(null);

const saveEmployee = async () => {
    const response = await http_request.save('POST', '/', state.employees);

    if (response.success) {
        alert(response.data.message)
        location.reload()
    } else {
        if (response.status.status == 422) {
            state.errors.push(response.status.data.errors)
        }
    }
}

const viewEmployee = (items) => {
    state.employees.firstname = items.firstname
    state.employees.lastname = items.lastname
    state.employees.middlename = items.middlename
    state.employees.age = items.age
    state.employees.address = items.address
    state.employees.id = items.id

    state.isButtonSave = false
    state.isDisabledButton = true
}

const updateEmployee = async () => {
    const response = await http_request.update(`/${state.employees.id}`, state.employees)

    if (response.success) {
        alert(response.data.message)
        location.reload()
    }
}

const deleteEmployee = async (items) => {
    let confirmation = confirm('Are you sure, you want to delete this record?')

    if (confirmation) {
        const response = await http_request.delete('DELETE', `/${items.id}`)

        if (response.success) {
            alert(response.data.message)
            location.reload()
        }
    }
    
}

const handleFileUpload = (event) => {
    console.log(event.target.files[0])
    selectedFile.value = event.target.files[0];
    importFile();
};

const triggerFileUpload = () => {
    fileInput.value.click();
};

const importFile = async () => {
    if (!selectedFile.value) return;

    console.log(selectedFile)

    const formData = new FormData();
    formData.append('file', selectedFile.value);

    try {
        const response = await axios.post('upload', formData, {
            headers: {
                'Content-Type': 'multipart/form-data',
            },
        });

        alert(response.data.message);
        location.reload()
    } catch (error) {
        alert(error.response.data.errors.file[0])
    }
};
</script>
