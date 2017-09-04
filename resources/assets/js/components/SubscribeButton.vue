<template>

    <div class="subscribe-button" v-if="subscribers !== nulls">
        {{ subscribers }} {{ pluralize('subscriber', subscribers) }} &nbsp;
        <button class="btn btn-xs btn-default" type="button" v-if="CanSubscribe" @click.prevent="handle">{{ userSubscribed ? 'Unsubscribe' : 'Subscribe'}}</button>
    </div>

</template>

<script>

    import pluralize from 'pluralize';
    export default{

        data(){
            return{
                subscribers: null,
                userSubscribed: false,
                CanSubscribe:false
            }
        },

        props:{
            channelSlug: null
        },

        methods: {
            pluralize,

            getSubscriptionStatus(){
                this.$http.get('/subscription/' + this.channelSlug).then( response => {

                    this.subscribers = response.body.data.count;
                    this.userSubscribed = response.body.data.user_subscribed;
                    this.CanSubscribe = response.body.data.can_subscribe;

                });
            },

            handle(){
                if(this.userSubscribed){
                    this.unsubscribe();
                }else{
                    this.subscribe();
                }
            },

            subscribe(){

                this.$http.post('/subscription/' + this.channelSlug).then(response => {

                    this.userSubscribed = true;
                    this.subscribers++;

                })


            },
            unsubscribe(){

                this.$http.delete('/subscription/' + this.channelSlug).then(response => {

                    this.userSubscribed = false;
                    this.subscribers--;

                })
            }
        },

        mounted(){

            this.getSubscriptionStatus();

        }
    }
</script>