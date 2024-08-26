<template>
    <list-filter @submit="onFilter"></list-filter>

    <v-container class="max-width pokemon-container">
        <div class="pokemon-list">
            <v-list lines="two" v-if="pokemons.value?.length > 0">
                <v-list-item
                    v-for="pokemon in pokemons.value"
                    :key="pokemon.id"
                    @click="goToItem(pokemon.id)"
                >
                    <template v-slot:prepend>
                        <div class="pokemon-types">
                            <pokemon-type-icon
                                v-for="(type, index) in pokemon.types"
                                :key="index"
                                :type="type"
                            />
                        </div>
                    </template>
                    <v-row align="center" justify="center">
                        <v-col>
                            <!--eslint-disable vue/no-v-text-v-html-on-component-->
                            <v-list-item-title
                                v-text="$filters.capitalize(pokemon.name)"
                            />
                        </v-col>
                        <v-col cols="auto">
                            <v-btn
                                variant="plain"
                                icon="mdi-menu-right"
                            ></v-btn>
                        </v-col>
                    </v-row>
                </v-list-item>
            </v-list>
            <v-empty-state
                v-else
                image="images/psyduck.png"
                size="200"
                text-width="250"
            >
                <template v-slot:media>
                    <v-img class="mb-8" />
                </template>

                <template v-slot:title>
                    <div class="text-h6 text-high-emphasis">
                        Nenhum resultado encontrado
                    </div>
                </template>
            </v-empty-state>

            <v-row justify="center">
                <v-col cols="8">
                    <v-pagination
                        v-on:update:modelValue="retrievePokemons"
                        v-model="page"
                        :length="listPagesNumber"
                    ></v-pagination>
                </v-col>
            </v-row>
        </div>
    </v-container>
</template>

<script setup>
import PokemonDataService from "@/js/services/PokemonDataService.js";
import PokemonTypeIcon from "@/js/components/Type.vue";
import ListFilter from "@/js/components/Filter.vue";
import { computed, onMounted, reactive, ref } from "vue";
import * as $filters from "@vue/compat";
import router from "@/js/router.js";

const pokemons = reactive({});
const meta = reactive({});
const filters = reactive({
    name: null,
    types: null,
});
let page = ref(1);

const listPagesNumber = computed(() => meta.value?.last_page || 1);

const retrievePokemons = async (currentPage) => {
    PokemonDataService.getAll(currentPage, filters)
        .then(function (response) {
            pokemons.value = response.data;
            meta.value = response.meta;
        })
        .catch((e) => console.log(e));
};

const onFilter = async (currentFilters) => {
    page.value = 1;
    filters.name = currentFilters.name;
    filters.types = currentFilters.types;

    await retrievePokemons(1);
};

const goToItem = (id) => {
    router.push({ name: "pokemon-item", params: { id: id } });
};

onMounted(() => {
    retrievePokemons(page.value);
});
</script>

<style scoped lang="scss">
.pokemon {
    &-list {
        border-radius: 16px;
        padding: 30px;
        background-color: #fff;

        @media only screen and (min-width: 960px) {
            margin-top: 160px;
        }
    }

    &-container {
        .v-list-item {
            border-bottom: 3px;
            position: relative;

            &:hover {
                background-color: rgba(#6613d0, 0.2);
                cursor: pointer;
                border-radius: 5px !important;

                &:after {
                    content: "";
                    position: absolute;
                    left: 10px;
                    top: 50%;
                    transform: translateX(-50%);
                }
            }
        }
    }

    &-types {
        min-width: 80px;

        .icon {
            margin-right: 10px;
        }
    }
}
</style>
