<template>
    <div class="form-field">
        <label :for="fieldId">{{ label }}</label>
        <input type="text" :id="fieldId" v-model="value" :placeholder="placeholder" />
        <span class="error" v-if="isValid === false">{{ assertion.message }}</span>
    </div>
</template>

<script>
    export default {
        props: {
            modelValue: 'string',
            label: 'string',
            placeholder: 'string',
            assertion: {
                type: Object,
                validator(value) {
                    return
                        value.regex instanceof RegExp
                        && typeof value.message === 'string';
                }
            },
        },
        data() {
            return {
                fieldId: 'field-' + this._uid,
                isValid: null,
            }
        },
        methods: {
            validate() {
                this.isValid = this.assertion && this.assertion.regex.test(this.value ? this.value : '');
                this.$emit("validation", this.isValid);
            }
        },
        computed: {
            value: {
                get() { return this.modelValue },
                set(val) { this.$emit("update:modelValue", val) }
            },
        },
        watch: {
            value() {
                this.validate();
            },
        }
    }
</script>

<style scoped>
    div.form-field {
        margin-bottom: 10px;
        input {
            display: block;
            width: 100%;
            padding: 5px;
            box-sizing: border-box;
            resize: vertical;
        }
        span.error {
            color: red;
        }
    }
</style>
