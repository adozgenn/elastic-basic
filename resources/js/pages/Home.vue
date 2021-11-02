<template>
  <v-app :style="{background: $vuetify.theme.themes.light.background}">
      <template>
          {{query_params}}
          <v-container fluid>
              <v-data-iterator
                      :items="items"
                      hide-default-footer
              >
                  <template v-slot:header>
                      <v-toolbar
                              dark
                              color="blue darken-3"
                              class="mb-1"
                      >
                          <v-text-field
                                  v-model="search"
                                  flat
                                  solo-inverted
                                  hide-details
                                  prepend-inner-icon="mdi-magnify"
                                  label="Search"
                          ></v-text-field>
                          <template>
                              <v-spacer></v-spacer>
                              <v-select
                                      v-model="sortBy"
                                      flat
                                      solo-inverted
                                      hide-details
                                      :items="keys"
                                      item-text="text"
                                      item-value="value"
                                      prepend-inner-icon="mdi-magnify"
                                      label="Sırala"
                              ></v-select>
                          </template>
                      </v-toolbar>
                  </template>

                  <template v-slot:default="props">
                     <products :items="props.items"></products>
                  </template>

              </v-data-iterator>
          </v-container>
      </template>
  </v-app>
</template>

<script>
    import Products from "./Products";
    import {mapGetters} from "vuex";
    export default {
        components: {Products},
        data () {
            return {
                search: '',
                sortBy: 'brand.keyword-asc',
                keys: [
                    {text: 'En Düşük Fiyat', value:'price-asc'},
                    {text: 'En Yüksek Fiyat', value:'price-desc'},
                    {text: 'En Yüksek İndirim Oranı', value:'discount_rate-desc'},
                    {text: 'En Yeni Ürünler', value:'created_at-desc'},
                ],
                items: [],
            }
        },
        computed: {
            ...mapGetters({query_params: 'query_params'}),
        },
        watch: {
            query_params: {
                handler: function(){
                    this.getProducts();
                },
                deep: true
            },
            search(s, oldS){
                if(s !== oldS && (s.length > 2 || s.length === 0)) {
                    setTimeout(() => {
                        this.getProducts();
                    }, 300)
                }
            },
            sortBy(){
                this.getProducts();
            }
        },
        created(){
           this.getProducts();
        },
        methods: {
            createQueryParams(){
                const {brand, color, size} = this.query_params;
                return `?search=${this.search ?? ''}&sort=${this.sortBy}&brand=${brand}&color=${color}&size=${size}`;
            },
            getProducts(){
                axios.get("/api/products"+this.createQueryParams()).then(res=>{
                    this.items = res.data;
                });
            },
        },
    }
</script>
<style>
.v-card--reveal {
  align-items: center;
  bottom: 0;
  justify-content: center;
  opacity: .5;
  position: absolute;
  width: 100%;
}
</style>