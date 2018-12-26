<template>

  <div class="wysiwyg">
    <ul class="post-list">
      <li v-for="post in postData" key="post.id">
        {{ post.title.rendered }}
      </li>
    </ul>
  </div>

</template>

<script>

  export default {
    name: 'HelloWorld',
    props: {
      msg: String
    },
    data() {
      return {
        postData: [],
        wpData: wpData
      };
    },
    mounted() {

      // Fetch posts from the rest api.

      fetch(`${this.wpData.rest_url}/wp/v2/posts`)
        .then(response => response.json())
        .then(data => this.postData = data);

    }
  }

</script>
