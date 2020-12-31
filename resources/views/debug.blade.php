<head>
    <script src="https://cdn.jsdelivr.net/npm/vue@2/dist/vue.js"></script>
</head>
<body>
    <div id="app">
        <input v-model="message">
        <p>Message is: @{{ message }}</p>
    </div>
</body>  
<script>
    var app = new Vue({
        el: '#app',
        data: {
            message: '',
        },   
    })
</script>
