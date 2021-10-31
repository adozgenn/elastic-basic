<template>
    <v-app :style="{background: $vuetify.theme.themes.light.background}">
        <v-container>
            <v-row>
                <v-col cols="12" md="3" class="mb-4"  v-for="(item, key) in items" :key="key">
                    <v-hover v-slot:default="{ hover }">
                        <v-card
                                max-width="250"
                                max-heith="250"
                                align="center"
                        >
                            <v-img
                                    src="01.jpg"
                                    width="150"
                                    height="150"
                            ></v-img>
                            <v-card-text>
                                <div class="text-subtitle-1">
                                    {{ item.price }}
                                </div>

                                <div class="red--text">
                                    {{ item.title }}
                                </div>

                                <div class="blue--text">
                                    {{ item.brand }}
                                </div>

                                <div class="red--text">
                                    {{ item.discount_rate }}
                                </div>

                                <div class="blue--text">
                                    {{ item.created_at }}
                                </div>
                            </v-card-text>
                            <v-expand-transition>
                                <div
                                        v-if="hover"
                                        class="d-flex transition-fast-in-fast-out red v-card--reveal display-3 white--text"
                                        style="height: 100%;"
                                >
                                    <v-btn outlined color="white"> Detail</v-btn>
                                </div>
                            </v-expand-transition>
                        </v-card>
                    </v-hover>
                </v-col>
            </v-row>
        </v-container>
    </v-app>
</template>

<script>
    // @ is an alias to /src

    export default {
        name: 'Products',
        props: {
            items: {
                type: Array,
                required: true
            }
        },
        components: {

        },
        computed:{
            theme(){
                return (this.$vuetify.theme.dark) ? 'dark' : 'light'
            }
        }
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