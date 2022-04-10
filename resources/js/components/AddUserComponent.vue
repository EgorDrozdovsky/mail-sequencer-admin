<template>
    <div class="add">
        <div class="add-body">
            <div class="add__form">
                <h2 class="h2 add__form-title">Add user</h2>
                <dropdown-component :label="'role'" :list="['user', 'admin']" @dd="changeRole"></dropdown-component>
                <div class="form-group">
                    <label for="email" class="label">E-mail</label>
                    <input type="email" name="email" id="email" class="input" required autofocus v-model="email">
                </div>
                <dropdown-component :label="'mail type'" :list="['Yandex', 'Gmail']" @dd="changeType" v-if="role === 'user'"></dropdown-component>
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
        </div>
    </div>
</template>

<script>
export default {
    name: "AddUserComponent",
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

        saveUser(){
            if (this.email.length !== 0){
                if (this.password.length !== 0 & this.name.length !== 0 || this.role === 'user'){
                    axios.post('/api/add-user', {
                        email: this.email,
                        role: this.role,
                        password: this.password,
                        name: this.name,
                        type: this.type
                    }).then((data) => this.$emit('close'))
                } else {
                    alert('Password or Name field not filled')
                }
            } else {
                alert('Email field not filled')
            }
        }
    }
}
</script>
