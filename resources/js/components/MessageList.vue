<template>
    <div class="message-list" ref="msgList">
        <ul v-if="contact">
            <li v-for="message in messages" :class="`message${message.to == contact.id ? ' sent' : ' received'}`"
                :key="message.id">
                <div class="body">
                    {{ message.body }}
                    <div class="time">{{ message.created_at | moment("from") }}</div>
                </div>
            </li>
        </ul>
    </div>
</template>

<script>
    Vue.use(require('vue-moment'));
    export default {
        props: {
            contact: {
                type: Object,
            },
            messages: {
                type: Array,
                required: true,
            }
        },
        methods: {
            scrollToBottom() {
                this.$refs.msgList.scrollTop = this.$refs.msgList.scrollHeight - this.$refs.msgList.clientHeight;
            }
        },
        mounted() {
            this.scrollToBottom();
        },
        watch: {
            contact(contact) {
                this.scrollToBottom();
            },
            messages(messages) {
                this.scrollToBottom();
            },
        },
        name: "MessageList"
    }
</script>

<style lang="scss" scoped>
    .message-list {
        background: #808080;
        height: 100%;
        max-height: 470px;
        overflow-y: scroll;

        ul {
            list-style-type: none;
            padding: 12px;

            li {
                &.message {
                    margin: 10px 0;
                    width: 100%;
                    .body {
                        max-width: 200px;
                        border-radius: 15px;
                        padding: 12px;
                        display: inline-block;
                        font-size: 16px;
                        .time {
                            font-size: 10px;
                            color: #5f5e64;
                        }
                    }
                    &.received {
                        text-align: left;
                        .body {
                            background: #d5f0bf;
                        }
                    }
                    &.sent {
                        text-align: right;
                        .body {
                            background: #ffffff;
                        }
                    }
                }
            }
        }
    }
</style>
