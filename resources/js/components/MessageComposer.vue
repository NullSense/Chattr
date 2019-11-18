<template>
    <div class="message-composer">
        <textarea v-model="message" @keypress.enter="sendMessage" placeholder="Type a message"></textarea>
        <button v-on:click="sendMessage" class="btn btn-outline-secondary">Send</button>
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
            sendMessage(e) {
                // resets cursor position
                e.preventDefault();

                if (this.message != '') {
                    this.$emit('sendMessage', this.message.trim());
                    // clear input
                    this.message = '';
                }
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
        position: relative;
        align-items: center;

        textarea {
            background-color: rgba(0, 0, 0, 0.3) !important;
            width: 100%;
            height: 50%;
            border-radius: 15px;
            resize: none;
            border: 1px solid lightgray;
            margin: 0 10px;
            line-height: 2.5em;
            text-align: left;
        }

        textarea::placeholder {
            text-align: left;
            line-height: 2.5em;
            padding-left: 1em;
        }

        button {
            background-color: rgba(0, 0, 0, 0.3) !important;
            border-radius: 15px;
            color: white !important;
            cursor: pointer;

            .button:hover {
                background-color: #3e8e41
            }
        }
    }
</style>
