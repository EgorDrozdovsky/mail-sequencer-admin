<template>
    <div class="add">
        <div class="add-body">
            <div class="add__form" v-if="user.length === 0">
                <h2 class="h2 add__form-title">Add user</h2>
                <dropdown-component :label="'role'" :list="['user', 'admin']" :default="'user'" @dd="changeRole"></dropdown-component>
                <div class="form-group">
                    <label for="email" class="label">E-mail</label>
                    <input type="email" name="email" id="email" class="input" required autofocus v-model="email">
                </div>
                <dropdown-component :label="'mail type'" :list="['Yandex', 'Gmail']" :default="'Yandex'" @dd="changeType" v-if="role === 'user'"></dropdown-component>
                <div class="form-group" v-if="role === 'admin'">
                    <label for="password" class="label">Password</label>
                    <input type="text" name="password" id="password" class="input" required v-model="password">
                </div>
                <div class="form-group" v-if="role === 'admin'">
                    <label for="name" class="label">name</label>
                    <input type="text" name="name" id="name" class="input" required v-model="name">
                </div>
                <div class="add__group">
                    <button class="add__form-btn btn3" @click="$emit('close')">Cancel</button>
                    <button class="add__form-btn btn" @click="saveUser">Add</button>
                </div>
            </div>
            <div class="add__form" v-else>
                <h2 class="h2 add__form-title">Edit user</h2>
                <div class="form-group">
                    <label for="email" class="label">E-mail</label>
                    <input type="email" name="email" id="email" class="input" required autofocus v-model="user.email">
                </div>
                <dropdown-component :label="'mail type'" :list="['Yandex', 'Gmail']" :default="user.type" @dd="changeTypeEdit" v-if="user.admin === 0"></dropdown-component>
                <div class="form-group" v-if="user.admin === 1">
                    <label for="password" class="label">New Password</label>
                    <input type="text" name="password" id="password" class="input" required v-model="user.password">
                </div>
                <div class="form-group" v-if="user.admin === 1">
                    <label for="name" class="label">name</label>
                    <input type="text" name="name" id="name" class="input" required v-model="user.name">
                </div>
                <div class="add__group">
                    <button class="add__form-btn btn3" @click="$emit('close')">Cancel</button>
                    <button class="add__form-btn btn" @click="editUser">Save</button>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: "AddUserComponent",
    props: ['user'],
    data(){
        return{
            role: 'user',
            email: '',
            password: '',
            name: '',
            type: 'Yandex'
        }
    },

    methods:{
        changeRole(val){
            this.role = val
        },

        changeType(val){
            this.type = val
        },

        changeTypeEdit(val){
            this.user.type = val
        },

        saveUser(){
            if (this.email.length !== 0){
                if (this.password.length !== 0 & this.name.length !== 0 || this.role === 'user'){
                    axios.post('/api/add-user', {
                        email: this.email,
                        role: this.role,
                        password: this.password,
                        name: this.name,
                        type: this.type
                    }).then(() => {
                        this.$notify({
                            group: 'notify',
                            title: 'User saved',
                            type: 'success',
                            duration: 5000
                        });
                        this.$emit('close')
                    })
                } else {
                    alert('Password or Name field not filled')
                }
            } else {
                alert('Email field not filled')
            }
        },

        editUser(){
            axios.post('/api/edit-user',{
                user: this.user
            }).then(() => {
                this.$notify({
                    group: 'notify',
                    title: 'User saved',
                    type: 'success',
                    duration: 5000
                });
                this.$emit('close')
            })
        }
    }
}
</script>
