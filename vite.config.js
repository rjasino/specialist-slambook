import { defineConfig } from "vite";
import laravel from "laravel-vite-plugin";
import tailwindcss from "@tailwindcss/vite";

export default defineConfig({
    plugins: [
        laravel({
            input: [
                "resources/css/app.css",
                "resources/css/main.css",
                "resources/css/navigation.css",
                "resources/css/footer.css",
                "resources/css/auth.css",
                "resources/css/slambook.css",
                "resources/css/dashboard.css",
                "resources/css/buttons.css",
                "resources/js/app.js",
                "resources/js/bootstrap.js",
            ],
            refresh: true,
        }),
        tailwindcss(),
    ],
});
