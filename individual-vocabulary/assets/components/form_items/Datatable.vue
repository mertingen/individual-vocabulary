<template>
    <table class="table table-striped table-bordered">
        <thead>
        <tr>
            <th>Word</th>
            <th>Mean</th>
        </tr>
        </thead>
        <tfoot>
        <tr>
            <th>Word</th>
            <th>Mean</th>
        </tr>
        </tfoot>
        <tbody>
        <tr v-for="item in items">
            <td>{{ item.foreignWord }}</td>
            <td>{{ item.knownMean }}</td>
        </tr>
        </tbody>
    </table>

</template>

<script>

    import '../../js/datatables/jquery.dataTables.js';
    import '../../js/datatables/dataTables.bootstrap4.js';

    export default {
        name: "datatable",
        props: {
            items: Array
        },
        data() {
            return {}
        },
        mounted: function () {
            //$(this.$el).DataTable();
            //$('td.dataTables_empty').hide();
        },
        created: function () {

        },
        watch: {
            items: function (items) {
                //$(this.$el).DataTable();
                /*$(this.$el).DataTable({
                    "data": items,
                    "columns": [
                        {"data": "foreignWord"},
                        {"data": "knownMean"}
                    ]
                });*/
            }
        },
        destroyed: function () {
            $(this.$el).DataTable().destroy();
        },
        methods: {}
    }
</script>

<style scoped>
    .table {
        width: 100%;
    }

</style>