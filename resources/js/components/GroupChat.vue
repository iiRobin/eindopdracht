<template>
  <v-layout>
    <v-flex xs12 sm6 offset-sm3>
      <v-card class="chat-card" >
        <v-list>
          <v-subheader>
              Group Chat
          </v-subheader>
          <v-divider></v-divider>

          <message-list :user="user" :all-messages="groupMessages"></message-list>
        </v-list>
      </v-card>
    </v-flex>

    <div class="floating-div">
        <picker v-if="emoStatus" set="emojione" @select="onInput" title="Pick your emoji…" />
    </div>

    <v-footer height="auto" fixed color="grey">
      <v-layout row>
        <v-flex class="ml-2 text-right" xs1>
            <v-btn @click="toggleEmo" fab dark small color="pink">
                <v-icon>insert_emoticon</v-icon>
            </v-btn>
        </v-flex>

        <v-flex xs1 class="text-center">

          <v-btn fab dark small color="#333">
           <file-upload
             post-action="/messages"
             ref='upload'
             @input-file="$refs.upload.active = true"
             :headers="{'X-CSRF-TOKEN': token}"
           >
               <v-icon>attach_file</v-icon>
           </file-upload>
         </v-btn>

        </v-flex>

        <v-flex xs6>
          <v-text-field
            rows=2
            v-model="message"
            label="Enter message"
            single-line
            @keyup.enter="sendMessage"></v-text-field>
        </v-flex>

        <v-flex xs4>
          <v-btn dark class="mt-3 ml-2 white--text" small color="green" @click="sendMessage">Send</v-btn>
        </v-flex>
      </v-layout>
    </v-footer>

  </v-layout>
</template>

<script>
import { Picker } from 'emoji-mart-vue'
import MessageList from './MessageList'

export default {

  props:[
    'user'
  ],

  components: {
    Picker,
    MessageList
  },

  data() {
    return {
      message: null,
      emoStatus: false,
      myText: null,
      allMessages: [],
      groupMessages: [],
      token:document.head.querySelector('meta[name="csrf-token"]').content
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
        this.emoStatus = false;
        setTimeout(this.scrollToEnd, 100);
      }).catch(error => {
        console.log(error.response)
      });
    },
    fetchMessages() {
      // Get the messages
      axios.get('/messages').then(response => {
        let groupMessages = [];
        $.each(response.data, function(key, message) {
          if(message.receiver_id == null)
            groupMessages.push(message);
        });
        this.groupMessages = groupMessages;
      }).catch(error => {
        console.log(error);
      });
    },
    scrollToEnd() {
      window.scrollTo(0, 99999);
    },
    onInput(e) {
      if(!e) {
        return false;
      }
      if(!this.message) {
        this.message = e.native;
      } else {
        this.message = this.message + e.native;
      }
    },
    toggleEmo(){
        this.emoStatus= !this.emoStatus;
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

<style scoped>
.chat-card {
  margin-bottom: 140px !important;
}
.floating-div {
    position: fixed;
}
.chat-card img {
    max-width: 300px;
    max-height: 200px;
}
</style>
