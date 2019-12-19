<template>
    <ul>
        <li v-for="result in searchResults">{{result.name}}</li>
    </ul>
</template>
<script>
    export default {
        props: {
            searchResults: Array
        },
        mounted() {
            console.log('Component mounted.')
        }
    };
</script>
