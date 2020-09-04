<template>
  <div class="card mb-3">
    <img v-if="post.image" class="card-img-top" :src="'/storage/' + post.image" alt="Card header" />
    <div class="card-body">
      <h5 class="card-title">{{ post.title }}</h5>
      <p class="card-text" v-format-links="post.description"></p>
    </div>
    <div class="card-footer text-muted">
      Posted by
      <a :href="showRoute">{{ post.user.name }}</a>
      <div class="float-right">
        <span v-human-time-diff="post.created_at"></span>
        <form
          v-if="post.user.id == user.id"
          :action="deleteRoute"
          method="POST"
          class="d-inline"
          ref="form"
        >
          <input type="hidden" name="_token" :value="csrf" />
          <input type="hidden" name="_method" value="DELETE" />
          <a @click="submitForm($event)">❌</a>
        </form>
      </div>
    </div>
  </div>
</template>

<script>
import moment from "moment";
export default {
  props: {
    post: { type: Object, required: true },
    user: { type: Object, required: true },
    showRoute: { type: String, required: true },
    deleteRoute: { type: String, required: true },
  },
  data: () => ({
    csrf: document
      .querySelector('meta[name="csrf-token"]')
      .getAttribute("content"),
  }),
  methods: {
    submitForm(event) {
      event.preventDefault();
      this.$refs.form.submit();
    },
  },
  directives: {
    humanTimeDiff: function (el, binding) {
      el.innerText = moment(binding.value).fromNow();
    },
    formatLinks: function (el, binding) {
      el.innerHTML = binding.value.replace(/(\b(https?|ftp):\/\/[-A-Z0-9+&@#\/%?=~_|!:,.;]*[-A-Z0-9+&@#\/%=~_|])/gim, '<a href="$1">$1</a>');
    },
  },
};
</script>
