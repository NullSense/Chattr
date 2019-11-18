<template>
    <div class="contact-bar">
        <div class="avatar">
            <img :src="contact ? contact.avatar: 'https://via.placeholder.com/100'" alt="Contact avatar">
        </div>
        <div class="name">
            <h1>{{ contact ? contact.name : 'Select a contact' }}</h1>
            <h3>{{ contact ? contact.email : 'Select a contact' }}</h3>
        </div>
    </div>
</template>

<script>
    export default {
        name: "ContactBar",
        props: {
            contact: {
                type: Object,
                default: null
            }
        }
    }
</script>

<style lang="scss" scoped>
    .contact-bar {
        display: flex;
        padding: 10px;

        .avatar {
            display:inline-block;

            img {
                border-radius: 50%;
                width: 100px;
                height: 100px;
                border:1.5px solid green;
            }
        }
        .name {
            flex-direction: column;
            align-items: center;
            margin: auto;

            h1 {
                font-size: 25px;
            }
            h3 {
                font-size: 15px;
            }
        }
    }
</style>
