<style scoped lang="scss">
h4 {
    margin-top: 20px !important;
}

h2 {
    color: #fa7f57;
}

a {
    color: white !important;
}
</style>
<template>
    <div>
        <v-container style="height: 100vh">
            <Vuemik
                :initialValues="{
                    test: 2,
                    paas: 2,
                    check: true,
                    textrsar: 'sssss',
                    textrar: 'tsfd',
                    tedt: 'testt',
                    number: 21,
                }"
                :onSubmit="handleSubmit"
            >
                <Field name="test" class="formfield" component="select">
                    <option class="test" id="qsd" value="1">test</option>
                    <option value="2">test2</option>
                </Field>

                <Field name="check" component="checkbox" />

                <Field name="textrar" component="textarea" />

                <Field name="tedt" component="text" />

                <Field name="number" component="number" />

                <Field name="paas" component="password" />

                <button type="submit">submit</button>
            </Vuemik>
        </v-container>
    </div>
</template>

<script>
import Vuemik from "../Vuemik/Vuemik.vue";
import Field from "../Vuemik/Field.vue";
export default {
    name: "TestVueMik",
    components: {
        Vuemik,
        Field,
    },
    methods: {
        handleSubmit: (e) => {
            window.console.log(e);
        },
    },
};
</script>
