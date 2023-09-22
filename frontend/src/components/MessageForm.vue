<template>
    <div class="border-t-2 border-gray-200 px-4 pt-4 mb-2 sm:mb-0">
        <div class="relative flex">
            <input v-model="message"
                   type="text"
                   @keyup.enter="sendMessage"
                   placeholder="Write your message!"
                   class="w-full focus:outline-none focus:placeholder-gray-400 text-gray-600 placeholder-gray-600 pl-6 bg-gray-200 rounded-md py-3">
            <div class="absolute right-0 items-center inset-y-0 hidden sm:flex" v-if="message.length > 1">
                <button type="button"
                        @click="sendMessage"
                        class="inline-flex items-center justify-center rounded-lg px-4 py-3 transition duration-500 ease-in-out text-white bg-blue-500 hover:bg-blue-400 focus:outline-none">
                    <span class="font-bold">Send</span>
                </button>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    props: {
        thread: Number
    },
    data() {
        return {
            message: ''
        }
    },
    methods: {
        sendMessage() {
            this.centrifuge.rpc('thread:publish', {
                id: this.thread,
                message: this.message,
                authToken: this.authToken
            }).then(() => {
                this.message = ''
            })
        }
    }
}
</script>
