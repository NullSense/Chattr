<template>
    <div class="message-composer">
        <textarea v-model="message" @keypress.enter="send" placeholder="Type a message"></textarea>
        <button v-on:click="send" class="btn btn-outline-secondary">Send</button>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                message: ''
            };
        },
        methods: {
            send(e) {
                // resets cursor position
                e.preventDefault();

                if (this.message == '') {
                    return;
                }

                this.$emit('send', this.message.trim());
                // clear input
                this.message = '';
            }
        },
        name: "MessageComposer"
    }
</script>

<style lang="scss" scoped>
    .message-composer {
        display: flex;
        flex: 1;
        padding: 10px;
        border: 1px solid #aaaaaa;
        position: relative;
        align-items: center;

        textarea {
            width: 100%;
            border-radius: 15px;
            resize: none;
            border: 1px solid lightgray;
            margin: 0 10px;
        }

        button {
            border-radius: 15px;
        }
    }
</style>
