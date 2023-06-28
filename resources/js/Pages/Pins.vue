
<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import Todo from "../Components/Todo.vue";
import { useForm } from '@inertiajs/inertia-vue3';

defineProps([
    'pin',
    'tasks',
]);

const form = useForm({
    title: '',
    description: '',
});

const formTask = useForm({
    id: '',
    text: '',
    priority: 1,
    pin_id: 0,
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

const deletePin = (id) => {
    form.delete(`/pins/${id}`);
};

const addTask = () => {
    formTask.post('tasks', {
        onSuccess: () => {
            formTask.reset()
            modal_2.close()
        },
        onError: (err) => console.log(err)
    });
};

const editTask = () => {
    formTask.put(`/updateTask/${formTask.id}`, {
        onSuccess: () => {
            formTask.reset()
            modal_3.close()
        },
        onError: (err) => console.log(err)
    });
};

const showModalTask = (id) => {
    formTask.pin_id = id;
    modal_2.showModal();
}

const showModalEditTask = (todo) => {
    formTask.id = todo.id;
    formTask.pin_id = todo.pin_id;
    formTask.text = todo.text;
    formTask.priority = todo.priority;
    modal_3.showModal();
}

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
                
                <a v-if="!pin" href="#" onclick="modal_1.showModal()" class="hover:border-blue-500 hover:border-solid hover:bg-white hover:text-blue-500 group w-full flex flex-col items-center justify-center rounded-md border-2 border-dashed border-slate-300 text-sm leading-6 text-slate-900 font-medium py-3">
                    <svg class="group-hover:text-blue-500 mb-1 text-slate-400" width="20" height="20" fill="currentColor" aria-hidden="true">
                    <path d="M10 5a1 1 0 0 1 1 1v3h3a1 1 0 1 1 0 2h-3v3a1 1 0 1 1-2 0v-3H6a1 1 0 1 1 0-2h3V6a1 1 0 0 1 1-1Z" />
                    </svg>
                    Pin a list
                </a>

                <!-- component -->
                <div v-if="pin" class="collapse collapse-arrow max-w-7xl mx-auto my-10 bg-white p-8 rounded-xl shadow shadow-slate-300">
                    <div class="flex flex-row justify-between items-center">
                        <div>
                            <h1 class="text-3xl font-medium">{{pin?.title}}</h1>
                        </div>
                        <div class="inline-flex space-x-2 items-center">
                            <button class="btn btn-outline btn-primary" @click="showModalTask(pin?.id)">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                    stroke="currentColor" class="w-4 h-4">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                                </svg>
                                Create Task
                            </button>
                            <button class="btn btn-outline btn-error" @click="deletePin(pin?.id)">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                    class="w-4 h-4 text-red-500 hover:text-rose-700 hover:cursor-pointer">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                                </svg>
                                Delete List
                            </button>
                        </div>
                    </div>
                    <p class="text-slate-500">{{pin?.description}}</p>

                    <div id="tasks" class="my-5">
                        <Todo v-for="task in tasks" :key="task.id" :todo="task" :handleEdit="showModalEditTask" />
                    </div>
                </div>
            </div>
        </div>

        <dialog id="modal_1" class="modal">
            <form  @submit.prevent="add" class="modal-box ">
                <h3 class="font-bold text-lg">Pin a list</h3>

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

        <dialog id="modal_2" class="modal">
            <form  @submit.prevent="addTask" class="modal-box ">
                <h3 class="font-bold text-lg">Create a task</h3>
                
                <div class="form-control w-full ">
                    <label class="label">
                        <span class="label-text">Task</span>
                    </label>
                    <input type="text" v-model="formTask.text" placeholder="Type here" class="input input-bordered w-full " />
                    <input type="hidden" v-model="formTask.pin_id" />
                </div>
    
                <div class="form-control w-full ">
                    <label class="label">
                        <span class="label-text">Priority</span>
                    </label>
                    <input type="range" min="1" max="3" v-model="formTask.priority" class="range range-warning" step="1" name="priority"/>
                        <div class="w-full flex justify-between text-xs px-2">
                        <span>Low</span>
                        <span>Medium</span>
                        <span>High</span>
                    </div>
                </div>

                <div class="modal-action">
                    <button type="button" onclick="modal_2.close()" class="btn">Close</button>
                    <button class="btn btn-primary">Add</button>
                </div>
            </form>
        </dialog>

        <dialog id="modal_3" class="modal">
            <form  @submit.prevent="editTask" class="modal-box ">
                <h3 class="font-bold text-lg">Edit a task</h3>
    
                <div class="form-control w-full ">
                    <label class="label">
                        <span class="label-text">Task</span>
                    </label>
                    <input type="text" v-model="formTask.text" placeholder="Type here" class="input input-bordered w-full " />
                    <input type="hidden" v-model="formTask.id" />
                </div>

                <div class="form-control w-full ">
                    <label class="label">
                        <span class="label-text">Priority</span>
                    </label>
                    <input type="range" min="1" max="3" v-model="formTask.priority" class="range range-warning" step="1" name="priority"/>
                        <div class="w-full flex justify-between text-xs px-2">
                        <span>Low</span>
                        <span>Medium</span>
                        <span>High</span>
                    </div>
                </div>

                <div class="modal-action">
                    <button type="button" onclick="modal_3.close()" class="btn">Close</button>
                    <button class="btn btn-primary">Update</button>
                </div>
            </form>
        </dialog>
    </AppLayout>
</template>
