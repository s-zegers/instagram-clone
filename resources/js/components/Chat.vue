<template>
  <div class="panel panel-default">
    <div class="panel-body mb-3">
      <ul class="chat">
        <li class="left clearfix" v-for="message in messages" v-bind:key="message.id">
          <div class="chat-body clearfix">
            <div class="header">
              <strong class="primary-font">{{ message.user.name }}</strong>
            </div>
            <p>{{ message.message }}</p>
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
          <button class="btn btn-primary" id="btn-chat" @click="sendMessage">Send</button>
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