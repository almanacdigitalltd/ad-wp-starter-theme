import { defineConfig } from "vite";

export default defineConfig({

    plugins: [
        {
            name: "php",
            handleHotUpdate({ file, server }) {
                if (file.endsWith(".php")) {
                server.ws.send({ type: "full-reload", path: "*" });
                }
            },
        }
    ]
})