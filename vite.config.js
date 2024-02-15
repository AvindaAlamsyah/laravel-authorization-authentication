import { defineConfig } from "vite";
import laravel from "laravel-vite-plugin";
import path from "path";

export default defineConfig({
    plugins: [
        laravel({
            input: [
                "resources/css/app.css",
                "resources/scss/external/app.scss",
                "resources/scss/internal/app.scss",
                "resources/js/app.js",
                "resources/js/external/app.js",
                "resources/js/internal/app.js",
            ],
            refresh: true,
        }),
    ],
    resolve: {
        alias: {
            "~assets": path.resolve(__dirname, "node_modules"),
        },
    },
});
