<template>
    <v-icon :class="`icon icon-${typeName}`" :title="typeName" />
</template>

<script setup>
import { computed } from "vue";

const props = defineProps({
    type: {
        type: Object,
        default: null,
    },
});

const typeName = computed(() => props.type?.name?.toLowerCase() || "");
</script>

<style lang="scss" scoped>
.icon {
    mask-size: contain !important;
    width: 30px;
    height: 30px;

    &-grass {
        -webkit-mask: url(@/icons/types/grass.svg) no-repeat center;
        mask: url(@/icons/types/grass.svg) no-repeat center;
        background: #5fbd58;
    }

    &-bug {
        -webkit-mask: url(@/icons/types/bug.svg) no-repeat center;
        mask: url(@/icons/types/bug.svg) no-repeat center;
        background: #92bc2c;
    }

    &-dark {
        -webkit-mask: url(@/icons/types/dark.svg) no-repeat center;
        mask: url(@/icons/types/dark.svg) no-repeat center;
        background: #595761;
    }

    &-dragon {
        -webkit-mask: url(@/icons/types/dragon.svg) no-repeat center;
        mask: url(@/icons/types/dragon.svg) no-repeat center;
        background: #0c69c8;
    }

    &-electric {
        -webkit-mask: url(@/icons/types/electric.svg) no-repeat center;
        mask: url(@/icons/types/electric.svg) no-repeat center;
        background: #f2d94e;
    }

    &-fire {
        -webkit-mask: url(@/icons/types/fire.svg) no-repeat center;
        mask: url(@/icons/types/fire.svg) no-repeat center;
        background: #fba54c;
    }

    &-fairy {
        -webkit-mask: url(@/icons/types/fairy.svg) no-repeat center;
        mask: url(@/icons/types/fairy.svg) no-repeat center;
        background: #ee90e6;
    }

    &-fighting {
        -webkit-mask: url(@/icons/types/fighting.svg) no-repeat center;
        mask: url(@/icons/types/fighting.svg) no-repeat center;
        background: #d3425f;
    }

    &-flying {
        -webkit-mask: url(@/icons/types/flying.svg) no-repeat center;
        mask: url(@/icons/types/flying.svg) no-repeat center;
        background: #a1bbec;
    }

    &-ghost {
        -webkit-mask: url(@/icons/types/ghost.svg) no-repeat center;
        mask: url(@/icons/types/ghost.svg) no-repeat center;
        background: #5f6dbc;
    }

    &-grass {
        -webkit-mask: url(@/icons/types/grass.svg) no-repeat center;
        mask: url(@/icons/types/grass.svg) no-repeat center;
        background: #5fbd58;
    }

    &-ground {
        -webkit-mask: url(@/icons/types/ground.svg) no-repeat center;
        mask: url(@/icons/types/ground.svg) no-repeat center;
        background: #da7c4d;
    }

    &-ice {
        -webkit-mask: url(@/icons/types/ice.svg) no-repeat center;
        mask: url(@/icons/types/ice.svg) no-repeat center;
        background: #75d0c1;
    }

    &-normal {
        -webkit-mask: url(@/icons/types/normal.svg) no-repeat center;
        mask: url(@/icons/types/normal.svg) no-repeat center;
        background: #a0a29f;
    }

    &-poison {
        -webkit-mask: url(@/icons/types/poison.svg) no-repeat center;
        mask: url(@/icons/types/poison.svg) no-repeat center;
        background: #b763cf;
    }

    &-psychic {
        -webkit-mask: url(@/icons/types/psychic.svg) no-repeat center;
        mask: url(@/icons/types/psychic.svg) no-repeat center;
        background: #fa8581;
    }

    &-rock {
        -webkit-mask: url(@/icons/types/rock.svg) no-repeat center;
        mask: url(@/icons/types/rock.svg) no-repeat center;
        background: #c9bb8a;
    }

    &-steel {
        -webkit-mask: url(@/icons/types/steel.svg) no-repeat center;
        mask: url(@/icons/types/steel.svg) no-repeat center;
        background: #5695a3;
    }

    &-water {
        -webkit-mask: url(@/icons/types/water.svg) no-repeat center;
        mask: url(@/icons/types/water.svg) no-repeat center;
        background: #539ddf;
    }
}
</style>
