<template>
    <div class="pokemon-header">
        <v-container>
            <v-form validate-on="submit lazy" @submit.prevent="onSubmit">
                <v-sheet class="d-md-flex flex-wrap pokemon-filter">
                    <v-sheet class="flex-1-0 ma-2 pa-2">
                        <v-text-field
                            label="Nome"
                            v-model="filters.name"
                            hint="Faça sua pelo nome do Pokemon"
                        />
                    </v-sheet>
                    <v-sheet class="flex-1-0 ma-2 pa-2">
                        <v-select
                            label="Tipos"
                            v-model="filters.types"
                            :items="allTypes.value"
                            item-title="name"
                            item-value="id"
                            chips
                            multiple
                            hint="Faça sua por um ou mais tipos de Pokemon"
                        />
                    </v-sheet>
                    <v-sheet class="flex-1-0 ma-2 pa-2">
                        <v-btn block type="submit" prepend-icon="mdi-magnify">
                            Filtrar
                        </v-btn>
                    </v-sheet>
                </v-sheet>
            </v-form>
        </v-container>
    </div>
</template>

<script setup>
import { onMounted, reactive } from "vue";

import TypeDataService from "@/js/services/TypeDataService.js";

const allTypes = reactive({});
const filters = reactive({
    name: null,
    types: null,
});

const emit = defineEmits(["submit"]);

const onSubmit = async () => {
    console.log("teste");
    emit("submit", filters);
};

const retrieveTypes = async () => {
    TypeDataService.getAll()
        .then((response) => (allTypes.value = response.data))
        .catch((e) => console.log(e));
};

onMounted(() => {
    retrieveTypes();
});
</script>

<style scoped lang="scss">
.pokemon {
    &-header {
        background-color: #072ac8;
        width: 100%;
        z-index: 1;

        @media only screen and (min-width: 960px) {
            position: fixed;
        }
    }

    &-filter {
        background-color: transparent;

        .v-sheet {
            background-color: transparent;
        }

        .v-btn {
            background-color: #fdd85d;
            height: 56px;
            color: #f8f9fa;
            font-weight: bold;
        }

        :deep(.v-field),
        :deep(.v-field__field),
        :deep(.v-field__input) {
            background-color: #fff;
        }

        :deep(.v-messages) {
            color: #fff;
        }
    }
}
</style>
