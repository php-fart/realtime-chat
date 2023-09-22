<template>
    <div id="messages"
         ref="messages"
         class="flex flex-col space-y-4 p-3 overflow-y-auto scrollbar-thumb-blue scrollbar-thumb-rounded scrollbar-track-blue-lighter scrollbar-w-2 scrolling-touch">
        {{messages}}
    </div>

    <MessageForm :thread="thread"/>
</template>

<script>
import MessageForm from "./MessageForm.vue";
import Message from "./Message.vue"

function delay(time) {
    return new Promise(resolve => setTimeout(resolve, time));
}

export default {
    components: {
        Message, MessageForm
    },
    props: {
        thread: Number
    },
    mounted() {
        // Get all messages for the thread from the server
                this.centrifuge.rpc('thread:history', {
                    id: this.thread,
                    authToken: this.authToken
                }).then(ctx => {
                    this.messages = ctx.data.messages;
                    delay(10).then(() => this.scrollToBottom());
        })

        // Listen for new messages from the server
        this.centrifuge.on('publication', ctx => {
            if (
                ctx.channel !== 'chat' ||
                ctx.data.type !== 'message' ||
                ctx.data.thread.id !== this.thread
            ) {
                return;
            }

            this.messages.push(ctx.data.message);

            delay(10).then(() => this.scrollToBottom());
        })
    },
    methods: {
        scrollToBottom() {
            this.$refs.messages.scrollTop = this.$refs.messages.scrollHeight;
        }
    },
    data() {
        return {
            messages: []
        }
    },
}
</script>
