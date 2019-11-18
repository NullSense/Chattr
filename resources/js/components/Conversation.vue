<template>
    <div class="conversation">
        <ContactBar :contact="contact"/>
        <MessageList :contact="contact" :messages="messages"/>
        <MessageComposer @sendMessage="sendMessage"/>
    </div>
</template>

<script>
    import ContactBar from "./ContactBar";
    import MessageList from "./MessageList";
    import MessageComposer from "./MessageComposer";

    export default {
        name: "Conversation",
        props: {
            contact: {
                type: Object,
                default: null
            },
            messages: {
                type: Array,
                default: []
            }
        },
        methods: {
            sendMessage(body) {
                if (!this.contact) {
                    return;
                }

                axios.post('/messages', {
                    to: this.contact.id,
                    body: body
                }).then((response) => {
                    this.$emit('sendMessage', response.data)
                }).catch(error => {
                    console.log(error.response)
                })
            }
        },
        components: {ContactBar, MessageList, MessageComposer}
    }
</script>

<style lang="scss" scoped>
    .conversation {
        flex: 6;
        display: flex;
        flex-direction: column;
        background-color: rgba(0,0,0,0.3) !important;
    }
</style>

