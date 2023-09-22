<template>
    <div class="chat-message">
        <div class="flex items-end" :class="{'justify-end': isOwnMessage}">
            <div class="flex flex-col space-y-2 text-xs mx-2 order-2 items-start">
                <div>
          <span class="px-4 py-2 rounded-lg inline-block rounded-bl-none"
                :class="{'bg-blue-600 text-white': isOwnMessage, 'bg-gray-300 text-gray-600': !isOwnMessage}">
             {{ message.message }}
          </span>
                </div>
                <span>
           {{ message.username }}
        </span>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    props: {
        message: Object
    },
    computed: {
        isOwnMessage() {
            return this.message.username === this.user.username
        }
    }
}
</script>
