<template>
  <div class="panel panel-default">
    <div class="panel-body mb-3">
      <ul class="chat">
        <li class="left clearfix" v-for="message in mergedMessages" :key="message.id">
          <div class="chat-body clearfix d-flex">
            <div>
              <img
                v-profile-picture="message.user"
                alt="Profile picture"
                height="32"
                width="32"
                class="rounded-circle mr-2"
              />
            </div>
            <div class="header">
              <strong class="primary-font">{{ message.user.name }}</strong>
              <p v-for="m in message.messages" :key="m.id">{{ m }}</p>
            </div>
          </div>
        </li>
      </ul>
    </div>
    <div class="panel-footer">
      <div class="input-group">
        <input
          id="btn-input"
          type="text"
          name="message"
          class="form-control input-sm"
          placeholder="Type your message here..."
          v-model="newMessage"
          @keyup.enter="sendMessage"
        />
        <span class="input-group-btn">
          <button class="btn btn-watermelon" id="btn-chat" @click="sendMessage">Send</button>
        </span>
      </div>
    </div>
  </div>
</template>

<script>
// https://pusher.com/tutorials/chat-laravel

let vm;

function chatScrollDown() {
  let container = document.querySelector(".panel-body");
  container.scrollTop = container.scrollHeight;
}

export default {
  created() {
    vm = this;
    this.fetchMessages();
  },
  props: {
    user: { type: Object, required: true },
  },
  data() {
    return {
      newMessage: "",
      messages: [],
    };
  },
  methods: {
    fetchMessages() {
      axios
        .get("/messages")
        .then((response) => {
          this.messages = response.data;
        })
        .then(() => {
          chatScrollDown();
        });
    },
    sendMessage() {
      if (this.newMessage.length === 0) return;
      let message = {
        user: this.user,
        message: this.newMessage,
      };
      this.messages.push(message);
      axios.post("/messages", message).then((response) => {
        this.newMessage = "";
        chatScrollDown();
      });
    },
  },
  directives: {
    profilePicture: function (el, binding) {
      let url = binding.value.profile_picture
        ? `http://127.0.0.1:8000/storage/${binding.value.profile_picture}`
        : `https://ui-avatars.com/api/?name=${binding.value.name}&color=7F9CF5&background=EBF4FF`;
      el.src = url;
    },
  },
  computed: {
    mergedMessages() {
      const messages = this.messages;
      let newMessagesArray = [];
      let mergedMessagesArray = [];
      messages.forEach(function (message, i) {
        mergedMessagesArray.push(message.message);
        try {
          if (message.user.id !== messages[i + 1].user.id) {
            newMessagesArray.push({
              user: message.user,
              messages: mergedMessagesArray,
            });
            mergedMessagesArray = [];
          }
        } catch (error) {
          newMessagesArray.push({
            user: message.user,
            messages: mergedMessagesArray,
          });
        }
      });
      return newMessagesArray;
    },
  },
};

Echo.private("chat").listen("MessageSent", (e) => {
  async function pushMessage() {
    vm.messages.push({
      message: e.message.message,
      user: e.user,
    });
  }

  (async () => {
    await pushMessage();

    // Scrolls the chat for you if you were at the most recent message
    let elem = $(".panel-body");
    if (elem[0].scrollHeight - elem.scrollTop() <= elem.outerHeight() + 100) {
      chatScrollDown();
    }
  })();
});
</script>