<template>
    <Form @add="addItem" />
    <ul>
        <Item
            v-for="item in items"
            :key="item.id"
            :item="item"
            @remove="removeItem"
        />
    </ul>
</template>

<script>
    import Form from './Form.vue';
    import Item from './Item.vue';

    export default {
        components: {
            Form,
            Item
        },
        data() {
            return {
                items: []
            }
        },
        methods: {
            removeItem(itemId) {
                this.items = this.items.filter(item => item.id !== itemId);
            },
            addItem(newItem) {
                this.items.push(newItem);
            },
            loadItems(items) {
                items.forEach(item => {
                    item.createdAt = new Date(item.createdAt);
                    item.dueDate = new Date(item.dueDate);
                    this.addItem(item);
                });
            },
            getItems() {
                const mockedItems = [
                    {
                        "id": 1,
                        "title": "Kupić mleko",
                        "completed": false,
                        "createdAt": "2025-08-21 10:30:00",
                        "dueDate": "2025-08-22 18:00:00",
                        "priority": "high",
                        "category": "zakupy",
                        "notes": "Kupić też jajka"
                    },
                    {
                        "id": 2,
                        "title": "Kupić mleko",
                        "completed": false,
                        "createdAt": "2025-08-21 10:30:00",
                        "dueDate": "2025-08-22 18:00:00",
                        "priority": "high",
                        "category": "zakupy",
                        "notes": "Kupić też jajka"
                    }
                ];

                return mockedItems;
            }
        },
        mounted() {
            this.loadItems(
                this.getItems()
            );
        }
    }
</script>

<style scoped>
    ul {
        background-color: #f9f9f9;
        padding: 10px;
        list-style-type: none;
        margin: 0px;
    }
</style>
