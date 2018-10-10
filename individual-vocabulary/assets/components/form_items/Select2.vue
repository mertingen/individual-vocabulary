<template>
    <select class="select2 col-3">
    </select>
</template>

<script>

    import 'select2';
    import 'select2/dist/css/select2.css';

    export default {
        name: "select2",
        props: {
            options: Array,
            selected: String
        },
        data() {
            return {}
        },
        mounted: function () {
            let vm = this;
            $(this.$el)
                .select2(
                    {
                        data: this.options,
                        placeholder: "Select an option",
                    }
                ).val(this.selected)
                .trigger('change')
                .on('change', function () {
                    vm.$emit('input', this.value)
                });

        },
        watch: {
            options: function (options) {
                $(this.$el).empty().select2({data: options});
                $(this.$el)
                    .val(this.selected)
                    .trigger('change');
            },
            selected: function (value) {
                /*$(this.$el)
                    .val(value)
                    .trigger('change');*/
            },
        },
        methods: {},
        created: function () {
        },
        destroyed: function () {
            $(this.$el).off().select2('destroy')
        }
    }
</script>

<style scoped>

</style>