
<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import Todo from "../Components/Todo.vue";
import { useForm } from '@inertiajs/inertia-vue3';

defineProps([
    'pins',
]);

const form = useForm({
    title: '',
    description: '',
});

const add = () => {
    form.post(route("pins"), {
        onSuccess: () => {
            form.reset()
            modal_1.close()
        },
        onError: (err) => console.log(err)
    });
};

</script>
<template>
    <AppLayout title="Dashboard">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Pins
            </h2>
        </template>

        <div class="py-6">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <dialog id="modal_1" class="modal">
                    <form  @submit.prevent="add" class="modal-box ">
                        <h3 class="font-bold text-lg">Pin a task</h3>

                        <div class="form-control w-full ">
                            <label class="label">
                                <span class="label-text">Title</span>
                            </label>
                            <input type="text" v-model="form.title" placeholder="Type here" class="input input-bordered w-full " />
                        </div>
                        <div class="form-control w-full ">
                            <label class="label">
                                <span class="label-text">Description</span>
                            </label>
                            <input type="text" v-model="form.description" placeholder="Type here" class="input input-bordered w-full " />
                        </div>

                        <div class="modal-action">
                            <button type="button" onclick="modal_1.close()" class="btn">Close</button>
                            <button class="btn btn-primary">Add</button>
                        </div>
                    </form>
                </dialog>


                <!-- <div className="collapse collapse-arrow bg-base-200">
                    <input type="radio" name="my-accordion-2" checked="checked" /> 
                    <div className="collapse-title text-xl font-medium">
                        Click to open this one and close others
                    </div>
                    <div className="collapse-content"> 
                        <p>hello</p>
                    </div>
                </div> -->

                <!-- <div class="collapse bg-base-200" @click="collapse">
                    <input type="radio" name="my-accordion-1" checked /> 
                    <div class="collapse-title text-xl font-medium">
                        Click to open this one and close others
                    </div>
                    <div class="collapse-content"> 
                        <p>hello</p>
                    </div>
                </div> -->
                <!-- component -->
                <div class="collapse collapse-arrow max-w-7xl mx-auto my-10 bg-white p-8 rounded-xl shadow shadow-slate-300">
                    <div class="flex flex-row justify-between items-center">
                        <div>
                            <h1 class="text-3xl font-medium">Tasks list</h1>
                        </div>
                        <!-- <div class="inline-flex space-x-2 items-center">
                            <button class="btn btn-outline btn-info" onclick="modal_1.showModal()">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                    stroke="currentColor" class="w-4 h-4">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                                </svg>
                                Crete Task
                            </button>
                        </div> -->
                    </div>
                    <p class="text-slate-500">Hello, here are your latest tasks</p>

                    <div id="tasks" class="my-5">
                        <Todo v-for="pin in pins" :key="pin.id" :todo="pin" />
                    </div>
                </div>
            </div>
        </div>
    </AppLayout>
</template>
