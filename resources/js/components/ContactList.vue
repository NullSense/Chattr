<template>
    <div class="contact-list">
        <ul>
            <li v-for="contact in contacts" :key="contact.id" @click="selectContact(contact)"
                :class="{ 'selected-contact': contact == selectedContact}">
                <div class="avatar">
                    <img :src="contact ? contact.avatar : 'https://via.placeholder.com/100'" alt="avatar">
                </div>
                <div class="contact">
                    <p class="name">{{ contact.name }}</p>
                    <p class="email">{{ contact.email }}</p>
                </div>
            </li>
        </ul>
    </div>
</template>

<script>
    export default {
        name: "ContactList",
        props: {
            contacts: {
                type: Array,
                default: []
            }
        },
        data() {
            return {
                // Select the first contact by default if not empty
                selectedContact: this.contacts.length ? this.contacts[0] : null
            };
        },
        methods: {
            // Sets the selected contact ID
            selectContact(contact) {
                this.selectedContact = contact;
                this.$emit('selectedContact', contact);
            }
        },
    }
</script>

<style lang="scss" scoped>
    .contact-list {
        flex: 2;
        max-height: 100%;
        height: 700px;
        overflow-y: scroll;

        ul {
            list-style-type: none;
            padding-left: 0;

            li {
                display: flex;
                padding: 2px;
                height: 80px;
                position: relative;
                cursor: pointer;

                &.selected-contact {
                    background-color: #82ccdd;

                }

                .avatar {
                    flex: 1;
                    display: flex;
                    align-items: center;
                    margin-left: 8px;

                    img {
                        width: 40px;
                        height: 40px;
                        border-radius: 50%;
                        margin: 0 auto;
                        border:1.5px solid green;
                    }
                }

                .contact {
                    flex: 3;
                    font-size: 10px;
                    overflow: hidden;
                    display: flex;
                    flex-direction: column;
                    justify-content: center;
                    margin-left: 16px;

                    p {
                        margin: 0;

                        &.name {
                            font-weight: bold;
                        }
                    }
                }
            }
        }
    }
</style>
