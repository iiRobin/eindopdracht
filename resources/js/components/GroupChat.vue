<template>
  <v-layout>
    <v-flex xs12 sm6 offset-sm3>
      <v-card class="mb-5 chat-card" dark="">
        <v-list>
          <v-subheader>
            Group Chat
          </v-subheader>
          <v-divider></v-divider>
          <v-list-tile class="p-3" v-for="(message, index) in allMessages" :key="index">

            <v-layout :align-end="(user.id !== message.user.id)" column>
              <v-flex>
                <v-layout column>
                  <v-flex>
                    <span class="small font-italic">{{ message.user.name }}</span>
                  </v-flex>

                  <v-flex>
                    <v-chip :color="(user.id === message.user.id) ? 'red' : 'green'" text-color="white">
                      <v-list-tile-content>
                        {{ message.message }}
                      </v-list-tile-content>
                    </v-chip>
                  </v-flex>

                  <v-flex class="caption font-italic">
                    {{ message.created_at }}
                  </v-flex>
                </v-layout>
              </v-flex>
            </v-layout>

          </v-list-tile>
        </v-list>
      </v-card>
    </v-flex>

    <v-footer height="auto" fixed color="grey">
      <v-layout row>
        <v-flex xs6 offset-xs3 justify-center align-center>
          <v-text-field rows=2
                        v-model="message"
                        label="Enter message"
                        single-line
                        @keyup.enter="sendMessage"></v-text-field>
        </v-flex>

        <v-flex>
          <v-btn dark class="mt-3 ml-2 white--text" small color="green" @click="sendMessage">Send</v-btn>
        </v-flex>
      </v-layout>
    </v-footer>

  </v-layout>
</template>

<script>
export default {

  props:[
    'user'
  ],

  data() {
    return {
      message: null,
      allMessages: []
    }
  },

  methods: {
    sendMessage() {
      // Check if there is a message
      if(!this.message){
        return alert('Please enter a message');
      }

      // Send post request.
      axios.post('/messages', {message: this.message}).then(response => {
        this.fetchMessages();
        this.message = null;
        setTimeout(this.scrollToEnd, 100);
      }).catch(error => {
        console.log(error.response)
      });
    },
    fetchMessages() {
      // Get the messages
      axios.get('/messages').then(response => {
        this.allMessages = response.data;
      }).catch(error => {
        console.log(error.response)
      });
    },
    scrollToEnd() {
      window.scrollTo(0, 99999);
    }
  },

  mounted() {

  },

  created(){
      this.fetchMessages();

      Echo.private('chat')
      .listen('MessageSent',(e)=>{
          this.fetchMessages();
          setTimeout(this.scrollToEnd,100);
      });
  }

}
</script>

<style lang="css" scoped>
.chat-card {
  margin-bottom: 140px !important;
}
</style>
