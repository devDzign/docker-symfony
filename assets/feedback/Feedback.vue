<template>
    <div>
        <ul v-if="feedback.length">
            <li :key="f['@id']" v-for="f in feedback">
                {{ f.author }}
                <star-rating :rating="f.rating" :read-only="true"></star-rating>
                {{ f.comment }}
            </li>
        </ul>
        <p v-else>
            No feedback yet !
        </p>

        <p v-if="sent">
            Thanks for rating this talk!
        </p>

        <form @submit.prevent="onSubmit" v-else>
            <div class="form-group">
                <label>Author</label>
                <input class="form-control" name="author" placeholder="Author" v-model="author">
                <small class="form-text text-muted" id="emailHelp">We'll never share your email with anyone else.</small>
            </div>

            <star-rating v-model="rating"></star-rating>

            <div class="form-group">
                <label for="exampleTextarea">Comment</label>
                <textarea class="form-control" id="exampleTextarea" name="comment" placeholder="This Talk was..." rows="3"
                          v-model="comment"></textarea>
            </div>
            <hr>

            <input :disabled="!author || !rating || !comment" class="btn btn-primary" type="submit" value="post">
        </form>
    </div>
</template>

<script>
    export default {
        props: ['sessionId'],
        data() {
            return {
                feedback: [],
                author: '',
                rating: 0,
                comment: '',
                sent: false
            }
        },
        created() {
            this.fetchFeedback();
        },
        methods: {
            fetchFeedback() {
                fetch('/api/sessions/' + this.sessionId + '/feedback')
                    .then(response => response.json())
                    .then(data => this.feedback = data['hydra:member'])
            },

            onSubmit() {
                const {sessionId, author, rating, comment} = this;
                console.log('click');
                fetch('/api/feedback', {
                    method: 'POST',
                    headers: {'Content-Type': 'application/ld+json'},
                    body: JSON.stringify({session: '/api/sessions/' + sessionId, author, rating, comment})
                })
                    .then(() => {
                        this.sent = true;
                        this.fetchFeedback();
                    })
            }
        }
    }
</script>
