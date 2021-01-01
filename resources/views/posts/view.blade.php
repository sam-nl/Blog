@extends('main')

@section('title')
View post
@endsection

@section('links')
<li class ="links"><a href="/users/show/{{session('profile')['id']}}">Back to profile</a></li>
@endsection

@section('content')
<article>
    <div class = "middle">
        
        <div class = "middle" id="app">
            <p>{{$user->username}} posted: {{$post->content}}</p>
            <hr>
            <input type="text" v-model="newComment" >
            <button @click="createComment">Add comment</button>
            <hr>
            <div v-for="comment in comments">
                <div v-if="comment.post_id==={{$post->id}}">
                    <div class="article-comment">
                        
                        <p>@{{comment.user.username}}</p>
                        <p>:  @{{comment.content}}</p>
                    </div>
                </div>
            <div>
        </div>
    </div>
</article>

@endsection

@section('script')
    <script>
        
        const app = new Vue({
            el: '#app',
            data: {
                comments: [],
                newComment: '',
                post: {{ $post->id }},
                user: {{Auth::user()->id}},
            },
            
            methods: {
                createComment: function(){
                    axios.post("/api/posts/"+this.post+"/comments",
                    {
                        comment: this.newComment,
                        user: this.user,
                        post: this.post,
                    })
                    .then(response=>
                    {
                        console.log(this.newComment);
                        this.comments.push(response.data);
                        this.newComment = "";
                        this.getComments();
                    })
                    .catch(response=>
                    {
                        console.log(response);
                    })
                },
                getComments: function(){
                    axios.get("/api/posts/"+this.post+"/comments")
                .then(response=>{
                    this.comments = response.data;
                })
                .catch(response=>{
                    console.log(response);
                })
                }
            },
            mounted(){
                this.getComments();
                
            },
        })
    </script>
@endsection