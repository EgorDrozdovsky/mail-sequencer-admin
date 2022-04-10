<template>
    <div class="panel-block">
        <div class="panel__header">
            <h2 class="h2 panel__header-title">User list</h2>
            <button class="btn panel__header-btn"><img src="/img/icons/add.svg" alt="Plus" class="btn-icon">Add user</button>
        </div>
        <input type="text" placeholder="Search" class="input panel-search">
        <div class="panel__table">
            <div class="panel__table-row">
                <p class="panel__table-row-cell table-title active">ID</p>
                <p class="panel__table-row-cell table-title">Email</p>
                <p class="panel__table-row-cell table-title">Total sequence</p>
                <p class="panel__table-row-cell table-title"></p>
            </div>
            <div class="panel__table-row" v-for="user in users">
                <p class="panel__table-row-cell">{{ user.id }}</p>
                <p class="panel__table-row-cell">{{ user.email }}</p>
                <p class="panel__table-row-cell">15</p>
                <div class="panel__table-row-cell">
                    <img src="/img/icons/edit.svg" alt="Delete" class="panel__table-row-cell-icon">
                    <img src="/img/icons/delete.svg" alt="Delete" class="panel__table-row-cell-icon">
                </div>
            </div>
        </div>
        <div class="panel__pagination">
            <p class="panel__pagination-item" v-for="n in pages" :class="{active: currentPage === n}" @click="changePage(n)">{{ n }}</p>
        </div>
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
        }
    },

    methods: {
        getUsers(){
            return axios.post('/api/get-users', {
                page: this.currentPage
            }).then((data) => this.users = data.data)
        },

        getPages(){
            return axios.get('/api/get-pages').then((data) => this.pages = Math.ceil(data.data / 2))
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
