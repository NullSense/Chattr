<template>
    <div class="chat">
        <ContactList :contacts="contacts" @selectedContact="getMessages"/>
        <Conversation :contact="selectedContact" :messages="messages" @sendMessage="sendMessage"/>
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
            getMessages(contact) {
                axios.get(`/messages/${contact.id}`)
                    .then((response) => {
                        this.messages = response.data;
                        this.selectedContact = contact;
                    }).catch(error => {
                    console.log(error.response)
                });
            },
            sendMessage(message) {
                this.messages.push(message);
            },
            getContacts() {
                axios.get('/contacts')
                    .then((response) => {
                        this.contacts = response.data;
                        // show the first conversation in the list
                        this.getMessages(this.contacts[0]);
                    }).catch(error => {
                    console.log(error.response)
                });
            }
        },
        mounted() {
            this.getContacts();
            // Poll the messages every 5s
            setInterval(() => {
                this.getMessages(this.selectedContact)
            }, 5*1000);
        },
        components: {Conversation, ContactList}
    }
</script>

<style lang="scss" scoped>
    .chat {
        display: flex;
        border-radius: 15px;
        background: -webkit-linear-gradient(to right, #91EAE4, #86A8E7, #7F7FD5);
        background: linear-gradient(to right, #91EAE4, #86A8E7, #7F7FD5);
        overflow:hidden;
    }
</style>
