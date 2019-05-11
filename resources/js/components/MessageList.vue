<template>
  <div class="messages">
    <v-list class="p-3" v-for="(message, index) in allMessages" :key="index">
      <div class="message-wrapper">
          <v-flex>
              <span class="small font-italic">{{ message.user.name }}</span>
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
    </v-list>
  </div>
</template>

<script>
  export default {
    props:[
      'user',
      'allMessages'
    ],
  }
</script>

<style scoped>
.chat-card {
  margin-bottom: 140px !important;
}
.floating-div {
    position: fixed;
}
.image {
    max-width: 300px;
    max-height: 200px;
}
</style>
