import http from "../http-common";

class PokemonDataService {
    getAll(page, filters) {
        return http
            .get("/pokemons", {
                params: {
                    page: page,
                    name: filters.name || null,
                    types: filters.types,
                },
            })
            .then((res) => res.data);
    }

    get(id) {
        return http.get(`/pokemons/${id}`).then((res) => res.data);
    }

    search() {
        return http.get(`/pokemons?name=${title}`);
    }
}

export default new PokemonDataService();
