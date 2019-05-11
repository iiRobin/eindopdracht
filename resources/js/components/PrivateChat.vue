<template>
  <v-layout row>
    <v-flex class="online-users" xs3>
      <v-list>
          <v-list-tile
            v-for="friend in friends"
            :color="(friend.id == activeFriend) ? 'green' : ''"
            :key="friend.id"
            @click="activeFriend = friend.id"
          >
            <v-list-tile-action>
              <v-icon :color="(onlineFriends.find(onlineFriends => onlineFriends.id == friend.id)) ? 'green' : 'red'">
                account_circle
              </v-icon>
            </v-list-tile-action>

            <v-list-tile-content>
              <v-list-tile-title>{{ friend.name }}</v-list-tile-title>
            </v-list-tile-content>

            <!-- <v-list-tile-avatar>
              <img :src="friend.avatar">
            </v-list-tile-avatar> -->
          </v-list-tile>
        </v-list>

    </v-flex>

    <div class="floating-div">
        <picker v-if="emoStatus" set="emojione" @select="onInput" title="Pick your emoji…" />
    </div>

    <v-flex id="privateMessageBox" class="mb-5" xs9>

      <div class="messages">
        <v-list class="p-3" v-for="(message, index) in allMessages" :key="index">
          <v-layout :align-end="(user.id !== message.user.id)" column>
            <div class="message-wrapper">
                <v-flex>
                    <span class="caption font-italic">{{ message.user.name }}</span>
                </v-flex>

                <div v-if="message.message" class="text-message-container">
                    <v-chip :color="(user.id === message.user_id) ? 'green' : 'red'" text-color="white">
                        {{ message.message }}
                    </v-chip>
                </div>

                <div class="image-container">
                    <img class="image" v-if="message.image" :src="'/storage/' + message.image" alt="">
                </div>

                <v-flex class="caption font-italic">
                    Send at {{ message.created_at | formatTime }}
                </v-flex>
            </div>
          </v-layout>
        </v-list>

      </div>

      <p v-if="typingFriend.name">{{ typingFriend.name }} is typing...</p>

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
                :post-action="'/chat/private/'+activeFriend"
                ref='upload'
                v-model="files"
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
              @keydown="onTyping"
              @keyup.enter="sendMessage"
            ></v-text-field>
          </v-flex>

          <v-flex xs4>
            <v-btn dark class="mt-3 ml-2 white--text" small color="green" @click="sendMessage">Send</v-btn>
          </v-flex>
        </v-layout>
      </v-footer>

    </v-flex>

  </v-layout>
</template>

<script>
  import { Picker } from 'emoji-mart-vue'

  export default {
    props:[
      'user'
    ],

    components: {
      Picker
    },

    data () {
      return {
        message: null,
        files: [],
        emoStatus: false,
        activeFriend: null,
        typingFriend: {},
        typingClock: null,
        allMessages: [],
        onlineFriends: [],
        users: [],
        token:document.head.querySelector('meta[name="csrf-token"]').content
      }
    },

    computed: {
      friends() {
        return this.users.filter((user) => {
            return user.id !== this.user.id;
        });
      }
    },

    watch: {
      activeFriend(val){
          this.fetchMessages();
      },
      files: {
        deep: true,
        handler() {
          let success = this.files[0].success;
          if(success) {
              this.fetchMessages();
          }
        }
      },
    },

    methods: {
      onTyping() {
        Echo.private('privatechat.' + this.activeFriend).whisper('typing', {
            user: this.user
        })
      },

      sendMessage() {
        //check if there message
        if(!this.message) {
            return alert('Please enter message');
        }
        if(!this.activeFriend) {
            return alert('Please select friend');
        }

        axios.post('/chat/private/' + this.activeFriend, {message: this.message}).then(response => {
            this.message = null;
            this.fetchMessages();
            setTimeout(this.scrollToEnd, 100);
        });
      },

      fetchMessages() {
          if(!this.activeFriend){
             return alert('Please select friend');
          }

          axios.get('/chat/private/' + this.activeFriend).then(response => {
              this.allMessages = response.data;
          });
      },

      fetchUsers() {
          axios.get('/chat/users').then(response => {
              this.users = response.data;
              this.activeFriend = this.friends[0].id;
          });
      },

      scrollToEnd(){
          document.getElementById('privateMessageBox').scrollTo(0, 99999);
      },

      onInput(e) {
        if(!e) {
          return false;
        }
        if(!this.message) {
          this.message=e.native;
        } else {
          this.message=this.message + e.native;
        }
      },

      toggleEmo(){
          this.emoStatus= !this.emoStatus;
      }

    },

    mounted(){

    },

    created(){
        this.fetchUsers();

        Echo.join(`pchat`)
        .here((users) => {
            console.log(users);
            this.onlineFriends = users;
        })
        .joining((user) => {
            this.onlineFriends.push(user);
            console.log(user.name);
        })
        .leaving((user) => {
            this.onlineFriends.splice(this.onlineFriends.indexOf(user), 1);
            console.log(user.name);
        });

        Echo.private('privatechat.' + this.user.id)
        .listen('PrivateMessageSent',(e) => {
            this.activeFriend = e.message.user_id;
            this.fetchMessages();
            setTimeout(this.scrollToEnd, 100);
        })
        .listenForWhisper('typing', (e) => {
            if(e.user.id == this.activeFriend) {
              this.typingFriend = e.user;

              if(this.typingClock)
                clearTimeout();

              this.typingClock = setTimeout(() => {
                                   this.typingFriend = {};
                                 }, 6000);
            }
        });
    }

  }
</script>

<style scoped>
.online-users, .messages {
    overflow-y: scroll;
    height: 100vh;
}
.floating-div {
    position: fixed;
    z-index: 999;
}
.image {
    max-width: 300px;
    max-height: 200px;
}
</style>
