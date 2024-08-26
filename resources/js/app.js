import App from "./App.vue";
import { createApp } from "vue";
import "vuetify/styles";
import "@mdi/font/css/materialdesignicons.css";
import { createVuetify } from "vuetify";
import * as components from "vuetify/components";
import * as directives from "vuetify/directives";
import router from "./router.js";

const vuetify = createVuetify({
    components,
    directives,
    icons: {
        defaultSet: "mdi",
    },
});

createApp(App).use(vuetify).use(router).mount("#app");
