<template>
    <div class="container">
        HOME VUE
    </div>
</template>

<script>
export default {
    name: 'App',

    data() {
        return{
            apiUrl: '/api/posts',
            posts: null
        }  
    },

    methods: {
        getApi(){
            axios.get(this.apiUrl)
            .then(response => {

                this.posts = response.data;
                console.log(this.posts);
            })
        }
    },

    mounted() {
        this.getApi();
    }
}
</script>

<style>

</style>