<template>
    <div>
        <div>Hello {{ name }}!</div>
        Licznik {{ counter }}
        <br/>
        <button @click="increment">inkrementuj</button>
    </div>
</template>

<script>
    export default {
        props: {
            name: String
        },
        data() {
            return {
                counter: 0
            }
        },
        methods: {
            increment() {
                this.counter++;
            }
        }
    }
</script>
