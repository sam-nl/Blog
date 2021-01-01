<head>
    <script src="https://cdn.jsdelivr.net/npm/vue@2/dist/vue.js"></script>
</head>
<body>
   
      <!-- kebab-case in HTML -->
      <blog-post post-title="hello!"></blog-post>
</body>  
<script>
    var app = new Vue({
        Vue.component('blog-post', {
        // camelCase in JavaScript
        props: ['postTitle'],
      })
        el: '#app',
        data: {
            message: '',
        },   
    })
</script>
