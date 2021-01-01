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
            <input type="text" v-model="newComment" required>
            <button @click="createComment">Add comment</button>
            @error('comment')<div class = "err"><p>{{$message}}<p></div>@enderror
            <hr>
            <div v-for="comment in comments">
                <div v-if="comment.post_id==={{$post->id}}">
                    <div class="article-comment">
                        
                        <p>@{{comment.user.username}}</p>
                        <p>:  @{{comment.content}}</p>
                        <div v-if="comment.user_id==={{Auth::user()->id}}">
                            <button @click="deleteComment(comment)">Delete comment</button>
                        </div>
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
                editComment: '',
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
                        if (response.data==0) {
                            alert('Comment is blank');
                        }else if(response.data==1){
                            alert('Comment is limited to 50 characters');
                        }else {
                            alert('added');
                            console.log(response);
                            this.comments.push(response.data);
                            this.newComment = "";
                            this.getComments();
                        }      
                        
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
                },
                deleteComment: function(comment){
                    axios.delete("/api/comments/"+comment.id+"/delete")
                .then(response=>{
                    this.getComments();
                })
                .catch(response=>{
                    console.log(response);
                })
                },
            },
            mounted(){
                this.getComments();
                
            },
        })
    </script>
@endsection