<template>
    <div class="panel-block">
        <div class="panel__header">
            <h2 class="h2 panel__header-title">User list</h2>
            <button class="btn panel__header-btn" @click="add = !add"><img src="/img/icons/Add.svg" alt="Plus" class="btn-icon">Add user</button>
        </div>
        <div class="panel__search">
            <input type="text" placeholder="Search" class="input panel__search-input" v-model="search">
            <button class="panel__search-btn btn" @click="getUsers"><img src="/img/icons/Search.svg" alt="Search" class="btn-icon">Search</button>
        </div>
        <div class="panel__table">
            <div class="panel__table-row">
                <p class="panel__table-row-cell table-title" :class="{active: sort === 1}" @click="sort = 1; getUsers()">ID</p>
                <p class="panel__table-row-cell table-title" :class="{active: sort === 2}" @click="sort = 2; getUsers()">Email</p>
                <p class="panel__table-row-cell table-title" :class="{active: sort === 3}" @click="sort = 3; getUsers()">Type</p>
                <p class="panel__table-row-cell table-title" :class="{active: sort === 4}" @click="sort = 4; getUsers()">Register</p>
                <p class="panel__table-row-cell table-title" :class="{active: sort === 5}" @click="sort = 5; getUsers()">Total sequences</p>
                <p class="panel__table-row-cell table-title"></p>
            </div>
            <div class="panel__table-row" v-for="user in users" v-if="users.length !== 0">
                <p class="panel__table-row-cell">{{ user.id }}</p>
                <p class="panel__table-row-cell">{{ user.email }}</p>
                <p class="panel__table-row-cell">{{ user.type }}</p>
                <p class="panel__table-row-cell">{{ formatDate(user.created_at) }}</p>
                <p class="panel__table-row-cell">15</p>
                <div class="panel__table-row-cell">
                    <img src="/img/icons/Edit.svg" alt="Edit" class="panel__table-row-cell-icon" @click="userEdit = user; add = !add">
                    <img src="/img/icons/Delete.svg" alt="Delete" class="panel__table-row-cell-icon" @click="delUser(user.id)">
                </div>
            </div>
            <div class="panel__table-row-full" v-if="users.length === 0">
                Ничего не найдено
            </div>
        </div>
        <div class="panel__pagination">
            <p class="panel__pagination-item" v-for="n in pages" :class="{active: currentPage === n}" @click="changePage(n)">{{ n }}</p>
        </div>

        <div class="panel__header">
            <h2 class="h2 panel__header-title">Admin list</h2>
        </div>
        <div class="panel__table">
            <div class="panel__table-row2">
                <p class="panel__table-row-cell table-title">ID</p>
                <p class="panel__table-row-cell table-title">Name</p>
                <p class="panel__table-row-cell table-title">Email</p>
                <p class="panel__table-row-cell table-title">Register</p>
                <p class="panel__table-row-cell table-title"></p>
            </div>
            <div class="panel__table-row2" v-for="admin in admins">
                <p class="panel__table-row-cell">{{ admin.id }}</p>
                <p class="panel__table-row-cell">{{ admin.name }}</p>
                <p class="panel__table-row-cell">{{ admin.email }}</p>
                <p class="panel__table-row-cell">{{ formatDate(admin.created_at) }}</p>
                <div class="panel__table-row-cell">
                    <img src="/img/icons/Edit.svg" alt="Edit" class="panel__table-row-cell-icon" @click="userEdit = admin; add = !add">
                    <img src="/img/icons/Delete.svg" alt="Delete" class="panel__table-row-cell-icon" @click="delUser(admin.id)">
                </div>
            </div>
        </div>
        <add-user-component @close="add = !add; getUsers(); getAdmins()" :user="userEdit" v-if="add"></add-user-component>
        <notifications position="bottom right" group="notify" />
    </div>
</template>

<script>
export default {
    name: "UserListComponent",
    data(){
        return {
            users: [],
            userEdit: '',
            admins: [],
            pages: 1,
            currentPage: 1,
            sort: 1,
            search: '',
            add: false
        }
    },

    methods: {
        getUsers(){
            return axios.post('/api/get-users', {
                page: this.currentPage,
                sort: this.sort,
                search: this.search
            }).then((data) => {this.users = data.data; this.userEdit = ''})
        },

        getAdmins(){
            return axios.get('/api/get-admins').then((data) => this.admins = data.data)
        },

        getPages(){
            return axios.get('/api/get-pages').then((data) => this.pages = Math.ceil(data.data / 25))
        },

        changePage(page){
            this.currentPage = page
            this.getUsers()
        },

        formatDate(d){
            let date = new Date(d);
            return date.toLocaleString()
        },

        delUser(id){
            axios
                .post('/api/del-user', {
                    id: id
                })
                .then(() => {this.$notify({
                    group: 'notify',
                    title: 'Success',
                    type: 'success',
                    duration: 5000
                }); this.getUsers(); this.getAdmins()})
                .catch(() => {this.$notify({
                    group: 'notify',
                    title: 'Error',
                    type: 'error',
                    duration: 5000
                }); this.getUsers(); this.getAdmins()})
        }
    },

    mounted() {
        this.getUsers()
        this.getAdmins()
        this.getPages()
    }
}
</script>
