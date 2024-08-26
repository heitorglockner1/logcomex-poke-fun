<template>
    <v-container class="max-width pokemon-container">
        <v-toolbar class="mb-5">
            <template v-slot:prepend>
                <v-btn @click="$router.go(-1)" icon="mdi-arrow-left" />
            </template>
        </v-toolbar>
        <v-table class="pokemon-detail">
            <thead>
                <tr>
                    <th class="text-left"></th>
                    <th class="text-left">Valor</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Nome</td>
                    <td>{{ pokemon.value?.name }}</td>
                </tr>
                <tr>
                    <td>Altura</td>
                    <td>{{ pokemon.value?.height }}</td>
                </tr>
                <tr>
                    <td>Peso</td>
                    <td>{{ pokemon.value?.weight }}</td>
                </tr>
                <tr v-if="types.value?.length > 0">
                    <td
                        class="pokemon-type-label"
                        :rowspan="types.value.length"
                    >
                        Tipos
                    </td>
                    <td class="pokemon-type">{{ types.value[0].name }}</td>
                </tr>
                <slot v-if="types.value?.length > 1">
                    <tr
                        v-for="(type, index) in types.value.slice(1)"
                        :key="index"
                    >
                        <td class="pokemon-type">
                            {{ type.name }}
                        </td>
                    </tr>
                </slot>
            </tbody>
        </v-table>
    </v-container>
</template>

<script setup>
import PokemonDataService from "@/js/services/PokemonDataService.js";
import { useRoute, useRouter } from "vue-router";
import { onMounted, reactive } from "vue";

const router = useRouter();
const route = useRoute();

const pokemon = reactive({});
const types = reactive({});

const retrievePokemon = async (pokemonId) => {
    PokemonDataService.get(pokemonId)
        .then(function (response) {
            pokemon.value = response.data;
            types.value = response.data.types;
        })
        .catch((e) => console.log(e));
};

const getCurrentId = async () => {
    await router.isReady();
    retrievePokemon(route.params.id);
};

onMounted(() => {
    getCurrentId();
});
</script>

<style scoped>
.v-table
    .v-table__wrapper
    > table
    > tbody
    > tr:not(:last-child)
    > td.pokemon-type-label {
    border-bottom: 0 none;
}
</style>
