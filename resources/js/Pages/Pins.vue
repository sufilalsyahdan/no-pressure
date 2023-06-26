
<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import Todo from "../Components/Todo.vue";

defineProps([
    'pins',
]);
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
                <dialog id="my_modal_1" class="modal">
                    <form method="dialog" class="modal-box">
                        <h3 class="font-bold text-lg">Create List!</h3>

                        <div class="my-2"></div>
                        <input type="text" placeholder="Type here" class="input w-full bg-slate-200" />
                        <div class="modal-action">
                            <!-- if there is a button in form, it will close the modal -->
                            <button type="button" class="btn">Close</button>
                            <button type="button" class="btn bg-slate-500">Save</button>
                        </div>
                    </form>
                </dialog>
                <!-- component -->
                <div class="max-w-7xl mx-auto my-10 bg-white p-8 rounded-xl shadow shadow-slate-300">
                    <div class="flex flex-row justify-between items-center">
                        <div>
                            <h1 class="text-3xl font-medium">Tasks list</h1>
                        </div>
                        <div class="inline-flex space-x-2 items-center">
                            <button class="btn border border-slate-700 bg-slate-100" onclick="my_modal_1.showModal()">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                    stroke="currentColor" class="w-4 h-4">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                                </svg>
                                Crete Task
                            </button>
                        </div>
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
