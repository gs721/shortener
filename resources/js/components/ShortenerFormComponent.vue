<template>
    <div class="shortener-form">
        <div class="form-group">
            <label for="shortener-url">Ссылка</label>
            <input v-model="url" class="form-control" id="shortener-url">
        </div>
        <button :disabled="url.length === 0" type="submit" class="btn btn-primary" @click="send">Отправить</button>

        <div v-if="shortUrl" class="card mt-4 p-3">
            {{shortUrl}}
        </div>
    </div>
</template>

<script>
    import axios from 'axios'

    export default {
        data() {
            return {
                url: '',
                shortUrl: null
            }
        },
        methods: {
            async send() {
                const res = await axios.post('/api/shortener', {
                    url: this.url
                })
                this.shortUrl = res.data.shortUrl
            }
        }
    }
</script>

<style scoped>
    .shortener-form {
        width: 400px;
        margin: 40px auto;
    }
</style>
