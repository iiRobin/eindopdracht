<template>
  <v-layout>
    <v-flex xs12 sm6 offset-sm3>
      <v-card class="mb-4" dark="">
        <v-list>
          <v-subheader>
            Group Chat
          </v-subheader>
          <v-divider></v-divider>
          <v-list-tile class="p-3" v-for="(item, index) in 32" :key="index">

            <v-layout :align-end="(index%2==0)" column>
              <v-flex>
                <v-layout column>
                  <v-flex>
                    <span class="small font-italic">Joren Frans</span>
                  </v-flex>

                  <v-flex>
                    <v-chip :color="(index%2==0) ? 'red' : 'green'" text-color="white">
                      <v-list-tile-content>
                        Hi buddy, this is a sample message.
                      </v-list-tile-content>
                    </v-chip>
                  </v-flex>

                  <v-flex class="caption font-italic">
                    2018-02-12
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
          <v-text-field rows=2 label="Enter message" single-line></v-text-field>
        </v-flex>

        <v-flex>
          <v-btn dark class="mt-3 ml-2 white--text" small color="green">Send</v-btn>
        </v-flex>
      </v-layout>
    </v-footer>

  </v-layout>
</template>

<script>
export default {
}
</script>

<style lang="css" scoped>
</style>
