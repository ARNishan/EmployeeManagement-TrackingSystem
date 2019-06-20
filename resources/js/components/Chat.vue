<template>
<v-layout row>
  <v-flex xs12 sm6 offset-sm3>
    <v-card class="chat-card" dark="">
      <v-list class="mb-5">
        <v-subheader>Group Chat</v-subheader>
        <v-divider></v-divider>
        <v-list class="p-2" v-for="(item,index) in allMessages" :key="index">
          <v-layout :align-end="(user.id !== item.user.id)" :class="{'hlw': user.id !== item.user.id,'hey': user.id === item.user.id}" column >
              <div class="message-wrapper">
                <v-flex>
                  <span class="small font-italic" :class="{'green--text': user.id !== item.user.id,'blue--text': user.id === item.user.id}">{{ item.user.user_name }}</span>
                </v-flex>
                <div v-if="item.message" class="text-message-container" style="text-align: justify;">
                  <v-chip :color="(user.id===item.user_id)?'green':'red' " text-color='white'>
                      {{ item.message }}
                    </v-chip>
                </div>
                <div class="image-container">
                  <img class="nishan" v-if="item.image" :src="'/OneToOneChat/storage/app/'+item.image">
                </div>
                <v-flex class="caption font-italic" :class="{'green--text': user.id !== item.user.id,'blue--text': user.id === item.user.id}">
                  {{ item.created_at }}
                </v-flex>
            </div>
              
         </v-layout>
        </v-list>
      </v-list>
    </v-card>
  </v-flex>
  <!-- <div class="floating-div ml-4">
    <picker v-if="emoStatus" class="floating-div" set="emojione" title="Pick your emoji..." @select="onInput" />
  </div> -->
  <v-footer height="auto" fixed color="grey">
    <v-layout row >
      <!-- <v-flex xs1 class="ml-12 text-right" offset-xs1>
        <v-btn fab dark small color="pink" @click="toggleEmo">
          <v-icon>insert_emoticon</v-icon>
        </v-btn>
      </v-flex> -->
       <v-flex xs1 class="text-center">
        <!-- <file-upload post-action="messages" ref="upload" @input-file="$refs.upload.active = true" :headers="{'X-CSRF-TOKEN': token}">
          <v-icon class="mt-3">attach_file</v-icon>
        </file-upload> --> 
       </v-flex>
        <v-flex xs6  justify-center align-center>
          <v-text-field id="textArea" rows=2 label="Enter Message" v-model="message" @keyup.enter="sendMessage"></v-text-field>
        </v-flex>
        <v-flex xs4>
          <v-btn dark class="mt-3 ml-2 white--text" color="" @click="sendMessage">send</v-btn>
        </v-flex>
    </v-layout>       
  </v-footer>
</v-layout>
</template>

<script>
  //FOR USING emoji-mart-vue-fast COMPONENT 
  // import { Picker } from 'emoji-mart-vue-fast'
  // import 'emoji-mart-vue-fast/css/emoji-mart.css'
  //END FOR USING emoji-mart-vue-fast COMPONENT 
  export default {
    props:['user'],
  //   //FOR USING emoji-mart-vue-fast COMPONENT 
    // components:{
    //   Picker
    // },
  //   //END FOR USING emoji-mart-vue-fast COMPONENT
    data() {
      return {
        message:null,
        allMessages:[],
        // token:document.head.querySelector('meta[name="csrf-token"]').content,
        // emoStatus:false,
      }
    },
    methods:{
      scrollToEnd(){
        window.scrollTo(0,9999999);
      },
      sendMessage(){
        //check if there message
        if(!this.message){
          return alert('Please enter your message');
        }
        //send post request
        axios.post('messages',{
          message: this.message
        })
        .then( response => {
          console.log(response.data);
          this.message = null;
          // this.allMessages = response.data.message; 
          
          setTimeout(this.scrollToEnd,1000);
          this.fetchMessages();
        })
        .catch( error => {
          console.log("tushar");
        });
      },
      fetchMessages(){
        axios.get('messages')
        .then( response => {
            this.allMessages = response.data;
            console.log(response.data);
        })
        .catch( error => {
            // handle error
            console.log(error);
        })
      },
      // toggleEmo(){
      //   this.emoStatus = !this.emoStatus;
      // },
      // onInput(e){
      //   console.log(e);
      //   if(!e){
      //     return false;
      //   }
      //   if(!this.message){
      //     this.message = e.native;
      //   }
      //   else
      //   {
      //     this.message = this.message + e.native;
      //   }
      // }
      
    },
    mounted(){
      this.fetchMessages();
      Echo.private('lChat')
      .listen('MessageSent', (e) => {
        this.allMessages.push(e.message);
        setTimeout(this.scrollToEnd,1000);
        // this.fetchMessages();
        console.log(e.message);
        // this.fetchMessages();
      });
    },
    created: function() {
        setInterval(this.fetchMessages, 3000);
},


  }
  
</script>

<style scoped>
  .nishan {
    max-width:300px;
    max-height:200px;
  }
  .floating-div{
    position: fixed;
  }
  .hlw{
    margin-left:150px;
  }
  .hey{
    margin-right:150px;
  }
</style>


