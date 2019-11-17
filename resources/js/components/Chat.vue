<template>
    <div class="chat">
        <ContactList :contacts="contacts" @selected="startConversation"/>
        <Conversation :contact="selectedContact" :messages="messages" @new="pushMessage"/>
    </div>
</template>

<script>
    import Conversation from './Conversation';
    import ContactList from './ContactList';

    export default {
        props: {
            user: {
                type: Object,
                required: true
            }
        },
        data() {
            return {
                contacts: [],
                selectedContact: null,
                messages: []
            };
        },
        methods: {
            startConversation(contact) {
                axios.get(`/messages/${contact.id}`)
                    .then((response) => {
                        this.messages = response.data;
                        this.selectedContact = contact;
                    }).catch(error => {
                    console.log(error.response)
                });
            },
            pushMessage(message) {
                this.messages.push(message);
            },
        },
        mounted() {
            axios.get('/contacts')
                .then((response) => {
                    this.contacts = response.data;
                    // show the first conversation in the list
                    this.startConversation(this.contacts[0]);
                }).catch(error => {
                console.log(error.response)
            });
            // Poll the messages every 5s
            setInterval(() => {
                this.startConversation(this.selectedContact)
            }, 5*1000);
        },
        components: {Conversation, ContactList}
    }
</script>

<style lang="scss" scoped>
    .chat {
        display: flex;
    }
</style>
