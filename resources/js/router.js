import { createWebHistory, createRouter } from "vue-router";
import PokemonList from "./pages/Pokemons/List.vue";
import PokemonItem from "./pages/Pokemons/Item.vue";

const routes = [
    {
        path: "/",
        name: "pokemons",
        component: () => PokemonList,
    },
    {
        path: "/pokemons/:id",
        name: "pokemon-item",
        component: () => PokemonItem,
    },
];

const router = createRouter({
    history: createWebHistory(),
    routes,
});

export default router;
