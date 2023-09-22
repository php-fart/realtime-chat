import {createApp} from 'vue'
import App from './App.vue'
import {Centrifuge} from "centrifuge";

const app = createApp(App)

app.use({
    install(app, options) {
        // Get the auth token from x-bearer meta tag
        const authToken = document.getElementsByName('x-bearer')[0].getAttribute('content')

        console.log(authToken)

        // Register the auth token as a global property
        app.config.globalProperties.authToken = authToken

        // Create a new Centrifuge instance
        const centrifuge = new Centrifuge('ws://127.0.0.1:8081/connection/websocket', {
            data: {authToken}
        });

        // Store the user data in the global property when the client is connected
        centrifuge.on('connected', (ctx) => {
            console.log(ctx)
            app.config.globalProperties.user = ctx.data.user
        })

        centrifuge.connect();

        // Register the centrifuge instance as a global property
        app.config.globalProperties.centrifuge = centrifuge
    }
})

app.mount('#app')
