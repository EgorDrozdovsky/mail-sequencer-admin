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
                <p class="panel__table-row-cell table-title" :class="{active: sort === 4}" @click="sort = 4; getUsers()">Total sequences</p>
                <p class="panel__table-row-cell table-title"></p>
            </div>
            <div class="panel__table-row" v-for="user in users">
                <p class="panel__table-row-cell">{{ user.id }}</p>
                <p class="panel__table-row-cell">{{ user.email }}</p>
                <p class="panel__table-row-cell">{{ user.type }}</p>
                <p class="panel__table-row-cell">15</p>
                <div class="panel__table-row-cell">
                    <img src="/img/icons/Edit.svg" alt="Delete" class="panel__table-row-cell-icon">
                    <img src="/img/icons/Delete.svg" alt="Delete" class="panel__table-row-cell-icon">
                </div>
            </div>
        </div>
        <div class="panel__pagination">
            <p class="panel__pagination-item" v-for="n in pages" :class="{active: currentPage === n}" @click="changePage(n)">{{ n }}</p>
        </div>
        <add-user-component @close="add = !add; getUsers()" v-if="add"></add-user-component>
    </div>
</template>

<script>
export default {
    name: "UserListComponent",
    data(){
        return {
            users: [],
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
            }).then((data) => this.users = data.data)
        },

        getPages(){
            return axios.get('/api/get-pages').then((data) => this.pages = Math.ceil(data.data / 5))
        },

        changePage(page){
            this.currentPage = page
            this.getUsers()
        }
    },

    mounted() {
        this.getUsers()
        this.getPages()
    }
}
</script>
