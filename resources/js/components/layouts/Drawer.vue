<template>
    <v-navigation-drawer
        permanent
        absolute
        app
        dark
        clipped
        color="blue-grey darken-4"
        height="100%"
    >
        <v-container fluid>
            <v-row align="center">
                <v-col
                        class="d-flex"
                >
                    <v-select
                            :items="brands"
                            v-model="queryParams.brand"
                            label="Marka Seçimi"
                            solo
                    ></v-select>
                </v-col>
            </v-row>
            <v-row align="center">
                <v-col
                        class="d-flex"
                >
                    <v-select
                            :items="colors"
                            v-model="queryParams.color"
                            item-text="text"
                            item-value="value"
                            label="Renk Seçimi"
                            solo
                    ></v-select>
                </v-col>
            </v-row>
            <v-row align="center">
                <v-col
                        class="d-flex"
                >
                    <v-select
                            :items="sizes"
                            v-model="queryParams.size"
                            label="Beden Seçimi"
                            solo
                    ></v-select>
                </v-col>
            </v-row>
            <v-row align="center">
                <v-col
                        class="d-flex"
                >
                    <v-btn
                            @click="reset"
                            rounded
                            color="error"
                            dark
                    >
                        Sıfırla
                    </v-btn>
                    <v-btn
                            @click="goFilter"
                            rounded
                            color="primary"
                            dark
                    >
                        Filtrele
                    </v-btn>

                </v-col>
            </v-row>
        </v-container>
    </v-navigation-drawer>
</template>

<script>
import {mapGetters} from "vuex";
export default {
    data() {
        return {
            queryParams: {
                brand: '',
                color: '',
                size: ''
            },
            brands: ['Altınyıldız', 'Koton', 'Mavi', 'Network', 'Fabrika'],
            colors: [{text: 'Yeşil', value: 'green'},{text: 'Mavi', value: 'blue'},
                    {text: 'Gri', value: 'gray'},{text: 'Kırmızı', value: 'red'}],
            sizes: ['XS', 'S', 'M', 'L', 'XL'],
            right: null
        };
    },
    created() {
        this.$store.commit("SET_QUERY_PARAMS", {
            brand: '',
            color: '',
            size: ''
        })
    },
    methods: {
        reset(){
            this.$store.commit("SET_QUERY_PARAMS", {
                brand: '',
                color: '',
                size: ''
            })
        },
        goFilter(){
            this.$store.commit("SET_QUERY_PARAMS", this.queryParams)
        }
    }
};
</script>

<style scoped>
.nav-link {
    text-decoration: none;
    font-size: 0.8125rem;
    font-weight: 500;
    line-height: 1rem;
    color: aliceblue;
}
</style>
