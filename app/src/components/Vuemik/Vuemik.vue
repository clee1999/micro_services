<script>
export default {
    name: 'Vuemik',
    props: {
        initialValues: {
            type: Object,
            default: () => {
            },
        },
        onSubmit: {
            type: Function,
            required: true
        },
    },
    data() {
        return {
            values: this.initialValues,
        }
    },
    methods: {
        //
    },
}
</script>
<style scoped></style>
