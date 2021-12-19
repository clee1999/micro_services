<script>
export default {
    name: 'Field',
    props: {
        name: {
            type: String,
            required: true
        },
        as: {
            type: String,
            default: 'text'
        },
    },
}
</script>
<style scoped></style>
